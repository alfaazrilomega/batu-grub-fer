<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Tambah Artikel</h1>
            <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/artikel/tambah') ?>" method="POST" enctype="multipart/form-data" id="artikelForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="judul_artikel_id" class="form-label required">
                                    Judul Artikel
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('judul_artikel_id')) ? 'is-invalid' : '' ?>" 
                                       id="judul_artikel_id" 
                                       name="judul_artikel_id" 
                                       value="<?= old('judul_artikel_id') ?>" 
                                       placeholder="Masukkan judul artikel"
                                       required>
                                <?php if ($validation->hasError('judul_artikel_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_artikel_id') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Hanya huruf dan angka
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="snippet_id" class="form-label">Snippet</label>
                                <textarea class="form-control" 
                                          id="snippet_id" 
                                          name="snippet_id" 
                                          rows="3"
                                          placeholder="Ringkasan singkat artikel (max 200 karakter)"
                                          maxlength="200"><?= old('snippet_id') ?></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Ringkasan yang ditampilkan di halaman list</small>
                                    <small class="text-muted"><span id="snippetCounter">0</span>/200</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_artikel_id" class="form-label">Deskripsi Lengkap</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_artikel_id" 
                                          name="deskripsi_artikel_id" 
                                          rows="8"
                                          placeholder="Konten artikel lengkap"><?= old('deskripsi_artikel_id') ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_artikel_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_artikel_id" 
                                               name="title_artikel_id" 
                                               value="<?= old('title_artikel_id') ?>"
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
                            <div class="mb-4">
                                <label for="foto_artikel" class="form-label required">
                                    Foto Artikel
                                </label>
                                <div class="file-upload-area">
                                    <input type="file" 
                                           class="form-control <?= ($validation->hasError('foto_artikel')) ? 'is-invalid' : '' ?>" 
                                           id="foto_artikel" 
                                           name="foto_artikel" 
                                           accept="image/jpg,image/jpeg,image/png"
                                           required>
                                    <?php if ($validation->hasError('foto_artikel')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto_artikel') ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i> 
                                        Format: JPG, JPEG, PNG. Maksimal 2MB. Ukuran maksimal 572x572 pixels
                                    </div>
                                </div>
                                
                                <div class="image-preview mt-3">
                                    <div class="preview-container">
                                        <img id="fotoPreview" 
                                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-size='14' fill='%236c757d'%3EPreview akan muncul disini%3C/text%3E%3C/svg%3E" 
                                             alt="Preview Foto" 
                                             class="img-fluid rounded">
                                        <div class="preview-overlay">
                                            <i class="fas fa-image"></i>
                                            <span>Preview Foto</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="alt_artikel_id" class="form-label">Alt Text (Alternatif Gambar)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="alt_artikel_id" 
                                       name="alt_artikel_id" 
                                       value="<?= old('alt_artikel_id') ?>" 
                                       placeholder="Deskripsi untuk aksesibilitas dan SEO">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Digunakan untuk screen reader dan SEO gambar
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="slug_artikel_id" class="form-label">Slug</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="slug_artikel_id" 
                                           name="slug_artikel_id" 
                                           value="<?= old('slug_artikel_id') ?>" 
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
                                    <li>Gunakan foto dengan rasio 1:1 (572x572 pixels)</li>
                                    <li>Judul artikel harus unik dan menarik</li>
                                    <li>Snippet adalah ringkasan yang ditampilkan di list artikel</li>
                                    <li>Alt text penting untuk aksesibilitas dan SEO gambar</li>
                                    <li>Semua field wajib diisi kecuali meta dan alt text</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Artikel
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
document.getElementById('judul_artikel_id').addEventListener('input', function() {
    generateSlug();
});

document.getElementById('generateSlug').addEventListener('click', function() {
    generateSlug();
});

function generateSlug() {
    const title = document.getElementById('judul_artikel_id').value;
    const slugField = document.getElementById('slug_artikel_id');
    
    if (title.trim()) {
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        slugField.value = slug;
    }
}

// Character counters
document.getElementById('title_artikel_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

document.getElementById('snippet_id').addEventListener('input', function() {
    document.getElementById('snippetCounter').textContent = this.value.length;
});

// Image preview
document.getElementById('foto_artikel').addEventListener('change', function(e) {
    const preview = document.getElementById('fotoPreview');
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
        
        // Check image dimensions
        const img = new Image();
        img.onload = function() {
            if (this.width > 572 || this.height > 572) {
                alert('Ukuran gambar maksimal 572x572 pixels!');
                document.getElementById('foto_artikel').value = '';
                preview.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="300" height="200" viewBox="0 0 300 200"%3E%3Crect width="300" height="200" fill="%23f8f9fa"/%3E%3Ctext x="50%25" y="50%25" dominant-baseline="middle" text-anchor="middle" font-family="Arial" font-size="14" fill="%236c757d"%3EPreview akan muncul disini%3C/text%3E%3C/svg%3E';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.objectFit = 'contain';
            };
            reader.readAsDataURL(file);
        };
        img.src = URL.createObjectURL(file);
    }
});

// Form validation
document.getElementById('artikelForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>