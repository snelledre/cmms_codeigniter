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
            <p><strong>Naam: </strong> <?= esc($location->name) ?></p>
            <p><strong>Gemaakt op: </strong> <?= esc($location->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($location->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($location->status ? 'Aktief' : 'Niet aktief'); ?></p>
            <p><strong>Afdeling: </strong> <?= esc($location->departmentname) ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="40"><?= esc($location->description) ?></textarea>
        </div>
    </div>
</body>

</html>