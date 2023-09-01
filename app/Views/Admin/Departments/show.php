<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?= $title ?></h5>
            <small class="text-muted float-end"></small>
        </div>
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label" for="name">Naam</label>
                <input class="form-control" type="text" name="name" id="name" value="<?= esc($department->name) ?>" readonly></input>
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Omschrijving</label>
                <input class="form-control" type="text" name="description" id="description" value="<?= esc($department->description) ?>" readonly></input>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" id="status" <?php if (esc($department->status)) : ?>checked<?php endif; ?> onclick="return false;" />
                    <label class="form-check-label" for="status">Aktief</label>
                </div>
            </div>

            <div>
                <p class="mb-1"><strong style="font-weight: 600">Gemaakt op:
                    </strong><?= esc($department->created_at) ?></p>
                <p><strong style="font-weight: 600">Gewijzigd op: </strong><?= esc($department->updated_at) ?>
                </p>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div>
                    <a class="btn btn-primary me-1" href="<?= route_to('departments_edit', $department->id) ?>">Bewerken</a>
                    <a class="btn btn-secondary" href="<?= route_to("departments") ?>">Terug</a>
                </div>
                <div>
                    <a class="btn btn-dark" href="<?= $department->pdf_link() ?>" target="_blank"><span class="tf-icons bx bx-printer me-1"></span> Print</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>