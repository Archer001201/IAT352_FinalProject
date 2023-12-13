<?php
require_once ("like_favorite_functions.php");
require_once ("sqlHelperFunctions.php");

session_start();
$db = connectDatabase();

$table = "comment_like";
$postKey = "commentLike_postId";

if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) exit();
$uid = $_SESSION['valid_user'];
$postId = $_POST[$postKey];

handleData($db, $uid, $table, $postId, "commentID");
