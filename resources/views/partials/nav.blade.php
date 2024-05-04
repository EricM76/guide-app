<header>
    <nav>
        <ul>
            <li ><a class="{{setActive('home')}}" href="{{route('home')}}">Home</a></li>
            <li><a class="{{setActive('messages.create')}}" href="{{route('messages.create')}}">Contacto</a></li>
            <li><a class="{{setActive('about')}}" href="{{route('about')}}">Acerca de</a></li>
            <li><a class="{{setActive('projects.*')}}" href="{{route('projects.index')}}">Portfolio</a></li>
        </ul>
    </nav>
</header>