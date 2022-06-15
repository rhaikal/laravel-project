<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/barangs*') ? 'active' : '' }}" href="/dashboard/barangs">
        <span data-feather="package"></span>
          Barang
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/pesanans*') ? 'active' : '' }}" href="/dashboard/pesanans">
        <span data-feather="archive"></span>
          Pesanan
        </a>
      </li>
    </ul>
  </div>
</nav>