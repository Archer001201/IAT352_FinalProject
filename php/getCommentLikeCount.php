<?php
require_once ("sqlHelperFunctions.php");
$db = connectDatabase();

if (empty($_GET['postId'])) exit();

echo showUserAmount($db, "comment_like", $_GET['postId'], "commentID");
