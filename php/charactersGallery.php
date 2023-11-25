<?php

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuide";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

echo "<p>s</p>";

echo "<h1>Characters</h1>";

echo "<div>";
$query_str = 'SELECT * FROM characters';
$res = $db->query($query_str);
if ($res === false) {
    echo "Query error: " . $db->error;
    exit();
}
while ($row = $res->fetch_assoc()) {
    loadInfoCard("characters", $row['name'], $row['image']);
}

echo "</div>";

$res->free_result();
$db->close();

function loadInfoCard($table, $name, $image){
    $resRoot = null;
    if ($table == "characters") $resRoot = "../res/CharacterImages/";
    else if ($table == "weapons") $resRoot = "../res/WeaponImages/";
    else if ($table == "artifacts") $resRoot = "../res/ArtifactImages/";

    echo "<div>";
    if ($resRoot == null){
        echo $table . " is invalid";
        return;
    }
    echo "<img src='" . $resRoot . $image . "'>";
    echo "<p>$name</p>";
    echo "</div>";
}
