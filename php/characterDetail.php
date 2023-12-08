<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
</head>
<body>

<?php
require ("header.php");
require("loginHelperFunctions.php");
require("detailHelperFunctions.php");


$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

if (!empty($_GET['id'])){
    $characterID = $_GET['id'];
    $_SESSION['characterId'] = $_GET['id'];
}
else {
    $db->close();
    exit();
}
$table = "characters";
$character = queryById($db,$table, $characterID, "id");

echo "<div class='mainContainer'>";
showBasicCharacterInfo($character);

echo "<div class='tool-bar'>";
formStart("characterDetail.php", "GET");
showDropdown("guideSorting", "Sorting", ["Likes: High to Low", "Likes: Low to High", "Favorites: High to Low", "Favorites: Low to High", "Date: Newest", "Date: Oldest"]);
formEnd();
showAddGuideButton($characterID);
echo "</div>";

echo "<div id='guidesContainer'>";
require ("characterGuides.php");
echo "</div>";
echo "</div>";
$db->close();
?>

</body>
</html>
