<?php
session_start();
// file for all action that don't need page
include("module/dbTools.php");
if(! isset($_POST["action"])){
    header("Location: /");
}
elseif ($_POST["action"] == "addArticle"){
    $options = array(
        "title" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "content" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
    $result = filter_input_array(INPUT_POST, $options);
    if (in_array('',$result,true )){
        header("Location: addArticle.php?error=option");
    }
    else{
        $query = $db -> prepare("INSERT INTO `post`(`postId`, `postTitle`, `postContent`, `postTime`, `postPinned`, `userName`) VALUES (NULL,?,?,NULL,0, ? );");
        $query->bindParam(1,$result["title"]);
        $query->bindParam(2,$result["content"]); 
        $query->bindParam(3,$_SESSION["user"]);
        var_dump($query);
        $query->execute();
        $result =  $query->fetch();
        header("Location: /?info=postSuccess");
    }
}