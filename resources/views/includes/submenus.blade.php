@if($menu["menus_hijos"] == 0)
    <li>
        <a class="nav-link" href="{{ url($menu["ruta"]) }}"> {{ $menu["nombre"] }} </a>
    </li>
@else
    
    <li class="nav-item dropdown">
        <a href="{{ url($menu["ruta"]) }}" data-toggle="dropdown" class="nav-link"> {{ $menu["nombre"] }} <b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu">
            @foreach($menu["submenu"] as $subMenu)
            @include('includes.submenus',["menu"=>$subMenu])
            @endforeach
        </ul>
    </li>
    
@endif