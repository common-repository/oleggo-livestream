<?php

  $username = rawurlencode($_REQUEST['username']);
  $password = rawurlencode($_REQUEST['password']);

  $valid = (bool) @file_get_contents("http://$username:$password@twitter.com/account/verify_credentials.json");
  
  if ($valid) {
    if(!isset($_SESSION)) session_start();
    $_SESSION['is_logged_in'] = true;
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
    include ("twitter_update_status_form.php");
  }
  else {
    $_REQUEST['error_msg'] = "Incorrect username or password; please try again.";
    include "twitter_login_form.php";
  }
  
?>