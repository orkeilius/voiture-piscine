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
    } else {
        $query = $db->prepare("INSERT INTO `post`(`postId`, `postTitle`, `postContent`, `postTime`, `postPinned`, `userName`) VALUES (NULL,?,?,?,0, ? );");
        $query->bindParam(1, $result["title"]);
        $query->bindParam(2, $result["content"]);
        $query->bindParam(3, time());
        $query->bindParam(4, $_SESSION["user"]);
        $query->execute();
        $result =  $query->fetch();
        header("Location: /?info=postSuccess");
    }
}
elseif($_GET["action"] == "changePassword" && getUserAccess() <= 3){
    $options = array(
        "old" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new2" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('', $result, true)) {
        header("Location: /option.php?error=password");
    }
    if (!checkPassword($_SESSION["user"], $result["old"]) || $result["new"] != $result["new2"]) {
        header("Location: /option.php?error=password");
    } else {
        $query = $db->prepare("UPDATE `user` SET `userPassword`=? WHERE `userName` = ?");
        $query->bindParam(1, password_hash($result["new"], PASSWORD_DEFAULT));
        $query->bindParam(2, $_SESSION["user"]);
        $query->execute();
        header("Location: /option.php?info=passwordSuccess");
    }
} elseif ($_GET["action"] == "editUser" && getUserAccess() == 0) {
    $options = array(
        "username" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "password" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "access" => FILTER_SANITIZE_NUMBER_INT,
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('', $result, true)) {
        header("Location: option.php?error=editUser#editUser");
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
