<?php session_start();
include('module/dbTools.php');
include("module/checkPassword.php") ?>
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
            <div class="itemWarper fullWidth" id="changePassword">
                <h2>changer de mot de passe</h2>
                <form action="action.php/?action=changePassword" method="post">
                    <label for="old">mot de passe actuel</label><br />
                    <input type="password" name="old" required><br />
                    <label for="new">nouveau mot de passe</label><br />
                    <input id="entry1" type="password" name="new" required><br />
                    <?php echo passwordChecker('entry1') ?>
                    <label for="new2">nouveau mot de passe</label><br />
                    <input type="password" name="new2" required><br />
                    <input type="submit">
                    <?php
                    if ($_GET["error"] == "badPassword") { ?>
                        <div class="errorItem">
                            <p><object data="media/error.svg" class="icon like" type="image/svg+xml"></object>
                                mot de passe faible</p>
                        </div>
                    <?php } ?>
                    <?php
                    if ($_GET["error"] == "password") { ?>
                        <div class="errorItem">
                            <p><object data="media/error.svg" class="icon like" type="image/svg+xml"></object>
                                mot de passe invalide</p>
                        </div>
                    <?php } ?>
            </div>
            </form>
            </div>
            <?php
            if (getUserAccess() == 0) { ?>

                <div class="itemWarper fullWidth" id="editUser">

                    <h2>editer un utilisateur</h2>
                    <form action="action.php/?action=editUser" method="post">
                        <label for="username">nom</label><br />
                        <input type="text" name="username" pattern="^.{0,255}" required><br />
                        <label for="password">mot de passe</label><br />
                        <input id="entry2" type="password" name="password" required><br />
                        <?php echo passwordChecker('entry2') ?>
                        <label for="access">role :</label>
                        <select name="access">
                            <option value="3">utilisateur</option>
                            <option value="2">rédacteur</option>
                            <option value="1">modérateur</option>
                            <option value="0">administrateur</option>
                        </select><br />

                        <input type="checkbox" name="overwrite"></input>
                        <label for="access">écraser l'utilisateur exitant</label><br />
                        <input type="submit">
                    </form>
                    <?php if ($_GET["error"] == "editUser") { ?>
                        <div class="errorItem">
                            <p><object data="media/error.svg" class="icon like" type="image/svg+xml"></object>
                                Donnés invalide</p>
                        </div>
                    <?php }
                    if ($_GET["error"] == "existingUser") { ?>
                        <div class="errorItem">
                            <p><object data="media/error.svg" class="icon like" type="image/svg+xml"></object>
                                L' utilisateur existe déjà</p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </section>

    <?php include("module/footer.php");
    }
    ?>
</body>

</html>