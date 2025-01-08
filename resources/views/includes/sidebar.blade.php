<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo" style="font-weight: bold; color: white;">
                <i class="fas fa-book mx-5"></i> CDT
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard -->
                <li class="nav-item {{ request()->routeIs('professeur.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('professeur.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Section Components (optional) -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                @if(Auth::user()->isAdmin())
                    <li class="nav-item {{ request()->routeIs('admin.professeurs') ? 'active' : '' }}">
                        <a href="{{ route('admin.professeurs') }}" class="nav-link">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Professeurs</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.filieres') ? 'active' : '' }}">
                        <a href="{{ route('admin.filieres') }}" class="nav-link">
                            <i class="fas fa-school"></i>
                            <span>Filieres</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.courses') ? 'active' : '' }}">
                        <a href="{{ route('admin.courses') }}" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>Cours</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.etudiants') ? 'active' : '' }}">
                        <a href="{{ route('admin.etudiants') }}" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                            <span>Etudiants</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.salles') ? 'active' : '' }}">
                        <a href="{{ route('admin.salles') }}" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                            <span>Salles</span>
                        </a>
                    </li>
                @endif

                <!-- Menu for Professors -->
                @if(Auth::user()->isProfessor())
                    <li class="nav-item {{ request()->routeIs('professeur.courses') ? 'active' : '' }}">
                        <a href="{{ route('professeur.courses') }}" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>Cours</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('professeur.sessions') ? 'active' : '' }}">
                        <a href="{{ route('professeur.sessions') }}" class="nav-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Séances</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('professeur.homework') ? 'active' : '' }}">
                        <a href="{{ route('professeur.homework') }}" class="nav-link">
                            <i class="fas fa-file-upload"></i>
                            <span>Soumissions</span>
                        </a>
                    </li>
                @endif

                <!-- Menu for Students
                @if(Auth::user()->isStudent())
                    <li class="nav-item {{ request()->routeIs('etudiants.cours') ? 'active' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <span>Cours</span>
                        </a>
                    </li>
                @endif -->
            </ul>
        </div>
    </div>
</div>
