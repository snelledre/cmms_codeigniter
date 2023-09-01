<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-semi-dark"
    data-assets-path="<?= site_url('assets/') ?>"
    data-template="vertical-menu-template-no-customizer-starter"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?= $title ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= site_url('assets/img/favicon/favicon.ico') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= site_url('assets/vendor/fonts/boxicons.css') ?>" />
    <link rel="stylesheet" href="<?= site_url('assets/vendor/fonts/fontawesome.css') ?>" />

    <!-- Jquery Toast css -->
    <link href="<?= site_url('css/jquery-toast-plugin/jquery.toast.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= site_url('assets/vendor/css/rtl/core.css') ?>" />
    <link rel="stylesheet" href="<?= site_url('assets/vendor/css/rtl/theme-semi-dark.css') ?>" />
    <link rel="stylesheet" href="<?= site_url('assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= site_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <!-- Page CSS -->
    <?= $this->renderSection('page_css') ?>

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('css/custom.css') ?>">

    <!-- Helpers -->
    <script src="<?= site_url('assets/vendor/js/helpers.js') ?>"></script>    

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= site_url('assets/js/config.js') ?>"></script>
    </head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                <?= $this->include('layouts/includes/_menu') ?>
                <!-- / Menu -->
                
                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <?= $this->include('layouts/includes/_navbar') ?>
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        
                        <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Forms /</span> Editors</h4> -->
                        <h5 class="breadcrumb-wrapper py-1"><?= $breadcrumbs; ?> </h5>

                            <?= $this->renderSection('content') ?>
                        
                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        <?= $this->include('layouts/includes/_footer') ?>
                        <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= site_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/hammer/hammer.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/js/menu.js') ?>"></script>
    <script src="<?= site_url('assets/vendor/libs/i18n/i18n.js') ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    
    <!-- Main JS -->
    <script src="<?= site_url('assets/js/main.js') ?>"></script>

    <!-- Page JS -->
    <?= $this->renderSection('page_js') ?>

    <!-- custom JS -->
    <link rel="stylesheet" type="text/css" href="<?= site_url('js/custom.js') ?>">

    <!-- Global JS -->
    
    <!-- Toast-->
    <script src="<?= site_url('js/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <?= $this->include('layouts/includes/_toastr') ?>

    <!-- <script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
    </script> -->

    </body>
</html>

