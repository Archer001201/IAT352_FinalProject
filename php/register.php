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
include('loginHelperFunctions.php');

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

if (isset($_POST['submit'])) { // detect form submission

    // detect if each variable is set (fname, lname, email, password, sid, faculty)
    $name = !empty($_POST["name"]) ? trim($_POST["name"]) : "";
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password2"]) ? $_POST["password2"] : "";
    
    if($password != $password2) {
        $message = "Passwords do not match.";
    }
    else if (!$name || !$email || !$password) {
    	$message = "All fields manadatory.";
    }
    else {
        $pw_encrypted = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (email, password, userName) ";
        $query .= "VALUES (?,?,?)";
      
      	$stmt = $db->prepare($query);
		$stmt->bind_param('sss',$email,$pw_encrypted,$name);
		$stmt->execute();
        echo $query;
        redirect_to('sign-in.php');
    }
}
else {
    $name = "";
    $email = "";
    $s_id = "";
    $faculty = "";
}

require('header.php');
?>
            <section>
            <h2>Register for a Classic Models account</h2>
            <form action="register.php" method="post">
                <label for="name">User Name: <input name="name" type="text" value="<?php $name ?>"></label>
				<br/>
                
                <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
				<br/>

                <label for="password">Password: <input type="password" name="password" value=""></label>
				<br/>
                <label for="password2">Password: <input type="password" name="password2" value=""></label>
				<br/>


                <input type="submit" name="submit" value="Register">
                <?php if(!empty($message)) echo '<p class="message">' . $message . '</p>' ?>
            </form>
            </section>


<?php
	require('footer.php');
    $db->close();
?>

</body>
</html>