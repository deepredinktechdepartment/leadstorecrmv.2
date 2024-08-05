<!-- Check if the user is not authenticated and handle the error -->
@guest
    <div class="alert alert-danger" role="alert">
        You are not logged in. Please <a href="{{ url('login') }}" class="alert-link">log in</a> to access this content.
    </div>
@else
    <!-- Display navigation if the user is authenticated -->
    <div class="nav-sub-strip-container">
        <div class="nav-sub-strip">
            <div class="nav flex-column">
                <div class="list-group">
                    <a href="{{ url('dashboard') }}" class="list-group-item list-group-item-action {{ (request()->is('dashboard')) ? 'active' : '' }}">
                        <div class="d-flex align-items-center">
                            <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                <i class="fa-solid fa-gauge"></i>
                            </div>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="nav flex-column">
                <div class="list-group">
                    <a href="{{ route('reg.user') }}" class="list-group-item list-group-item-action {{ (request()->is('reg.user')) ? 'active' : '' }}">
                        <div class="d-flex align-items-center">
                            <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                <i class="fa-solid fa-gauge"></i>
                            </div>
                            <span>Users</span>
                        </div>
                    </a>
                </div>
            </div>

                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action {{ (request()->is('projects/listing') || (request()->is('projects/listing/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-diagram-project"></i>
                                </div>
                                <span>Projects</span>
                            </div>
                        </a>
                    </div>
                </div>



            <div class="fixed_company_name">
                <p href="#">CRM Software by DeepRedInk</p>
            </div>
        </div>
    </div>
@endguest
