<?php
    // $sql = new PDO("mysql:host=192.168.50.138;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
   $sql = new PDO("mysql:host=127.0.0.1;dbname=temperature;charset=utf8;", "admin", "1234");
    date_default_timezone_set("Asia/Taipei");
    $datas = $sql->query("SELECT * FROM `temperature` ORDER BY `id` DESC limit 30")->fetchAll();
    $valid_data = $datas[0];
    $valid_data["value"] = floatval($valid_data["value"]) + floatval($_GET["temperature_gain"]);
    if(($valid_data["value"] >= $_GET["max_temperature"]) && (strtotime($valid_data["date"] . " + 1 seconds") > strtotime(date("Y/m/d"))))
    {
        echo "1";
    }else
    {
        echo "0";
    }
?>