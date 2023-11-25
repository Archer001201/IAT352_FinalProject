<?php

function showInfoCard($table, $name, $image){
    $resRoot = null;
    if ($table == "characters") $resRoot = "../res/CharacterImages/";
    else if ($table == "weapons") $resRoot = "../res/WeaponImages/";
    else if ($table == "artifacts") $resRoot = "../res/ArtifactImages/";

    echo "<a class='card' href='#'>";
    if ($resRoot == null){
        echo $table . " is invalid";
        return;
    }
    echo "<img src='" . $resRoot . $image . "' width=150>";
    echo "<p>$name</p>";
    echo "</a>";
}

function showInfoCards($table, $db){
    $query_str = 'SELECT * FROM ' . $table;
    $res = $db->query($query_str);
    if ($res === false) {
        echo "Query error: " . $db->error;
        exit();
    }
    while ($row = $res->fetch_assoc()) {
        showInfoCard($table, $row['name'], $row['image']);
    }
    $res->free_result();
}
