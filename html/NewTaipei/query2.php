<?php
    // $sql = new PDO("mysql:host=192.168.50.138;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
   $sql = new PDO("mysql:host=10.5.5.1;dbname=temperature;charset=utf8;", "phpmyadmin", "1234");
    $datas = $sql->query("SELECT * FROM `temperature` where `value` >= '" . (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38') . "' ORDER BY `id` DESC limit 30")->fetchAll();
    foreach($datas as $data) {
        $data["value"] = floatval($data["value"]) + floatval(isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0');
    ?>
        <tr>
            <td><?=$data["date"]?></td>
            <td <?=$data["value"] >= (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38') ? "style='color:tomato;'" : "style=''"?>><?=floor($data["value"])?></td>
            <td style="">
            <?php
                if($data["value"] >= (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38')){
            ?>
                <img <?=isset($_COOKIE["validate"]) && $_COOKIE["validate"] ? "" : "hidden"?> src="data:image/jpeg;base64, <?=$data["image"]?>" style="width: 70%;height: auto;" alt="">
            <?php
                }
            ?>
            </td>
        </tr>
    <?php
    }
?>