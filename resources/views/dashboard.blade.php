<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>Panel de Administración</h1>
    <p>Bienvenido, administrador. Aquí puedes gestionar los hoteles y usuarios.</p>

    <nav>
        <ul>
            <li><a href="{{ route('hotels.index') }}">Gestión de Hoteles</a></li>
            <li><a href="{{ route('accommodations.index') }}">Gestión de Acomodaciones</a></li>
        </ul>
    </nav>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Cerrar Sesión
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
