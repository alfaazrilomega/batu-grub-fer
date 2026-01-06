<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="app-content">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Data Artikel</h1>
            <a href="<?= base_url('admin/artikel/tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Artikel
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
        
        <?php if (!empty($all_data_artikel)): ?>
        <!-- Artikel Navigation Controls -->
        <div class="artikel-navigation mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="artikel-info">
                    <span class="text-muted">
                        <i class="fas fa-newspaper me-1"></i>
                        <span id="currentPosition">1</span> dari <?= count($all_data_artikel) ?> artikel
                    </span>
                </div>
                <div class="artikel-nav-buttons">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary" id="prevArtikel" title="Artikel Sebelumnya">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" id="nextArtikel" title="Artikel Berikutnya">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Artikel Container -->
        <div class="artikel-container" id="artikelContainer">
            <?php $index = 0; ?>
            <?php foreach ($all_data_artikel as $artikel): ?>
            <div class="artikel-card <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                <div class="app-card">
                    <div class="app-card-body">
                        <div class="row">
                            <!-- Foto Artikel -->
                            <div class="col-md-4">
                                <div class="artikel-image-container">
                                    <?php if ($artikel['foto_artikel'] && file_exists(FCPATH . 'assets/img/artikel/' . $artikel['foto_artikel'])): ?>
                                    <img src="<?= base_url('assets/img/artikel/' . $artikel['foto_artikel']) ?>" 
                                         alt="<?= htmlspecialchars($artikel['alt_artikel_id'] ?? 'Artikel', ENT_QUOTES, 'UTF-8') ?>" 
                                         class="img-fluid rounded artikel-main-image">
                                    <?php else: ?>
                                    <div class="artikel-no-image-main">
                                        <i class="fas fa-image fa-3x"></i>
                                        <p class="mt-2 mb-0">Tidak ada gambar</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Detail Artikel -->
                            <div class="col-md-8">
                                <div class="artikel-details">
                                    <h4 class="artikel-title mb-3">
                                        <?= htmlspecialchars($artikel['judul_artikel_id']) ?>
                                    </h4>
                                    
                                    <!-- Slug dan Alt Text -->
                                    <div class="artikel-meta mb-3">
                                        <div class="mb-2">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="fas fa-link me-1"></i>
                                                <?= $artikel['slug_artikel_id'] ?>
                                            </span>
                                            <?php if ($artikel['alt_artikel_id']): ?>
                                            <span class="badge bg-info text-white">
                                                <i class="fas fa-tag me-1"></i>
                                                Alt: <?= htmlspecialchars(substr($artikel['alt_artikel_id'], 0, 30)) ?>
                                                <?= strlen($artikel['alt_artikel_id']) > 30 ? '...' : '' ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Snippet -->
                                    <?php if ($artikel['snippet_id']): ?>
                                    <div class="artikel-snippet mb-3">
                                        <h6 class="text-muted mb-2"><i class="fas fa-quote-left me-1"></i> Snippet</h6>
                                        <p class="mb-0"><?= htmlspecialchars($artikel['snippet_id']) ?></p>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <!-- Deskripsi -->
                                    <?php if ($artikel['deskripsi_artikel_id']): ?>
                                    <div class="artikel-deskripsi mb-3">
                                        <h6 class="text-muted mb-2"><i class="fas fa-align-left me-1"></i> Deskripsi</h6>
                                        <div class="text-truncate-3">
                                            <?= strip_tags($artikel['deskripsi_artikel_id']) ?>
                                        </div>
                                        <?php if (strlen(strip_tags($artikel['deskripsi_artikel_id'])) > 300): ?>
                                        <a href="javascript:void(0)" class="read-more-link" data-artikel-id="<?= $artikel['id_artikel'] ?>">
                                            Baca selengkapnya...
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <!-- SEO Info -->
                                    <div class="artikel-seo mb-4">
                                        <div class="row">
                                            <?php if ($artikel['title_artikel_id']): ?>
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-2"><i class="fas fa-heading me-1"></i> Meta Title</h6>
                                                <p class="mb-0 small"><?= htmlspecialchars($artikel['title_artikel_id']) ?></p>
                                            </div>
                                            <?php endif; ?>
                                            <?php if ($artikel['meta_desc_id']): ?>
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-2"><i class="fas fa-file-alt me-1"></i> Meta Description</h6>
                                                <p class="mb-0 small"><?= htmlspecialchars($artikel['meta_desc_id']) ?></p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Timestamps -->
                                    <div class="artikel-timestamps mb-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-plus me-1"></i>
                                                    Dibuat: <?= date('d/m/Y H:i', strtotime($artikel['created_at'])) ?>
                                                </small>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    Diupdate: <?= date('d/m/Y H:i', strtotime($artikel['updated_at'])) ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="artikel-actions">
                                        <div class="d-flex gap-2">
                                            <a href="<?= base_url('admin/artikel/edit/' . $artikel['id_artikel']) ?>" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm delete-btn" 
                                                    data-id="<?= $artikel['id_artikel'] ?>"
                                                    data-name="<?= htmlspecialchars($artikel['judul_artikel_id'], ENT_QUOTES, 'UTF-8') ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
            <?php endforeach; ?>
        </div>
        
        <!-- Artikel Thumbnails -->
        <div class="artikel-thumbnails mt-4">
            <div class="d-flex justify-content-center">
                <div class="thumbnails-container" id="thumbnailsContainer">
                    <?php $thumbIndex = 0; ?>
                    <?php foreach ($all_data_artikel as $artikel): ?>
                    <button type="button" 
                            class="thumbnail-btn <?= $thumbIndex === 0 ? 'active' : '' ?>" 
                            data-index="<?= $thumbIndex ?>"
                            title="<?= htmlspecialchars($artikel['judul_artikel_id']) ?>">
                        <div class="thumbnail-content">
                            <?php if ($artikel['foto_artikel'] && file_exists(FCPATH . 'assets/img/artikel/' . $artikel['foto_artikel'])): ?>
                            <img src="<?= base_url('assets/img/artikel/' . $artikel['foto_artikel']) ?>" 
                                 alt="Thumbnail" 
                                 class="thumbnail-image">
                            <?php else: ?>
                            <div class="thumbnail-no-image">
                                <i class="fas fa-image"></i>
                            </div>
                            <?php endif; ?>
                            <div class="thumbnail-title">
                                <?= htmlspecialchars(substr($artikel['judul_artikel_id'], 0, 20)) ?>
                                <?= strlen($artikel['judul_artikel_id']) > 20 ? '...' : '' ?>
                            </div>
                        </div>
                    </button>
                    <?php $thumbIndex++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <?php else: ?>
        <div class="app-card">
            <div class="app-card-body text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada data artikel</h4>
                <p class="text-muted mb-4">Mulai dengan menambahkan artikel pertama Anda</p>
                <a href="<?= base_url('admin/artikel/tambah') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Artikel Pertama
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
                <h5 class="mb-2">Anda akan menghapus artikel:</h5>
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

<!-- Artikel Detail Modal -->
<div class="modal fade" id="artikelDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="artikelDetailModalLabel">
                    <i class="fas fa-file-alt me-2"></i>Detail Artikel
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="artikelDetailContent">
                <!-- Content will be loaded via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
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

// Artikel carousel functions (existing code)
document.addEventListener('DOMContentLoaded', function() {
    let currentArtikelIndex = 0;
    const totalArtikel = <?= count($all_data_artikel) ?>;
    const artikelCards = document.querySelectorAll('.artikel-card');
    const thumbnailButtons = document.querySelectorAll('.thumbnail-btn');
    
    // Initialize
    updateNavigation();
    
    // Previous Artikel Button
    document.getElementById('prevArtikel').addEventListener('click', function() {
        if (currentArtikelIndex > 0) {
            currentArtikelIndex--;
            showArtikel(currentArtikelIndex);
        }
    });
    
    // Next Artikel Button
    document.getElementById('nextArtikel').addEventListener('click', function() {
        if (currentArtikelIndex < totalArtikel - 1) {
            currentArtikelIndex++;
            showArtikel(currentArtikelIndex);
        }
    });
    
    // Thumbnail Click
    thumbnailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            currentArtikelIndex = index;
            showArtikel(index);
        });
    });
    
    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            if (currentArtikelIndex > 0) {
                currentArtikelIndex--;
                showArtikel(currentArtikelIndex);
            }
        } else if (e.key === 'ArrowRight') {
            if (currentArtikelIndex < totalArtikel - 1) {
                currentArtikelIndex++;
                showArtikel(currentArtikelIndex);
            }
        }
    });
    
    // Show specific artikel
    function showArtikel(index) {
        // Hide all artikel cards
        artikelCards.forEach(card => {
            card.classList.remove('active');
            card.style.display = 'none';
        });
        
        // Show selected artikel card
        artikelCards[index].classList.add('active');
        artikelCards[index].style.display = 'block';
        
        // Update thumbnails
        thumbnailButtons.forEach(btn => btn.classList.remove('active'));
        thumbnailButtons[index].classList.add('active');
        
        // Scroll thumbnail into view if needed
        const thumbnail = thumbnailButtons[index];
        const container = document.getElementById('thumbnailsContainer');
        const containerRect = container.getBoundingClientRect();
        const thumbnailRect = thumbnail.getBoundingClientRect();
        
        if (thumbnailRect.left < containerRect.left) {
            thumbnail.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        } else if (thumbnailRect.right > containerRect.right) {
            thumbnail.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
        
        // Update navigation info
        updateNavigation();
    }
    
    // Update navigation display
    function updateNavigation() {
        document.getElementById('currentPosition').textContent = currentArtikelIndex + 1;
        
        // Update button states
        const prevBtn = document.getElementById('prevArtikel');
        const nextBtn = document.getElementById('nextArtikel');
        
        prevBtn.disabled = currentArtikelIndex === 0;
        nextBtn.disabled = currentArtikelIndex === totalArtikel - 1;
        
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }
    
    // Read More Link
    document.querySelectorAll('.read-more-link').forEach(link => {
        link.addEventListener('click', function() {
            const artikelId = this.getAttribute('data-artikel-id');
            showArtikelDetail(artikelId);
        });
    });
    
    // Show artikel detail modal
    function showArtikelDetail(artikelId) {
        // In a real implementation, you would fetch the data via AJAX
        // For now, we'll show a message
        document.getElementById('artikelDetailContent').innerHTML = `
            <div class="text-center py-4">
                <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                <p>Memuat detail artikel...</p>
            </div>
        `;
        
        const modal = new bootstrap.Modal(document.getElementById('artikelDetailModal'));
        modal.show();
        
        // Simulate loading
        setTimeout(() => {
            document.getElementById('artikelDetailContent').innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Fitur ini akan menampilkan detail lengkap artikel dalam tampilan yang lebih luas.
                </div>
            `;
        }, 500);
    }
    
    // DELETE FUNCTIONALITY (UPDATED)
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
        fetch(`<?= base_url('admin/artikel/delete/') ?>${deleteId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showCustomToast('Data artikel berhasil dihapus', 'success');
                
                // Close modal
                closeModal();
                
                // Reload page after 1.5 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                showCustomToast(data.message || 'Gagal menghapus data artikel', 'error');
                this.innerHTML = originalHtml;
                this.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showCustomToast('Gagal menghapus data artikel', 'error');
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

// Resize handler untuk responsif
window.addEventListener('resize', function() {
    // Update table container width jika perlu
    const containers = document.querySelectorAll('.anggota-container, .komoditas-container');
    containers.forEach(container => {
        container.style.width = '100%';
    });
});
</script>

<?= $this->endSection() ?>