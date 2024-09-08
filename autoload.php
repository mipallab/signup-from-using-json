<?php

if (file_exists(__DIR__ . "/apps/functions.php")) {
    require_once(__DIR__ . "/apps/functions.php");
} else {
    echo "not found function.php";
}

if (file_exists(__DIR__ . "/apps/data.php")) {
    require_once(__DIR__ . "/apps/data.php");
} else {
    echo "not found data.php";
}
