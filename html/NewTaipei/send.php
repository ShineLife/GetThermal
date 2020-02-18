<?php
    include("sql.php");
    date_default_timezone_set("Asia/Taipei");
    $datas = $sql->query("SELECT * FROM `temperature` GROUP BY `date` ORDER BY `id` DESC limit 30")->fetchAll();
    $valid_data = $datas[0];
    $valid_data["value"] = floatval($valid_data["value"]) + floatval(isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0');
    if(($valid_data["value"] >= ($_COOKIE["max_temperature"] ?: '0')) && ($valid_data["value"] < 42) && (strtotime($valid_data["date"] . " + 1 seconds") > strtotime(date("Y/m/d H:i:s"))))
    {
        echo "1";
    }else
    {
        echo "0";
    }
?>