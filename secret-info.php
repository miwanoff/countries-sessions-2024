<?php
include "action.php";

if (isset($_SESSION['authorized']) && isset($_GET['login']) && $_GET['login'] == "admin") {
    include "header.php";
    $login = $_GET['login'];
    echo '<div class="container authorized">';
    echo "<h2>Hello $login</h2>";
    echo "<p>Weather</p>";
    echo "</div>";
    include "footer.php";
} else {
    header("Location: index.php");
}