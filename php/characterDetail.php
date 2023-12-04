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
$character = queryById($db,$table, $characterID);
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
//echo '<svg fill="#000000" viewBox="-4.8 -4.8 41.60 41.60" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Group_13" data-name="Group 13" transform="translate(-93.998 -396.695)"> <path id="Path_365" data-name="Path 365" d="M108.706,410.042A7.884,7.884,0,0,1,108,406.7a10.121,10.121,0,0,1,.708-3.659,10.989,10.989,0,0,1,1.929-3.205,9.586,9.586,0,0,1,2.86-2.272,7.686,7.686,0,0,1,3.5-.864,9,9,0,0,1,6.364,15.365c-.814.813-12.287,11.179-13.364,11.635h0c-1.077-.456-12.55-10.822-13.364-11.635A9,9,0,0,1,103,396.7a7.68,7.68,0,0,1,3.5.864,9.591,9.591,0,0,1,2.861,2.272,11.011,11.011,0,0,1,1.929,3.205A10.141,10.141,0,0,1,112,406.7a7.9,7.9,0,0,1-.707,3.347,7.328,7.328,0,0,1-1.929,2.518"></path> </g> </g></svg>';

$db->close();
?>

</body>
</html>
