<?php
session_start();
// file for all action that don't need page
include("module/dbTools.php");

if($_GET["action"] == "login"){
    if (checkPassword($_POST["username"],$_POST["password"])){
        header("Location: /");
    }
    else{
        header("Location: /?error=login");
    }
}
elseif($_GET["action"] == "logout"){
    session_destroy();
    header("Location: /");
}
elseif ($_GET["action"] == "addArticle" && getUserAccess() <= 2){
    $options = array(
        "title" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "content" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('',$result,true )){
        header("Location: addArticle.php?error=option");
    }
    else{
        $query = $db -> prepare("INSERT INTO `post`(`postId`, `postTitle`, `postContent`, `postTime`, `postPinned`, `userName`) VALUES (NULL,?,?,?,0, ? );");
        $query->bindParam(1,$result["title"]);
        $query->bindParam(2,$result["content"]); 
        $query->bindParam(3,time()); 
        $query->bindParam(4,$_SESSION["user"]);
        $query->execute();
        $result =  $query->fetch();
        header("Location: /?info=postSuccess");
    }
}
elseif($_GET["action"] == "changePassword"){
    $options = array(
        "old" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "new2" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('',$result,true )){
        header("Location: addArticle.php?error=password");
    } 
    if(! checkPassword($_SESSION["user"],$result["old"]) || $result["new"] != $result["new2"]){
        header("Location: addArticle.php?error=password"); 
    }
    else{
        $query = $db -> prepare("UPDATE `user` SET `userPassword`=? WHERE `userName` = ?");
        $query->bindParam(1,password_hash($result["new"],PASSWORD_DEFAULT));
        $query->bindParam(2,$_SESSION["user"]);
        $query->execute();
        header("Location: /option.php?info=passwordSuccess"); 
    }
}

else {
    header("Location: /"); 
}