<html lang="en">
<head>
    <title>Artifacts</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
</head>
<body>

<?php
require("newGuideHelperFunctions.php");
require("detailHelperFunctions.php");
require("loginHelperFunctions.php");
require("header.php");

session_start();
redirect_to_if("sign-in.php", empty($_SESSION['valid_user']), "newGuide");

if (empty($_GET['characterID'])){
    echo "Error: Invalid characterID";
    exit();
}
$characterID = $_GET['characterID'];

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}
$character = queryPrimaryKey($db,"characters", $characterID);
$allWeaponsByWeaponType = queryForeignKey($db,"weapons","weapon_weaponType", $character['character_weaponType']);
$allArtifacts = queryAllFromTable($db, "artifacts");

echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);
echo "<h1>New Game Guide</h1>";
showTextBox();
showDropdown("bestWeapon", "Best Weapon", getAllName($allWeaponsByWeaponType));
showDropdown("replacementWeapon", "Replacement Weapon", getAllName($allWeaponsByWeaponType));
showDropdown("artifacts_1", "Artifacts (2pcs)", getAllName($allArtifacts));
showDropdown("artifacts_2", "Artifacts (2pcs)", getAllName($allArtifacts));
echo "</div>";
$db->close();
?>

</body>
</html>
