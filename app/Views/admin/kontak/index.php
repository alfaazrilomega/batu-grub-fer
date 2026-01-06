<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Kontak</h1>
            <div>
                <a href="<?= base_url('admin/kontak/edit') ?>" class="btn btn-primary">
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
            <div class="col-lg-6">
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Informasi Kontak</h5>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Judul:</strong>
                            <span><?= $kontakData['judul_kontak_id'] ?? '-' ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Subjudul:</strong>
                            <span><?= $kontakData['subjudul_kontak_id'] ?? '-' ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Deskripsi:</strong>
                            <p><?= $kontakData['deskripsi_kontak_id'] ? nl2br(htmlspecialchars($kontakData['deskripsi_kontak_id'])) : '-' ?></p>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Slug:</strong>
                            <span><?= $kontakData['slug_kontak_id'] ?? '-' ?></span>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Link WhatsApp:</strong>
                            <?php if ($kontakData['link_wa']): ?>
                            <a href="<?= $kontakData['link_wa'] ?>" target="_blank"><?= $kontakData['link_wa'] ?></a>
                            <?php else: ?>
                            <span>-</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="app-card mb-4">
                    <div class="app-card-body">
                        <h5 class="card-title mb-3">Kontak Detail</h5>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Alamat:</strong>
                            <p><?= $kontakData['alamat_id'] ? nl2br(htmlspecialchars($kontakData['alamat_id'])) : '-' ?></p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong class="d-block mb-1">Telepon:</strong>
                                    <span><?= $kontakData['telepon'] ?? '-' ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong class="d-block mb-1">Email:</strong>
                                    <?php if ($kontakData['email']): ?>
                                    <a href="mailto:<?= $kontakData['email'] ?>"><?= $kontakData['email'] ?></a>
                                    <?php else: ?>
                                    <span>-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <strong class="d-block mb-1">Jam Operasional:</strong>
                            <p><?= $kontakData['jam_operasional'] ? nl2br(htmlspecialchars($kontakData['jam_operasional'])) : '-' ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <h6 class="alert-heading mb-2">
                        <i class="fas fa-info-circle me-2"></i>Informasi
                    </h6>
                    <p class="mb-0">Data kontak ini akan ditampilkan pada halaman kontak website. Klik tombol "Edit Data" untuk mengubah informasi kontak.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>