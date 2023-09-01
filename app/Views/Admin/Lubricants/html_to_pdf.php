<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
</head>

<body>
    <div id="container">
        <h1 align="center"><?= $title ?></h1>

        <hr>
        <br>

        <div id="body">
            <p><strong>Leverancier: </strong> <?= esc($lubricant->supplier) ?></p>
            <p><strong>Naam: </strong> <?= esc($lubricant->name) ?></p>
            <p><strong>Gemaakt op: </strong> <?= esc($lubricant->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($lubricant->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($lubricant->status ? 'Aktief' : 'Niet aktief'); ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="40"><?= esc($lubricant->description) ?></textarea>
        </div>
    </div>
</body>

</html>