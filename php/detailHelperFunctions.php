<?php
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

function showAddGuideButton($characterID){
    echo "<a class='box-button' href='newGuide.php'>Add New Guide</a>";
    $_SESSION['characterID'] = $characterID;
}

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

function showTextInfo($array){
    if (is_array($array)) {
        foreach ($array as $name => $detail) {
            echo "<h3>" . ucwords($name) . "</h3>";
            echo "<p>" . $detail . "</p>";
        }
    }
}



