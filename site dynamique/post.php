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
        $query = $db->prepare("SELECT * FROM `post` WHERE `postId`=?");
        $query->bindParam(1,$id);
        $query->execute();
        $result = $query->fetch();



        include("module/header.php"); ?>
        <section>
            <article class="itemWarper">
                <h2><?php echo $result["postTitle"] ?></h2>
                <h4><?php echo $result["userName"] ?></h4>
                <p>
                    <?php echo $result["postContent"] ?>
                </p>
            </article>
        </section>
        
    <?php include("module/footer.php");
    }
    ?>
</body>

</html>