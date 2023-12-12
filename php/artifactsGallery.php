<html lang="en">
<head>
    <title>Artifacts</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
</head>
<body>

<?php
require ("header.php");
require_once ("loginHelperFunctions.php");
require_once ("galleryHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

$db = connectDatabase();

echo "<div class='mainContainer'>";
echo "<h1 class='pageTitle'>Artifacts</h1>";
echo "<div class='cardContainer' id='card-container'>";
showInfoCards($db, "artifacts");
echo "</div>";

echo "</div>";
$db->close();
?>

</body>
</html>
