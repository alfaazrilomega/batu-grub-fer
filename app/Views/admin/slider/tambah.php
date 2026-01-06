<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Tambah Slider</h1>
            <a href="<?= base_url('admin/slider') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/slider/tambah') ?>" method="POST" enctype="multipart/form-data" id="sliderForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="foto_slider" class="form-label required">
                                    Foto Slider
                                </label>
                                <div class="file-upload-area">
                                    <input type="file" 
                                           class="form-control <?= ($validation->hasError('foto_slider')) ? 'is-invalid' : '' ?>" 
                                           id="foto_slider" 
                                           name="foto_slider" 
                                           accept="image/jpg,image/jpeg,image/png"
                                           required>
                                    <?php if ($validation->hasError('foto_slider')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto_slider') ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                    </div>
                                </div>
                                
                                <div class="image-preview mt-3">
                                    <div class="preview-container">
                                        <img id="fotoPreview" 
                                             src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='150' viewBox='0 0 300 150'%3E%3Crect width='300' height='150' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='Arial' font-size='14' fill='%236c757d'%3EPreview akan muncul disini%3C/text%3E%3C/svg%3E" 
                                             alt="Preview Foto Slider" 
                                             class="img-fluid rounded">
                                        <div class="preview-overlay">
                                            <i class="fas fa-image"></i>
                                            <span>Preview Slider</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="alt_foto_slider_id" class="form-label">Alt Text (Alternatif Gambar)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="alt_foto_slider_id" 
                                       name="alt_foto_slider_id" 
                                       value="<?= old('alt_foto_slider_id') ?>" 
                                       placeholder="Deskripsi untuk aksesibilitas dan SEO">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Digunakan untuk screen reader dan SEO gambar
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="caption_slider_id" class="form-label">Caption Slider</label>
                                <textarea class="form-control" 
                                          id="caption_slider_id" 
                                          name="caption_slider_id" 
                                          rows="4"
                                          placeholder="Teks yang akan ditampilkan pada slider"><?= old('caption_slider_id') ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Teks deskriptif atau tagline untuk slider
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-lightbulb me-2"></i>Tips
                                </h6>
                                <ul class="mb-0 ps-3">
                                    <li>Gunakan foto yang menarik dan relevan</li>
                                    <li>Ukuran gambar disarankan rasio 2:1 (contoh: 1200x600px)</li>
                                    <li>Alt text penting untuk aksesibilitas dan SEO gambar</li>
                                    <li>Caption harus singkat, jelas, dan menarik</li>
                                    <li>Pastikan foto slider wajib diupload</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/slider') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Slider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview
document.getElementById('foto_slider').addEventListener('change', function(e) {
    const preview = document.getElementById('fotoPreview');
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
            preview.style.objectFit = 'cover';
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.getElementById('sliderForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>