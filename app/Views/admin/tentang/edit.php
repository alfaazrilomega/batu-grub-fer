<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Tentang Perusahaan</h1>
            <div>
                <a href="<?= base_url('admin/tentang') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
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
        
        <div class="app-card">
            <div class="app-card-body">
                <form action="<?= base_url('admin/tentang/update') ?>" method="POST" enctype="multipart/form-data" id="tentangForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <?php if (!empty($tentangData['id_tentang'])): ?>
                    <input type="hidden" name="id_tentang" value="<?= $tentangData['id_tentang'] ?>">
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_perusahaan" class="form-label required">
                                    Nama Perusahaan
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : '' ?>" 
                                       id="nama_perusahaan" 
                                       name="nama_perusahaan" 
                                       value="<?= old('nama_perusahaan', $tentangData['nama_perusahaan']) ?>" 
                                       placeholder="Masukkan nama perusahaan"
                                       required>
                                <?php if ($validation->hasError('nama_perusahaan')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_perusahaan') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="logo" class="form-label">Logo Perusahaan</label>
                                        <div class="file-upload-area">
                                            <input type="file" 
                                                   class="form-control <?= ($validation->hasError('logo')) ? 'is-invalid' : '' ?>" 
                                                   id="logo" 
                                                   name="logo" 
                                                   accept="image/jpg,image/jpeg,image/png">
                                            <?php if ($validation->hasError('logo')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('logo') ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="form-text">
                                                <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($tentangData['logo']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['logo'])): ?>
                                        <div class="current-image mt-3">
                                            <h6 class="mb-2">Logo Saat Ini:</h6>
                                            <img src="<?= base_url('assets/img/tentang/' . $tentangData['logo']) ?>" 
                                                 alt="Logo Perusahaan" 
                                                 class="img-fluid rounded border" 
                                                 style="max-height: 100px;">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="hapus_logo" id="hapus_logo" value="1">
                                                <label class="form-check-label" for="hapus_logo">
                                                    Hapus logo saat ini
                                                </label>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="favicon" class="form-label">Favicon</label>
                                        <div class="file-upload-area">
                                            <input type="file" 
                                                   class="form-control <?= ($validation->hasError('favicon')) ? 'is-invalid' : '' ?>" 
                                                   id="favicon" 
                                                   name="favicon" 
                                                   accept="image/jpg,image/jpeg,image/png,image/x-icon,image/vnd.microsoft.icon">
                                            <?php if ($validation->hasError('favicon')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('favicon') ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="form-text">
                                                <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG, ICO. Maksimal 1MB
                                            </div>
                                        </div>
                                        
                                        <?php if (!empty($tentangData['favicon']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['favicon'])): ?>
                                        <div class="current-image mt-3">
                                            <h6 class="mb-2">Favicon Saat Ini:</h6>
                                            <img src="<?= base_url('assets/img/tentang/' . $tentangData['favicon']) ?>" 
                                                 alt="Favicon" 
                                                 class="img-fluid rounded border" 
                                                 style="max-height: 50px; max-width: 50px;">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="hapus_favicon" id="hapus_favicon" value="1">
                                                <label class="form-check-label" for="hapus_favicon">
                                                    Hapus favicon saat ini
                                                </label>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_tentang_id" class="form-label">Deskripsi Perusahaan</label>
                                <textarea class="form-control tiny" 
                                          id="deskripsi_tentang_id" 
                                          name="deskripsi_tentang_id" 
                                          rows="6"
                                          placeholder="Deskripsi lengkap tentang perusahaan"><?= old('deskripsi_tentang_id', $tentangData['deskripsi_tentang_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="snippet_id" class="form-label">Snippet</label>
                                <textarea class="form-control" 
                                          id="snippet_id" 
                                          name="snippet_id" 
                                          rows="3"
                                          placeholder="Ringkasan singkat tentang perusahaan"><?= old('snippet_id', $tentangData['snippet_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="link_youtube" class="form-label">Link YouTube</label>
                                <input type="url" 
                                       class="form-control <?= ($validation->hasError('link_youtube')) ? 'is-invalid' : '' ?>" 
                                       id="link_youtube" 
                                       name="link_youtube" 
                                       value="<?= old('link_youtube', $tentangData['link_youtube']) ?>" 
                                       placeholder="https://www.youtube.com/...">
                                <?php if ($validation->hasError('link_youtube')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('link_youtube') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="struktur_organisasi" class="form-label">Struktur Organisasi</label>
                                <div class="file-upload-area">
                                    <input type="file" 
                                           class="form-control <?= ($validation->hasError('struktur_organisasi')) ? 'is-invalid' : '' ?>" 
                                           id="struktur_organisasi" 
                                           name="struktur_organisasi" 
                                           accept="image/jpg,image/jpeg,image/png">
                                    <?php if ($validation->hasError('struktur_organisasi')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('struktur_organisasi') ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i> Format: JPG, JPEG, PNG. Maksimal 2MB
                                    </div>
                                </div>
                                
                                <?php if (!empty($tentangData['struktur_organisasi']) && file_exists(FCPATH . 'assets/img/tentang/' . $tentangData['struktur_organisasi'])): ?>
                                <div class="current-image mt-3">
                                    <h6 class="mb-2">Struktur Organisasi Saat Ini:</h6>
                                    <img src="<?= base_url('assets/img/tentang/' . $tentangData['struktur_organisasi']) ?>" 
                                         alt="Struktur Organisasi" 
                                         class="img-fluid rounded border" 
                                         style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="hapus_struktur" id="hapus_struktur" value="1">
                                        <label class="form-check-label" for="hapus_struktur">
                                            Hapus struktur saat ini
                                        </label>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="visi_id" class="form-label">Visi</label>
                                <textarea class="form-control tiny" 
                                          id="visi_id" 
                                          name="visi_id" 
                                          rows="4"
                                          placeholder="Visi perusahaan"><?= old('visi_id', $tentangData['visi_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="misi_id" class="form-label">Misi</label>
                                <textarea class="form-control tiny" 
                                          id="misi_id" 
                                          name="misi_id" 
                                          rows="4"
                                          placeholder="Misi perusahaan"><?= old('misi_id', $tentangData['misi_id']) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="slug_tentang_id" class="form-label">Slug</label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="slug_tentang_id" 
                                           name="slug_tentang_id" 
                                           value="<?= old('slug_tentang_id', $tentangData['slug_tentang_id']) ?>" 
                                           placeholder="Akan digenerate otomatis"
                                           readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Slug untuk URL halaman tentang
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title_tentang_id" class="form-label">Meta Title</label>
                                        <input type="text" 
                                               class="form-control <?= ($validation->hasError('title_tentang_id')) ? 'is-invalid' : '' ?>" 
                                               id="title_tentang_id" 
                                               name="title_tentang_id" 
                                               value="<?= old('title_tentang_id', $tentangData['title_tentang_id']) ?>"
                                               placeholder="Max 59 karakter"
                                               maxlength="59">
                                        <?php if ($validation->hasError('title_tentang_id')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('title_tentang_id') ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO halaman</small>
                                            <small class="text-muted"><span id="titleCounter"><?= strlen($tentangData['title_tentang_id'] ?? '') ?></span>/59</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="meta_desc_id" class="form-label">Meta Description</label>
                                        <textarea class="form-control <?= ($validation->hasError('meta_desc_id')) ? 'is-invalid' : '' ?>" 
                                                  id="meta_desc_id" 
                                                  name="meta_desc_id" 
                                                  rows="2"
                                                  placeholder="Max 159 karakter"
                                                  maxlength="159"><?= old('meta_desc_id', $tentangData['meta_desc_id']) ?></textarea>
                                        <?php if ($validation->hasError('meta_desc_id')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('meta_desc_id') ?>
                                        </div>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-between align-items-center mt-1">
                                            <small class="form-text">Untuk SEO halaman</small>
                                            <small class="text-muted"><span id="metaCounter"><?= strlen($tentangData['meta_desc_id'] ?? '') ?></span>/159</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-lightbulb me-2"></i>Catatan
                                </h6>
                                <ul class="mb-0 ps-3">
                                    <li>Nama perusahaan wajib diisi</li>
                                    <li>Logo dan favicon opsional untuk diubah</li>
                                    <li>Slug akan digenerate otomatis dari nama perusahaan</li>
                                    <li>Hanya ada satu data tentang perusahaan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/tentang') ?>" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
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
document.getElementById('nama_perusahaan').addEventListener('input', function() {
    generateSlug();
});

document.getElementById('generateSlug').addEventListener('click', function() {
    generateSlug();
});

function generateSlug() {
    const name = document.getElementById('nama_perusahaan').value;
    const slugField = document.getElementById('slug_tentang_id');
    
    if (name.trim()) {
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        slugField.value = slug;
    }
}

// Character counters
document.getElementById('title_tentang_id').addEventListener('input', function() {
    document.getElementById('titleCounter').textContent = this.value.length;
});

document.getElementById('meta_desc_id').addEventListener('input', function() {
    document.getElementById('metaCounter').textContent = this.value.length;
});

// Form validation
document.getElementById('tentangForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>