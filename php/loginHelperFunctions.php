<?php

//session_start for store user account infor for detect signin or signout
session_start();

//change https and http when user in signin and register page.
function no_SSL() {
	if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
		header("Location: http://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}
function require_SSL() {
	if($_SERVER['HTTPS'] != "on") {
		header("Location: https://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

function redirect_to($url) {
    header('Location: ' . $url);
    exit;
}

if(!empty($_SESSION['valid_user']))  {
    $current_user = $_SESSION['valid_user'];
    //$query = "SELECT * from members WHERE email = '$current_user'";
    //$result = mysqli_query($connection, $query);
    //while($subject = mysqli_fetch_assoc($result)) {
    //    $s_id = $subject['s_id'];
    //    $fname = $subject['firstname'];
    //    $lname = $subject['lastname'];
    //    $faculty = $subject['faculty'];
    //}
}

function is_logged_in() {
	return isset($_SESSION['valid_user']);
}

function showLoginRequestMessage(){
    if (empty($_SESSION['loginRequestPage'])) return;
    $loginRequestPage = $_SESSION['loginRequestPage'];
    if ($loginRequestPage == "newGuide")
        echo "<p>Please log in to post game guides.</p>";
}