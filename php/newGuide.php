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
require("newGuideHelperFunctions.php");
require("detailHelperFunctions.php");
require("loginHelperFunctions.php");


updateSession();
//session_start();
redirect_to_if("sign-in.php", empty($_SESSION['valid_user']), "newGuide");

if (empty($_SESSION['characterID'])){
    echo "Error: Invalid characterID";
    exit();
}
$characterID = $_SESSION['characterID'];

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}
$character = queryById($db,"characters", $characterID);
$allWeaponsByWeaponType = queryForeignKey($db,"weapons","weapon_weaponType", $character['character_weaponType']);
$allArtifacts = queryAllFromTable($db, "artifacts");

createGuideData($db);

echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);
echo "<h1>New Game Guide</h1>";
formStart(("newGuide.php"), "post");

echo "<div class='titleInput'>";
showTextBox("title","Title", true);
echo "</div>";

echo "<div class='equipment-section'>";
echo "<div class='horizontal-layout'>";
echo "<div>";
echo "<div class='horizontal-layout'>";
echo "<img id='bestWeapon_image' src='../res/WeaponImages/" . $allWeaponsByWeaponType[0]['image'] . "' width=100>";
showDropdown("bestWeapon", "Best Weapon",$allWeaponsByWeaponType);
echo "</div>";
echo "<div class='horizontal-layout'>";
echo "<img id='artifacts_1_image' src='../res/ArtifactImages/" . $allArtifacts[0]['image'] . "' width=100>";
showDropdown("artifacts_1", "Artifacts (2pcs)",$allArtifacts);
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='horizontal-layout'>";
echo "<img id='replacementWeapon_image' src='../res/WeaponImages/" . $allWeaponsByWeaponType[0]['image'] . "' width=100>";
showDropdown("replacementWeapon", "Replacement Weapon",$allWeaponsByWeaponType);
echo "</div>";
echo "<div class='horizontal-layout'>";
echo "<img id='artifacts_2_image' src='../res/ArtifactImages/" . $allArtifacts[0]['image'] . "' width=100>";
showDropdown("artifacts_2", "Artifacts (2pcs)",$allArtifacts);
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
