/**
 * Batu Grub Admin - Main JavaScript (Bootstrap Compatible)
 */

document.addEventListener('DOMContentLoaded', function() {
    // ============ SIDEBAR TOGGLE ============
    const sidebarToggle = document.getElementById('sidebarToggle');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
            saveSidebarState();
        });
    }
    
    // Load sidebar state from localStorage
    loadSidebarState();
    
    // ============ DELETE CONFIRMATION MODAL ============
    const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const itemName = this.getAttribute('data-name');
            const deleteUrl = this.getAttribute('data-delete-url');
            
            if (deleteUrl) {
                document.getElementById('deleteConfirm').setAttribute('href', deleteUrl);
            }
            
            if (itemName) {
                const deleteNameElement = document.getElementById('deleteName');
                if (deleteNameElement) {
                    deleteNameElement.textContent = itemName;
                }
            }
        });
    });
    
    // ============ FORM VALIDATION ============
    setupFormValidation();
    
    // ============ IMAGE PREVIEW ============
    setupImagePreview();
    
    // ============ PASSWORD VISIBILITY TOGGLE ============
    setupPasswordToggle();
    
    // ============ CHARACTER COUNTER ============
    setupCharacterCounter();
    
    // ============ AUTO SLUG GENERATION ============
    setupSlugGeneration();
    
    // ============ USER DROPDOWN (Custom Behavior) ============
    setupUserDropdown();
    
    // ============ TABLE INTERACTIONS ============
    setupTableInteractions();
    
    // ============ TOAST NOTIFICATIONS ============
    checkForFlashMessages();
});

// ============ UTILITY FUNCTIONS ============

/**
 * Save sidebar state to localStorage
 */
function saveSidebarState() {
    const isCollapsed = document.body.classList.contains('sidebar-collapsed');
    localStorage.setItem('sidebarCollapsed', isCollapsed);
}

/**
 * Load sidebar state from localStorage
 */
function loadSidebarState() {
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        document.body.classList.add('sidebar-collapsed');
    }
}

/**
 * Setup form validation with Bootstrap
 */
function setupFormValidation() {
    const forms = document.querySelectorAll('form.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    // Real-time validation for required fields
    const requiredFields = document.querySelectorAll('input[required], textarea[required], select[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });
}

/**
 * Setup image preview for file inputs
 */
function setupImagePreview() {
    const imageInputs = document.querySelectorAll('input[type="file"][data-preview]');
    
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.getAttribute('data-preview');
            const preview = document.getElementById(previewId);
            
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
}

/**
 * Setup password visibility toggle
 */
function setupPasswordToggle() {
    const passwordToggles = document.querySelectorAll('.password-toggle-btn');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const target = document.getElementById(targetId);
            
            if (target) {
                if (target.type === 'password') {
                    target.type = 'text';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    target.type = 'password';
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                }
            }
        });
    });
}

/**
 * Setup character counter
 */
function setupCharacterCounter() {
    const textareas = document.querySelectorAll('textarea[maxlength]');
    
    textareas.forEach(textarea => {
        const maxLength = parseInt(textarea.getAttribute('maxlength'));
        const counterId = textarea.id + '-counter';
        
        // Create counter element if it doesn't exist
        let counter = document.getElementById(counterId);
        if (!counter) {
            counter = document.createElement('div');
            counter.id = counterId;
            counter.className = 'form-text text-end text-muted';
            textarea.parentNode.appendChild(counter);
        }
        
        const updateCounter = () => {
            const currentLength = textarea.value.length;
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength > maxLength) {
                counter.classList.add('text-danger');
                counter.classList.remove('text-muted');
            } else if (currentLength > maxLength * 0.9) {
                counter.classList.add('text-warning');
                counter.classList.remove('text-muted', 'text-danger');
            } else {
                counter.classList.remove('text-warning', 'text-danger');
                counter.classList.add('text-muted');
            }
        };
        
        textarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial update
    });
}

/**
 * Setup auto slug generation from title
 */
function setupSlugGeneration() {
    const slugSources = document.querySelectorAll('[data-slug-source]');
    
    slugSources.forEach(source => {
        const targetId = source.getAttribute('data-slug-source');
        const target = document.getElementById(targetId);
        
        if (target) {
            source.addEventListener('blur', function() {
                // Only generate slug if target is empty
                if (!target.value.trim()) {
                    const slug = this.value
                        .toLowerCase()
                        .replace(/[^\w\s]/gi, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();
                    target.value = slug;
                }
            });
            
            // Add generate slug button if exists
            const generateBtn = document.querySelector(`[data-generate-slug="${targetId}"]`);
            if (generateBtn) {
                generateBtn.addEventListener('click', function() {
                    const slug = source.value
                        .toLowerCase()
                        .replace(/[^\w\s]/gi, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();
                    target.value = slug;
                });
            }
        }
    });
}

/**
 * Setup user dropdown custom behavior
 */
function setupUserDropdown() {
    const userDropdown = document.querySelector('.app-user-dropdown .dropdown-toggle');
    
    if (userDropdown) {
        // Add active class on click
        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target)) {
                userDropdown.parentElement.classList.remove('show');
            }
        });
    }
}

/**
 * Setup table interactions
 */
function setupTableInteractions() {
    // Make table rows with data-href clickable
    const clickableRows = document.querySelectorAll('tr[data-href]');
    
    clickableRows.forEach(row => {
        row.style.cursor = 'pointer';
        
        row.addEventListener('click', function(e) {
            // Don't trigger if clicking on a button or link
            if (!e.target.closest('a') && !e.target.closest('button')) {
                window.location.href = this.getAttribute('data-href');
            }
        });
    });
    
    // Highlight row on hover
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(0, 0, 0, 0.02)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
}

/**
 * Check for flash messages and show toast
 */
function checkForFlashMessages() {
    const alerts = document.querySelectorAll('.alert:not(.toast-alert)');
    
    alerts.forEach(alert => {
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.3s ease';
                
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            }
        }, 5000);
    });
}

/**
 * Show custom toast notification
 */
function showToast(message, type = 'success') {
    // Create toast container if it doesn't exist
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
        `;
        document.body.appendChild(toastContainer);
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-alert toast-${type}`;
    toast.style.cssText = `
        background-color: ${getToastColor(type)};
        color: ${type === 'warning' ? 'var(--primary-color)' : 'var(--white-color)'};
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        opacity: 0;
        transform: translateX(100px);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    `;
    
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas ${getToastIcon(type)} me-2"></i>
            <span class="toast-message">${message}</span>
        </div>
        <button type="button" class="btn-close ${type === 'warning' ? '' : 'btn-close-white'}" 
                onclick="this.parentElement.style.opacity='0'; 
                         setTimeout(() => this.parentElement.remove(), 300);">
        </button>
    `;
    
    toastContainer.appendChild(toast);
    
    // Show toast with animation
    setTimeout(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateX(0)';
    }, 10);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100px)';
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }
    }, 5000);
}

/**
 * Get toast color based on type
 */
function getToastColor(type) {
    switch (type) {
        case 'success':
            return 'var(--success-color)';
        case 'error':
            return 'var(--danger-color)';
        case 'warning':
            return 'var(--warning-color)';
        case 'info':
            return 'var(--info-color)';
        default:
            return 'var(--primary-color)';
    }
}

/**
 * Get toast icon based on type
 */
function getToastIcon(type) {
    switch (type) {
        case 'success':
            return 'fa-check-circle';
        case 'error':
            return 'fa-exclamation-circle';
        case 'warning':
            return 'fa-exclamation-triangle';
        case 'info':
            return 'fa-info-circle';
        default:
            return 'fa-bell';
    }
}

/**
 * Confirm action with custom modal
 */
function confirmAction(title, message, confirmCallback, cancelCallback = null) {
    // Create modal elements
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.id = 'customConfirmModal';
    modal.tabIndex = '-1';
    modal.innerHTML = `
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>${message}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="customConfirmBtn">Konfirmasi</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Initialize Bootstrap modal
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
    
    // Handle confirm button click
    document.getElementById('customConfirmBtn').addEventListener('click', function() {
        bsModal.hide();
        confirmCallback();
    });
    
    // Handle cancel
    modal.addEventListener('hidden.bs.modal', function() {
        if (cancelCallback) {
            cancelCallback();
        }
        document.body.removeChild(modal);
    });
}

/**
 * Copy text to clipboard
 */
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showToast('Teks berhasil disalin ke clipboard', 'success');
    }).catch(err => {
        showToast('Gagal menyalin teks', 'error');
    });
}

/**
 * Initialize Bootstrap tooltips
 */
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/**
 * Initialize Bootstrap popovers
 */
function initPopovers() {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

// Initialize Bootstrap components when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initTooltips();
    initPopovers();
});

// Make functions available globally
window.showToast = showToast;
window.confirmAction = confirmAction;
window.copyToClipboard = copyToClipboard;