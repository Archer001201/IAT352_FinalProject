<html lang="en">
<head>
    <title>Artifacts</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/account.css" rel="stylesheet">
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/ajax.js"></script>
</head>
<body>

<?php
require("header.php");
require("loginHelperFunctions.php");

redirect_to_if("sign-in.php", empty($_SESSION['valid_user']), "account");
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";
$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}

$user = queryById($db,"users", $_SESSION['valid_user'], "uid");

echo "<div class='mainContainer'>";
echo "<h1>" . $user['userName'] . "</h1>";
require ("account_nav.php");
header('Location: favorites.php');
echo "</div>";
?>

</body>
</html>