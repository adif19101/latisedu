<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/tabler.min.css') ?>">

</head>

<body>
    <?= $this->include('layout/tabler_navbar') ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container-xl">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <div class="mb-1">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <?php
                            if (isset($breadcrumbs)) {
                                foreach ($breadcrumbs as $crumbs) {
                                    echo '<li class="breadcrumb-item">';
                                    if (isset($crumbs['url'])) {
                                        echo '<a href="' . $crumbs['url'] . '">' . $crumbs['crumb'] . '</a>';
                                    } else {
                                        echo $crumbs['crumb'];
                                    }
                                }
                            }
                            ?>
                        </ol>
                    </div>
                    <?php if (isset($subtitle)) : ?>
                        <h2 class="page-title">
                            <span class="text-truncate"><?= $subtitle ?></span>
                        </h2>
                    <?php endif; ?>
                </div>

                <?= $this->renderSection('header-button'); ?>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content') ?>

    <?= $this->include('layout/tabler_footer') ?>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/tabler.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/additional-methods.min.js') ?>"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        $(document).ready(function() {

            <?php if (session()->getFlashdata('toast')) : ?>
                Toast.fire({
                    icon: "<?= session()->getFlashdata('toast')['icon'] ?>",
                    title: "<?= session()->getFlashdata('toast')['title'] ?>",
                })
            <?php endif; ?>
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>