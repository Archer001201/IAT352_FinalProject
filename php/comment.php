<?php
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

if (!empty($_SESSION['guideID'])) $guideId = (int)$_SESSION['guideID'];
else {
    $db->close();
    exit();
}

if (!empty($_POST['postComment'])) {
    $postComment = $_POST['postComment'];
    $newCommentId = insertComment($db, $postComment, $guideId);
    echo (int)$newCommentId;
} else {
    echo '<script src="../js/like_favorite.js"></script>';
    if (empty($_GET['commentSorting'])){
        $commentList = sortingDataByTime($db, "DESC", $guideId, "postDate", "guideID", "comments");
    }
    else{
        $commentSorting = $_GET['commentSorting'];
        if ($commentSorting == "sorting_0") $commentList = sortingDataByCount($db, "comments", "comment_like", "commentID", "DESC", $guideId,"guideID");
        else if ($commentSorting == "sorting_1") $commentList = sortingDataByCount($db, "comments","comment_like", "commentID","ASC", $guideId,"guideID");
        else if ($commentSorting == "sorting_2") $commentList = sortingDataByTime($db, "DESC", $guideId, "postDate", "guideID", "comments");
        else if ($commentSorting == "sorting_3") $commentList = sortingDataByTime($db, "ASC", $guideId, "postDate", "guideID", "comments");
        else $commentList = sortingDataByTime($db, "DESC", $guideId, "postDate", "guideID", "comments");
    }

    echo "<div id='commentContainer'>";
    foreach ($commentList as $comment) {
        showCommentCard($db, $comment);
    }
    echo "</div>";
}

function showCommentCard($db, $comment){
    $publisher = queryById($db, "users", $comment['userID'], "uid");
    echo "<div class='comment-card' id='commentID_" . $comment['commentID'] . "'>";
    echo "<p>" . $comment['text'] . "</p>";
    echo "<div class='comment-card-bottom'>";
    echo "<div class='comment-info'>";
    echo "<p>" . $comment['postDate'] . "</p>";
    echo "<p>" . $publisher['userName'] . "</p>";
    echo "</div>";
    echo "<button class='svg-button commentLike' data-guide-id='" . $comment['commentID'] . "'>";
    echo "<p class='count' data-commentLike-guide-id='" . $comment['commentID'] . "'>"
        . showUserAmount($db, "comment_like", $comment['commentID'], "commentID") . "</p>";
    showThumb();
    echo "</button>";
    echo "</div>";
    echo "</div>";
}

function insertComment($db, $comment, $guideId){
    $uid = $_SESSION['valid_user'];
    $insertStr = "INSERT INTO comments (userID, guideID, text) VALUES (?, ?, ?)";
    $stmt = $db->prepare($insertStr);
    if (!$stmt) {
        echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        return null;
    }
    $stmt->bind_param("iis", $uid, $guideId, $comment);
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        return null;
    }

    $newCommentId = $db->insert_id;
    $stmt->close();
    return $newCommentId;
}

function showThumb(){
    echo '<svg class="svg-thumb" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.24001 11V20H5.63001C4.73001 20 4.01001 19.28 4.01001 18.39V12.62C4.01001 11.73 4.74001 11 5.63001 11H7.24001ZM18.5 9.5H13.72V6C13.72 4.9 12.82 4 11.73 4H11.64C11.24 4 10.88 4.24 10.72 4.61L7.99001 11V20H17.19C17.92 20 18.54 19.48 18.67 18.76L19.99 11.26C20.15 10.34 19.45 9.5 18.51 9.5H18.5Z" fill="#919191" class="svg-thumb-color"></path> </g></svg>';
}
