<?php
$serverName = "localhost";
$dBusername = "root";
$dBpassword = "";
$dBname = "celiac_website";
$conn = mysqli_connect($serverName, $dBusername, $dBpassword, $dBname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
