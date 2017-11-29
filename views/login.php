<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Forum - prijava</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {

    });
</script>

<body>

    <form action="<?= BASE_URL ?>prijava" method="post">
        <label for="upb_ime">Upime:</label>
        <input type="text" name="upb_ime" id="upb_ime"/> <br/>
        <label for="geslo">Geslo:</label>
        <input type="password" name="geslo" id="geslo" /> <br/>
        <?php if(isset($_GET["error"])): ?>
            <span class="alert alert-danger">Napačno uporabniško ime in/ali geslo!</span>
        <?php endif ?>
        <button type="submit">Prijava</button>
    </form>

</body>

</html>