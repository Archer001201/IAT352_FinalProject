<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
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

if (!empty($_GET['id'])) $id = $_GET['id'];
else {
    $db->close();
    exit();
}
$table = "weapons";
$res = queryById($db,$table, $id, "id");

echo "<div class='mainContainer'>";
showBasicWeaponInfo($res);

echo "</div>";

$db->close();
?>

</body>
</html>
