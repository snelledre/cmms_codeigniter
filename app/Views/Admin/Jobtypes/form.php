<div class="mb-3">
    <label class="form-label" for="description">Omschrijving</label>
    <input type="text" class="form-control <?php if (session('errors.description')): ?>is-invalid<?php endif; ?>"
        name="description" id="description" value="<?= old('description', esc($jobtype->description)) ?>" maxlength="64" tabindex="1"></input>
    <div class="invalid-feedback">
        <?= session('errors.description') ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-check">
        <input type="hidden" name="status" value="0">
        <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
            <?php if (old('status', $jobtype->status)): ?>checked<?php endif; ?> tabindex="2"/>
        <label class="form-check-label" for="status">Aktief</label>
    </div>
</div>