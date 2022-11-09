<?php session_start(); include('module/dbTools.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php
    if (getUserAccess() > 3) {
        header("Location: /");
    } else {
        include("module/header.php"); ?>
        <section>
            <h2> crée un article</h2>
                <form action="action.php?action=addArticle" method="post">
                    <label for="title" >Titre:</label><br/>
                    <input type="text" name="title" placeholder="Titre" pattern="^.{0,255}" required><br/>
                    <label for="content" >article:</label><br/>
                    <textarea name="content" placeholder="article" required></textarea><br/><br/>
                    <input type="submit">
                </form>
        </section>

    <?php include("module/footer.php");
    }
    ?>
</body>

</html>