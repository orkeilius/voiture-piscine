<?php
session_start();
// file for all action that don't need page
include("module/dbTools.php");
if ($_GET["action"] == "login") {
    if (checkPassword($_POST["username"], $_POST["password"])) {
        header("Location: /");
    } else {
        header("Location: /?error=login");
    }
} elseif ($_GET["action"] == "logout") {
    session_destroy();
    header("Location: /");
} elseif ($_GET["action"] == "addArticle" && getUserAccess() <= 2) {
    $options = array(
        "title" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "content" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );

    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('', $result, true)) {
        header("Location: addArticle.php?error=option");
        return;
    }

    //get next postId
    $query = $db->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'post' AND table_schema = DATABASE( ) ;");
    $query->execute();
    $postId =  $query->fetch()[0];

    //var_dump($_FILES);
    foreach ($_FILES as $k => $file) {
        var_dump($file);
        var_dump($file["name"]);
        if (($file["size"] <= 400000000) && ($file["error"] == 0)) { //50mo
            mkdir("postMedia/" . $postId, 0666, True);
            $fileLocation = "postMedia/" . $postId . "/" . basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $fileLocation);
        }
    }

    // replace link to <a>
    $link_pattern = '/https?:\/\/[www\.]?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b[-a-zA-Z0-9()@:%_\+.~#?&\/=]*/m';
    preg_match(
        $link_pattern,
        $result["content"],
        $links
    );
    var_dump($links);
    foreach ($links as $link) {
        $result["content"] = str_replace($link, "<a href=\"$link\">$link</a>", $result["content"]);
    }

    // replace line break by <br>
    $result["content"] = str_replace(array("\r\n"), "</br>", $result["content"]);

    $time = time();
    $query = $db->prepare("INSERT INTO `post`(`postId`, `postTitle`, `postContent`, `postTime`, `postPinned`, `userName`) VALUES (NULL,?,?,?,0, ? );");
    $query->bindParam(1, $result["title"]);
    $query->bindParam(2, $result["content"]);
    $query->bindParam(3, $time);
    $query->bindParam(4, $_SESSION["user"]);
    $query->execute();
    $result =  $query->fetch();
    //header("Location: /?info=postSuccess");
} elseif ($_GET["action"] == "changePassword" && getUserAccess() <= 3) {
    $options = array(
        "old" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new2" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('', $result, true)) {
        header("Location: /option.php?error=password");
    }
    if (!preg_match(`^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$`, $result["new"])) {
        header("Location: /option.php?error=badPassword");
    } else if (!checkPassword($_SESSION["user"], $result["old"]) || $result["new"] != $result["new2"]) {
        header("Location: /option.php?error=password");
    } else {
        $query = $db->prepare("UPDATE `user` SET `userPassword`=? WHERE `userName` = ?");
        $query->bindParam(1, password_hash($result["new"], PASSWORD_DEFAULT));
        $query->bindParam(2, $_SESSION["user"]);
        $query->execute();
        header("Location: /option.php?info=passwordSuccess");
    }
} elseif ($_GET["action"] == "deletePost" && isset($_GET["post"])) {
    $argument = filter_var($_GET["post"], FILTER_VALIDATE_INT);

    if ($argument == false) {
        header("Location: /");
        return;
    }
    $files = glob("postMedia/" . $argument . "/" . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir("postMedia/" . $argument);

    $query = $db->prepare("SELECT userName FROM `post` WHERE `postId`=?");
    $query->bindParam(1, $argument);
    $query->execute();
    $result = $query->fetch();
    if (getUserAccess() <= 1 || $_SESSION["user"] == $result["userName"]) {
        $query = $db->prepare("DELETE FROM `post` WHERE `postId`=?");
        $query->bindParam(1, $argument);
        $query->execute();
        header("Location: /index.php?info=deleteSuccess");
    } else {
        header("Location: /");
    }
} elseif ($_GET["action"] == "editUser" && getUserAccess() == 0) {
    $options = array(
        "username" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "password" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "access" => FILTER_SANITIZE_NUMBER_INT,
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('', $result, true)) {
        header("Location: /option.php?error=editUser#editUser");
        return;
    }

    #check if already exist
    $query = $db->prepare("SELECT `userName` FROM `user` WHERE `userName`=?");
    $query->bindParam(1, $result["username"]);
    $query->execute();
    $old =  $query->fetch();
    if ($old != false) {
        if (isset($_POST["overwrite"])) {
            $query = $db->prepare("DELETE FROM `user` WHERE `userName`=?");
            $query->bindParam(1, $result["username"]);
            $query->execute();
        } else {
            header("Location: /option.php?error=existingUser#editUser");
            return;
        }
    }

    $query = $db->prepare("INSERT INTO `user`(`userName`, `userPassword`, `userAccess`) VALUES (?,?,?)");
    $query->bindParam(1, $result["username"]);
    $query->bindParam(2, password_hash($result["password"], PASSWORD_DEFAULT));
    $query->bindParam(3, $result["access"]);
    $query->execute();
    header("Location: /option.php?info=editSuccess#editUser");
} else {
    header("Location: /");
}
