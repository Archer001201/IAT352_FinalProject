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

function showGuideCard($db, $guides){
    foreach ($guides as $data) {
        $bestWeapon = queryById($db,"weapons",$data['bestWeaponID']);
        $replacementWeapon = queryById($db,"weapons",$data['replacementWeaponID']);
        $artifact_1 = queryById($db,"artifacts",$data['artifactID_1']);
        $artifact_2 = queryById($db,"artifacts",$data['artifactID_2']);
        $publisher = queryForeignKey($db,"users", "uid", $data['userID']);
        $postDateTimestamp = strtotime($data['postDate']);
        $formattedDate = date('Y-m-d', $postDateTimestamp);

        echo "<div class='guideCard' id='guideID_" . $data['guideID'] . "'>";
        echo "<h2>" . $data['guideTitle'] . "</h2>";
        echo "<div class='horizontal-layout'>";


        echo "<div class='equipment'>";
        echo "<div class='vertical-layout'>";
        echo "<div><p><strong>Best Weapon</strong></p>";
        echo "<img src='../res/WeaponImages/" . $bestWeapon['image'] . "' width=100>";
        echo "</div>";

        echo "<div><p><strong>Artifacts (2pcs)</strong></p>";
        echo "<img src='../res/ArtifactImages/" . $artifact_1['image'] . "' width=75>";
        echo "</div>";
        echo "</div>";

        echo "<div class='vertical-layout'>";
        echo "<div><p><strong>Replacement Weapon</strong></p>";
        echo "<img src='../res/WeaponImages/" . $replacementWeapon['image'] . "' width=100>";
        echo "</div>";


        echo "<div><p><strong>Artifacts (2pcs)</strong></p>";
        echo "<img src='../res/ArtifactImages/" . $artifact_2['image'] . "' width=75>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

        echo "<div class='guide-info'>";
        echo "<p><strong>Description</strong></p>";
        echo "<p>" . $data['guideDescription'] . "</p>";
        echo "<p>Published by <strong>" . $publisher[0]['userName'] . "</strong></p>";
        echo "<p>" . $formattedDate . "</p>";
        echo "</div>";

        echo "</div>";
        echo "</div>";
    }
}
