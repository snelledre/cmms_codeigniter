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
            <p><strong>Code: </strong> <?= esc($costcenter->code) ?></p>
            <p><strong>Gemaakt op: </strong> <?= esc($costcenter->created_at) ?></p>
            <p><strong>Gewijzigd op: </strong> <?= esc($costcenter->updated_at) ?></p>
            <p><strong>Status: </strong> <?= esc($costcenter->status ? 'Aktief' : 'Niet aktief'); ?></p>

            <p><strong>Omschrijving: </strong></p>
            <textarea name="" id="" cols="85" rows="42"><?= esc($costcenter->description) ?></textarea>
        </div>
    </div>
</body>

</html>