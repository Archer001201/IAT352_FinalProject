<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/like_favorite.js"></script>
<?php
require("guideCardHelperFunctions.php");
require ("sqlHelperFunctions.php");
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

$user = queryById($db,"users", $_SESSION['valid_user'], "uid");

if (empty($_GET['post_guideSorting'])){
    $guides = sortingDataByTime($db, "DESC", $user["uid"], "postDate", "userID", "guides");
}
else{
    $guideSorting = $_GET['post_guideSorting'];
    if ($guideSorting == "sorting_0") $guides = sortingDataByTime($db, "DESC", $user['uid'], "postDate", "userID", "guides");
    else if ($guideSorting == "sorting_1") $guides = sortingDataByTime($db, "ASC", $user['uid'], "postDate", "userID", "guides");
    else if ($guideSorting == "sorting_2") $guides = sortingDataByCount($db, "guides","user_like", "guideID","DESC", $user['uid'], "userID");
    else if ($guideSorting == "sorting_3") $guides = sortingDataByCount($db, "guides","user_like", "guideID","ASC", $user['uid'], "userID");
    else if ($guideSorting == "sorting_4") $guides = sortingDataByCount($db, "guides","user_favorite", "guideID","DESC", $user['uid'], "userID");
    else if ($guideSorting == "sorting_5") $guides = sortingDataByCount($db, "guides","user_favorite", "guideID","ASC", $user['uid'], "userID");
    else $guides = sortingDataByTime($db, "DESC", $user["uid"], "postDate", "userID", "guides");
}

showGuideCard($db,$guides);

