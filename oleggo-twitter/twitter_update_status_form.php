<?php if(!isset($_SESSION)) session_start(); ?>
<div id="formwrapper">
  <div id="countdown"></div>
  <div id="form">
    <div class="msgfieldwrapper">
	  <input type="text" class="msgfield" id="tweetText" value="<?php echo $t_tweetbegin; ?> "/>
	</div>
	<div class="sendmeta">
	  <span id="status-update-result">
	  <?php
        if(isset($_REQUEST['status_update_result']))
          echo "Status updated; please wait a moment for a refresh.";
      ?>
	  </span>
	  <div class="sendbtnwrapper">
	    <span class="charcount" id="charCounter" maxlength="140">140</span>
		<input type="button" class="sendbtn" value="Send" id="updateStatusButton"/>
	  </div>
	  <div class="twitter-user">@<?php echo $_SESSION['username'] ?> | <a href="javascript:;" id="logoutButton">log out</a></div>
    </div>
  </div>
</div>
<script type="text/javascript">
    Event.observe($('tweetText'), 'keyup', function(){TwitterWidget.charCounter('tweetText', 140);}, false);
	Event.observe($('tweetText'), 'keydown', function(){TwitterWidget.charCounter('tweetText', 140);}, false);
	Event.observe($('logoutButton'), 'click', function(e){ TwitterWidget.logoutUser(); });
	Event.observe($('updateStatusButton'), 'click', function(e){ TwitterWidget.updateStatus(); });
</script>