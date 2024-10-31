<?php

  require_once ("./twitter.lib.php");

  if(!isset($_SESSION)) session_start();
  if($_SESSION['is_logged_in'] == TRUE) {
    $twitter = new Twitter($_SESSION['username'], $_SESSION['password']);
	$twitter->endSession();
	$_SESSION['is_logged_in'] = false;
	$_SESSION['username'] = '';
	$_SESSION['password'] = '';
  }
  
  include ("./twitter_login_form.php");

?>