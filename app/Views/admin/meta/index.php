<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Data Meta</h1>
            <a href="<?= base_url('admin/meta/tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Meta
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
        
        <?php if (!empty($all_data_meta)): ?>
        <div class="app-card">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Nama Halaman</th>
                                <th>Deskripsi Halaman</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($all_data_meta as $meta): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <strong><?= $meta['nama_halaman_id'] ?></strong>
                                </td>
                                <td>
                                    <?php if ($meta['deskripsi_halaman_id']): ?>
                                    <div class="text-truncate-2" style="max-width: 200px;" 
                                         title="<?= htmlspecialchars($meta['deskripsi_halaman_id'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= substr($meta['deskripsi_halaman_id'], 0, 80) ?>
                                        <?= strlen($meta['deskripsi_halaman_id']) > 80 ? '...' : '' ?>
                                    </div>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($meta['title_id']): ?>
                                    <small class="text-muted" title="<?= htmlspecialchars($meta['title_id'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= substr($meta['title_id'], 0, 30) ?>
                                        <?= strlen($meta['title_id']) > 30 ? '...' : '' ?>
                                    </small>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($meta['meta_desc_id']): ?>
                                    <small class="text-muted" title="<?= htmlspecialchars($meta['meta_desc_id'], ENT_QUOTES, 'UTF-8') ?>">
                                        <?= substr($meta['meta_desc_id'], 0, 50) ?>
                                        <?= strlen($meta['meta_desc_id']) > 50 ? '...' : '' ?>
                                    </small>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('admin/meta/edit/' . $meta['id_meta']) ?>" 
                                           class="btn btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger delete-btn" 
                                                data-id="<?= $meta['id_meta'] ?>"
                                                data-name="<?= htmlspecialchars($meta['nama_halaman_id'], ENT_QUOTES, 'UTF-8') ?>"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="app-card">
            <div class="app-card-body text-center py-5">
                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data meta</h4>
                <p class="text-muted mb-4">Mulai dengan menambahkan meta data pertama Anda</p>
                <a href="<?= base_url('admin/meta/tambah') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Meta Pertama
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h5 class="modal-title">
                <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                Konfirmasi Hapus
            </h5>
            <button type="button" class="btn-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="text-center mb-3">
                <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                <h5 class="mb-2">Anda akan menghapus meta data:</h5>
                <p class="fs-5 fw-bold" id="deleteName"></p>
            </div>
            <div class="alert alert-danger mb-0">
                <i class="fas fa-info-circle me-2"></i>
                <small>Tindakan ini tidak dapat dibatalkan! Semua data terkait akan dihapus permanen.</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">
                <i class="fas fa-times me-2"></i>Batal
            </button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                <i class="fas fa-trash me-2"></i>Ya, Hapus
            </button>
        </div>
    </div>
</div>

<!-- Custom Toast Notification -->
<div id="customToast" class="custom-toast">
    <div class="toast-content">
        <i class="toast-icon"></i>
        <span class="toast-message"></span>
        <button type="button" class="toast-close" onclick="closeToast()">&times;</button>
    </div>
</div>

<script>
// Modal functions
function openDeleteModal(id, name) {
    document.getElementById('deleteName').textContent = name;
    document.getElementById('deleteModal').style.display = 'flex';
    document.getElementById('deleteModal').setAttribute('data-id', id);
}

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Toast functions
function showCustomToast(message, type = 'success') {
    const toast = document.getElementById('customToast');
    const toastIcon = toast.querySelector('.toast-icon');
    const toastMessage = toast.querySelector('.toast-message');
    
    // Set content based on type
    if (type === 'success') {
        toastIcon.className = 'toast-icon fas fa-check-circle';
        toast.style.backgroundColor = '#28a745';
    } else if (type === 'error') {
        toastIcon.className = 'toast-icon fas fa-exclamation-circle';
        toast.style.backgroundColor = '#dc3545';
    }
    
    toastMessage.textContent = message;
    
    // Show toast
    toast.classList.add('show');
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        toast.classList.remove('show');
    }, 5000);
}

function closeToast() {
    document.getElementById('customToast').classList.remove('show');
}

// Main script
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button clicks
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            openDeleteModal(id, name);
        });
    });
    
    // Handle delete confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        const deleteId = document.getElementById('deleteModal').getAttribute('data-id');
        if (!deleteId) return;
        
        // Show loading on button
        const originalHtml = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';
        this.disabled = true;
        
        // Send delete request
        fetch(`<?= base_url('admin/meta/delete/') ?>${deleteId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showCustomToast('Data meta berhasil dihapus', 'success');
                
                // Close modal
                closeModal();
                
                // Reload page after 1.5 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showCustomToast(data.message || 'Gagal menghapus data meta', 'error');
                this.innerHTML = originalHtml;
                this.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showCustomToast('Gagal menghapus data meta', 'error');
            this.innerHTML = originalHtml;
            this.disabled = false;
        });
    });
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
});
</script>

<?= $this->endSection() ?>