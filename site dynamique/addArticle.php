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
            <div class="itemWarper">
                <form action="action.php" method="post">
                    <input type='hidden' name='action' value='addArticle' />
                    <label for="title" >Titre:</label><br/>
                    <input type="text" name="title" placeholder="Titre" required><br/>
                    <label for="content" >article:</label><br/>
                    <textarea name="content" placeholder="article" required></textarea>
                    <input type="submit">
                </form>
            </div>
        </section>

    <?php include("module/footer.php");
    }
    ?>
</body>

</html>