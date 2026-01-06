<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Lowongan</h1>
            <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/lowongan/update/' . $lowonganData['id_lowongan']) ?>" method="POST" enctype="multipart/form-data" id="editLowonganForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_lowongan_id" class="form-label required">
                                    Nama Lowongan
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('nama_lowongan_id')) ? 'is-invalid' : '' ?>" 
                                       id="nama_lowongan_id" 
                                       name="nama_lowongan_id" 
                                       value="<?= old('nama_lowongan_id', $lowonganData['nama_lowongan_id']) ?>" 
                                       required>
                                <?php if ($validation->hasError('nama_lowongan_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_lowongan_id') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Hanya huruf dan angka
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_lowongan_id" class="form-label">Deskripsi Lowongan</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_lowongan_id" 
                                          name="deskripsi_lowongan_id" 
                                          rows="6"><?= old('deskripsi_lowongan_id', $lowonganData['deskripsi_lowongan_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="kualifikasi_lowongan_id" class="form-label">Kualifikasi</label>
                                <textarea class="form-control tiny" 
                                          id="kualifikasi_lowongan_id" 
                                          name="kualifikasi_lowongan_id" 
                                          rows="6"><?= old('kualifikasi_lowongan_id', $lowonganData['kualifikasi_lowongan_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="tawaran_lowongan_id" class="form-label">Tawaran</label>
                                <textarea class="form-control tiny" 
                                          id="tawaran_lowongan_id" 
                                          name="tawaran_lowongan_id" 
                                          rows="6"><?= old('tawaran_lowongan_id', $lowonganData['tawaran_lowongan_id']) ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Poster Saat Ini</label>
                                <div class="current-image mb-3">
                                    <?php if ($lowonganData['poster_lowongan'] && file_exists(FCPATH . 'assets/img/lowongan/' . $lowonganData['poster_lowongan'])): ?>
                                    <div class="image-container">
                                        <img src="<?= base_url('assets/img/lowongan/' . $lowonganData['poster_lowongan']) ?>" 
                                             alt="Poster Lowongan" 
                                             class="img-fluid rounded border" 
                                             id="currentPoster">
                                        <div class="image-info mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i> 
                                                Poster saat ini. Kosongkan jika tidak ingin mengganti.
                                            </small>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Belum ada poster yang diupload
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <label for="poster_lowongan" class="form-label">Ganti Poster (Opsional)</label>
                                <input type="file" 
                                       class="form-control <?= ($validation->hasError('poster_lowongan')) ? 'is-invalid' : '' ?>" 
                                       id="poster_lowongan" 
                                       name="poster_lowongan" 
                                       accept="image/jpg,image/jpeg,image/png">
                                <?php if ($validation->hasError('poster_lowongan')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('poster_lowongan') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                </div>
                                
                                <div class="image-preview mt-3" id="newPosterPreview" style="display: none;">
                                    <h6 class="mb-2">Preview Poster Baru:</h6>
                                    <img id="posterPreview" 
                                         class="img-fluid rounded border" 
                                         alt="Preview Poster Baru">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="status_lowongan" class="form-label required">Status</label>
                                <select class="form-control" id="status_lowongan" name="status_lowongan" required>
                                    <option value="active" <?= old('status_lowongan', $lowonganData['status_lowongan']) == 'active' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="inactive" <?= old('status_lowongan', $lowonganData['status_lowongan']) == 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="slug_lowongan_id" class="form-label">Slug</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="slug_lowongan_id" 
                                           name="slug_lowongan_id" 
                                           value="<?= old('slug_lowongan_id', $lowonganData['slug_lowongan_id']) ?>" 
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-link me-1"></i> Digunakan untuk URL: 
                                    <code>/lowongan/<?= $lowonganData['slug_lowongan_id'] ?></code>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_lowongan_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_lowongan_id" 
                                               name="title_lowongan_id" 
                                               value="<?= old('title_lowongan_id', $lowonganData['title_lowongan_id']) ?>"
                                               maxlength="59">
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="titleCounter"><?= strlen($lowonganData['title_lowongan_id'] ?? '') ?></span>/59</small>
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
                                                  maxlength="159"><?= old('meta_desc_id', $lowonganData['meta_desc_id']) ?></textarea>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="metaCounter"><?= strlen($lowonganData['meta_desc_id'] ?? '') ?></span>/159</small>
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
                                                <?= date('d/m/Y H:i', strtotime($lowonganData['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Diupdate:</small>
                                            <p class="mb-1">
                                                <?= date('d/m/Y H:i', strtotime($lowonganData['updated_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/lowongan') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Lowongan
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
document.getElementById('nama_lowongan_id').addEventListener('input', function() {
    generateSlug();
});

document.getElementById('generateSlug').addEventListener('click', function() {
    generateSlug();
});

function generateSlug() {
    const name = document.getElementById('nama_lowongan_id').value;
    const slugField = document.getElementById('slug_lowongan_id');
    
    if (name.trim()) {
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        slugField.value = slug;
    }
}

// Character counters
document.getElementById('title_lowongan_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

// Image preview for new poster
document.getElementById('poster_lowongan').addEventListener('change', function(e) {
    const preview = document.getElementById('posterPreview');
    const previewContainer = document.getElementById('newPosterPreview');
    const currentPoster = document.getElementById('currentPoster');
    const file = e.target.files[0];
    
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB!');
            this.value = '';
            return;
        }
        
        if (!file.type.match('image/jpeg') && !file.type.match('image/jpg') && !file.type.match('image/png')) {
            alert('Format file harus JPG, JPEG, atau PNG!');
            this.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            
            if (currentPoster) {
                currentPoster.style.opacity = '0.5';
            }
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        if (currentPoster) {
            currentPoster.style.opacity = '1';
        }
    }
});

// Form validation
document.getElementById('editLowonganForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>