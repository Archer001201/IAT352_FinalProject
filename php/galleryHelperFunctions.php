<?php
/*
 * echo a html structure that shows a single information card of character, weapon, or artifact
 * $table -> the table name which matches database's table
 * (actually $table in this function is to handle different url based on the string)
 * $name -> the name of character, weapon, or artifact (get it from database)
 * $image -> the image url from database
 */
function showInfoCard($table, $name, $image, $id, $namePosition){
    $resRoot = null;
    $hrefStr = "#";
    if ($table == "characters"){
        $resRoot = "../res/CharacterImages/";
        $hrefStr = "characterDetail.php?id=" . $id;
    }
    else if ($table == "weapons"){
        $resRoot = "../res/WeaponImages/";
        $hrefStr = "weaponDetail.php?id=" . $id;
    }
    else if ($table == "artifacts"){
        $resRoot = "../res/ArtifactImages/";
        $hrefStr = "artifactDetail.php?id=" . $id;
    }

    echo "<a class='card' href=$hrefStr>";
    if ($resRoot == null){
        echo $table . " is invalid";
        return;
    }

    if ($namePosition == "top") echo "<p>$name</p>";
    echo "<img src='" . $resRoot . $image . "' width=150>";
    if ($namePosition == "bottom") echo "<p>$name</p>";
    echo "</a>";
}

/*
 * update session data in gallery pages
 */
function updateSession(){
    if (isset($_GET["characterRarity"])) $_SESSION['characterRarity'] = $_GET['characterRarity'];
    if (isset($_GET["region"])) $_SESSION['region'] = $_GET['region'];
    if (isset($_GET["elementType"])) $_SESSION['elementType'] = $_GET['elementType'];
    if (isset($_GET["character_weaponType"])) $_SESSION['character_weaponType'] = $_GET['character_weaponType'];

    if (isset($_GET["weaponRarity"])) $_SESSION['weaponRarity'] = $_GET['weaponRarity'];
    if (isset($_GET["weapon_weaponType"])) $_SESSION['weapon_weaponType'] = $_GET['weapon_weaponType'];

    if (isset($_SESSION['bestWeapon'])) unset($_SESSION['bestWeapon']);
    if (isset($_SESSION['replacementWeapon'])) unset($_SESSION['replacementWeapon']);
    if (isset($_SESSION['artifacts_1'])) unset($_SESSION['artifacts_1']);
    if (isset($_SESSION['artifacts_2'])) unset($_SESSION['artifacts_2']);
}

/*
 * echo a html structure that shows all conditions satisfied information cards by sql query and call showInfoCard function
 * $db -> the instance of database
 * $table -> the table name that matches database
 */
function showInfoCards($db, $table){
    $query_str = 'SELECT * FROM ' . $table;
    $conditions = array();
    $params = array();
    $types = '';

    if ($table == "weapons"){
        if (isset($_SESSION['weaponRarity']) && $_SESSION['weaponRarity'] != "All") {
            $conditions[] = "weaponRarity = ?";
            $params[] = $_SESSION['weaponRarity'];
            $types .= 's';
        }
        if (isset($_SESSION['weapon_weaponType']) && $_SESSION['weapon_weaponType'] != "All") {
            $conditions[] = "weapon_weaponType IN (SELECT id FROM weaponTypes WHERE weaponTypes.name = ?)";
            $params[] = $_SESSION['weapon_weaponType'];
            $types .= 's';
        }
    }

    if ($table == "characters") {
        if (isset($_SESSION['characterRarity']) && $_SESSION['characterRarity'] != "All") {
            $conditions[] = "characterRarity = ?";
            $params[] = $_SESSION['characterRarity'];
            $types .= 's';
        }
        if (isset($_SESSION['region']) && $_SESSION['region'] != "All") {
            $conditions[] = "region = ?";
            $params[] = $_SESSION['region'];
            $types .= 's';
        }
        if (isset($_SESSION['elementType']) && $_SESSION['elementType'] != "All") {
            $conditions[] = "elementType = ?";
            $params[] = $_SESSION['elementType'];
            $types .= 's';
        }
        if (isset($_SESSION['character_weaponType']) && $_SESSION['character_weaponType'] != "All") {
            $conditions[] = "character_weaponType IN (SELECT id FROM weaponTypes WHERE weaponTypes.name = ?)";
            $params[] = $_SESSION['character_weaponType'];
            $types .= 's';
        }
    }

    if (count($conditions) > 0) $query_str .= "  WHERE " . implode(" AND ", $conditions);

//    echo $query_str;
    $stmt = $db->prepare($query_str);
    if ($stmt === false) {
        echo "Prepare error: " . $db->error;
        exit();
    }

    if ($types != '') {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        echo "Execute error: " . $stmt->error;
        exit();
    }

    $res = $stmt->get_result();

    if ($res === false) {
        echo "Query error: " . $db->error;
        exit();
    }


    while ($row = $res->fetch_assoc()) {
        showInfoCard($table, $row['name'], $row['image'], $row['id'], "bottom");
    }

    $res->free_result();
}



