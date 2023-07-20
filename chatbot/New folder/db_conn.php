<?php

$sname = "sql105.epizy.com";
$unmae = "epiz_30693670";
$password = "sg29pmBhafzQ";

$db_name = "epiz_30693670_login";
$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
