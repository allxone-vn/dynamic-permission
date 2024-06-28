<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <title>ADMIN DASHBOARD</title>
  </head>
  <body id="body">
    <div class="container">
      <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a class="active_link" href="#">Admin</a>
        </div>
        <div class="navbar__right">
          <a href="#">
            <i class="fa fa-search" aria-hidden="true"></i>
          </a>
          <a href="#">
            <img width="30" src="{{ asset('assets/avatar.svg') }}" alt="" />
            <!-- <i class="fa fa-user-circle-o" aria-hidden="true"></i> -->
          </a>
        </div>
      </nav>

      <main>
        <div class="main__container">
          @yield('content')
          @yield('scripts')
        </div>
      </main>

      <div id="sidebar">
        <div class="sidebar__title">
          <div class="sidebar__img">
            <img src="https://cdn.worldvectorlogo.com/logos/laravel-2.svg" alt="logo" />
            <h1>&nbsp&nbsp&nbspLARAVEL</h1>
          </div>
          <i
            onclick="closeSidebar()"
            class="fa fa-times"
            id="sidebarIcon"
            aria-hidden="true"
          ></i>
        </div>

        <div class="sidebar__menu">
          <div class="sidebar__link active_menu_link">
            <i class="fa fa-home"></i>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
          </div>
          <div class="sidebar__link">
            <i class="fas fa-user"></i>
            <a href="{{ route('admin.profile') }}">Profile</a>
          </div>
          <div class="sidebar__link">
            <i class="fas fa-list"></i>
            <a href="{{ route('admin.employeeList') }}">Employee Management</a>
          </div>
          <div class="sidebar__link">
            <i class="fas fa-users-cog"></i>
            <a href="{{ route('permissions.index') }}">Permission</a>
          </div>
          <div class="sidebar__link">
            <i class="fas fa-key"></i>
            <a href="{{ route('changePassword_form') }}">Change password</a>
          </div>
          <div class="sidebar__logout">
            <a href="#" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/script.js"></script>
  </body>
</html>
