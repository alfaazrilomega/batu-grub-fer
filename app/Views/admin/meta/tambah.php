<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Tambah Meta</h1>
            <a href="<?= base_url('admin/meta') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
        
        <div class="app-card">
            <div class="app-card-body">
                <form action="<?= base_url('admin/meta/tambah') ?>" method="POST" id="metaForm">
                    <?= csrf_field() ?>
                    
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
                                       value="<?= old('nama_halaman_id') ?>" 
                                       placeholder="Contoh: Home, About, Contact"
                                       required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Nama halaman yang akan ditampilkan
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_halaman_id" class="form-label">Deskripsi Halaman</label>
                                <textarea class="form-control" 
                                          id="deskripsi_halaman_id" 
                                          name="deskripsi_halaman_id" 
                                          rows="4"
                                          placeholder="Deskripsi singkat tentang halaman"><?= old('deskripsi_halaman_id') ?></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="title_id" class="form-label">Meta Title</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="title_id" 
                                       name="title_id" 
                                       value="<?= old('title_id') ?>"
                                       placeholder="Max 59 karakter"
                                       maxlength="59">
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Untuk SEO halaman</small>
                                    <small class="text-muted"><span id="titleCounter">0</span>/59</small>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="meta_desc_id" class="form-label">Meta Description</label>
                                <textarea class="form-control" 
                                          id="meta_desc_id" 
                                          name="meta_desc_id" 
                                          rows="3"
                                          placeholder="Max 159 karakter"
                                          maxlength="159"><?= old('meta_desc_id') ?></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="form-text">Untuk SEO halaman</small>
                                    <small class="text-muted"><span id="metaCounter">0</span>/159</small>
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-lightbulb me-2"></i>Tips SEO
                                </h6>
                                <ul class="mb-0 ps-3">
                                    <li>Meta Title ideal 50-59 karakter</li>
                                    <li>Meta Description ideal 120-159 karakter</li>
                                    <li>Gunakan kata kunci yang relevan</li>
                                    <li>Buat deskripsi yang menarik</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/meta') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Meta
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
document.getElementById('metaForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>