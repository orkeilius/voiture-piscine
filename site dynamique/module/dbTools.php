<?php
if(! isset($_GET["error"])){
    $_GET["error"] = NULL;
}
try{
    $db = new PDO('mysql:dbname=vp-enterprise;host=127.0.0.1' ,"root" , "");
} catch(PDOException $e){
    die ("DB Error".$e);
}
function checkPassword($user, $password){
    global $db;
    $query = $db->prepare("SELECT * FROM `user` WHERE `userName` = ?;");
    $query->bindParam(1,htmlspecialchars($user));
    $query->execute();
    $result = $query->fetch();

    if (password_verify(htmlspecialchars($password), $result["userPassword"])){
        $_SESSION["user"] = $result["userName"];
        return true;
    };
    return false;
}
function getUserAccess(){
    if (! isset($_SESSION["user"])){
        return 99;
    }
    global $db;
    $query = $db -> prepare("SELECT `userAccess` FROM `user` WHERE `userName` =  ?");
    $query->bindParam(1,$_SESSION["user"]);
    $query->execute();
    $result =  $query->fetch();
    return $result["userAccess"];
}
