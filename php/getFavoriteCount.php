<?php
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}
if (empty($_GET['guideId'])) exit();

showLikeAmount($db, "user_favorite", $_GET['guideId']);

function showLikeAmount($db, $table, $guideId){
    $query = "SELECT COUNT(*) AS like_count FROM " . $table . " WHERE guideID = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        return null;
    }
    $stmt->bind_param('i', $guideId);
    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        return null;
    }
    $result = $stmt->get_result();
    if ($result === false) {
        echo "Query error: " . $db->error;
        return null;
    }

    $row = $result->fetch_assoc();
    echo $row['like_count'];
}