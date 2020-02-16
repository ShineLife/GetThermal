<?php
    // $sql = new PDO("mysql:host=192.168.50.138;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
   $sql = new PDO("mysql:host=127.0.0.1;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
    $datas = $sql->query("SELECT * FROM `temperature` ORDER BY `id` DESC limit 30")->fetchAll();
    foreach($datas as $data) {
        $data["value"] = floatval($data["value"]) + floatval(isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0');
    ?>
        <tr>
            <td><?=$data["date"]?></td>
            <td <?=$data["value"] >= (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '0') ? "style='color:tomato;'" : "style=''"?>><?=floor($data["value"])?></td>
            <td style=""><img <?=isset($_COOKIE["validate"]) && $_COOKIE["validate"] ? "" : "hidden"?> src="w644.jpg" style="width: 100%;height: auto;" alt=""></td>
        </tr>
    <?php
    }
?>