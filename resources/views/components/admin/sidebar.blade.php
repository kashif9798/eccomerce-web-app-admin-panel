<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
      Interface
    </div>
    <hr class="sidebar-divider my-0">

    <x-admin.sidebar.products-sidebar-link/>

    <x-admin.sidebar.categories-sidebar-link/>        


    <!-- Divider -->
    <span class="d-block my-4">


    <div class="sidebar-heading">
      User Settings
    </div>

    <hr class="sidebar-divider my-0">

    <x-admin.sidebar.logout-sidebar-link/>
    <x-admin.sidebar.email-sidebar-link/>

  </ul>