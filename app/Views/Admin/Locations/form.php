<div class="mb-3">
    <label class="form-label" for="name">Naam</label>
    <input type="text" class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif; ?>" name="name" id="name" value="<?= old('name', esc($location->name)) ?>" minlength="2" maxlength="64" required tabindex="1"></input>
    <div class="invalid-feedback">
        <?= session('errors.name') ?>
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="description">Omschrijving</label>
    <input type="text" class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif; ?>" name="description" id="description" value="<?= old('description', esc($location->description)) ?>" maxlength="64" tabindex="2"></input>
    <div class="invalid-feedback">
        <?= session('errors.description') ?>
    </div>
</div>

<div class="mb-3">
    <label for="department" class="form-label">Afdeling</label>
    <select class="form-select <?php if (session('errors.department_id')) : ?>is-invalid<?php endif; ?>" name="department_id" id="department_id" tabindex="3">
        <option value="">--- Kies een afdeling ---</option>
        <?php foreach ($departments as $key => $value) : ?>
            <option value="<?= $value->id ?>" <?= $value->id === $location->department_id ? 'selected' : '' ?>>
                <?= $value->name ?></option>
        <?php endforeach ?>
    </select>
    <div class="invalid-feedback">
        <?= session('errors.department') ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="hidden" name="status" value="0">
        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" <?php if (old('status', $location->status)) : ?>checked<?php endif; ?> tabindex="4" />
        <label class="form-check-label" for="status">Aktief</label>
    </div>
</div>