<?php
    // $sql = new PDO("mysql:host=192.168.50.138;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
   $sql = new PDO("mysql:host=10.5.5.1;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
    date_default_timezone_set("Asia/Taipei");
    $datas = $sql->query("SELECT * FROM `temperature` ORDER BY `id` DESC limit 30")->fetchAll();
    $valid_data = $datas[0];
    $valid_data["value"] = floatval($valid_data["value"]) + floatval(isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0');
    if(($valid_data["value"] >= ($_COOKIE["max_temperature"] ?: '0')) && (strtotime($valid_data["date"] . " + 1 seconds") > strtotime(date("Y/m/d"))))
    {
        echo "1";
    }else
    {
        echo "0";
    }
?>