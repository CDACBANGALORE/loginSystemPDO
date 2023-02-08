<?php
session_start();
if (($_SESSION['login'] == false) || !isset($_SESSION['login'])) {
    session_unset();
    session_destroy();
    header('location: ../index.html');
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/homeStyle.css">

</head>

<body>
    <?php

    include '../essential/nav.php';

    ?>

    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                Welcome
            </div>
            <div class="card-body">
                <h5 class="card-title">User: <?php echo $_SESSION['name']; ?></h5>
                <p class="card-text">Email: <?php echo $_SESSION['email']; ?></p>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>