<?php
require_once ("like_favorite_functions.php");
require_once ("sqlHelperFunctions.php");

session_start();
$db = connectDatabase();

$table = "user_like";
$postKey = "userLike_guideId";

if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) return;
$uid = $_SESSION['valid_user'];
$guideId = $_POST[$postKey];

handleData($db, $uid, $table, $guideId, "guideID");
