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
            <p><strong>Gemaakt op: </strong> <?= esc($jobtype->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($jobtype->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($jobtype->status ? 'Aktief' : 'Niet aktief'); ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="45"><?= esc($jobtype->description) ?></textarea>
        </div>
    </div>
</body>

</html>