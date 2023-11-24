<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/queue">
      {{-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div> --}}
      <div class="sidebar-brand-text mx-3">Admin MOTO-FIX</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
      <a class="nav-link" href="/queue">
          <i class="fas fa-solid fa-list"></i>
          <span>QUEUE</span></a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="/storage">
          <i class="fas fa-solid fa-warehouse"></i>
          <span>STORAGE</span>
      </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
      manage
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
          aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Master:</h6>
              <a class="collapse-item" href="/category">Category</a>
              <a class="collapse-item" href="/suplier">Suplier</a>
              <a class="collapse-item" href="/price">Service Price</a>
          </div>
      </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>