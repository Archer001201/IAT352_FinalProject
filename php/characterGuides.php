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
$characterId = (int)$_SESSION['characterId'];
$character = queryByPrimaryKeyForGuide($db,"characters", $characterId, "id");
if (empty($_GET['guideSorting'])){
    $guides = sortingGuideDataByCount($db, "user_like", "DESC", $characterId, "characterID");
}
else{
    $guideSorting = $_GET['guideSorting'];
    if ($guideSorting == 0) $guides = sortingGuideDataByCount($db, "user_like", "DESC", $characterId, "characterID");
    else if ($guideSorting == 1) $guides = sortingGuideDataByCount($db, "user_like", "ASC", $characterId, "characterID");
    else if ($guideSorting == 2) $guides = sortingGuideDataByCount($db, "user_favorite", "DESC", $characterId, "characterID");
    else if ($guideSorting == 3) $guides = sortingGuideDataByCount($db, "user_favorite", "ASC", $characterId, "characterID");
    else if ($guideSorting == 4) $guides = sortingGuideDataByTime($db, "DESC", $characterId, "postDate", "characterID", "guides");
    else if ($guideSorting == 5) $guides = sortingGuideDataByTime($db, "ASC", $characterId, "postDate", "characterID", "guides");
    else $guides = queryForeignKeyForGuide($db,"guides","characterID",$_SESSION['characterId']);
}

echo "<h1>Guides for " . $character['name'] . "</h1>";
showGuideCard($db,$guides);
