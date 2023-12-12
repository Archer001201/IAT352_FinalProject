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
require_once ("loginHelperFunctions.php");
require_once ("detailHelperFunctions.php");
require_once ("sqlHelperFunctions.php");

$db = connectDatabase();

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
