<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A202C;">

    <a href="/" class="brand-link">
        <img src="{{asset('img/images/logo_transparent.png')}}" alt="LydecResolver Logo" class="brand-image border img-circle elevation-5" style="opacity: .8; max-width:100px;">
        <span class="brand-text font-weight-bold fs-5">LydecResolver</span>
    </a>

    {{-- START SIDEBAR --}}
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/images/profil.png')}}" class="img-circle elevation-2" alt="User Image" style="max-width:50px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">Utilisateur XY</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Simple Link 
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    {{-- END SIDEBAR --}}
    
</aside>

{{-- SIDEBAR RIGHT LIE AU CLIC SUR L'ICONE USER --}}
<aside class="control-sidebar " style="background-color: #1A202C; max-heigth:60%;">
    <!-- Control sidebar content goes here -->
<div style="background-color: #1A202C;">
    <div class="card-body  box-profile" style="background-color: #1A202C;">
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/images/profil.png') }}" alt="User profile picture">
    </div>

    <h3 class="profile-username text-center text-primary truncable">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h3>

    <p class="text-muted text-center">{{auth()->user()->profil}}</p>

    <ul class="list-group my-5 mb-3" style="background-color: #1A202C;">
        <li class="list-group-item bg-light">
        <a href="#" class="d-flex align-items-center text-primary "><i class="fa fa-lock pr-2"></i><b >Mot de passe</b> </a>
        </li>
        <li class="list-group-item bg-light">
        <a href="#" class="d-flex align-items-center text-primary"><i class="fa fa-user pr-2"></i><b >Mon profile</b> </a>
        </li>
    </ul>

    <a class="btn btn-danger  btn-block" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        Déconnexion
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </div>
    <!-- /.card-body -->
</div>
</aside>
        
{{-- END SIDEBAR RIGHT LIE AU CLIC SUR L'ICONE USER --}}