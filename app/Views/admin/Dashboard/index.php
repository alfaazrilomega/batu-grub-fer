<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <h1 class="app-page-title">Dashboard</h1>
        
        <!-- Mobile-friendly stats grid -->
        <div class="stats-grid-mobile">
            <!-- Row 1 -->
            <div class="mobile-stats-row">
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/anggota') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_anggota ?></div>
                    <div class="stat-label-mobile">Anggota</div>
                </div>
                
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/artikel') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_artikel ?></div>
                    <div class="stat-label-mobile">Artikel</div>
                </div>
            </div>
            
            <!-- Row 2 -->
            <div class="mobile-stats-row">
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/komoditas') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_komoditas ?></div>
                    <div class="stat-label-mobile">Komoditas</div>
                </div>
                
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/karir') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_karir ?></div>
                    <div class="stat-label-mobile">Karir</div>
                </div>
            </div>
            
            <!-- Row 3 -->
            <div class="mobile-stats-row">
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/lowongan') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_lowongan ?></div>
                    <div class="stat-label-mobile">Lowongan</div>
                </div>
                
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/slider') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_slider ?></div>
                    <div class="stat-label-mobile">Slider</div>
                </div>
            </div>
            
            <!-- Row 4 (Single card for odd number) -->
            <div class="mobile-stats-row mobile-single-card">
                <div class="stat-card-mobile" onclick="location.href='<?= base_url('admin/meta') ?>'">
                    <div class="stat-icon-mobile">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="stat-number-mobile"><?= $total_meta ?></div>
                    <div class="stat-label-mobile">Meta</div>
                </div>
            </div>
        </div>
        
        <!-- Original Desktop Grid (hidden on mobile) -->
        <div class="stats-grid desktop-only">
            <div class="stat-card" onclick="location.href='<?= base_url('admin/anggota') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number"><?= $total_anggota ?></div>
                <div class="stat-label">Anggota</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/artikel') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-number"><?= $total_artikel ?></div>
                <div class="stat-label">Artikel</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/komoditas') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="stat-number"><?= $total_komoditas ?></div>
                <div class="stat-label">Komoditas</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/karir') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-number"><?= $total_karir ?></div>
                <div class="stat-label">Karir</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/lowongan') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-number"><?= $total_lowongan ?></div>
                <div class="stat-label">Lowongan</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/slider') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stat-number"><?= $total_slider ?></div>
                <div class="stat-label">Slider</div>
            </div>
            
            <div class="stat-card" onclick="location.href='<?= base_url('admin/meta') ?>'">
                <div class="stat-icon">
                    <i class="fas fa-code"></i>
                </div>
                <div class="stat-number"><?= $total_meta ?></div>
                <div class="stat-label">Meta</div>
            </div>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mt-4 mobile-alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mt-4 mobile-alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>