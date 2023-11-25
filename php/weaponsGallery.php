<html lang="en">
<head>
    <title>Weapons</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/DataFilter.js"></script>
</head>
<body>

<?php
require ("helper_functions.php");
require ("header.php");

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

echo "<h1>Weapons</h1>";
//echo "<div class='cardContainer'>";
updateSession();
formStart('weaponsGallery.php');
showDropdown("rarity", "Rarity", ["All", "3-star", "4-star", "5-star"]);
showDropdown("weaponType","Weapon Type", ["All", "Sword", "Claymore", "Polearm", "Bow", "Catalyst"]);
formEnd();
showInfoCards("weapons", $db, "weaponCardContainer");
//echo "</div>";

$db->close();
?>

</body>
</html>
