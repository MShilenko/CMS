<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <?php if ($user->isAdmin()): ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Настройки
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="/admin/settings">
        <i class="fas fa-fw fa-cog"></i>
        <span>Общие</span></a>
    </li>
  <?php endif; ?>  

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Разделы
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Login Screens:</h6>
        <a class="collapse-item" href="login.html">Login</a>
        <a class="collapse-item" href="register.html">Register</a>
        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
        <div class="collapse-divider"></div>
        <h6 class="collapse-header">Other Pages:</h6>
        <a class="collapse-item" href="404.html">404 Page</a>
        <a class="collapse-item" href="blank.html">Blank Page</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <?php if ($user->isAdmin()): ?>
    <li class="nav-item">
      <a class="nav-link" href="/admin/users">
        <i class="fas fa-fw fa-user"></i>
        <span>Пользователи</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/subscribes">
        <i class="fas fa-fw fa-envelope"></i>
        <span>Подписки</span></a>
    </li>
  <?php endif; ?>
  <li class="nav-item">
    <a class="nav-link" href="/admin/articles">
      <i class="fas fa-fw fa-book"></i>
      <span>Статьи</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/admin/pages">
      <i class="fas fa-fw fa-folder"></i>
      <span>Страницы</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/admin/comments">
      <i class="fas fa-fw fa-comments"></i>
      <span>Комментарии</span></a>
  </li>  

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->