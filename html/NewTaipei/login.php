<?php
session_start();
    if($_GET["password"] == "2020nt") {
        $_SESSION["validate"] = true;
        echo "1234";
    }