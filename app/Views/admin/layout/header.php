<header class="app-header">
    <div class="app-header-inner">
        <div class="app-header-content">
            <div class="d-flex align-items-center gap-2">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="d-none d-md-inline">Admin Panel</span>
            </div>
            
            <div class="app-user-dropdown">
                <a class="dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    <span class="d-none d-md-inline"><?= session()->get('username') ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="<?= site_url('logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>