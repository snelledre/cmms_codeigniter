<?php if (session()->has('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?= session('success') ?>
</div>
<?php endif; ?>

<?php if (session()->has('warning')): ?>
<div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?= session('warning') ?>
</div>
<?php endif; ?>

<?php if (session()->has('info')): ?>
<div class="alert alert-info alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?= session('info') ?>
</div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?= session('error') ?>
</div>
<?php endif; ?>

<?php if (session()->has('errors')): ?>
<?php foreach(session('errors') as $error): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <?= $error ?>
</div>
<?php endforeach; ?>
<?php endif ?>