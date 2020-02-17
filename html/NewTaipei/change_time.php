<?php
    date_default_timezone_set(date_default_timezone_get());
    $time = date("Y/m/d H:i:s");
    exec("sudo date -s ". $time);