<?php
$link = mysqli_connect("localhost", "root", "", "kajusko");
$mysqli= new mysqli("localhost", "root", "", "kajusko");
$mysqli->query("set charset utf8;");
$mysqli->query("set names utf8;");
?>