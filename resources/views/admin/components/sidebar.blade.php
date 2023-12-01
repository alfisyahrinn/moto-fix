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
<li class="nav-item {{ request()->routeIs('admin.pages.dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.pages.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Nav Item - Queue -->
<li class="nav-item {{ request()->routeIs('queue.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('queue.index') }}">
        <i class="fas fa-solid fa-clock"></i> <!-- Updated icon to clock -->
        <span>Queue</span>
    </a>
</li>

<!-- Nav Item - Transaction -->
<li class="nav-item {{ request()->routeIs('transaction.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('transaction.index') }}">
        <i class="fas fa-money-bill-wave"></i>
        <span>Transaction</span>
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
                {{-- <a class="collapse-item" href="{{ route('category.index') }}">Category</a> --}}
                {{-- <a class="collapse-item" href="{{ route('supplier.index') }}">Suplier</a> --}}
                {{-- <a class="collapse-item" href="/price">Service Price</a> --}}
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
