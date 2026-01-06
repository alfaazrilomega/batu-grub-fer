<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Tentang Perusahaan</h1>
            <div>
                <a href="<?= base_url('admin/tentang/edit') ?>" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Data
                </a>
            </div>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-lg-4">
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Informasi Perusahaan</h5>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Nama Perusahaan:</strong>
                            <span><?= $tentangData['nama_perusahaan'] ?? 'Belum diisi' ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Slug:</strong>
                            <span><?= $tentangData['slug_tentang_id'] ?? 'Belum diisi' ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Link YouTube:</strong>
                            <?php if (!empty($tentangData['link_youtube'])): ?>
                            <a href="<?= $tentangData['link_youtube'] ?>" target="_blank" class="text-decoration-none">
                                <?= $tentangData['link_youtube'] ?>
                            </a>
                            <?php else: ?>
                            <span class="text-muted">Belum diisi</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Logo & Favicon</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <strong class="d-block mb-2">Logo:</strong>
                                <?php if (!empty($tentangData['logo']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['logo'])): ?>
                                <img src="<?= base_url('assets/img/tentang/' . $tentangData['logo']) ?>" 
                                     alt="Logo" 
                                     class="img-fluid rounded border"
                                     style="max-height: 100px;">
                                <?php else: ?>
                                <span class="text-muted">Belum ada logo</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-2">Favicon:</strong>
                                <?php if (!empty($tentangData['favicon']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['favicon'])): ?>
                                <img src="<?= base_url('assets/img/tentang/' . $tentangData['favicon']) ?>" 
                                     alt="Favicon" 
                                     class="img-fluid rounded border"
                                     style="max-height: 50px; max-width: 50px;">
                                <?php else: ?>
                                <span class="text-muted">Belum ada favicon</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Deskripsi & Snippet</h5>
                        <div class="mb-3">
                            <strong class="d-block mb-2">Snippet:</strong>
                            <p class="mb-0"><?= !empty($tentangData['snippet_id']) ? nl2br(htmlspecialchars($tentangData['snippet_id'])) : '<span class="text-muted">Belum diisi</span>' ?></p>
                        </div>
                        <div>
                            <strong class="d-block mb-2">Deskripsi Lengkap:</strong>
                            <div class="tentang-description">
                                <?= !empty($tentangData['deskripsi_tentang_id']) ? $tentangData['deskripsi_tentang_id'] : '<span class="text-muted">Belum diisi</span>' ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="app-card mb-4">
                            <div class="app-card-body">
                                <h5 class="card-title mb-3">Visi</h5>
                                <div class="visi-content">
                                    <?= !empty($tentangData['visi_id']) ? $tentangData['visi_id'] : '<span class="text-muted">Belum diisi</span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="app-card mb-4">
                            <div class="app-card-body">
                                <h5 class="card-title mb-3">Misi</h5>
                                <div class="misi-content">
                                    <?= !empty($tentangData['misi_id']) ? $tentangData['misi_id'] : '<span class="text-muted">Belum diisi</span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Struktur Organisasi</h5>
                        <?php if (!empty($tentangData['struktur_organisasi']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['struktur_organisasi'])): ?>
                        <img src="<?= base_url('assets/img/tentang/' . $tentangData['struktur_organisasi']) ?>" 
                             alt="Struktur Organisasi" 
                             class="img-fluid rounded border">
                        <?php else: ?>
                        <span class="text-muted">Belum ada struktur organisasi</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="app-card">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">SEO Settings</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <strong class="d-block mb-2">Meta Title:</strong>
                                <p class="mb-0"><?= !empty($tentangData['title_tentang_id']) ? $tentangData['title_tentang_id'] : '<span class="text-muted">Belum diisi</span>' ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-2">Meta Description:</strong>
                                <p class="mb-0"><?= !empty($tentangData['meta_desc_id']) ? $tentangData['meta_desc_id'] : '<span class="text-muted">Belum diisi</span>' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alert alert-info mt-4">
            <h6 class="alert-heading mb-2">
                <i class="fas fa-info-circle me-2"></i>Informasi
            </h6>
            <p class="mb-0">Hanya ada satu data tentang perusahaan. Klik tombol "Edit Data" untuk mengubah informasi tentang perusahaan.</p>
        </div>
    </div>
</div>

<style>
.tentang-description, .visi-content, .misi-content {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    border: 1px solid #e9ecef;
}
</style>

<?= $this->endSection() ?>