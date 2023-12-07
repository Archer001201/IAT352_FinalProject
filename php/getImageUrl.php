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

if (isset($_GET['bestWeapon'])) {
    $itemId = $_GET['bestWeapon'];
    $query = "SELECT * FROM weapons WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "../res/WeaponImages/" . $row['image'];
    } else {
        echo "No image found";
    }
}

if (isset($_GET['replacementWeapon'])) {
    $itemId = $_GET['replacementWeapon'];
    $query = "SELECT * FROM weapons WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "../res/WeaponImages/" . $row['image'];
    } else {
        echo "No image found";
    }
}

if (isset($_GET['artifacts_1'])) {
    $itemId = $_GET['artifacts_1'];
    $query = "SELECT * FROM artifacts WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "../res/ArtifactImages/" . $row['image'];
    } else {
        echo "No image found";
    }
}

if (isset($_GET['artifacts_2'])) {
    $itemId = $_GET['artifacts_2'];
    $query = "SELECT * FROM artifacts WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "../res/ArtifactImages/" . $row['image'];
    } else {
        echo "No image found";
    }
}

$db->close();