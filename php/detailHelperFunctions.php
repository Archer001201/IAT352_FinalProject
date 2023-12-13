<?php
/*
 * echo a html structure that shows a character's basic information
 * $res -> the character data from database
 */
function showBasicCharacterInfo($res){
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoImage'><img src='../res/CharacterImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    echo "<p><strong>Name: " . $res['name'] . "</strong></p>";
    echo "<p> Element: " . $res['elementType'] . "</p>";
    echo "<p> Region: " . $res['region'] . "</p>";
    echo "<p> Rarity: " . $res['characterRarity'] . "</p>";
    if ($res['description'] != null){
        $array = json_decode($res['description'], true);
        showHoverInfo($array,"talents");
        showHoverInfo($array, "constellation");
    }

    echo "</div>";
    echo "</div>";
}

/*
 * echo a html structure that shows a weapon's basic information
 * $res -> the weapon data from database
 */
function showBasicWeaponInfo($res){
    switch ($res['weapon_weaponType']){
        case 1:
            $type = "Sword";
            break;
        case 2:
            $type = "Claymore";
            break;
        case 3:
            $type = "Catalyst";
            break;
        case 4:
            $type = "Polearm";
            break;
        case 5:
            $type = "Bow";
            break;
        default:
            $type = "Unknown Type";
            break;
    }
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoName'><h1>" . $res['name'] . "</h1></div>";
    echo "<div class='basicInfoImage'><img src='../res/WeaponImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    echo "<p> Rarity: " . $res['weaponRarity'] . "</p>";
    echo "<p> Type: " . $type . "</p>";
    if ($res['description'] != null){
        $array = json_decode($res['description'], true);
        showTextInfo($array);
    }
    echo "</div>";
    echo "</div>";
}

/*
 * echo a html structure that shows a artifact's basic information
 * $res -> the artifact data from database
 */
function showBasicArtifactInfo($res){
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoName'><h1>" . $res['name'] . "</h1></div>";
    echo "<div class='basicInfoImage'><img src='../res/ArtifactImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    if ($res['description'] != null){
        $array = json_decode($res['description'], true);
        showTextInfo($array);
    }
    echo "</div>";
    echo "</div>";
}

/*
 * echo a html structure that shows add guide button, and update session data with character id
 * $characterID -> the character id which this new guide is writing for
 */
function showAddGuideButton($characterID){
    echo "<a class='box-button' href='newGuide.php'>Add New Guide</a>";
    $_SESSION['characterID'] = $characterID;
}

/*
 * echo a html structure that shows character's skills
 * skill name will be displayed as the tag, and then moused hovered will show skill description below it
 * $array -> the skill data from database
 * (the row skill data from database is formed as json format)
 * (need to decode the row data into associative array before call this function)
 * $type -> two types of skill: talents and constellation
 */
function showHoverInfo($array, $type){
    if (isset($array[$type]) && is_array($array[$type])) {
        echo "<div class='skills'> <p><strong>" . ucwords($type) . "</strong></p>";
        foreach ($array[$type] as $name => $detail) {
            echo "<div class='skill'>";
            echo $name;
            echo "<span class='skill-detail'>" . $detail . "</span>";
            echo "</div>";
        }
        echo "</div>";
    }
}

/*
 * echo a html structure that shows weapon and artifact's skills
 * $array -> the skill data from database
 * (the row skill data from database is formed as json format)
 * (need to decode the row data into associative array before call this function)
 */
function showTextInfo($array){
    if (is_array($array)) {
        foreach ($array as $name => $detail) {
            echo "<h3>" . ucwords($name) . "</h3>";
            echo "<p>" . $detail . "</p>";
        }
    }
}



