<?php
function connexion(){
    try{
        $db = new PDO('mysql:dbname=vp-enterprise;host=127.0.0.1' ,"root" , "");
        return $db;
    } catch(PDOException $e){
        die ("DB Error".$e);
    }
}
function getUserAccess(){
    $db = connexion();
    $query = $db -> prepare("SELECT `userAccess` FROM `user` WHERE `userName` =  ?");
    $query->bindParam(1,$_SESSION["user"]);
    $query->execute();
    $result =  $query->fetch();
    return $result["userAccess"];
}

