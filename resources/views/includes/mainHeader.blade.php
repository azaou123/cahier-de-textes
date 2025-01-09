<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img
                    src="../../img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20"
                />
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <!-- Add "Tableau de bord" on the left -->
            <div class="navbar-brand ms-3">
                <span class="text-dark fw-bold">Tableau de bord</span>
            </div>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a
                        class="dropdown-toggle profile-pic"
                        data-bs-toggle="dropdown"
                        href="#"
                        aria-expanded="false"
                    >
                        <!-- Replace profile photo with a blue empty circle -->
                        <div class="avatar-sm">
                            <div class="avatar-img rounded-circle" style="background-color: #007bff; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <span class="text-white">{{ Auth::user()->prenom[0] }}</span>
                            </div>
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Bonjour, {{ Auth::user()->prenom }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <!-- Blue empty circle for the dropdown profile -->
                                        <div class="avatar-img rounded" style="background-color: #007bff; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                            <span class="text-white" style="font-size: 24px;">{{ Auth::user()->prenom[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="u-text ms-4">
                                        <h4>{{ Auth::user()->prenom }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                        <a class="btn btn-xs btn-secondary btn-sm">{{ Auth::user()->Role }}</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Mon Profil</a>
                                <div class="dropdown-divider"></div>
                                <!-- Improved logout button -->
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger p-0 w-100 text-start">
                                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>