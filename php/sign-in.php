<html lang="en">
<head>
    <title>Characters</title>
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/signIn.css" rel="stylesheet">
    <link href="../css/gallery.css" rel="stylesheet">
</head>
<body>
    
<?php
require ('header.php');
require_once ("sqlHelperFunctions.php");
//require_SSL();

$db = connectDatabase();

if (!isset($_POST['submit'])) { // detect form submission

    $email = $pass = "";

} else {
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? trim($_POST["password"]) : "";

    $query = "SELECT uid, password FROM users WHERE email = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
    $stmt->bind_result($uid, $pass2_hash);

	

    if($stmt->fetch() && password_verify($password,$pass2_hash)) {
        $_SESSION['valid_user'] = $uid;
        $callback_url = "index.php";
        if (isset($_SESSION['callback_url']))
        	$callback_url = $_SESSION['callback_url'];
        //switch back to non-secure http
        redirect_to($callback_url);
    }
    else $message = "Sorry, email and password combination not registered. <a href=\"\">Forgot?</a>";
}

//require('header.php');
?>

    <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>

    <form action="sign-in.php" method="post">
        <div>
            <h2>Sign in </h2>
            <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
            <br/>
            <label for="password">Password: <input type="password" name="password" value=""></label>
            <br/>
            <input class="submit-button" type="submit" name="submit" value="Submit">
            <br/>
            <a href="register.php">Not registered yet? Register here.</a>

<?php
    showLoginRequestMessage();
?>
        </div>
    </form>
<?php
	require('footer.php');
?>


</body>
</html>