<?php if (session()->has('success')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Success',
            text: "<?= session('success') ?>",
            showHideTransition: 'slide',
            icon: 'success',
            position: 'top-right',
            hideAfter: 5000   // in milli seconds
        })
    </script>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Error',
            text: "<?= session('error') ?>",
            showHideTransition: 'slide',
            icon: 'error',
            position: 'top-right',
            hideAfter: 5000   // in milli seconds
        })
    </script>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
    <?php foreach(session('errors') as $error): ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Errors',
                text: "<?= $error ?>",
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
                hideAfter: 5000   // in milli seconds
            })
        </script>
    <?php endforeach; ?>
<?php endif ?>

<?php if (session()->has('info')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Info',
            text: "<?= session('info') ?>",
            showHideTransition: 'slide',
            icon: 'info',
            position: 'top-right',
            hideAfter: 5000   // in milli seconds
        })
    </script>
<?php endif ?>

<?php if (session()->has('warning')) : ?>
    <script type="text/javascript">
        $.toast({
            heading: 'Warning',
            text: "<?= session('warning') ?>",
            showHideTransition: 'slide',
            icon: 'warning',
            position: 'top-right',
            hideAfter: 5000   // in milli seconds
        })
    </script>
<?php endif ?>