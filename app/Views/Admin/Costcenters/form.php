<div class="mb-3">
    <label class="form-label" for="code">Code</label>
    <input type="text" class="form-control <?php if (session('errors.code')): ?>is-invalid<?php endif; ?>"
        name="code" id="code" value="<?= old('code', esc($costcenter->code)) ?>" minlength="2" maxlength="64" required tabindex="1"></input>
    <div class="invalid-feedback">
        <?= session('errors.code') ?>
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="description">Omschrijving</label>
    <input type="text" class="form-control <?php if (session('errors.description')): ?>is-invalid<?php endif; ?>"
        name="description" id="description" value="<?= old('description', esc($costcenter->description)) ?>" maxlength="64" tabindex="2"></input>
    <div class="invalid-feedback">
        <?= session('errors.description') ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="hidden" name="status" value="0">
        <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
            <?php if (old('status', $costcenter->status)): ?>checked<?php endif; ?> tabindex="3"/>
        <label class="form-check-label" for="status">Aktief</label>
    </div>
</div>