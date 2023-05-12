<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge"></span>
    </a>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"></span>
    </a>
    </li>


    <li class="nav-item dropdown">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-link" type="submit">            <i class="nav-icon fas fa-power-off"></i>
            </button>
        </form>
    </li>

</ul>