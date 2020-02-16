<?php

if(isset($_GET["val"])){
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=temperature;charset=utf8","admin","1234");
    $pdo->query("insert into temperature values(0,'" . $_GET["val"] . "',now(),'')");
}

?>
