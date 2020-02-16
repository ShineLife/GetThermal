<?php
    // $sql = new PDO("mysql:host=192.168.50.138;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
   $sql = new PDO("mysql:host=127.0.0.1;dbname=temperature;charset=utf8;", "admin", "1234");
    $datas = $sql->query("SELECT * FROM `temperature` ORDER BY `id` DESC limit 30")->fetchAll();
    foreach($datas as $data) {
        $data["value"] = floatval($data["value"]) + floatval($_GET["temperature_gain"]);
    ?>
        <tr>
            <td><?=$data["date"]?></td>
            <td <?=$data["value"] >= $_GET["max_temperature"] ? "style='color:tomato;'" : "style=''"?>><?=floor($data["value"])?></td>
            <td style=""><img <?=isset($_COOKIE["validate"]) && $_COOKIE["validate"] ? "" : "hidden"?> src="w644.jpg" style="width: 100%;height: auto;" alt=""></td>
        </tr>
    <?php
    }
?>