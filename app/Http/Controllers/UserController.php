<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Models\Organizations;
use App\Models\GroupLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;
use Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Carbon;
Use Exception;
use Illuminate\Support\Facades\Crypt;
use Config;
use Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    public function index(Request $request)
    {
        if (isset($request->company_name) && !empty($request->company_name)) {
            $organizationID = $request->company_name;
        } else {
            $organizationID = '-1';
        }

        $users = User::select('users.*', 'user_types.name as ut_name')
            ->leftJoin('user_types', 'user_types.id', '=', 'users.role')
            ->orderBy('users.fullname')
            ->orderByRaw('FIELD(users.role, 1, 2, 3)')
            ->get();

        $pageTitle = "Users List";
        $addlink = route('users.create');
        return view('users.index', compact('pageTitle', 'users', 'organizationID', 'addlink'));
    }



    public function edit(Request $request)
    {
        try {
            // Determine if an ID is provided for editing
            $user_id = null;
            if ($request->has('userID')) {
                $id = $request->userID;
                $user_id = Crypt::decrypt($id);
                $users = User::findOrFail($user_id); // Fetch the user by ID
            } else {
                $users = new User(); // Initialize a new User instance for adding
            }

            // Fetch user types that are active
            $user_type_data = UserType::where('is_active', 1)->get();

            $pageTitle = $user_id ? "Edit User" : "Add User"; // Set the page title based on the context
            return view('users.add_user', compact('pageTitle', 'users', 'user_type_data'));
        } catch (DecryptException $e) {
            // Handle the error if the ID decryption fails
            return redirect()->route('users.index')->with('error', 'Invalid user ID.');
        } catch (\Exception $e) {
            // Handle any other errors
            return redirect()->route('users.index')->with('error', 'An error occurred while retrieving the user data.');
        }
    }



public function storeOrUpdate(Request $request)
{
    try {

        // Validate the request data
        $request->validate([
            'firstname' => 'required|min:1|max:100',
            'email' => 'required|email',
            'role' => 'required',
            'phone' => 'required|regex:/^[6-9]{1}[0-9]{9}/',
            'is_active_status' => 'required',
            'profile_picture' => 'sometimes|nullable|mimes:jpg,jpeg,png|max:512', // max 500KB
        ]);

        // Check if the email already exists for updates
        if ($request->id) {
            $isExistEmail = User::where('username', $request->email)->where('id', '!=', $request->id)->exists();
        } else {
            $isExistEmail = User::where('username', $request->email)->exists();
        }

        if ($isExistEmail) {
            return redirect()->route('users.index')->with('error', "Duplicate email not allowed");
        }

        // Handle file upload
        $profileFilename = null;
        if ($request->hasFile('profile_picture')) {
            $profileFilename = uniqid() . '_' . time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('assets/uploads'), $profileFilename);
        }

        // Determine whether to create or update a user
        if ($request->id) {
            // Update existing user
            $user = User::findOrFail($request->id);
        } else {
            // Create new user
            $user = new User();
        }

        // Set user data
        $user->fullname = $request->firstname;
        $user->role = $request->role;
        $user->username = $request->email;
        $user->phone = $request->phone;
        $user->active = $request->is_active_status;

        if ($profileFilename) {
            $user->profile_photo = $profileFilename;
        }

        // Handle client data if available
        if ($request->has('client_data') && !empty($request->input('client_data'))) {
            $clientData = $request->input('client_data', []);
            $user->projects_mapped = json_encode($clientData);
        } else {
            // Clear client data if not provided
            $user->projects_mapped = null;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', "Success! Details are saved successfully");

    } catch (\Exception $e) {
        dd($e->getmessage());
        // Log the error or handle it as necessary
        return redirect()->route('users.index')->with('error', "An error occurred while saving the details");
    }
}



	public function showForgetPasswordForm()
      {

         return view('frontend.auth.forgetPassword');
      }


	  public function submitForgetPasswordForm(Request $request)
      {



		try{

			$nof_customer=DB::table('users')->where('email',$request->email)->where('is_active_status','1')->get()->count();
          $customers=DB::table('users')->where('email',$request->email)->where('is_active_status','1')->get()->first();


		  if($nof_customer==0){

			return back()->with('error', 'Email id does not exist.');

		  }

		  else{


					if(isset($customers->email) == $request->email){

					$request->validate([
					'email' => 'required|email|exists:users',
					]);

					$token = Str::random(64);


					$password_resets=DB::table('password_resets')->insert([
					'email' => $request->email,
					'token' => $token,
					]);



					$email = $request->email;
					$offer = [
					'token' => $token
					];


try{
Mail::to($email)->send(new ResetPassword($offer));
	return back()->with('success', 'We have e-mailed your password reset link.');

}
catch (\Exception $exception) {
 return back()->with('error', 'Something Went Wrong. Mail is not delivered.');
}






					}
					else{
					return back()->with('error', 'Something Went Wrong!');
					}


		  }


		  }
		catch (\Exception $exception) {
		return redirect()->back()->with('error', "Something went wrong.". $exception->getMessage()??'');
		}
      }
	    public function showResetPasswordForm($token) {
			try{
			$reset_data=DB::table('password_resets')->where('token',$token)->get()->first();
			if($reset_data){
				return view('frontend.auth.forgetPasswordLink', ['token' => $token,'email'=>$reset_data->email??'']);
			}
			else{
			}

			}
			catch (\Exception $exception) {
			return redirect()->back()->with('error', "Something went wrong.". $exception->getMessage()??'');
			}
      }

	   public function submitResetPasswordForm(Request $request)
      {

		  try{

          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);


          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token,
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = DB::table('users')
		  ->where('email', $request->email)
          ->update([
		  'password' => Hash::make($request->password)
		  ]);

		  if($user){
          $DeleteToken=DB::table('password_resets')->where(['email'=> $request->email])->delete();
		  }
			return redirect('/')->with('message', 'Your password has been changed!. Please login with new credentials.');

		}
			catch (\Exception $exception) {
			return redirect()->back()->with('error', "Something went wrong.". $exception->getMessage()??'');
			}
      }

      public function changePasswordForm()
      {

           $pageTitle="Change Password";
          return view('changepassword.change_password', compact('pageTitle'));
      }

      public function saveChangePassword(Request $request)
      {
          // Validate the request
          $validatedData = $request->validate([
              'password' => 'required|min:8|max:16|confirmed',
          ]);

          try {
              // Get the currently authenticated user
              $user = User::find(auth()->user()->id);

              // Update the user's password
              $user->password = Hash::make($request->password);
              $user->password_updated_at =Carbon\Carbon::now();
              $user->save();

              // Redirect with success message
              return redirect()->back()->with('toast_success', 'Password changed successfully.');
          } catch (\Exception $e) {
              // Redirect with error message
              return redirect()->back()->with('toast_error', 'Failed to change password. Please try again.');
          }
      }

      public function showProfileForm(){

        try{
        $users_data=User::get()->where("id",auth()->user()->id)->first();
        $pageTitle="Update Profile";
        return view('users.edit_profile',compact('users_data','pageTitle'));
    } catch (\Exception $e) {
        // Redirect with error message
        return redirect()->back()->with('toast_error', 'Failed to '.$pageTitle.'. Please try again.');
    }

}

public function updateProfile(Request $request)
{
    // Validate request data
    $request->validate([
        'firstname' => 'required|min:1|max:100',
        'email' => 'required|email',
        'phone' => 'required|regex:/^[6-9]{1}[0-9]{9}$/',
        'profile' => 'nullable|mimes:jpg,jpeg,png|max:2048', // Optional file, max size 2MB
    ]);

    try {

        // Get the authenticated user
        $user = User::findOrFail(auth()->user()->id);
        // Handle profile picture upload
           if ($request->hasFile('profile')) {
            $profileFile = $request->file('profile');
            $profileFilename = uniqid() . '_' . time() . '.' . $profileFile->extension();

            // Store the file in storage/app/uploads/
            $profileFilePath = $profileFile->storeAs('uploads', $profileFilename, 'public');

            // Store the full path in the database, including 'storage/app/' prefix
            $user->profile_photo = $profileFilePath;
        }

        // Update user details
        $user->fullname = $request->firstname;
        $user->username = $request->email;
        $user->phone = $request->phone;

        // Save user details
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    } catch (\Exception $e) {
        // Log error message
        \Log::error('Profile update failed: ' . $e->getMessage());

        // Redirect back with error message
        return redirect()->back()->with('error', 'Failed to update profile. Please try again.'. $e->getMessage());
    }

}


public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Decrypt the user ID
        $user = User::findOrFail(Crypt::decrypt($request->userId));

        // Hash the password before saving
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);

    } catch (Exception $e) {
        // Log the error for debugging purposes
        \Log::error('Password update failed: ' . $e->getMessage());

        // Return a JSON response with an error message
        return response()->json(['success' => false, 'message' => 'An error occurred while updating the password.'], 500);
    }
}

public function toggleStatus(Request $request)
{
    try {
        $userId = Crypt::decrypt($request->input('userId'));
        $status = $request->input('status');

        $user = User::find($userId);
        if ($user) {
            $user->active = $status;
            $user->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404); // User not found
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return response()->json(['success' => false, 'error' => 'Invalid user ID'], 400);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => 'An error occurred while toggling status'], 500);
    }
}
public function destroy($id)
{
    try {
        // Decrypt the user ID
        $userId = Crypt::decrypt($id);

        // Find the user by ID and delete
        $user = User::findOrFail($userId);
        $user->delete();

        // Redirect or return success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    } catch (Exception $e) {
        // Handle exceptions (e.g., user not found, decryption failure)
        return redirect()->route('users.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
    }
}


}
