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
$characterId = (int)$_SESSION['characterId'];
$character = queryById($db,"characters", $characterId, "id");
if (empty($_GET['guideSorting'])){
//    echo "???";
    $guides = sortingDataByCount($db, "guides", "user_like","guideID","DESC", $characterId, "characterID");
}
else{
    $guideSorting = $_GET['guideSorting'];
    if ($guideSorting == "sorting_0") $guides = sortingDataByCount($db, "guides", "user_like","guideID","DESC", $characterId, "characterID");
    else if ($guideSorting == "sorting_1") $guides = sortingDataByCount($db, "guides", "user_like","guideID","ASC", $characterId, "characterID");
    else if ($guideSorting == "sorting_2") $guides = sortingDataByCount($db, "guides", "user_favorite","guideID","DESC", $characterId, "characterID");
    else if ($guideSorting == "sorting_3") $guides = sortingDataByCount($db, "guides", "user_favorite","guideID","ASC", $characterId, "characterID");
    else if ($guideSorting == "sorting_4") $guides = sortingDataByTime($db, "DESC", $characterId, "postDate", "characterID", "guides");
    else if ($guideSorting == "sorting_5") $guides = sortingDataByTime($db, "ASC", $characterId, "postDate", "characterID", "guides");
    else $guides = sortingDataByCount($db, "guides", "user_like","guideID","DESC", $characterId, "characterID");
}
showGuideCard($db,$guides);
