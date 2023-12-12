<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/like_favorite.js"></script>
<?php
require_once ("guideCardHelperFunctions.php");
require_once ("sqlHelperFunctions.php");
require_once ("sqlHelperFunctions.php");
session_start();

$db = connectDatabase();

$user = queryById($db,"users", $_SESSION['valid_user'], "uid");

if (empty($_GET['favorite_guideSorting'])){
    $guides = sortingDataByTime($db, "DESC", $user["uid"], "favoriteDate", "userID", "user_favorite");
}
else{
    $guideSorting = $_GET['favorite_guideSorting'];
    if ($guideSorting == "sorting_1"){
        $guides = sortingDataByTime($db, "ASC", $user["uid"], "favoriteDate", "userID", "user_favorite");
    }
    else{
        $guides = sortingDataByTime($db, "DESC", $user["uid"], "favoriteDate", "userID", "user_favorite");
    }
}


if (count($guides)>0){
    $guideData = queryFavoritedGuides($db, $guides);
    showGuideCard($db,$guideData);
}
else{
    echo "<p><strong class='empty-notice'>Explore and Mark Your Favorites!</strong></p>";
}

function queryFavoritedGuides($db, $guides){
    $allRows = [];

    foreach ($guides as $guide) {
        $allRows[] = queryById($db, "guides", $guide['guideID'], "guideID");
    }
    return $allRows;
}
