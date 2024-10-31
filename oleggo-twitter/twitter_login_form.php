<div id="formwrapper">
  <div id="form">
	<div class="loginform" style="position: relative;">
	  <span class="logintitle">Login with Twitter </span>
	  <input type="text" value="Username" class="usernamefield unfilled" id="usernameField" />
	  <input type="password" value="Password" class="passwordfield unfilled" id="passwordField"  />
      <input type="button" value="Login" class="loginbtn" id="loginButton" />
	</div>
  </div>
  <?php
    if(isset($_REQUEST['msg']))
      echo "<div id=\"msg\">" . $_REQUEST['msg'] . "</div>";
    
	if(isset($_REQUEST['error_msg']))
      echo "<div id=\"error\">" . $_REQUEST['error_msg'] . "</div>";
  ?>
</div>
<script type="text/javascript">
    Event.observe($('usernameField'), 'focus', function(e){ TwitterWidget.enableFieldText($('usernameField'), 'Username');});
	Event.observe($('passwordField'), 'focus', function(e){ TwitterWidget.enableFieldText($('passwordField'), 'Password');});
	Event.observe($('usernameField'), 'blur', function(e){ TwitterWidget.disableFieldText($('usernameField'), 'Username');});
    Event.observe($('passwordField'), 'blur', function(e){ TwitterWidget.disableFieldText($('passwordField'), 'Password');});
	Event.observe($('loginButton'), 'click', function(e){ TwitterWidget.authzUser(); });	
</script>