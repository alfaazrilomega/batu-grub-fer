<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Anggota</h1>
            <a href="<?= base_url('admin/anggota') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/anggota/update/' . $anggotaData['id_anggota']) ?>" method="POST" enctype="multipart/form-data" id="editAnggotaForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_perusahaan_anggota" class="form-label required">
                                    Nama Perusahaan
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('nama_perusahaan_anggota')) ? 'is-invalid' : '' ?>" 
                                       id="nama_perusahaan_anggota" 
                                       name="nama_perusahaan_anggota" 
                                       value="<?= old('nama_perusahaan_anggota', $anggotaData['nama_perusahaan_anggota']) ?>" 
                                       required>
                                <?php if ($validation->hasError('nama_perusahaan_anggota')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_perusahaan_anggota') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_anggota_id" class="form-label">Deskripsi Anggota</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_anggota_id" 
                                          name="deskripsi_anggota_id" 
                                          rows="8"><?= old('deskripsi_anggota_id', $anggotaData['deskripsi_anggota_id']) ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_anggota_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_anggota_id" 
                                               name="title_anggota_id" 
                                               value="<?= old('title_anggota_id', $anggotaData['title_anggota_id']) ?>"
                                               maxlength="59">
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="titleCounter"><?= strlen($anggotaData['title_anggota_id'] ?? '') ?></span>/59</small>
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
                                                  maxlength="159"><?= old('meta_desc_id', $anggotaData['meta_desc_id']) ?></textarea>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="metaCounter"><?= strlen($anggotaData['meta_desc_id'] ?? '') ?></span>/159</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Logo Saat Ini</label>
                                        <div class="current-image mb-3">
                                            <?php if ($anggotaData['logo_anggota'] && file_exists(FCPATH . 'assets/img/anggota/' . $anggotaData['logo_anggota'])): ?>
                                            <div class="image-container">
                                                <img src="<?= base_url('assets/img/anggota/' . $anggotaData['logo_anggota']) ?>" 
                                                     alt="Logo <?= htmlspecialchars($anggotaData['nama_perusahaan_anggota'] ?? 'Anggota', ENT_QUOTES, 'UTF-8') ?>" 
                                                     class="img-fluid rounded border" 
                                                     id="currentLogo">
                                                <div class="image-info mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i> 
                                                        Logo saat ini. Kosongkan jika tidak ingin mengganti.
                                                    </small>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Belum ada logo yang diupload
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <label for="logo_anggota" class="form-label">Ganti Logo (Opsional)</label>
                                        <input type="file" 
                                               class="form-control <?= ($validation->hasError('logo_anggota')) ? 'is-invalid' : '' ?>" 
                                               id="logo_anggota" 
                                               name="logo_anggota" 
                                               accept="image/jpg,image/jpeg,image/png">
                                        <?php if ($validation->hasError('logo_anggota')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('logo_anggota') ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                        </div>
                                        
                                        <div class="image-preview mt-3" id="newLogoPreview" style="display: none;">
                                            <h6 class="mb-2">Preview Logo Baru:</h6>
                                            <img id="logoPreview" 
                                                 class="img-fluid rounded border" 
                                                 alt="Preview Logo Baru">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="current-image mb-3">
                                            <?php if ($anggotaData['image_anggota'] && file_exists(FCPATH . 'assets/img/anggota/' . $anggotaData['image_anggota'])): ?>
                                            <div class="image-container">
                                                <img src="<?= base_url('assets/img/anggota/' . $anggotaData['image_anggota']) ?>" 
                                                     alt="Gambar <?= htmlspecialchars($anggotaData['nama_perusahaan_anggota'] ?? 'Anggota', ENT_QUOTES, 'UTF-8') ?>" 
                                                     class="img-fluid rounded border" 
                                                     id="currentImage">
                                                <div class="image-info mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i> 
                                                        Gambar saat ini. Kosongkan jika tidak ingin mengganti.
                                                    </small>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Belum ada gambar yang diupload
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <label for="image_anggota" class="form-label">Ganti Gambar (Opsional)</label>
                                        <input type="file" 
                                               class="form-control <?= ($validation->hasError('image_anggota')) ? 'is-invalid' : '' ?>" 
                                               id="image_anggota" 
                                               name="image_anggota" 
                                               accept="image/jpg,image/jpeg,image/png">
                                        <?php if ($validation->hasError('image_anggota')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('image_anggota') ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="form-text">
                                            <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                        </div>
                                        
                                        <div class="image-preview mt-3" id="newImagePreview" style="display: none;">
                                            <h6 class="mb-2">Preview Gambar Baru:</h6>
                                            <img id="imagePreview" 
                                                 class="img-fluid rounded border" 
                                                 alt="Preview Gambar Baru">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="slug_anggota_id" class="form-label">Slug</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="slug_anggota_id" 
                                           name="slug_anggota_id" 
                                           value="<?= old('slug_anggota_id', $anggotaData['slug_anggota_id']) ?>" 
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-link me-1"></i> Digunakan untuk URL: 
                                    <code>/anggota/<?= $anggotaData['slug_anggota_id'] ?></code>
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
                                                <?= date('d/m/Y H:i', strtotime($anggotaData['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Diupdate:</small>
                                            <p class="mb-1">
                                                <?= date('d/m/Y H:i', strtotime($anggotaData['updated_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/anggota') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Anggota
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
document.getElementById('nama_perusahaan_anggota').addEventListener('input', function() {
    generateSlug();
});

document.getElementById('generateSlug').addEventListener('click', function() {
    generateSlug();
});

function generateSlug() {
    const name = document.getElementById('nama_perusahaan_anggota').value;
    const slugField = document.getElementById('slug_anggota_id');
    
    if (name.trim()) {
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        slugField.value = slug;
    }
}

// Character counters
document.getElementById('title_anggota_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

// Logo preview for new file
document.getElementById('logo_anggota').addEventListener('change', function(e) {
    const preview = document.getElementById('logoPreview');
    const previewContainer = document.getElementById('newLogoPreview');
    const currentLogo = document.getElementById('currentLogo');
    const file = e.target.files[0];
    
    if (file) {
        // Validation
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
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            
            // Hide current logo if exists
            if (currentLogo) {
                currentLogo.style.opacity = '0.5';
            }
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        if (currentLogo) {
            currentLogo.style.opacity = '1';
        }
    }
});

// Image preview for new file
document.getElementById('image_anggota').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const previewContainer = document.getElementById('newImagePreview');
    const currentImage = document.getElementById('currentImage');
    const file = e.target.files[0];
    
    if (file) {
        // Validation
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
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
            
            // Hide current image if exists
            if (currentImage) {
                currentImage.style.opacity = '0.5';
            }
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        if (currentImage) {
            currentImage.style.opacity = '1';
        }
    }
});

// Form validation
document.getElementById('editAnggotaForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>