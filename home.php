<?php

require_once("inc/header.php");
require_once("config/config.php");
require_once("libraries/Database.php");

if (isset($_SESSION['name'])) {
        include "temp/subject.php";
} else {
    header("Location: index.php");
}


require_once("inc/footer.php");