<?php
     include("sql.php");
    $datas = $sql->query("SELECT `date`, max(`value`) as `value`, image FROM `temperature` where `value` >= '" . (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38') . "' and `value` < 42 GROUP BY `date` ORDER BY `id` DESC")->fetchAll();
    foreach($datas as $data) {
        $data["value"] = floatval($data["value"]) + floatval(isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0');
    ?>
        <tr>
            <td><?=$data["date"]?></td>
            <td <?=$data["value"] >= (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38') ? "style='color:tomato;'" : "style=''"?>><?=number_format($data["value"], 2)?></td>
            <td style="">
            <?php
                if($data["value"] >= (isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38')){
            ?>
                <img <?=isset($_SESSION["validate"]) && $_SESSION["validate"] == true ? "" : "hidden"?> src="data:image/jpeg;base64, <?=$data["image"]?>" style="width: 70%;height: auto;" alt="">
            <?php
                }
            ?>
            </td>
        </tr>
    <?php
    }
?>