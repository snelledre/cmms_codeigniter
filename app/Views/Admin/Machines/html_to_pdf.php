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
            <p><strong>Naam: </strong> <?= esc($machine->name) ?></p>
            <p><strong>Gemaakt op: </strong> <?= esc($machine->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($machine->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($machine->status ? 'Aktief' : 'Niet aktief'); ?></p>
            <p><strong>Locatie: </strong> <?= esc($machine->locationname) ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="40"><?= esc($machine->description) ?></textarea>
        </div>
    </div>
</body>

</html>