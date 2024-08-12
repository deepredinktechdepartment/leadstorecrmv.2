<div class="row pb-5">
    <div class="col-lg-12">
        <h1 class="mb-4">Recently Active</h1>

        @php
            // Define roles you want to fetch activities for
            $roles = [3, 2]; // Adjust according to your roles
        @endphp

        <div class="row">
            @foreach($roles as $index => $role)
                @php
                    // Fetch users with specific role and last login details
                    $users = \App\Models\User::where('role', $role)
                        ->where('active', 1)
                        ->orderBy('last_logged_on', 'DESC')
                        ->limit(10)
                        ->get();

                    // Add time difference to each user
                    $users = $users->map(function ($user) {
                        $lastLoggedOn = \Carbon\Carbon::parse($user->last_logged_on);
                        $now = \Carbon\Carbon::now();

                        if ($lastLoggedOn->isToday()) {
                            $minutes = $now->diffInMinutes($lastLoggedOn);
                        } else {
                            $daysBetween = $now->diffInDays($lastLoggedOn);
                            $minutes = $daysBetween * 1440; // Convert days to minutes
                        }

                        $user->time_diff = $minutes;
                        return $user;
                    })->sortBy('time_diff'); // Sort by time difference in ascending order
                @endphp

                @if($users->isNotEmpty())
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <h2 class="mb-4">{{ $role == 3 ? 'From the Agency' : 'From the Client' }}</h2>
                            <div class="row recently_active_users">
                                @foreach($users as $user)
                                    @php
                                        $userName = ucwords($user->fullname);


                                        $lastLoggedOn = \Carbon\Carbon::parse($user->last_logged_on);
                                        $now = \Carbon\Carbon::now();

                                        if ($lastLoggedOn->isToday()) {
                                            $hours = $now->diffInHours($lastLoggedOn);
                                            $minutes = $now->diffInMinutes($lastLoggedOn) % 60;
                                            $timeDiff = $hours > 0 ? "$hours Hour" . ($hours > 1 ? 's' : '') : "$minutes Minute" . ($minutes > 1 ? 's' : '');
                                        } else {
                                            $daysBetween = $now->diffInDays($lastLoggedOn);
                                            $timeDiff = $daysBetween > 0 ? "$daysBetween Day" . ($daysBetween > 1 ? 's' : '') : 'Today';
                                        }
                                    @endphp
                                    <div class="col-lg-3 col-6 mb-4">
                                        <a href="#" class="w-100">
                                            <div>
                                                @if (!empty($user->profile_photo) && File::exists(storage_path('app/public/' . $user->profile_photo)))
                                                <img src="{{ URL::to(env('APP_STORAGE').''.$user->profile_photo) }}" alt="{{ $userName }}" class="d-block mx-md-auto client_logo mb-2">
                                                @else
                                                <img src="assets/images/no_image.png" alt="Client Logo" class="d-block mx-md-auto client_logo mb-2">
                                                @endif
                                                <div>
                                                    <h6 class="text-md-center mb-1">{{ $userName }}</h6>
                                                    <p class="text-md-center">{{ $timeDiff }} Ago</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
