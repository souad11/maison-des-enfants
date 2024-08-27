<header>

      


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <a href="index.html" class="navbar-brand">
            <img src="logo/logo.svg" alt="Logo" style="width: 150px; height: auto;">
            </a>
            
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/home') }}" class="nav-item nav-link active">Accueil</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link">A propos</a>
                    <a href="{{ url('/partnersTemplate') }}" class="nav-item nav-link">Nos partenaires</a>
                    <a href="{{ url('/equipe') }}" class="nav-item nav-link">Notre équipe</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Nos activités</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                            <a href="#" class="dropdown-item">Activités à l'année</a>
                            <a href="{{ url('/activitiesTemplate') }}" class="dropdown-item">Activités hebdomadaires</a>
                        </div>
                    </div>
                    <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
                </div>
                <div class="header_top_right">
                <ul class="list-inline">
                @guest
                <li class="list-inline-item">
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">S'inscrire</a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Se connecter</a>
                </li>
            @else
                <li class="list-inline-item" style="margin-right: 20px;">
                    <a class="btn btn-primary rounded-pill px-3 d-none d-lg-block" href="{{ url('/dashboard') }}">Mon tableau de bord</a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-primary rounded-pill px-3 d-none d-lg-block" href="javascript:void(0);"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         Se déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest

                </ul>
            </div>


            </div>
        </nav>
        <!-- Navbar End -->
</header>