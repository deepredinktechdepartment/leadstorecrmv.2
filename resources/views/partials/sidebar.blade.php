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

            @if(auth()->user()->role == 1 || auth()->user()->id == 46)
                <div class="nav flex-column">
                    <div class="accordion" id="accordionConfigurations">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseConfigurations" aria-expanded="true"
                                    aria-controls="collapseConfigurations">
                                    <div class="d-flex align-items-center" style="width: 30px;"> <!-- Adjust the width as needed -->
                                        <i class="fa-solid fa-gear"></i>
                                    </div>
                                    <span>Configurations</span>
                                </button>
                            </h2>
                            <div id="collapseConfigurations" class="accordion-collapse collapse"
                                aria-labelledby="headingConfigurations" data-bs-parent="#accordionConfigurations">
                                <div class="accordion-body">
                                    @include("common_pages.configuration_menus")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role == 1)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ url('organizations-table-summary') }}" class="list-group-item list-group-item-action {{ (request()->is('organizations-table-summary') || (request()->is('organizations-table-summary/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-database"></i>
                                </div>
                                <span>Data Summary</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role == 2 || auth()->user()->role == 5)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ url('tasks?type=mytasks&status=' . Config::get('constants.defaultmytaskstatus')) }}" class="list-group-item list-group-item-action {{ (request()->is('tasks?type=mytasks&status=' . Config::get('constants.defaultmytaskstatus')) || (request()->is('tasks/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <span>Tasks</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role == 2)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ url('organizations/contacts') }}" class="list-group-item list-group-item-action {{ (request()->is('organizations/contacts') || (request()->is('organizations/contacts/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-regular fa-address-book"></i>
                                </div>
                                <span>Contacts</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role != 1)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ route('projects.listing') }}" class="list-group-item list-group-item-action {{ (request()->is('projects/listing') || (request()->is('projects/listing/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-diagram-project"></i>
                                </div>
                                <span>Projects</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role == 2 || auth()->user()->role == 5)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ url('employees/lists') }}" class="list-group-item list-group-item-action {{ (request()->is('employees/lists') || (request()->is('employees/lists/*'))) ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-people-group"></i>
                                </div>
                                <span>Team</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            @if(auth()->user()->role == 2 || auth()->user()->role == 5)
                <div class="nav flex-column">
                    <div class="list-group">
                        <a href="{{ url('documents/mydocuments') }}" class="list-group-item list-group-item-action {{ request()->routeIs('documents.list', 'documents.create', '') ? 'active' : '' }}">
                            <div class="d-flex align-items-center">
                                <div style="width: 30px;"> <!-- Adjust the width as needed -->
                                    <i class="fa-solid fa-file"></i>
                                </div>
                                <span>Documents</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <div class="fixed_company_name">
                <p href="#">CRM Software by DeepRedInk</p>
            </div>
        </div>
    </div>
@endguest
