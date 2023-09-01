<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card mb-4 pb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><?= $title ?></h5>
        <a class="btn btn-primary rounded-pill" href="<?= route_to('lubricants_new') ?>">Nieuw</a>
    </div>    
    <div class="table-responsive text-nowrap">
        <table class="table card-table">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Leverancier</th>
                    <th style="width: 15%">Naam</th>
                    <th style="width: 25%">Omschrijving</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Gemaakt op</th>
                    <th style="width: 15%">Akties</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (isset($lubricants) && count($lubricants)) : ?>
                    <?php foreach ($lubricants as $lubricant) : ?>
                        <tr>
                            <td><i><?= $lubricant->id ?></i></td>
                            <td><?= esc($lubricant->supplier); ?></td>
                            <td><?= esc($lubricant->name); ?></td>
                            <td><?= character_limiter(esc($lubricant->description), 50); ?></td>
                            <td><span
                                class="badge bg-label-<?= $lubricant->status ? 'primary' : 'danger'; ?> me-1"><?= $lubricant->status ? 'Aktief' : 'Niet aktief'; ?></span>
                            </td>
                            <td><?= esc($lubricant->updated_at); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= $lubricant->link() ?>"><box-icon name='printer' ></box-icon><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="<?= $lubricant->pdf_link() ?>" target="_blank" ><i class="bx bx-file me-1"></i> Pdf</a>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#delete-modal" data-bs-id="<?= $lubricant->id ?>">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">
                            <h6 class="text-center">Geen smeermiddel gevonden</h3>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($lubricants) && count($lubricants)) : ?>
<!-- Danger Alert Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= $title ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <p class="mt-3" id="message">Weet je zeker dat je dit record wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</a>
                <?= form_open("", ['id' => 'deleteForm']) ?>
                <button class="btn btn-danger">Verwijder</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('page_js') ?>
<script>
    var exampleModal = document.getElementById('delete-modal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var id = button.getAttribute('data-bs-id')
        // Update the modal's content.
        var modalForm = exampleModal.querySelector('#deleteForm')
        var message = exampleModal.querySelector('#message')

        message.textContent = 'Weet je zeker dat je record ' + id + ' wilt verwijderen?'

        modalForm.setAttribute('action', '<?= site_url("/admin/lubricants/delete/") ?>' + id)
    })
</script> -->

<?= $this->endSection() ?>