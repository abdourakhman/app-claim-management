@section('navbar')
    <nav class="main-header navbar navbar-expand navbar-white" style="background-color: #1A202C;">

        <ul class="navbar-nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto nav-pills nav-fill">

            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form 
                        class="form-inline"
                        method="GET"
                        @if (Auth::user()->profil == "client")
                            action="{{route('customer.search')}}"
                        @elseif(Auth::user()->profil == "gestionnaire")
                            action="{{route('manager.search')}}"
                        @else
                        action='/'
                        @endif
                    >
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar  offset-4 col-4" type="text" name="term" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                            {{$notifications ?? 0}}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <span class="dropdown-header">
                    @if (Auth::user()->profil == "gestionnaire")
                        {{$notifications ?? 0}} Réclamation(s) en attente
                    @endif
                    @if (Auth::user()->profil == "client")
                        {{$notifications ?? 0}} Réclamation(s) en traitement
                    @endif
                    @if (Auth::user()->profil == "technicien")
                        {{$notifications ?? 0}} Intevention(s) à traiter
                    @endif 
                    
                </span>
                <div class="dropdown-divider"></div>
                @if (Auth::user()->profil == "gestionnaire")
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{$notifications}} réclamation(s)
                        @if ($notifications != 0)    
                            <a class=" float-right text-muted text-sm" href="{{route('manager.claim.pending')}}">consulter</a>
                        @else
                        <a class=" float-right text-muted text-sm" href="#">Rien à consulter</a>
                        @endif
                    </a>                  
                @endif
                @if (Auth::user()->profil == "client")
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{$notifications ?? 0}} Message(s)
                        @if($notifications?? 0 != 0)    
                            <a class=" float-right text-muted text-sm" href="{{route('customer.claim.processed')}}">consulter</a>
                        @else
                        <a class=" float-right text-muted text-sm" href="#">Rien à consulter</a>
                        @endif
                    </a>                  
                @endif
                @if (Auth::user()->profil == "technicien")
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{$notifications}} Intervention(s)
                        @if ($notifications != 0)    
                            <a class=" float-right text-muted text-sm" href="{{route('technicien.list.interventions')}}">consulter</a>
                        @else
                        <a class=" float-right text-muted text-sm" href="#">Rien à consulter</a>
                        @endif
                    </a>                  
                @endif
                <div class="dropdown-divider"></div>
            </div>
            </li>   

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-user "></i>
                </a>
            </li>
        </ul>
    </nav>
@endsection

