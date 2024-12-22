<?php
include "action.php";

if (session_destroy()) {
    header("location: index.php");
}