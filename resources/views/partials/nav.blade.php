<header class="header navbar navbar-expand-sm expand-header">

    @include('partials.headerlogo')
    @include('partials.task_notifications')
    @php


        $contactinfo="";

        $profilePic=$profilePic??'';
        $destination_path=$contactinfo->destination_path??'';
        $profilePicPath = $destination_path??'' . '/' . $profilePic;
    @endphp

    <ul class="navbar-item flex-row ml-auto">
        <li class="nav-item dropdown user-dropdown">
            <a href="#" class="nav-link user d-flex align-items-center" id="Notify" data-bs-toggle="dropdown">

                <!-- User Profile Image -->
                @php
                    $profilePic = $contactinfo->profile_pic ?? '';

                    $defaultImage = 'user.png';
                    if (isset($contactinfo->gender)) {
                        $defaultImage = ($contactinfo->gender == 'M') ? 'male-user.jpg' : 'female-user.jpg';
                    }
                @endphp

                @if(!empty($profilePic) && File::exists($profilePicPath))
                    <img src="{{ URL::to($profilePicPath) }}" alt="user" class="img-fluid mb-1 rounded-circle" width="30px"/>
                @else
                    <img src="{{ URL::to('assets/admin/img/' . $defaultImage) }}" alt="user" class="img-fluid mb-1 rounded-circle" width="30px"/>
                @endif

                <h6 class="text-center">{{ Str::title($contactinfo->firstname ?? '') }} {{ Str::title($contactinfo->lastname ?? '') }}</h6>
            </a>

            <div class="dropdown-menu dropdown-menu-end">
                <div class="dp-main-menu">
                    <div class="profile_dropdown p-2">
                        <div class="d-flex justify-content-center">
                            @if(!empty($profilePic) && File::exists($profilePicPath))
                                <img src="{{ URL::to($profilePicPath) }}" alt="user" class="img-fluid mb-1 rounded-circle"/>
                            @else
                                <img src="{{ URL::to('assets/admin/img/' . $defaultImage) }}" alt="user" class="img-fluid mb-1 rounded-circle"/>
                            @endif
                        </div>
                        <div class="mb-2">
                            <h6 class="text-center">{{ Str::title($contactinfo->firstname ?? '') }} {{ Str::title($contactinfo->lastname ?? '') }}</h6>
                            <p class="text-center">{{ $contactinfo->official_email ?? '' }}</p>
                        </div>
                        <a href="{{ url('profile') }}" class="text-center m-0 p-0"><u>My Profile</u></a>

                        @if(Auth::check() && auth()->user()->role == 2)
                            <a href="{{ route('organizations.single.customer', ['customerid' => Crypt::encryptString(auth()->user()->org_id)]) }}" class="text-center m-0 p-0"><u>My Organization</u></a>
                        @endif

                        <a href="{{ route('reset.password') }}" class="text-center m-0 p-0"><u>Change Password</u></a>
                    </div>
                </div>
                <div class="d-flex justify-content-center pb-2 mt-3 nav-profile">
                    <a href="{{ route('logout') }}" class="dropdown-item message-item btn text-center w-50 btn-red">
                        <div class="d-flex align-items-center mx-auto">
                            <span class="text-white">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </span>
                            <p class="ms-2 text-center text-white logout-text">Logout</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</header>
