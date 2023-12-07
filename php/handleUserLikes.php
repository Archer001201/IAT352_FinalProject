<?php
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

$table = "user_like";
$postKey = "userLike_guideId";

if (empty($_SESSION['valid_user']) || empty($_POST[$postKey])) return;
$uid = $_SESSION['valid_user'];
$guideId = $_POST[$postKey];

$query = "SELECT * FROM " . $table . " WHERE guideID = ? AND userID = ?";
$stmt = $db->prepare($query);
if ($stmt === false) {
    echo "Prepare error: " . $db->error;
    return null;
}
$stmt->bind_param('ii', $guideId, $uid);
if (!$stmt->execute()) {
    echo "Execute error: " . $stmt->error;
    return null;
}

$result = $stmt->get_result();
if ($result === false) {
    echo "Query error: " . $db->error;
    return null;
}

if (mysqli_num_rows($result) > 0) {
    // 如果找到了记录，则删除它
    $deleteQuery = "DELETE FROM " . $table . " WHERE guideID = ? AND userID = ?";
    $deleteStmt = $db->prepare($deleteQuery);
    if (!$deleteStmt) {
        echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        return;
    }
    $deleteStmt->bind_param('ii', $guideId, $uid);
    if (!$deleteStmt->execute()) {
        echo "Execute failed: (" . $deleteStmt->errno . ") " . $deleteStmt->error;
        return;
    }
    $deleteStmt->close();
} else {
    // 如果没有找到记录，则插入新记录
    $insert = "INSERT INTO " . $table . " (userID, guideID) VALUES (?, ?)";
    $stmt = $db->prepare($insert);
    if (!$stmt) {
        echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        return;
    }
    $stmt->bind_param("ii", $uid, $guideId);
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        return;
    }
    $stmt->close();
}

$db->close();
