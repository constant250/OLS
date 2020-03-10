<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('users.show', Auth::user()->id)}}">
     <div class="sidebar-brand-icon" style="width: 3rem;position:relative;">
        <img class="img-profile rounded-circle" style="width: 100%;" src="/storage/user/avatars/{{Auth::user()->profile_image}}">
      </div>
      <div class="sidebar-brand-text mx-3">Hi {{ Auth::user()->username }} </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="/home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    {{-- <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Interface
    </div> --}}
    <!-- Nav Item - Pages Collapse Menu -->
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
      Management
    </div> --}}
    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-hands-helping"></i>
        <span>Students</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('student.index') }}"><i class="fas fa-envelope-open-text"></i> Offer Letter</a>
          <a class="collapse-item" href="#"><i class="fas fa-money-bill-wave"></i></i> Payment Schedule</a>
          <a class="collapse-item" href="#"><i class="fas fa-tasks"></i> Course Completion</a>
          <a class="collapse-item" href="#"><i class="fas fa-chart-line"></i> Progress Report</a>
          <a class="collapse-item" href="#"><i class="fas fa-certificate"></i> Certificate Issuance</a>
        </div>
      </div>
    </li> --}}
    <li class="nav-item">
      {{-- <a class="nav-link" href="{{ route('quotation.index')  }}"> --}}
      <a class="nav-link" href="{{route('project.index')}}">
        <i class="fas fa-home"></i>
        <span>Projects</span></a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="/discipline">
        <i class="fas fa-first-aid"></i>
        <span>Disciplines</span></a>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="/sub-discipline">
        <i class="fas fa-first-aid"></i>
        <span>Sub-Disciplines</span></a>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="/category">
        <i class="fas fa-first-aid"></i>
        <span>Categories</span></a>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="/family-type">
        <i class="fas fa-first-aid"></i>
        <span>Family Types</span></a>
    </li> --}}
    {{-- <li class="nav-item">
      <a class="nav-link" href="/family">
        <i class="fas fa-first-aid"></i>
        <span>Families</span></a>
    </li> --}}
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </ul>