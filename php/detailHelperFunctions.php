<?php
//require ("sqlHelperFunctions.php");
function showBasicCharacterInfo($res){
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoName'><h1>" . $res['name'] . "</h1></div>";
    echo "<div class='basicInfoImage'><img src='../res/CharacterImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    echo "<p> Element: " . $res['elementType'] . "</p>";
    echo "<p> Region: " . $res['region'] . "</p>";
    echo "<p> Rarity: " . $res['characterRarity'] . "</p>";
    echo "</div>";
    echo "</div>";
}

function showBasicWeaponInfo($res){
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoName'><h1>" . $res['name'] . "</h1></div>";
    echo "<div class='basicInfoImage'><img src='../res/WeaponImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    echo "<p> Rarity: " . $res['weaponRarity'] . "</p>";
    echo "</div>";
    echo "</div>";
}

function showBasicArtifactInfo($res){
    echo "<div class='basicInfoContainer'>";
    echo "<div class='basicInfoName'><h1>" . $res['name'] . "</h1></div>";
    echo "<div class='basicInfoImage'><img src='../res/ArtifactImages/" . $res['image'] . "' alt='image'></div>";
    echo "<div class='basicInfoDescription'>";
    echo "</div>";
    echo "</div>";
}

function showAddGuideButton($characterID){
    echo "<a href='newGuide.php'>Add New Guide</a>";
    $_SESSION['characterID'] = $characterID;
}

