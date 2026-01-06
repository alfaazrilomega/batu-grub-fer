<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Tambah Anggota</h1>
            <a href="<?= base_url('admin/anggota') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
        
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <div class="app-card">
            <div class="app-card-body">
                <form action="<?= base_url('admin/anggota/tambah') ?>" method="POST" enctype="multipart/form-data" id="anggotaForm">
                    <?= csrf_field() ?>
                    
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
                                       value="<?= old('nama_perusahaan_anggota') ?>" 
                                       placeholder="Masukkan nama perusahaan"
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
                                          rows="8"
                                          placeholder="Deskripsi lengkap tentang anggota perusahaan"><?= old('deskripsi_anggota_id') ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_anggota_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_anggota_id" 
                                               name="title_anggota_id" 
                                               value="<?= old('title_anggota_id') ?>"
                                               placeholder="Max 59 karakter"
                                               maxlength="59">
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO halaman</small>
                                            <small class="text-muted"><span id="titleCounter">0</span>/59</small>
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
                                                  placeholder="Max 159 karakter"
                                                  maxlength="159"><?= old('meta_desc_id') ?></textarea>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO halaman</small>
                                            <small class="text-muted"><span id="metaCounter">0</span>/159</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="logo_anggota" class="form-label required">
                                            Logo Perusahaan
                                        </label>
                                        <div class="file-upload-area">
                                            <input type="file" 
                                                   class="form-control <?= ($validation->hasError('logo_anggota')) ? 'is-invalid' : '' ?>" 
                                                   id="logo_anggota" 
                                                   name="logo_anggota" 
                                                   accept="image/jpg,image/jpeg,image/png"
                                                   required>
                                            <?php if ($validation->hasError('logo_anggota')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('logo_anggota') ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="image-preview mt-3">
                                            <div class="preview-container">
                                                <img id="logoPreview" 
                                                     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-size='14' fill='%236c757d'%3EPreview Logo%3C/text%3E%3C/svg%3E" 
                                                     alt="Preview Logo Perusahaan" 
                                                     class="img-fluid rounded">
                                                <div class="preview-overlay">
                                                    <i class="fas fa-image"></i>
                                                    <span>Preview Logo</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="image_anggota" class="form-label required">
                                            Gambar Perusahaan
                                        </label>
                                        <div class="file-upload-area">
                                            <input type="file" 
                                                   class="form-control <?= ($validation->hasError('image_anggota')) ? 'is-invalid' : '' ?>" 
                                                   id="image_anggota" 
                                                   name="image_anggota" 
                                                   accept="image/jpg,image/jpeg,image/png"
                                                   required>
                                            <?php if ($validation->hasError('image_anggota')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('image_anggota') ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="image-preview mt-3">
                                            <div class="preview-container">
                                                <img id="imagePreview" 
                                                     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-size='14' fill='%236c757d'%3EPreview Gambar%3C/text%3E%3C/svg%3E" 
                                                     alt="Preview Gambar Perusahaan" 
                                                     class="img-fluid rounded">
                                                <div class="preview-overlay">
                                                    <i class="fas fa-image"></i>
                                                    <span>Preview Gambar</span>
                                                </div>
                                            </div>
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
                                           value="<?= old('slug_anggota_id') ?>" 
                                           placeholder="Akan digenerate otomatis"
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Slug untuk URL yang SEO-friendly
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-lightbulb me-2"></i>Tips
                                </h6>
                                <ul class="mb-0 ps-3">
                                    <li>Logo perusahaan digunakan untuk tampilan utama</li>
                                    <li>Gambar perusahaan digunakan untuk detail halaman</li>
                                    <li>Nama perusahaan harus jelas dan mudah dikenali</li>
                                    <li>Deskripsi harus informatif tentang perusahaan</li>
                                    <li>Semua field wajib diisi kecuali meta</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/anggota') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Anggota
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

// Logo preview
document.getElementById('logo_anggota').addEventListener('change', function(e) {
    const preview = document.getElementById('logoPreview');
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
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.objectFit = 'contain';
        };
        reader.readAsDataURL(file);
    }
});

// Image preview
document.getElementById('image_anggota').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
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
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.objectFit = 'contain';
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.getElementById('anggotaForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>