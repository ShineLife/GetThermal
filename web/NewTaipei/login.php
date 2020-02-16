<?php
    if($_GET["password"] == "123456") {
        setcookie("validate", true);
        echo "1234";
    }