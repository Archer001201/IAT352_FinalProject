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
if (empty($_SESSION['valid_user'])) exit();
$uid = $_SESSION['valid_user'];

$query = "SELECT * FROM user_like WHERE userID = ?";
$stmt = $db->prepare($query);
if ($stmt === false) {
    echo "Prepare error: " . $db->error;
    return null;
}
$stmt->bind_param('i', $uid);
if (!$stmt->execute()) {
    echo "Execute error: " . $stmt->error;
    return null;
}

$result = $stmt->get_result();
if ($result === false) {
    echo "Query error: " . $db->error;
    return null;
}

$guideIds = [];
while ($row = $result->fetch_assoc()){
    $guideIds[] = $row['guideID'];
}
$db->close();
echo json_encode($guideIds);
