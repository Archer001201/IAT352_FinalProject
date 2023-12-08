<html lang="en">
<head>
    <title>guideDetail</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
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


echo "<div class='mainContainer'>";
echo "<h1>" . $guideData['guideTitle'] . "</h1>";
echo "<h2> Equipments Recommendation </h2>";
showInfoCard("weapons", $bestWeapon['name'], $bestWeapon['image'], $bestWeapon['id']);
showInfoCard("weapons", $replacementWeapon['name'], $replacementWeapon['image'], $replacementWeapon['id']);
showInfoCard("artifacts", $artifacts_1['name'], $artifacts_1['image'], $artifacts_1['id']);
showInfoCard("artifacts", $artifacts_2['name'], $artifacts_2['image'], $artifacts_2['id']);
echo "<p>" . $guideData['guideDescription'] . "</p>";
echo "</div>";

$db->close();
?>

</body>
</html>
