<?php

  require_once ("./twitter.lib.php");

  if(!isset($_SESSION)) session_start();
  if($_SESSION['is_logged_in'] == TRUE && $_REQUEST['text'] != '') {
    $twitter = new Twitter($_SESSION['username'], $_SESSION['password']);
	$twitter->updateStatus(urldecode($_REQUEST['text']));
	$_REQUEST['status_update_result'] = true;
  }
  
  include ("./twitter_update_status_form.php");

?>