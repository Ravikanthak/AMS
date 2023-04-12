<a href="#" class="brand-link">
  <img src="{{ asset('/img/logo.png') }}" alt="SL ARMY" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">WTTAM System</span>
</a>

<div class="sidebar">

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item dashboard_li">
        <a href="{{route('dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>    

      <li class="nav-item add_establishment_li">
        <a href="{{route('add_establishment')}}" class="nav-link">
          <i class="nav-icon fas fa-solid fa-building"></i>
          <p>Add Establishment</p>
        </a>
      </li>  

      <li class="nav-item troops_transport_li">
        <a href="#" class="nav-link">
        <i class="nav-icon fas fa-people-arrows"></i>
          <p>Troops Transport
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('auth_req_lttr')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Authority Req</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('auth_req_lttr')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Requests</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item weapon_transport_li">
        <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M528 56c0-13.3-10.7-24-24-24s-24 10.7-24 24v8H32C14.3 64 0 78.3 0 96V208c0 17.7 14.3 32 32 32H42c20.8 0 36.1 19.6 31 39.8L33 440.2c-2.4 9.6-.2 19.7 5.8 27.5S54.1 480 64 480h96c14.7 0 27.5-10 31-24.2L217 352H321.4c23.7 0 44.8-14.9 52.7-37.2L400.9 240H432c8.5 0 16.6-3.4 22.6-9.4L477.3 208H544c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32H528V56zM321.4 304H229l16-64h105l-21 58.7c-1.1 3.2-4.2 5.3-7.5 5.3zM80 128H464c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
          <p>Weapon Transport
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../tables/simple.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create Authority Req</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tables/data.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Requests</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tables/jsgrid.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Explosive</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item report_li">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>Report
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../tables/simple.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Troops Authority Reqs</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../tables/data.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Weapon Authority Reqs</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item settings_li">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p>Settings
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('create_user')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Create User</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../tables/simple.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Change Password</p>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item logout_li">
        <a href="{{route('logout')}}" class="nav-link">
          <i class="nav-icon fas fa-power-off"></i>
          <p class="logout">Logout</p>
        </a>
      </li>
  

    </ul>

  </nav>
</div>