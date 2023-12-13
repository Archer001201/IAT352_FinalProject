<script src="../js/jquery-3.6.1.js"></script>
<script src="../js/like_favorite.js"></script>
<?php
require_once ("guideCardHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

session_start();

$db = connectDatabase();

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

if (count($guides)>0) showGuideCards($db,$guides);
else{
    echo "<p><strong class='empty-notice'>You Haven't Shared Any Guides Yet.</strong></p>";
}

