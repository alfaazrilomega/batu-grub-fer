<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Artikel</h1>
            <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/artikel/update/' . $artikelData['id_artikel']) ?>" method="POST" enctype="multipart/form-data" id="editArtikelForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    
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
                                       value="<?= old('judul_artikel_id', $artikelData['judul_artikel_id']) ?>" 
                                       required
                                       oninput="generateSlug()">
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
                                          maxlength="200"
                                          oninput="updateCounter('snippetCounter', this)"><?= old('snippet_id', $artikelData['snippet_id']) ?></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Ringkasan yang ditampilkan di halaman list</small>
                                    <small class="text-muted"><span id="snippetCounter"><?= strlen($artikelData['snippet_id'] ?? '') ?></span>/200</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_artikel_id" class="form-label">Deskripsi Lengkap</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_artikel_id" 
                                          name="deskripsi_artikel_id" 
                                          rows="8"><?= old('deskripsi_artikel_id', $artikelData['deskripsi_artikel_id']) ?></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_artikel_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="title_artikel_id" 
                                               name="title_artikel_id" 
                                               value="<?= old('title_artikel_id', $artikelData['title_artikel_id']) ?>"
                                               maxlength="59"
                                               oninput="updateCounter('titleCounter', this)">
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="titleCounter"><?= strlen($artikelData['title_artikel_id'] ?? '') ?></span>/59</small>
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
                                                  maxlength="159"
                                                  oninput="updateCounter('metaCounter', this)"><?= old('meta_desc_id', $artikelData['meta_desc_id']) ?></textarea>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO</small>
                                            <small class="text-muted"><span id="metaCounter"><?= strlen($artikelData['meta_desc_id'] ?? '') ?></span>/159</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Foto Saat Ini</label>
                                <div class="current-image mb-3">
                                    <?php if ($artikelData['foto_artikel'] && file_exists(FCPATH . 'assets/img/artikel/' . $artikelData['foto_artikel'])): ?>
                                    <div class="image-container">
                                        <img src="<?= base_url('assets/img/artikel/' . $artikelData['foto_artikel']) ?>" 
                                             alt="<?= htmlspecialchars($artikelData['alt_artikel_id'] ?? 'Artikel', ENT_QUOTES, 'UTF-8') ?>" 
                                             class="img-fluid rounded border artikel-current-img" 
                                             id="currentFoto">
                                        <div class="image-info mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i> 
                                                Foto saat ini. Upload file baru jika ingin mengganti.
                                            </small>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Belum ada foto yang diupload
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <label for="foto_artikel" class="form-label">Ganti Foto (Opsional)</label>
                                <input type="file" 
                                       class="form-control <?= ($validation->hasError('foto_artikel')) ? 'is-invalid' : '' ?>" 
                                       id="foto_artikel" 
                                       name="foto_artikel" 
                                       accept="image/jpg,image/jpeg,image/png"
                                       onchange="previewImage(this)">
                                <?php if ($validation->hasError('foto_artikel')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('foto_artikel') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> 
                                    Format: JPG, JPEG, PNG. Maksimal 2MB. Ukuran maksimal 572x572 pixels
                                </div>
                                
                                <div class="image-preview mt-3" id="newFotoPreview" style="display: none;">
                                    <h6 class="mb-2">Preview Foto Baru:</h6>
                                    <img id="fotoPreview" 
                                         class="img-fluid rounded border artikel-preview-img" 
                                         alt="Preview Foto Baru">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeFoto()">
                                        <i class="fas fa-times me-1"></i>Hapus Preview
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="alt_artikel_id" class="form-label">Alt Text (Alternatif Gambar)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="alt_artikel_id" 
                                       name="alt_artikel_id" 
                                       value="<?= old('alt_artikel_id', $artikelData['alt_artikel_id']) ?>">
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
                                           value="<?= old('slug_artikel_id', $artikelData['slug_artikel_id']) ?>" 
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="generateSlug()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-link me-1"></i> Digunakan untuk URL: 
                                    <code class="slug-url">/artikel/<?= $artikelData['slug_artikel_id'] ?></code>
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
                                                <?= date('d/m/Y H:i', strtotime($artikelData['created_at'])) ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted">Diupdate:</small>
                                            <p class="mb-1">
                                                <?= date('d/m/Y H:i', strtotime($artikelData['updated_at'])) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/artikel') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Update Artikel
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

// Character counter update
function updateCounter(counterId, element) {
    document.getElementById(counterId).textContent = element.value.length;
}

// Image preview for new foto
function previewImage(input) {
    const preview = document.getElementById('fotoPreview');
    const previewContainer = document.getElementById('newFotoPreview');
    const currentFoto = document.getElementById('currentFoto');
    const file = input.files[0];
    
    if (file) {
        // Validation
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB!');
            input.value = '';
            return;
        }
        
        if (!file.type.match('image/jpeg') && !file.type.match('image/jpg') && !file.type.match('image/png')) {
            alert('Format file harus JPG, JPEG, atau PNG!');
            input.value = '';
            return;
        }
        
        // Check image dimensions
        const img = new Image();
        img.onload = function() {
            if (this.width > 572 || this.height > 572) {
                alert('Ukuran gambar maksimal 572x572 pixels!');
                input.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
                
                // Hide current foto if exists
                if (currentFoto) {
                    currentFoto.style.opacity = '0.5';
                }
            };
            reader.readAsDataURL(file);
        };
        img.src = URL.createObjectURL(file);
    } else {
        previewContainer.style.display = 'none';
        if (currentFoto) {
            currentFoto.style.opacity = '1';
        }
    }
}

// Remove file and reset preview
function removeFoto() {
    document.getElementById('foto_artikel').value = '';
    document.getElementById('newFotoPreview').style.display = 'none';
    const currentFoto = document.getElementById('currentFoto');
    if (currentFoto) {
        currentFoto.style.opacity = '1';
    }
}

// Form validation
document.getElementById('editArtikelForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>