<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Forum</title>
        <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#openView").click(function () {
                $("#novice").toggle("slow");
                $("#novaNovica").toggle("slow");
                $(".toggle:visible").not("#novaNovica").hide();
            });
            $("#closeView").click(function () {
                $("#novice").toggle("slow");
                $("#novaNovica").toggle("slow");
                $(".toggle:visible").not("#novaNovica").hide();
            });
        });
    </script>

    <body>
        <a href="<?= BASE_URL ?>odjava">Logout</a>
        <div id="novice">
            <button class="btn btn-default" id="openView">Dodaj novico</button>
            <?php foreach ($novice as $novica): ?>
                <div>
                    <h3><?= $novica["naslov"] ?></h3>
                    <p><?= $novica["tekst"] ?></p>
                    <p><?= $novica["datum"] ?>, posted by: <?= $novica["avtor_id"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="novaNovica" class="toggle">
            <button class="btn btn-danger" id="closeView">Prekliči</button>
            <form action="<?= BASE_URL ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="naslov">Naslov:</label>
                    <input class="form-control" type="text" name="naslov" id="naslov" required/>
                </div>
                <div class="form-group">
                    <label for="tekst">Novica:</label>
                    <textarea class="form-control" name="tekst" id="tekst" required rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-default">Shrani</button>
            </form>
        </div>
    </body>

</html>