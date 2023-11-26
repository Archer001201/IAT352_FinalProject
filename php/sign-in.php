<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    
</head>
<body>
<?php
include('helper_functions.php');
//require_SSL();

$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "genshinGuides";

$db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
if ($db->connect_errno) {
    echo "Database connection error: " . $db->connect_error;
    exit();
}


if (!isset($_POST['submit'])) { // detect form submission

    $email = $pass = "";

} else {
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : "";

    $query = "SELECT email,password from users ";
    $query .= "WHERE email = ?";

	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($email2,$pass2_hash);
	

    if($stmt->fetch() && password_verify($password,$pass2_hash)) {
        $_SESSION['valid_user'] = $email;
        $callback_url = "index.php";
        if (isset($_SESSION['callback_url']))
        	$callback_url = $_SESSION['callback_url'];
        //switch back to non-secure http
        redirect_to($callback_url);
    }
    else $message = "Sorry, email and password combination not registered. <a href=\"\">Forgot?</a>";
}

require('header.php');
?>
    <section>
	<h2>Sign in </h2>
    <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>

    <form action="sign-in.php" method="post">
    <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
    <br/>
    <br/>
    <label for="password">Password: <input type="password" name="password" value=""></label>
    <br/>
    <br/>
    <input type="submit" name="submit" value="Submit">
            </form>
	<p><a href="register.php">Not registered yet? Register here.</a></p>
    </section>
<?php 
	require('footer.php');
?>


</body>
</html>