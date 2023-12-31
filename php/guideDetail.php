<html lang="en">
<head>
    <title>guideDetail</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <link href="../css/guide.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/like_favorite.js"></script>
</head>
<body>

<?php
require ("header.php");
require_once ("detailHelperFunctions.php");
require_once ("galleryHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

$db = connectDatabase();

if (!empty($_GET['guideID'])){
    $guideId = $_GET['guideID'];
    $_SESSION['guideID'] = $_GET['guideID'];
}
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


echo "<div class='comment-section'>";
echo "<h2>Comments</h2>";
echo '<div class="tool-bar">';
showDropdown("commentSorting", "Sorting", ["Likes: High to Low", "Likes: Low to High", "Date: Newest", "Date: Oldest"]);
echo '<button class="box-button" id="toggleButton" type="button">Post Comment</button>';
echo '</div>';

echo "<div id='commentInput' style='display: none'>";
echo '<textarea id="commentText"></textarea>';
echo '<button id="submitComment" class="submit-button">Submit</button>';
echo "</div>";

echo "<div id='comment-container'>";
require ("comment.php");
echo "</div>";

echo "</div>";

echo "</div>";

$db->close();
?>

</body>
</html>
