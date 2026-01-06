<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Slider</h1>
            <a href="<?= base_url('admin/slider') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/slider/update/' . $sliderData['id_slider']) ?>" method="POST" enctype="multipart/form-data" id="editSliderForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Foto Saat Ini</label>
                                <div class="current-image mb-3">
                                    <?php if ($sliderData['foto_slider'] && file_exists(FCPATH . 'assets/img/slider/' . $sliderData['foto_slider'])): ?>
                                    <div class="image-container">
                                        <img src="<?= base_url('assets/img/slider/' . $sliderData['foto_slider']) ?>" 
                                             alt="<?= htmlspecialchars($sliderData['alt_foto_slider_id'] ?? 'Slider', ENT_QUOTES, 'UTF-8') ?>" 
                                             class="img-fluid rounded border" 
                                             id="currentFoto">
                                        <div class="image-info mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i> 
                                                Foto slider saat ini. Kosongkan jika tidak ingin mengganti.
                                            </small>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Belum ada foto slider yang diupload
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <label for="foto_slider" class="form-label">Ganti Foto Slider (Opsional)</label>
                                <input type="file" 
                                       class="form-control <?= ($validation->hasError('foto_slider')) ? 'is-invalid' : '' ?>" 
                                       id="foto_slider" 
                                       name="foto_slider" 
                                       accept="image/jpg,image/jpeg,image/png">
                                <?php if ($validation->hasError('foto_slider')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto_slider') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                </div>
                                
                                <div class="image-preview mt-3" id="newFotoPreview" style="display: none;">
                                    <h6 class="mb-2">Preview Foto Baru:</h6>
                                    <img id="fotoPreview" 
                                         class="img-fluid rounded border" 
                                         alt="Preview Foto Baru">
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
                                       value="<?= old('alt_foto_slider_id', $sliderData['alt_foto_slider_id']) ?>">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Digunakan untuk screen reader dan SEO gambar
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="caption_slider_id" class="form-label">Caption Slider</label>
                                <textarea class="form-control" 
                                          id="caption_slider_id" 
                                          name="caption_slider_id" 
                                          rows="4"><?= old('caption_slider_id', $sliderData['caption_slider_id']) ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Teks deskriptif atau tagline untuk slider
                                </div>
                            </div>
                            
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Slider
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <small class="text-muted">ID Slider:</small>
                                            <p class="mb-1">
                                                <code><?= $sliderData['id_slider'] ?></code>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/slider') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Slider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview for new foto
document.getElementById('foto_slider').addEventListener('change', function(e) {
    const preview = document.getElementById('fotoPreview');
    const previewContainer = document.getElementById('newFotoPreview');
    const currentFoto = document.getElementById('currentFoto');
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
            
            if (currentFoto) {
                currentFoto.style.opacity = '0.5';
            }
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        if (currentFoto) {
            currentFoto.style.opacity = '1';
        }
    }
});

// Form validation
document.getElementById('editSliderForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>