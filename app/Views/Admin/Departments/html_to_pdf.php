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
            <p><strong>Naam: </strong> <?= esc($department->name) ?></p>
            <p><strong>Gemaakt op: </strong> <?= esc($department->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($department->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($department->status ? 'Aktief' : 'Niet aktief'); ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="42"><?= esc($department->description) ?></textarea>
        </div>
    </div>
</body>

</html>