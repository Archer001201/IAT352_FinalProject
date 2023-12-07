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

$table = "user_like";
$postKey = "userLike_guideId";

if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) return;
$uid = $_SESSION['valid_user'];
$guideId = $_POST[$postKey];

handleData($db, $uid, $table, $guideId);
