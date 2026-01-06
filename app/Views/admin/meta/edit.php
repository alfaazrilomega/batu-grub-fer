<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Meta</h1>
            <a href="<?= base_url('admin/meta') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
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
        
        <div class="app-card">
            <div class="app-card-body">
                <form action="<?= base_url('admin/meta/update/' . $metaData['id_meta']) ?>" method="POST" id="editMetaForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_halaman_id" class="form-label required">
                                    Nama Halaman
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="nama_halaman_id" 
                                       name="nama_halaman_id" 
                                       value="<?= old('nama_halaman_id', $metaData['nama_halaman_id']) ?>" 
                                       required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_halaman_id" class="form-label">Deskripsi Halaman</label>
                                <textarea class="form-control" 
                                          id="deskripsi_halaman_id" 
                                          name="deskripsi_halaman_id" 
                                          rows="4"><?= old('deskripsi_halaman_id', $metaData['deskripsi_halaman_id']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="title_id" class="form-label">Meta Title</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="title_id" 
                                       name="title_id" 
                                       value="<?= old('title_id', $metaData['title_id']) ?>"
                                       maxlength="59">
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Untuk SEO halaman</small>
                                    <small class="text-muted"><span id="titleCounter"><?= strlen($metaData['title_id'] ?? '') ?></span>/59</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="meta_desc_id" class="form-label">Meta Description</label>
                                <textarea class="form-control" 
                                          id="meta_desc_id" 
                                          name="meta_desc_id" 
                                          rows="3"
                                          maxlength="159"><?= old('meta_desc_id', $metaData['meta_desc_id']) ?></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Untuk SEO halaman</small>
                                    <small class="text-muted"><span id="metaCounter"><?= strlen($metaData['meta_desc_id'] ?? '') ?></span>/159</small>
                                </div>
                            </div>
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Meta
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted">ID Meta:</small>
                                            <p class="mb-1">
                                                <code><?= $metaData['id_meta'] ?></code>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Slug:</small>
                                            <p class="mb-1">
                                                <?php if (!empty($metaData['slug_meta_id'])): ?>
                                                <code class="badge bg-light text-dark"><?= $metaData['slug_meta_id'] ?></code>
                                                <?php else: ?>
                                                <span class="text-muted">Belum ada slug</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/meta') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Meta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Character counters
document.getElementById('title_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

// Form validation
document.getElementById('editMetaForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>