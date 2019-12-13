<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{ asset('/admins/img/users/usuario.png') }}" alt="Foto de perfil" /><span class="hide-menu">{{ Auth::user()->name }} </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sección</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">MÓDULOS</li>
                <li><a class="waves-effect waves-dark" href="{{ route('home') }}"><i class="mdi mdi-coffee"></i><span class="hide-menu">Inicio</span></a></li>
                @if(auth()->user()->rol=="Admin")
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Usuarios</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('usuarios.create') }}">Registrar</a></li>
                        <li><a href="{{ route('usuarios.index') }}">Lista</a></li>
                    </ul>
                </li>
                @endif
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase"></i><span class="hide-menu">Activos</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(auth()->user()->rol=="Admin")
                        <li><a href="{{ route('productos.create') }}">Registrar</a></li>
                        @endif
                        <li><a href="{{ route('productos.index') }}">Lista</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>