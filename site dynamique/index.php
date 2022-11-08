<?php session_start();
include('module/dbTools.php');  ?>
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
            <?php
            $query = $db->prepare("SELECT * FROM `post` ");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $post) {
            ?>
                <article class="itemWarper">
                    <div class="articleTitle">
                        <h2><?php echo $post["postTitle"] ?></h2>
                        <p><?php echo $post["userName"] ?></p>
                    </div>

                    <p><?php 
                        if (strlen($post["postContent"]) < 300) {
                            echo $post["postContent"];
                        }
                        else {
                            echo substr($post["postContent"],0, 300) . "...";
                        }
                    ?></p>

                    <div>
                        <a class="articleLink" href=<?php echo "/post.php?id=" . $post["postId"]  ?> >lire la suite</a>
                        <!-- <a class="articleLike"><object data="media/heart.svg" class="icon like" type="image/svg+xml"></object>
                            like</a> -->
                    </div>
                </article>
            <?php }
        } else { ?>
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