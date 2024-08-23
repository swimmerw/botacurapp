<aside id="left-sidebar-nav">
    <ul class="side-nav fixed leftside-navigation" id="slide-out">
        <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img alt="" class="circle responsive-img valign profile-image cyan" src="/images/avatar/avatar-7.png">
                    </img>
                </div>
                <div class="col col s8 m8 l8">
                    <ul class="dropdown-content" id="profile-dropdown-nav">
                        <li>
                            <a class="grey-text text-darken-1" href="#">
                                <i class="material-icons">face</i>
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a class="grey-text text-darken-1" href="#">
                                <i class="material-icons">settings</i>
                                Ajustes
                            </a>
                        </li>
                        <li>
                            <a class="grey-text text-darken-1" href="#">
                                <i class="material-icons">live_help</i>
                                Ayuda
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="grey-text text-darken-1" href="#">
                                <i class="material-icons">keyboard_tab</i>
                                Salir
                            </a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" data-activates="profile-dropdown-nav" href="#">
                        {{Auth::user()->name}}
                        <i class="mdi-navigation-arrow-drop-down right"></i>
                    </a>
                    <p class="user-roal">{{Auth::user()->list_roles()}}</p>
                </div>
            </div>
        </li>
        <li class="no-padding">
            <ul class="collapsible" data-collapsible="accordion">
                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.admin.show') }}">
                        <i class="material-icons">
                            pie_chart_outlined
                        </i>
                        <span class="nav-text">
                            Panel de administración
                        </span>
                    </a>
                </li>

                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.cliente.index') }}">
                        <i class="material-icons">
                            airport_shuttle
                        </i>
                        <span class="nav-text">
                            Clientes
                        </span>
                    </a>
                </li>
                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.reserva.index') }}">
                        <i class="material-icons">
                            assignment
                        </i>
                        <span class="nav-text">
                            Reservaciones
                        </span>
                    </a>
                </li>
                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.programa.index') }}">
                        <i class="material-icons">
                            check_circle
                        </i>
                        <span class="nav-text">
                            Programas
                        </span>
                    </a>
                </li>
                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.user.index') }}">
                        <i class="material-icons">
                            people
                        </i>
                        <span class="nav-text">
                            Usuarios del Sistema
                        </span>
                    </a>
                </li>



                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.role.index') }}">
                        <i class="material-icons">
                            perm_identity
                        </i>
                        <span class="nav-text">
                            Roles del Sistema
                        </span>
                    </a>
                </li>

                <li class="bold">
                    <a class="waves-effect waves-cyan" href="{{ route ('backoffice.permission.index') }}">
                        <i class="material-icons">
                            vpn_key
                        </i>
                        <span class="nav-text">
                            Permisos del Sistema
                        </span>
                    </a>
                </li>

            </ul>
        </li>
    </ul>

    <a class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only" data-activates="slide-out" href="#">
        <i class="material-icons">menu</i>
    </a>

</aside>