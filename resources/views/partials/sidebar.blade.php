<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <!-- Category Products -->
        <li class="nav-item">
          <a href="{{route('categories.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Category Products
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>



        <!-- Menu -->
        <li class="nav-item">
          <a href="{{route('menus.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Menus
            </p>
          </a>
        </li>

        <!-- Product -->
        <li class="nav-item">
          <a href="{{route('products.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Products
            </p>
          </a>
        </li>

        <!-- Slider -->
        <li class="nav-item">
          <a href="{{route('sliders.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Slider
            </p>
          </a>
        </li>

        <!-- setting -->
        <li class="nav-item">
          <a href="{{route('settings.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Setting
            </p>
          </a>
        </li>

        <!-- Employee -->
        <li class="nav-item">
          <a href="{{route('users.index')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Employee List
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>