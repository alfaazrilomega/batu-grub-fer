<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Karir</h1>
            <a href="<?= base_url('admin/karir') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/karir/update/' . $karirData['id_karir']) ?>" method="POST" id="editKarirForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="judul_karir_id" class="form-label required">
                                    Judul Karir
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('judul_karir_id')) ? 'is-invalid' : '' ?>" 
                                       id="judul_karir_id" 
                                       name="judul_karir_id" 
                                       value="<?= old('judul_karir_id', $karirData['judul_karir_id']) ?>" 
                                       required>
                                <?php if ($validation->hasError('judul_karir_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_karir_id') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Hanya huruf dan angka
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_karir_id" class="form-label">Deskripsi Karir</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_karir_id" 
                                          name="deskripsi_karir_id" 
                                          rows="8"><?= old('deskripsi_karir_id', $karirData['deskripsi_karir_id']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="slug_karir_id" class="form-label">Slug</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="slug_karir_id" 
                                           name="slug_karir_id" 
                                           value="<?= old('slug_karir_id', $karirData['slug_karir_id']) ?>" 
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-link me-1"></i> Digunakan untuk URL: 
                                    <code>/karir/<?= $karirData['slug_karir_id'] ?></code>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_karir_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_karir_id" 
                                               name="title_karir_id" 
                                               value="<?= old('title_karir_id', $karirData['title_karir_id']) ?>"
                                               maxlength="59">
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="titleCounter"><?= strlen($karirData['title_karir_id'] ?? '') ?></span>/59</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="meta_desc_id" class="form-label">Meta Description</label>
                                        <textarea class="form-control" 
                                                  id="meta_desc_id" 
                                                  name="meta_desc_id" 
                                                  rows="2"
                                                  maxlength="159"><?= old('meta_desc_id', $karirData['meta_desc_id']) ?></textarea>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="metaCounter"><?= strlen($karirData['meta_desc_id'] ?? '') ?></span>/159</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-history me-2"></i>Informasi Update
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted">Dibuat:</small>
                                            <p class="mb-1">
                                                <?= date('d/m/Y H:i', strtotime($karirData['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Diupdate:</small>
                                            <p class="mb-1">
                                                <?= date('d/m/Y H:i', strtotime($karirData['updated_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/karir') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Karir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto generate slug
document.getElementById('judul_karir_id').addEventListener('input', function() {
    generateSlug();
});

document.getElementById('generateSlug').addEventListener('click', function() {
    generateSlug();
});

function generateSlug() {
    const name = document.getElementById('judul_karir_id').value;
    const slugField = document.getElementById('slug_karir_id');
    
    if (name.trim()) {
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        slugField.value = slug;
    }
}

// Character counters
document.getElementById('title_karir_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

// Form validation
document.getElementById('editKarirForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>