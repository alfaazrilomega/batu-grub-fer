<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?? 'Admin Panel' ?> - Batu Grub</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/style.css') ?>">
    
    <!-- TinyMCE Local (Tanpa API Key) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.0/tinymce.min.js"></script>
</head>


    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<body class="app <?= session()->get('sidebar_collapsed') ? 'sidebar-collapsed' : '' ?>">
    <!-- Sidebar -->
    <?= $this->include('admin/layout/sidebar') ?>
    
    <!-- Main Content -->
    <div class="app-wrapper">
        <!-- Header -->
        <?= $this->include('admin/layout/header') ?>
        
        <!-- Page Content -->
        <?= $this->renderSection('content') ?>
    </div>
    
    <!-- Custom JS -->
    <script src="<?= base_url('assets/admin/js/script.js') ?>"></script>
    
    
    <!-- TinyMCE Initialization -->
    <!-- Initialize TinyMCE -->
    <script>
        // Initialize TinyMCE untuk semua textarea dengan class 'tiny'
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.tiny',
                    height: 300,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic backcolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'removeformat | help',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    // Nonaktifkan notifikasi API key
                    promotion: false,
                    branding: false,
                    // Optional: Mode simple
                    toolbar_mode: 'sliding',
                    // URL base untuk upload image (optional)
                    images_upload_url: '<?= base_url("admin/upload/image") ?>',
                    // Setup untuk upload image
                    images_upload_handler: function (blobInfo, success, failure) {
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', '<?= base_url("admin/upload/image") ?>');
                        
                        xhr.onload = function() {
                            var json;
                            
                            if (xhr.status != 200) {
                                failure('HTTP Error: ' + xhr.status);
                                return;
                            }
                            
                            json = JSON.parse(xhr.responseText);
                            
                            if (!json || typeof json.location != 'string') {
                                failure('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            
                            success(json.location);
                        };
                        
                        formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        
                        xhr.send(formData);
                    }
                });
            }
        });
    </script>
</body>

</html>