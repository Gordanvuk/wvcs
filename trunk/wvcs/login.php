<?php
include 'libraries/initial.inc.php';
include 'libraries/login.lib.php';
include 'style/header.inc.php';
?>
<div class="row login">
<div class="span4 columns">latest news</div>
<div class="span12 columns">
<form action="login_check.php" method="post">
<fieldset><legend>Sign in <?php echo $system_name_short; ?></legend>
<div class="clearfix<?php login_error_hl(); ?>">
<label for="xlInput"><?php echo $system_name_short; ?> ID</label>
<div class="input"><input <?php default_id(); ?>class="xlarge" id="id" name="id" size="50" type="text" /><?php login_id (); ?>
</div>
</div>
<!-- /clearfix -->
<div class="clearfix<?php login_error_hl (); ?>">
<label for="xlInput">Password</label>
<div class="input">
<input class="xlarge" id="password" name="password" size="30" type="password" /><?php login_pw (); ?>
</div>
</div>
<!-- /clearfix -->
<div class="clearfix"><label id="optionsRadio"></label>
<div class="input">
<ul class="inputs-list">
	<li><label> <input type="checkbox" name="remember" value="1"> <span>Remember me</span>
	&nbsp;&nbsp;&nbsp;<a href="mailto: <?php echo $administrator_email; ?>">Forgot login details?</a> </label></li>
</ul>
</div>
</div>
<!-- /clearfix -->
<div class="actions">
<button type="submit" class="btn large primary">Sign in</button>
&nbsp;
<button type="reset" class="btn large">Cancel</button>
</div>
</fieldset>
</form>
</div>
</div>
<?php
include 'style/footer.inc.php';
?>