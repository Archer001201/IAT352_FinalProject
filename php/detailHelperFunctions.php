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

function showGuideCard($db,$guides){
    foreach ($guides as $data) {
        $bestWeapon = queryPrimaryKey($db,"weapons",$data['bestWeaponID']);
        $replacementWeapon = queryPrimaryKey($db,"weapons",$data['replacementWeaponID']);
        $artifact_1 = queryPrimaryKey($db,"artifacts",$data['artifactID_1']);
        $artifact_2 = queryPrimaryKey($db,"artifacts",$data['artifactID_2']);
        echo "<div class='guideCard'>";
        echo "<h3>" . $data['guideTitle'] . "</h3>";
        echo "<img src='../res/WeaponImages/" . $bestWeapon['image'] . "' width=100>";
        echo "<img src='../res/WeaponImages/" . $replacementWeapon['image'] . "' width=100>";
        echo "<img src='../res/ArtifactImages/" . $artifact_1['image'] . "' width=75>";
        echo "<img src='../res/ArtifactImages/" . $artifact_2['image'] . "' width=75>";
        echo "</div>";
    }
}
