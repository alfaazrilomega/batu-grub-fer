<div id="app-sidepanel" class="app-sidepanel">
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-gem me-2"></i>
                <span class="logo-text">BATU GRUB</span>
            </a>
        </div>
        
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/anggota/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="nav-link-text">Anggota</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/artikel/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-newspaper"></i>
                        </span>
                        <span class="nav-link-text">Artikel</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/komoditas/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-seedling"></i>
                        </span>
                        <span class="nav-link-text">Komoditas</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/karir/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-briefcase"></i>
                        </span>
                        <span class="nav-link-text">Karir</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/lowongan/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </span>
                        <span class="nav-link-text">Lowongan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/slider/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-images"></i>
                        </span>
                        <span class="nav-link-text">Slider</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/tentang') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-building"></i>
                        </span>
                        <span class="nav-link-text">Tentang</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/kontak') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-address-book"></i>
                        </span>
                        <span class="nav-link-text">Kontak</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/meta/index') ?>">
                        <span class="nav-icon">
                            <i class="fas fa-code"></i>
                        </span>
                        <span class="nav-link-text">Meta</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>