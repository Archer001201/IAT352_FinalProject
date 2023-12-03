<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
</head>
<body>

<?php
require("loginHelperFunctions.php");
require("detailHelperFunctions.php");
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

if (!empty($_GET['id'])) $characterID = $_GET['id'];
else {
    $db->close();
    exit();
}
$table = "characters";
$character = queryPrimaryKey($db,$table, $characterID);
$guides = queryForeignKey($db,"guides","characterID",$characterID);
session_start();

echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);
showAddGuideButton($characterID);
echo "<div class='guidesContainer'>";
echo "<h2>Guides for " . $character['name'] . "</h2>";
showGuideCard($db,$guides);
echo "</div>";
echo "</div>";

$db->close();
?>

</body>
</html>
