<html lang="en">
<head>
    <title>Artifacts</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
    <link href="../css/newGuide.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
</head>
<body>

<?php
require("header.php");
require_once("newGuideHelperFunctions.php");
require_once("detailHelperFunctions.php");
require_once ("sqlHelperFunctions.php");


updateSession();
//session_start();
redirect_to_if("sign-in.php", empty($_SESSION['valid_user']), "newGuide");

if (empty($_SESSION['characterID'])){
    echo "Error: Invalid characterID";
    exit();
}
$characterID = $_SESSION['characterID'];

$db = connectDatabase();

$character = queryById($db,"characters", $characterID, "id");
$allWeaponsByWeaponType = queryForeignKey($db,"weapons","weapon_weaponType", $character['character_weaponType']);
$allArtifacts = queryAllFromTable($db, "artifacts");

createGuideData($db);

echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);
//echo "<h1>New Game Guide</h1>";
formStart(("newGuide.php"), "post");

echo "<div class='titleInput'>";
showTextBox("title","Title", true);
echo "</div>";

echo "<div class='equipment-section'>";
echo "<div class='horizontal-layout'>";
echo "<div>";
echo "<div class='horizontal-layout'>";
echo "<img id='bestWeapon_image' src='../res/WeaponImages/" . $allWeaponsByWeaponType[0]['image'] . "' width=100>";
showDropdownWithAssoc("bestWeapon", "Best Weapon",$allWeaponsByWeaponType);
echo "</div>";
echo "<div class='horizontal-layout'>";
echo "<img id='artifacts_1_image' src='../res/ArtifactImages/" . $allArtifacts[0]['image'] . "' width=100>";
showDropdownWithAssoc("artifacts_1", "Artifacts (2pcs)",$allArtifacts);
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='horizontal-layout'>";
echo "<img id='replacementWeapon_image' src='../res/WeaponImages/" . $allWeaponsByWeaponType[0]['image'] . "' width=100>";
showDropdownWithAssoc("replacementWeapon", "Replacement Weapon",$allWeaponsByWeaponType);
echo "</div>";
echo "<div class='horizontal-layout'>";
echo "<img id='artifacts_2_image' src='../res/ArtifactImages/" . $allArtifacts[0]['image'] . "' width=100>";
showDropdownWithAssoc("artifacts_2", "Artifacts (2pcs)",$allArtifacts);
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

echo "<div class='description'>";
showTextArea("description", "Description");
echo "</div>";

showSubmitButton();
formEnd();

echo "</div>";
$db->close();
?>

</body>
</html>
