<?php
require ("like_favorite_functions.php");

session_start();
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}
if (empty($_SESSION['valid_user'])) exit();
$uid = $_SESSION['valid_user'];

getData($db, $uid, 'user_like', "guideID");
