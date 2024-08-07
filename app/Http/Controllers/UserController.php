<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organizations;
use App\Models\GroupLevel;
use App\Models\Departments_Users;
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
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	// use PasswordValidationRules;

    public function index(Request $request)
    {
            if(isset($request->company_name) && !empty($request->company_name)) {
            $organizationID=$request->company_name;
            }
            else{
            $organizationID='-1';
            }

            $users=User::select('users.*','user_types.name as ut_name')
            ->leftjoin('user_types','user_types.id','=','users.role')
            ->get();

            $pageTitle="Users List";
            $addlink=route('users.create');
            return view('users.index', compact('pageTitle','users','organizationID','addlink'));
    }


    public function create_user()
    {

        $pageTitle="Add User";
        $user_type_data=DB::table('user_types')->whereNotIn('user_types.id',[1])->where('is_active','1')->get();
        return view('admin.users.add_user',compact('pageTitle','user_type_data'));

    }
    public function store_user(Request $request)
    {


        $request->validate([
         'firstname' => 'required|min:1|max:100',
         'lastname' => 'required|min:1|max:100',
         'email' => 'required|email|unique:users,email',
         'role' => 'required',
         'phone' => 'required',
         'is_active_status' => 'required',
         'password' => 'sometimes|nullable',
         'phone' => 'sometimes|nullable|regex:/^[6-9]{1}[0-9]{9}/',
         'profile' => 'mimes:jpg,jpeg,png',
         // 'password' => $this->passwordRules(),
        ]);


        $isexistemail = User::select('id')->where('email',$request->admin_email)->get();
            if($isexistemail->count()==0){
            $decrypt_password=Str::random(8);



        User::insert([
            [
                "organization_id"=>$request->company_name??0,
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "role"=>$request->role,
                "email"=>$request->email,
                "password"=> Hash::make($decrypt_password),
                "phone"=>$request->phone??'',
                "role"=>'2',
                'created_at' =>Carbon\Carbon::now(),
                'updated_at' =>Carbon\Carbon::now(),
                'email_verified_at' =>Carbon\Carbon::now(),
                'is_email_verified' =>1,
                'is_active_status' =>1,
                'ip' =>request()->ip()??0,
            ]
        ]);

		   $email = $request->email;




	 try{



		 $offer = [
            'token' => $decrypt_password,
			 'password' =>$decrypt_password,
			  'name' =>$request->firstname,
			  'email' =>$request->email
        ];

		 Mail::to($request->email)->send(new ResetPassword($offer));





			}
			catch (\Exception $exception) {

			}


        return redirect(Config::get('constants.superadmin').'/admin-users')->with('success', "Success! Details are added successfully");
    }



	else{

         return redirect()->back()->with('error', 'User already exist an account.');
     }


	}
	public function edit_user($id){

        $user_id=Crypt::decryptString($id);

            $users_data=User::where("id",$user_id)->get()->first();
             $user_type_data=DB::table('user_types')->where('is_active','1')->get();
            $pageTitle="Edit User";
            return view('admin.users.add_user',compact('pageTitle','users_data','user_type_data'));

    }
    public function update_user(Request $request)
    {
		$request->validate([
		 'firstname' => 'required|min:1|max:100',
         'lastname' => 'required|min:1|max:100',
         'email' => 'required|email',
         'role' => 'required',
         'phone' => 'required',
         'is_active_status' => 'required',
         'password' => 'sometimes|nullable',
         'phone' => 'sometimes|nullable|regex:/^[6-9]{1}[0-9]{9}/',
         'profile' => 'mimes:jpg,jpeg,png',
		]);



		$isexistemail = User::select('id')->where('email',$request->email)->get();
        if($isexistemail->count()==1){
        if ($request->hasFile('profile')) {
        $profile_filename=uniqid().'_'.time().'.'.$request->profile->extension();
        $request->profile->move(('assets/uploads'),$profile_filename);

        DB::table('users')
        ->where('id', $request->id)
        ->update(["profile"=>$profile_filename]);
        }
        else{
            $profile_filename="";
        }

		/*

        if ($request->password) {
        $password = Hash::make($request->password);

        DB::table('users')
        ->where('id', $request->id)
        ->update(["password"=>$password]);

    }else{
        $password ="";
    }
	*/

        DB::table('users')
            ->where('id', $request->id)
            ->update(
            [
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "role"=>$request->role,
                "email"=>$request->email,
                "phone"=>$request->phone??'',
                "is_active_status"=>$request->is_active_status??0,
				"organization_id"=>$request->company_name??0,
            ]
            );
        return redirect('admin/users')->with('success', "Success! Details are updated successfully");

			}

			else{

				  return redirect('admin/users')->with('error', "Duplicate email not allowed");
			}









    }

    public function profile(){

            $users_data=DB::table('users')->get()->where("id",auth()->user()->id)->first();
            $pageTitle="Edit Profile";
            return view('admin.users.edit_profile',compact('users_data','pageTitle'));

    }
    public function update_profile(Request $request)
    {
        $request->validate([
         'firstname' => 'required|min:1|max:100',
         'lastname' => 'required|min:1|max:100',
         'email' => 'required|email',
         'phone' => 'required',
         'phone' => 'sometimes|nullable|regex:/^[6-9]{1}[0-9]{9}/',
         'profile' => 'mimes:jpg,jpeg,png',
        ]);


        if ($request->hasFile('profile')) {
        $profile_filename=uniqid().'_'.time().'.'.$request->profile->extension();
        $request->profile->move(('assets/uploads'),$profile_filename);

        DB::table('users')
        ->where('id', auth()->user()->id)
        ->update(["profile"=>$profile_filename]);
        }
        else{
            $profile_filename="";
        }
/*
        if ($request->password) {
        $password = Hash::make($request->password);

        DB::table('users')
        ->where('id', auth()->user()->id)
        ->update(["password"=>$password]);

    }

	else{
        $password ="";
    }

*/

        DB::table('users')
            ->where('id', auth()->user()->id)
            ->update(
            [
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "email"=>$request->email,
                "phone"=>$request->phone??'',
            ]
            );
                return redirect('admin/profile')->with('success', "Success! Details are updated successfully");
            }
    public function delete_user($id)
    {
        $user_id=Crypt::decryptString($id);
        $data=DB::table('users')->where('id',$user_id)->delete();
        return redirect()->back()->with('success','Success! Details are deleted successfully');

    }


    public function listUsers(Request $request)
    {

try{
    $role="";
        $users_data=User::leftjoin('user_types','user_types.id','=','users.role')
        //->where('users.organization_id',Session::get('companyID')??0)
        ->where(function($users_data) use ($role){
        if($role){
        $users_data->where('users.role',"=",$role);
        }
        })
        ->orderby('users.created_at','desc')
        ->get(['users.*','user_types.name as ut_name']);

            $addlink=url(Config::get('constants.admin').'/user/create');
            $role=$request->role??'';
            $pageTitle="Users";
            return view('users.users_list', compact('pageTitle','users_data','addlink','role'));

    }
        catch (\Exception $exception) {
          return redirect()->back()->with('error', 'User already exist an account.'.$exception->getMessage());

        }

    }
    public function department_create_user()
    {

        $pageTitle="Add User";
        //$user_type_data=DB::table('user_types')->whereNotIn('user_types.id',[1,2])->where('organization_id',Session::get('companyID'))->get();
        $user_type_data=DB::table('user_types')->whereNotIn('user_types.id',[1])->where('is_active','1')->get();
        $group_level_data=GroupLevel::get();
        return view('admin.department_users.add_user',compact('pageTitle','user_type_data','group_level_data'));

    }
    public function department_store_user(Request $request)
    {

		try{
        $request->validate([
         'firstname' => 'required|min:1|max:100',
         'email' => 'required|email|unique:users,email',
         'role' => 'required',
         // 'designation_id' => 'required',
         'phone' => 'required',
         'is_active_status' => 'required',
         'password' => 'sometimes|nullable',
         'phone' => 'sometimes|nullable|regex:/^[6-9]{1}[0-9]{9}/',
        ]);


	$decrypt_password=Str::random(8);
	$isexistemail = User::select('id')->where('email',$request->admin_email)->get();
	if($isexistemail->count()==0){

        $userdata_id=User::insertGetId(
            [
                "organization_id"=>$request->company_name??0,
                // "designation_id"=>$request->designation_id,
                "firstname"=>$request->firstname,
                "role"=>$request->role,
                "email"=>$request->email,
                "password"=> Hash::make($decrypt_password),
                "phone"=>$request->phone??'',
               "reportingto"=>$request->reportingto??0,
                "department"=>$request->department[0]??0,
                'created_at' =>Carbon\Carbon::now(),
                'updated_at' =>Carbon\Carbon::now(),
                'email_verified_at' =>Carbon\Carbon::now(),
                'is_email_verified' =>1,
                'is_active_status' =>$request->is_active_status??0,
                'need_escalation' =>$request->need_escalation??0,
                'ip' =>request()->ip()??0,
            ]
        );


	$LastInserID=$userdata_id??0;
	$DepartmentSelected=$request->department??'';
	if($LastInserID){
	    if(isset($request->department[0]) && !empty($request->department[0]))
	$this->mapping_departments_users($DepartmentSelected,$LastInserID);

	}

        try{
        $offer = [
        'token' => $decrypt_password??'',
        'password' =>$decrypt_password??'',
        'name' =>$request->firstname??'',
        'email' =>$request->email??''
        ];

        //Mail::to($request->email)->send(new ResetPassword($offer));
        }
        catch (\Exception $exception) {

        }


        return redirect(Config::get('constants.admin').'/users')->with('success', "Success! Details are added successfully");
    }else{

         return redirect()->back()->with('error', 'User already exist an account.');
     }


		}
			catch (\Exception $exception) {

			    return redirect()->back()->with('error', 'User already exist an account.'.$exception->getMessage());

			}

    }





	public function mapping_departments_users($DepartmentSelected,$LastInserID){




		if(isset($LastInserID) && $LastInserID>0)
		{

		$User = User::select('id')->where('id',$LastInserID)->get()->count();

			if($User>0){
				$remove_data=Departments_Users::where('user_id',$LastInserID)->delete();
				foreach($DepartmentSelected as $key=>$value){

				$checking_exist=Departments_Users::where("department_id",$value)->where("user_id",$LastInserID)->get()->count();

						if($checking_exist==0) {

							if($value>0) {
								$Dep_Users=Departments_Users::insert(
									[
										[
											"department_id"=>$value,
											"user_id"=>$LastInserID,
											'created_at' =>Carbon\Carbon::now(),
											'updated_at' =>Carbon\Carbon::now(),
										]
									]
									);

							}

						}
						else{


							if($value>0) {
								$Dep_Users=Departments_Users::where('department_id',$value)->where('user_id',$LastInserID)
								->update(
										[
										"department_id"=>$value,
										"user_id"=>$LastInserID,
										'updated_at' =>Carbon\Carbon::now(),
										]
								);

							}


						}

				}





			}
		}
		else{

		}

	}

    public function department_edit_user($id){


		try {
		$user_id=Crypt::decryptString($id);
		$users_data=User::where("id",$user_id)->get()->first();

			if(isset($users_data)){
				$group_level_data=GroupLevel::get();
				$user_type_data=DB::table('user_types')->where('is_active','1')->get();
				$pageTitle="Edit User";

				$Departments_Users=Departments_Users::where('user_id',$user_id)->pluck('department_id')->toArray();
				return view('admin.department_users.add_user',compact('pageTitle','users_data','user_type_data','group_level_data','Departments_Users'));
			}
			else{
				return redirect()->back()->with('error', "Something went wrong/Organization is not found.");
			}

		}
		catch (RequestException $exception) {
		// Catch all 4XX errors
		// To catch exactly error 400 use
		if ($exception->hasResponse()){
		if ($exception->getResponse()->getStatusCode() == '400') {
		}
		}
		// You can check for whatever error status code you need
		return redirect()->back()->with('error', "Something went wrong.". $exception->getMessage()??'');
		}
		catch (\Exception $exception) {
		return redirect()->back()->with('error', "Something went wrong.". $exception->getMessage()??'');
		}



    }
    public function department_update_user(Request $request)
    {


        $request->validate([
         'firstname' => 'required',
         'email' => 'required|email',
         'role' => 'required',
         // 'designation_id' => 'required',
         'phone' => 'required',
         'is_active_status' => 'required',
         'password' => 'sometimes|nullable',
         'phone' => 'sometimes|nullable',
        ]);

        User::where('id', $request->id)
            ->update(
            [
                "organization_id"=>$request->company_name??0,
                "firstname"=>$request->firstname,
                "role"=>$request->role,
                "email"=>$request->email,
                "phone"=>$request->phone??'',
                "reportingto"=>$request->reportingto??0,
                "department"=>$request->department[0]??0,
                'email_verified_at' =>Carbon\Carbon::now(),
                'is_email_verified' =>1,
                'is_active_status' =>$request->is_active_status??0,
                'need_escalation' =>$request->need_escalation??0,
                'ip' =>request()->ip()??0,
            ]
            );


			$DepartmentSelected=$request->department??[0];
			$LastInserID=$request->id;
			$update_departments=$this->mapping_departments_users($DepartmentSelected,$LastInserID);


        return redirect('admin/users')->with('success', "Success! Details are updated successfully");



    }
    public function department_delete_user($id)
    {
        $user_id=Crypt::decryptString($id);
        $data=User::where('id',$user_id)->delete();
		$remove_data=Departments_Users::where('user_id',$user_id)->delete();
        return redirect()->back()->with('success','User&Mapped Departments are deleted');

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
          return view('changePassword.change_password', compact('pageTitle'));
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
            $user->profile_photo = 'storage/app/public/' . $profileFilePath;
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





}
