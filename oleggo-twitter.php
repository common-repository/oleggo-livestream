<div id="oleggo-twitter-box" style="width:<?php echo $t_width; ?>px;height:<?php echo $t_height; ?>px;">
  <?php $form_height = 80; ?>
  <div id="oleggo-twitter-form" style="height:<?php echo $form_height; ?>px;">
    <?php 
	  if($_SESSION['is_logged_in'] == TRUE) {
	    include ("oleggo-twitter/twitter_update_status_form.php"); 
	  } else {
	    include ("oleggo-twitter/twitter_login_form.php"); 
	  }
    ?>
  </div>
  <div id="oleggo-twitter-results" style="height:<?php echo ($t_height - $form_height - 1); ?>px;">
    <span class="loading">Loading Tweets...</span>
  </div>
</div> 