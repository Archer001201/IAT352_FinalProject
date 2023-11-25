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

function updateSession(){
    session_start();
    if (isset($_GET["rarity"])) $_SESSION['rarity'] = $_GET['rarity'];
    if (isset($_GET["region"])) $_SESSION['region'] = $_GET['region'];
    if (isset($_GET["elementType"])) $_SESSION['elementType'] = $_GET['elementType'];
}

function showInfoCards($table, $db, $id){
    $query_str = 'SELECT * FROM ' . $table;
    $conditions = array();

    if (isset($_SESSION['rarity'])) {
        $rarity = $db->real_escape_string($_SESSION['rarity']);
        if ($rarity != "All") $conditions[] = "rarity = '$rarity'";
    }
    if (isset($_SESSION['region'])) {
        $region = $db->real_escape_string($_SESSION['region']);
        if ($region != "All") $conditions[] = "region = '$region'";
    }
    if (isset($_SESSION['elementType'])) {
        $elementType = $db->real_escape_string($_SESSION['elementType']);
        if ($elementType != "All") $conditions[] = "elementType = '$elementType'";
    }

    if (count($conditions) > 0) $query_str .= " WHERE " . implode(" AND ", $conditions);
    $res = $db->query($query_str);

    echo "<div class='cardContainer' id='" . $id . "'>";
    if ($res === false) {
        echo "Query error: " . $db->error;
        exit();
    }
    while ($row = $res->fetch_assoc()) {
        showInfoCard($table, $row['name'], $row['image']);
    }
    echo "</div>";

    $res->free_result();
}

function showDropdown($label, $displayName, $options){
    echo "<label for='" . $label . "'>" . $displayName;
    echo "<select name='" . $label . "' id='" . $label . "'>";
    foreach ($options as $opt){
        $selected = (isset($_SESSION[$label]) && $_SESSION[$label] == $opt) ? 'selected' : '';
        echo "<option value='" . $opt . "' " . $selected . ">" . $opt . "</option>";
    }
    echo "</select></label>";
}

function formStart($filePath){
    echo "<form action='$filePath'>";
}

function formEnd(){
    echo "</form>";
}
