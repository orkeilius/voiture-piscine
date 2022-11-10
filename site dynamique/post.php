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
                <?php if(getUserAccess() <= 1 || $result["userName"] == $_SESSION["user"]){ ?>
                    <a onclick="return confirm('êtes vous sur?')" href=<?php echo "/action.php?action=deletePost&post=" . $result["postId"] ?> class="articleLink">suprimmer</a>
                <?php } ?>
            </article>
        </section>
        
    <?php include("module/footer.php");
    }
    ?>
</body>

</html>