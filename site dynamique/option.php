<?php session_start(); include('module/dbTools.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php
    if (getUserAccess() >= 3) {
        header("Location: /");
    } else {
        include("module/header.php"); ?>
        <section>
            <div class="itemWarper">
            <h2>changer de mot de passe</h2>
                <form action="action.php" method="post">
                    <input type='hidden' name='action' value='change password' />
                    <label for="old" >mot de passe actuel</label><br/>
                    <input type="password" name="old" pattern="^.{0,255}" required><br/>
                    <label for="new" >nouveau mot de passe</label><br/>
                    <input type="password" name="new" pattern="^.{0,255}" required><br/>
                    <label for="new2" >nouveau mot de passe</label><br/>
                    <input type="password" name="new2" pattern="^.{0,255}" required><br/>
                    <input type="submit">
                </form>
            </div> 
        </section>

    <?php include("module/footer.php");
    }
    ?>
</body>

</html>