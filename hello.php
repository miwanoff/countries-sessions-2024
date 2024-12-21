<?php
if (isset($_GET['login']) && $_GET['login'] == "admin") {
    include "db.php";
    $login = $_GET['login'];
    echo "<h2>Secret info for $login</h2>";
} else {
    header("Location: index.php");
}