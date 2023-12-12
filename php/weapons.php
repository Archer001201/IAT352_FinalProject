<?php
require_once ("galleryHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

session_start();
$db = connectDatabase();

updateSession();
showInfoCards($db, "weapons");
