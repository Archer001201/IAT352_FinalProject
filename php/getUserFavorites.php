<?php
require_once ("like_favorite_functions.php");
require_once ("sqlHelperFunctions.php");

session_start();
$db = connectDatabase();

if (empty($_SESSION['valid_user'])) exit();
$uid = $_SESSION['valid_user'];

getData($db, $uid, 'user_favorite', "guideID");
