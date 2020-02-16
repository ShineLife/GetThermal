<?php

$pdo = new PDO("mysql:host=192.168.50.112;dbname=temperature;charset=utf8","admin","1234");
$r = $pdo->query("select id,value from temperature order by id desc limit 1")->FetchAll()[0]['value'];
print_r($r);


?>
<script>
setTimeout(function(){
    location.reload();
},500);

</script>