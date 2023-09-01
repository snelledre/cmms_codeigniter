<?php

$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item first">
                <a class="page-link" href="<?= $pager->getFirst() ?>">
                    <i class="bx bx-chevrons-left"></i>
                </a>
            </li>
            <li class="page-item prev">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>">
                    <i class="bx bx-chevron-left"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item first disabled">
                <a class="page-link" href="<?= $pager->getFirst() ?>">
                    <i class="bx bx-chevrons-left"></i>
                </a>
            </li>
            <li class="page-item prev disabled">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>">
                    <i class="bx bx-chevron-left"></i>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'class="page-item"' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item next">
                <a class="page-link" href="<?= $pager->getNextPage() ?>">
                    <i class="bx bx-chevron-right"></i>
                </a>
            </li>
            <li class="page-item last">
                <a class="page-link" href="<?= $pager->getLast() ?>">
                    <i class="bx bx-chevrons-right"></i>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item next disabled">
                <a class="page-link" href="<?= $pager->getNextPage() ?>">
                    <i class="bx bx-chevron-right"></i>
                </a>
            </li>
            <li class="page-item last disabled">
                <a class="page-link" href="<?= $pager->getLast() ?>">
                    <i class="bx bx-chevrons-right"></i>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
