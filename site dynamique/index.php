<?php session_start(); include('module/dbTools.php');  ?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php include("module/header.php"); ?>
    <section id="sectionLogin">
        <?php # placeholder for login
        if (isset($_SESSION["user"])) { ?>
            <h2>dernier article :</h2>
            <?php #future for each statement
            ?>
            <article class="itemWarper">
                <div class="articleTitle">
                    <h2>lorem ipsum </h2>
                    <p>de richard paté</p>
                </div>

                <p>blabla voiuture blabla eau blablablablab l a b lbalbalba lbal balblabl albllblab labl ablabl blabl blab lblablab la dfg sdfgs dfg </p>

                <div>
                    <a class="articleLink">lire la suite</a>
                    <a class="articleLike"><object data="media/heart.svg" class="icon like" type="image/svg+xml"></object>
                        like</a>
                </div>
            </article>
            <?php #future for each statement
            ?>
        <?php } else { ?>
            <div class="itemWarper">
                <h2>log in</h2>
                <form class="formCenter" action="login.php" method="post">
                    <input type="text" class="entry" id="username" name="username" placeholder="username" required><br>
                    <input type="password" class="entry" id="password" name="password" placeholder="password" required><br>
                    <input type="submit" value="se connecter">
                </form>
                <?php if (isset($_GET["loginError"])) { ?>
                    <div class="errorItem">
                        <p><object data="media/error.svg" class="icon like" type="image/svg+xml"></object>
                        nom / mot de passe invalide</p>
                    </div>
                <?php } ?>
            </div>
            <svg id="svgBackground" xmlns="http://www.w3.org/2000/svg" width="200%" height="100%">
                <defs>
                    <pattern id="bg" patternUnits="userSpaceOnUse" width="200" height="1000">
                        <path id="rect1465" style="fill:#004bff;stroke:none;stroke-width:17.1931" d="M 0,9.8923415 V 987.03985 c 0,0 200,29.16035 200,0 V 9.8923415 c -80.63446,31.7000165 -110.451513,-33.5702665 -200,0 z" />
                    </pattern>
                </defs>
                <rect width="200%" height="100%" fill="url(#bg)" />
            </svg>

        <?php }; ?>
    </section>
    <?php include("module/footer.php") ?>
</body>

</html>