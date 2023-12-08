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

if (empty($_GET['favorite_guideSorting'])){
    $guides = sortingGuideDataByTime($db, "DESC", $user["uid"], "favoriteDate", "userID", "user_favorite");
}
else{
    $guideSorting = $_GET['favorite_guideSorting'];
    if ($guideSorting == 1){
        $guides = sortingGuideDataByTime($db, "ASC", $user["uid"], "favoriteDate", "userID", "user_favorite");
    }
    else{
        $guides = sortingGuideDataByTime($db, "DESC", $user["uid"], "favoriteDate", "userID", "user_favorite");
    }
}
$guideData = queryFavoritedGuides($db, $guides);

showGuideCard($db,$guideData);

function queryFavoritedGuides($db, $guides){
    $allRows = [];

    foreach ($guides as $guide) {
        $allRows[] = queryByPrimaryKeyForGuide($db, "guides", $guide['guideID'], "guideID");
    }
    return $allRows;
}
