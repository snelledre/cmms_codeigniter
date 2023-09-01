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
                <label class="form-label" for="description">Omschrijving</label>
                <input class="form-control" type="text" name="description" id="description" value="<?= esc($jobtype->description) ?>" readonly></input>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" id="status" <?php if (esc($jobtype->status)) : ?>checked<?php endif; ?> onclick="return false;" />
                    <label class="form-check-label" for="status">Aktief</label>
                </div>
            </div>

            <div>
                <p class="mb-1"><strong style="font-weight: 600">Gemaakt op:
                    </strong><?= esc($jobtype->created_at) ?></p>
                <p><strong style="font-weight: 600">Gewijzigd op: </strong><?= esc($jobtype->updated_at) ?>
                </p>
            </div>

            <div class="mt-3">
                <a class="btn btn-primary me-1" href="<?= route_to('jobtypes_edit', $jobtype->id) ?>">Bewerken</a>
                <a class="btn btn-secondary" href="<?= route_to("jobtypes") ?>">Annuleren</a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>