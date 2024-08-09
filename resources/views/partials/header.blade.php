<header>
  <div class="container">
      <div class="row align-items-sm-center">
          <div class="col-sm-4 col-6">
              <a href="{{ route('dashboard') }}">
                  <img src="https://imgur.com/EiMbaC5.png" class="img-fluid header-logo" alt="Leadstore">
              </a>
          </div>
          <div class="col-sm-8 col-6">
              <nav class="navbar navbar-expand-lg justify-content-end">
                  <button class="navbar-toggler p-0 mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="fas fa-bars"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-sm-start text-end align-items-center">
                        <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                      </li>
                          <li class="nav-item {{ Request::routeIs('clients.index') ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('clients.index') }}">Projects</a>
                          </li>
                          <li class="nav-item {{ Request::routeIs('reports.index') ? 'active' : '' }}">
                              <a class="nav-link " href="{{ route('reports.index') }}">Reports</a>
                          </li>
                          <li class="nav-item {{ Request::routeIs('users.index') ? 'active' : '' }}">
                              <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                          </li>
                          <li class="nav-item dropdown {{ Request::routeIs('sources.index', 'source_groups.index') ? 'active' : '' }}">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  UTM
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <li><a class="dropdown-item {{ Request::routeIs('sources.index') ? 'active' : '' }}" href="{{ route('sources.index') }}">Source</a></li>
                                  <li><a class="dropdown-item {{ Request::routeIs('source_groups.index') ? 'active' : '' }}" href="{{ route('source_groups.index') }}">Source Group</a></li>
                              </ul>
                          </li>
                          <li class="nav-item dropdown {{ Request::routeIs('profile.show', 'reset.password', 'logout') ? 'active' : '' }}">
                              <a class="nav-link dropdown-toggle profile-dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <img src="https://leadstore.in/salesteampics/deep-red-ink-consultancy-squarelogo.png" class="profile-image img-circle" height="40"> Deepredink
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <li><a class="dropdown-item {{ Request::routeIs('profile.show') ? 'active' : '' }}" href="{{ route('profile.show') }}">Your Profile</a></li>
                                  <li><a class="dropdown-item {{ Request::routeIs('reset.password') ? 'active' : '' }}" href="{{ route('reset.password') }}">Change Password</a></li>
                                  <li><a class="dropdown-item {{ Request::routeIs('logout') ? 'active' : '' }}" href="{{ route('logout') }}">Logout</a></li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </nav>
          </div>
      </div>
  </div>
</header>
