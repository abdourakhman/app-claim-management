@section('sidebar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A202C;">

        <a href="/" class="brand-link">
            <img src="{{asset('img/images/logo_transparent.png')}}" alt="LydecResolver Logo" class="brand-image border img-circle elevation-5" style="opacity: .8; max-width:100px;">
            <span class="brand-text font-weight-bold fs-5">LydecResolver</span>
        </a>

        {{-- START SIDEBAR --}}
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if (Storage::disk('public')->exists(Auth::user()->photo_url))
                        <img src="{{Storage::url(Auth::user()->photo_url)}}" class="img-circle elevation-2" alt="User Image" style="max-width:80px;">    
                    @else
                        <img src="{{asset('img/images/profil.png')}}" class="img-circle elevation-2" alt="User Image" style="max-width:50px;">
                    @endif
                </div>
                <div class="info">
                    <a class="d-block profile-username text-center text-primary truncable text-light" href="#">{{ Auth::user()->prenom }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @cannot('client')     
                    <li class="nav-item">
                        <a href="{{route('manager.dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Tableau de Bord
                                <span class="right badge badge-danger">All</span>
                            </p>
                        </a>
                    </li>
                    @endcannot
                    @can('client')
                    <li class="nav-item menu-open mt-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-exclamation"></i>
                            <p>
                                Réclamation <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{route('customer.claim.deposit')}}" class="nav-link">
                                    <i class="fas fa-paper-plane nav-icon"></i>
                                    <p style="font-size: 0.8em;">Réclamations déposées</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('customer.claim.processed')}}" class="nav-link">
                                    <i class="fas fa-spinner nav-icon"></i>
                                    <p style="font-size: 0.8em;">Réclamations en traitement</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('customer.claim.aborted')}}" class="nav-link">
                                    <i class="fas fa-undo nav-icon"></i>
                                    <p style="font-size: 0.8em;">Réclamations annulée</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('customer.claim.create')}}" class="nav-link  bg-primary">
                                    <i class="fas fa-share nav-icon"></i>
                                    <p style="font-size: 0.8em;">Déposer une réclamation</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    {{-- Start gestion utilisateurs --}}
                    @can('admin')
                        
                    <li class="nav-item menu-open mt-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Administration <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{route('admin.user.create')}}" class="nav-link">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p style="font-size: 0.8em;">Ajouter utilisateur</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.user.delete')}}" class="nav-link">
                                    <i class="fas fa-user-minus nav-icon"></i>
                                    <p style="font-size: 0.8em;">Supprimer utilisateur</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.user.edit')}}" class="nav-link">
                                    <i class="fas fa-edit nav-icon"></i>
                                    <p style="font-size: 0.8em;">Modifier  utilisateur</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.user.list')}}" class="nav-link">
                                    <i class="fas fa-eye nav-icon"></i>
                                    <p style="font-size: 0.8em;">Consulter utilisateurs</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    {{-- End gestion utilisateur --}}
                    {{-- Start gestion reclamation --}}
                    @can('gestionnaire')
                        
                    <li class="nav-item menu-open mt-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>
                               Gestion Reclamation <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{route('manager.claim.getAll')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p style="font-size: 0.8em;">Toutes les réclamations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('manager.claim.affected')}}" class="nav-link">
                                    <i class="fas fa-check-square nav-icon"></i>
                                    <p style="font-size: 0.8em;">Réclamations affectées</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('manager.claim.pending')}}" class="nav-link">
                                    <i class="fas fa-spinner nav-icon"></i>
                                    <p style="font-size: 0.8em;">Réclamations en attente</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- End gestion reclamation --}}
                    {{-- Start gestion techniciens --}}
                    <li class="nav-item menu-open mt-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                Gestion Techniciens <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{route('manager.technicien.list')}}" class="nav-link  ">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p style="font-size: 0.8em;">Listes des agents</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('manager.technicien.disponible')}}" class="nav-link ">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p style="font-size: 0.8em;">Agents disponibles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('manager.technicien.indisponible')}}" class="nav-link">
                                    <i class="fas fa-location-arrow nav-icon"></i>
                                    <p style="font-size: 0.8em;">Agents en mission</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- End gestion techniciens --}}
                    @endcan
                    {{-- Start gestion interventions --}}
                    @can('technicien','manager')
                        
                    <li class="nav-item menu-open mt-2">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Gestion Interventions <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{route('technicien.list.interventions')}}" class="nav-link">
                                    <i class="fas fa-list-alt nav-icon"></i>
                                    <p style="font-size: 0.8em;">Listes des interventions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('technicien.interventions.solved')}}" class="nav-link">
                                    <i class="fas fa-check nav-icon"></i>
                                    <p style="font-size: 0.8em;">Interventions résolues</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('technicien.interventions.pending')}}" class="nav-link">
                                    <i class="fas fa-times nav-icon"></i>
                                    <p style="font-size: 0.8em;">Interventions à résoudre</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    {{-- END GESTION Interventions --}}
                    <li class="nav-item menu-open mt-2">
                        <a class="nav-link bg-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-window-close"></i>
                            <p>
                                Déconnexion
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
            @if (Storage::disk('public')->exists(Auth::user()->photo_url))
                        <img src="{{Storage::url(Auth::user()->photo_url)}}" class=" rounded-circle img-fluid' alt="User Image" style="width:100px;">    
                    @else
                        <img src="{{asset('img/images/profil.png')}}" class="img-circle elevation-2" alt="User Image" style="max-width:50px;">
                    @endif
        </div>

        <h3 class="profile-username text-center text-secondary truncable">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h3>

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
@endsection  
{{-- END SIDEBAR RIGHT LIE AU CLIC SUR L'ICONE USER --}}