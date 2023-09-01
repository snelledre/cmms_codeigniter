<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card mb-4 pb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><?= $title ?></h5>
        <a class="btn btn-primary rounded-pill" href="<?= route_to('machines_new') ?>">Nieuw</a>
    </div>    
    <div class="table-responsive text-nowrap">
        <table class="table card-table">
            <thead class="table-dark">
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Afdeling</th>
                    <th style="width: 15%">Locatie</th>
                    <th style="width: 20%">Naam</th>
                    <th style="width: 25%">Omschrijving</th>                    
                    <th style="width: 10%">Status</th>
                    <th style="width: 10%">Akties</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (isset($machines) && count($machines)) : ?>
                    <?php foreach ($machines as $machine) : ?>
                        <tr>
                            <td><i><?= $machine->id ?></i></td>
                            <td><?= esc($machine->departmentname); ?></td>
                            <td><?= esc($machine->locationname); ?></td>
                            <td><?= esc($machine->name); ?></td>
                            <td><?= character_limiter(esc($machine->description), 50); ?></td>                            
                            <td><span
                                class="badge bg-label-<?= $machine->status ? 'primary' : 'danger'; ?> me-1"><?= $machine->status ? 'Aktief' : 'Niet aktief'; ?></span>
                            </td>                            
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= $machine->link() ?>"><box-icon name='printer' ></box-icon><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="<?= $machine->pdf_link() ?>" target="_blank" ><i class="bx bx-file me-1"></i> Pdf</a>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#delete-modal" data-bs-id="<?= $machine->id ?>">
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
                            <h6 class="text-center">Geen machine gevonden</h3>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($machines) && count($machines)) : ?>
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

        modalForm.setAttribute('action', '<?= site_url("/admin/machines/delete/") ?>' + id)
    })
</script> -->

<?= $this->endSection() ?>