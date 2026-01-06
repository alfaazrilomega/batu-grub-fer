<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Kontak</h1>
            <div>
                <a href="<?= base_url('admin/kontak') ?>" class="btn btn-outline-secondary">
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
                <form action="<?= base_url('admin/kontak/update') ?>" method="POST" id="kontakForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id_kontak" value="<?= $kontakData['id_kontak'] ?>">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="judul_kontak_id" class="form-label required">
                                    Judul Kontak
                                </label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('judul_kontak_id')) ? 'is-invalid' : '' ?>" 
                                       id="judul_kontak_id" 
                                       name="judul_kontak_id" 
                                       value="<?= old('judul_kontak_id', $kontakData['judul_kontak_id']) ?>" 
                                       required>
                                <?php if ($validation->hasError('judul_kontak_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul_kontak_id') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="subjudul_kontak_id" class="form-label">Subjudul Kontak</label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('subjudul_kontak_id')) ? 'is-invalid' : '' ?>" 
                                       id="subjudul_kontak_id" 
                                       name="subjudul_kontak_id" 
                                       value="<?= old('subjudul_kontak_id', $kontakData['subjudul_kontak_id']) ?>">
                                <?php if ($validation->hasError('subjudul_kontak_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('subjudul_kontak_id') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="deskripsi_kontak_id" class="form-label">Deskripsi Kontak</label>
                                <textarea class="form-control <?= ($validation->hasError('deskripsi_kontak_id')) ? 'is-invalid' : '' ?>" 
                                          id="deskripsi_kontak_id" 
                                          name="deskripsi_kontak_id" 
                                          rows="4"><?= old('deskripsi_kontak_id', $kontakData['deskripsi_kontak_id']) ?></textarea>
                                <?php if ($validation->hasError('deskripsi_kontak_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('deskripsi_kontak_id') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="link_wa" class="form-label">Link WhatsApp</label>
                                <input type="text" 
                                       class="form-control <?= ($validation->hasError('link_wa')) ? 'is-invalid' : '' ?>" 
                                       id="link_wa" 
                                       name="link_wa" 
                                       value="<?= old('link_wa', $kontakData['link_wa']) ?>">
                                <?php if ($validation->hasError('link_wa')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('link_wa') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Link untuk tombol WhatsApp
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="alamat_id" class="form-label required">Alamat</label>
                                <textarea class="form-control <?= ($validation->hasError('alamat_id')) ? 'is-invalid' : '' ?>" 
                                          id="alamat_id" 
                                          name="alamat_id" 
                                          rows="3"
                                          required><?= old('alamat_id', $kontakData['alamat_id']) ?></textarea>
                                <?php if ($validation->hasError('alamat_id')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alamat_id') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="telepon" class="form-label required">Telepon</label>
                                        <input type="text" 
                                               class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : '' ?>" 
                                               id="telepon" 
                                               name="telepon" 
                                               value="<?= old('telepon', $kontakData['telepon']) ?>" 
                                               required>
                                        <?php if ($validation->hasError('telepon')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('telepon') ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="email" class="form-label required">Email</label>
                                        <input type="email" 
                                               class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                               id="email" 
                                               name="email" 
                                               value="<?= old('email', $kontakData['email']) ?>" 
                                               required>
                                        <?php if ($validation->hasError('email')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="jam_operasional" class="form-label required">Jam Operasional</label>
                                <textarea class="form-control <?= ($validation->hasError('jam_operasional')) ? 'is-invalid' : '' ?>" 
                                          id="jam_operasional" 
                                          name="jam_operasional" 
                                          rows="3"
                                          required><?= old('jam_operasional', $kontakData['jam_operasional']) ?></textarea>
                                <?php if ($validation->hasError('jam_operasional')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jam_operasional') ?>
                                </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i> Contoh: Senin - Jumat: 08:00 - 17:00
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-info-circle me-2"></i>Informasi
                                </h6>
                                <p class="mb-0">Data kontak ini akan ditampilkan pada halaman kontak website. Pastikan semua informasi sudah benar sebelum disimpan.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-top pt-4 mt-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/kontak') ?>" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Simpan Kontak
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
document.getElementById('judul_kontak_id').addEventListener('input', function() {
    generateSlug();
});

function generateSlug() {
    const judul = document.getElementById('judul_kontak_id').value;
    if (judul.trim()) {
        const slug = judul.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '')
            .replace(/\s+/g, '-');
        // Note: Kontak tidak memiliki field slug di form, tetapi controller akan mengenerate
    }
}

// Form validation
document.getElementById('kontakForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
});
</script>

<?= $this->endSection() ?>