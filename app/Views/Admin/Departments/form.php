<div class="mb-3">
    <label class="form-label" for="name">Naam</label>
    <input type="text" class="form-control <?php if (session('errors.name')): ?>is-invalid<?php endif; ?>"
        name="name" id="name" value="<?= old('name', esc($department->name)) ?>" minlength="2" maxlength="64" required tabindex="1"></input>
    <div class="invalid-feedback">
        <?= session('errors.name') ?>
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="description">Omschrijving</label>
    <input type="text" class="form-control <?php if (session('errors.description')): ?>is-invalid<?php endif; ?>"
        name="description" id="description" value="<?= old('description', esc($department->description)) ?>" maxlength="64" tabindex="2"></input>
    <div class="invalid-feedback">
        <?= session('errors.description') ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="hidden" name="status" value="0">
        <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
            <?php if (old('status', $department->status)): ?>checked<?php endif; ?> tabindex="3"/>
        <label class="form-check-label" for="status">Aktief</label>
    </div>
</div>