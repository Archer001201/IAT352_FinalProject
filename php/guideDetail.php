<html lang="en">
<head>
    <title>guideDetail</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
</head>
<body>

<?php
require ("header.php");
require ("loginHelperFunctions.php");
require ("detailHelperFunctions.php");
require ("galleryHelperFunctions.php");


$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

if (!empty($_GET['guideID'])) $guideId = $_GET['guideID'];
else {
    $db->close();
    exit();
}

$guideData = queryById($db, "guides", $_GET['guideID'], "guideID");
$bestWeapon = queryById($db, "weapons", $guideData['bestWeaponID'], "id");
$replacementWeapon = queryById($db, "weapons", $guideData['replacementWeaponID'], "id");
$artifacts_1 = queryById($db, "artifacts", $guideData['artifactID_1'], "id");
$artifacts_2 = queryById($db, "artifacts", $guideData['artifactID_2'], "id");
$character = queryById($db,"characters", $guideData['characterID'], "id");


echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);
echo "<h1>" . $guideData['guideTitle'] . "</h1>";
echo "<div class='guide-table'>";
echo "<div class='equipment-table'>";
echo "<h3>Equipments Recommendation</h3>";

echo "<div class='equipment-row'>";
echo "<div class='equipment-colum'>";
echo "<p><strong>Best Weapon</strong></p>";
showInfoCard("weapons", $bestWeapon['name'], $bestWeapon['image'], $bestWeapon['id'], "top");
echo "<p><strong>Artifacts (2pcs)</strong></p>";
showInfoCard("artifacts", $artifacts_1['name'], $artifacts_1['image'], $artifacts_1['id'], "top");
echo"</div>";

echo "<div class='equipment-colum'>";
echo "<p><strong>Replacement Weapon</strong></p>";
showInfoCard("weapons", $replacementWeapon['name'], $replacementWeapon['image'], $replacementWeapon['id'], "top");
echo "<p><strong>Artifacts (2pcs)</strong></p>";
showInfoCard("artifacts", $artifacts_2['name'], $artifacts_2['image'], $artifacts_2['id'], "top");
echo"</div>";
echo"</div>";
echo"</div>";

echo "<div class='description-container'>";
echo "<h3>Description</h3>";
echo "<p>" . $guideData['guideDescription'] . "</p>";
echo "</div>";
echo "</div>";


echo "</div>";

$db->close();
?>

</body>
</html>
