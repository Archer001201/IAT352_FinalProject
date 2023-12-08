<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/like_favorite.js"></script>
<?php
require("guideCardHelperFunctions.php");
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

$user = queryByPrimaryKeyForGuide($db,"users", $_SESSION['valid_user'], "uid");

if (empty($_GET['post_guideSorting'])){
    $guides = sortingGuideDataByTime($db, "DESC", $user["uid"], "postDate", "userID", "guides");
}
else{
    $guideSorting = $_GET['post_guideSorting'];
    if ($guideSorting == 0) $guides = sortingGuideDataByTime($db, "DESC", $user['uid'], "postDate", "userID", "guides");
    else if ($guideSorting == 1) $guides = sortingGuideDataByTime($db, "ASC", $user['uid'], "postDate", "userID", "guides");
    else if ($guideSorting == 2) $guides = sortingGuideDataByCount($db, "user_like", "DESC", $user['uid'], "userID");
    else if ($guideSorting == 3) $guides = sortingGuideDataByCount($db, "user_like", "ASC", $user['uid'], "userID");
    else if ($guideSorting == 4) $guides = sortingGuideDataByCount($db, "user_favorite", "DESC", $user['uid'], "userID");
    else if ($guideSorting == 5) $guides = sortingGuideDataByCount($db, "user_favorite", "ASC", $user['uid'], "userID");
    else $guides = sortingGuideDataByTime($db, "DESC", $user["uid"], "postDate", "userID", "guides");
}

showGuideCard($db,$guides);

