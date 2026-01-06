<div class="app-sidepanel" id="appSidepanel">
    <div class="app-branding">
        <a class="app-logo" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-gem logo-icon"></i>
            <span class="logo-text">BATU GRUB</span>
        </a>
    </div>
    
    <nav class="app-nav">
        <ul class="app-menu">
            <li class="nav-item">
                <a class="nav-link <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>" 
                   href="<?= base_url('admin/dashboard') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/anggota') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/anggota') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="nav-link-text">Anggota</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/artikel') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/artikel') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <span class="nav-link-text">Artikel</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/komoditas') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/komoditas') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-seedling"></i>
                    </span>
                    <span class="nav-link-text">Komoditas</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/karir') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/karir') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    <span class="nav-link-text">Karir</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/lowongan') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/lowongan') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </span>
                    <span class="nav-link-text">Lowongan</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/slider') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/slider') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-images"></i>
                    </span>
                    <span class="nav-link-text">Slider</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/tentang') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/tentang') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="nav-link-text">Tentang</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/kontak') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/kontak') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-address-book"></i>
                    </span>
                    <span class="nav-link-text">Kontak</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= strpos(current_url(), 'admin/meta') !== false ? 'active' : '' ?>" 
                   href="<?= base_url('admin/meta') ?>">
                    <span class="nav-icon">
                        <i class="fas fa-code"></i>
                    </span>
                    <span class="nav-link-text">Meta</span>
                </a>
            </li>
        </ul>
    </nav>
</div>