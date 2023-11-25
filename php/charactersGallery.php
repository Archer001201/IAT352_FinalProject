<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
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

echo "<h1>Characters</h1>";
echo "<div class='cardContainer'>";
showInfoCards("characters", $db);
echo "</div>";

$db->close();
?>

</body>
</html>
