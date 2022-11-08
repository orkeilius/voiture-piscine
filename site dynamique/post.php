<?php session_start(); include('module/dbTools.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php
    $id = filter_var($_GET["id"],FILTER_VALIDATE_INT);
    if (getUserAccess() > 3 || $id == false ) {
        header("Location: /");
    } else {
        include("module/header.php"); ?>


    <?php include("module/footer.php");
    }
    ?>
</body>

</html>