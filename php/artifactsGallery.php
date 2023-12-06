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
require("loginHelperFunctions.php");
require("galleryHelperFunctions.php");


$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

echo "<div class='mainContainer'>";
echo "<h1 class='pageTitle'>Artifacts</h1>";
showInfoCards($db, "artifacts");

echo "</div>";
$db->close();
?>

</body>
</html>
