<?php
function connexion(){
    try{
        $db = new PDO('mysql:dbname=vp-enterprise;host=127.0.0.1' ,"root" , "");
        return $db;
    } catch(PDOException $e){
        die ("DB Error".$e);
    }
}