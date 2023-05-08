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
                    <span class="badge badge-warning navbar-badge"><?= rand(0,3)?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <span class="dropdown-header"><?= rand(0,3)?> Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-list mr-2"></i>11 interventions
                    <span class="float-right text-muted text-sm">3 jours</span>
                </a>
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

