<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= $title ?></h5>
            <small class="text-muted float-end"></small>
        </div>
        <div class="card-body">
            <?= form_open(route_to('machines_create'), 'class="needs-validation" novalidate'); ?>

            <?= $this->include('Admin/machines/form') ?>

            <button class="btn btn-primary me-1" type="submit">Opslaan</button>
            <a class="btn btn-secondary" href="<?= route_to('machines') ?>">Annuleren</a>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>