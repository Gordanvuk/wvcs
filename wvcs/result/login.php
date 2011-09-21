<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--header-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Language" content="en" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Version Control, Cloud, Task-oriented, Project, Teamwork" />
		<meta name="author" content="Sheng Yu, sy595@cs.york.ac.uk" />
		<meta name="description" content="WVCS 1.0; Working in the Cloud: Web-based Version Control System for Task-oriented Group and Individual Projects">
		<link rel="stylesheet" type="text/css" href="style/bootstrap-1.2.0.css" />
		<link rel="stylesheet" type="text/css" href="style/common.css" />
		<script type="text/javascript" src="style/jquery-1.6.2.min.js"></script> 
		<script type="text/javascript" src="style/jquery.tablesorter.min.js"></script>
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements --> 
		<!--[if lt IE 9]>
			<script src="style/html5.js"></script>
		<![endif]--> 
		<title>Web-based Version Control System</title>
	</head>
	<body>
		<div class="topbar">
			<div class="fill">
				<div class="container">
					<h3><a href="./">WVCS 1.0</a></h3>
					<ul>
						<li><a href="summary.php">Summary</a></li>
						<li><a href="summary.php">Group Projects</a></li>
					</ul>
					<form action="task_search.php" method="get">
						<input type="text" name="s" placeholder="search tasks">
					</form>
					<ul class="nav secondary-nav">
						<li><a href="project.php?private=1">My Private Projects</a></li>
						<li><a href="login.php">Sign In</a></li>
					</ul>
				</div><!-- /container -->
			</div><!-- /fill -->
		</div><!-- /topbar -->
		<div class="container main_content">
		<div class="page_icon float_right">
		<img class="page_icon" src="images/icon/default.gif" alt="Welcome" />
		</div>
		<div class="page-header">
			<h1>Web-based Version Control System <small>WVCS</small></h1>
		</div>
		<!--/header--><div class="row login">
<div class="span4 columns">Welcome back!</div>
<div class="span12 columns">
<form action="summary.php" method="post">
<fieldset><legend>Sign in WVCS</legend>
<div class="clearfix">
<label for="xlInput">WVCS ID</label>
<div class="input"><input class="xlarge" id="id" name="id" size="50" type="text" /><br /><span class="help-inline">Maybe your e-mail address.</span></div>
</div>
<!-- /clearfix -->
<div class="clearfix">
<label for="xlInput">Password</label>
<div class="input">
<input class="xlarge" id="password" name="password" size="30" type="password" /></div>
</div>
<!-- /clearfix -->
<div class="clearfix"><label id="optionsRadio"></label>
<div class="input">
<ul class="inputs-list">
	<li><label> <input type="checkbox" name="remember" value="1"> <span>Remember me</span>
	&nbsp;&nbsp;&nbsp;<a href="mailto: sy595@cs.york.ac.uk">Forgot login details?</a> </label></li>
</ul>
</div>
</div>
<!-- /clearfix -->
<div class="actions">
<button type="submit" class="btn large primary">Sign in</button>
&nbsp;
<button type="reset" class="btn large" onclick="location.href='login.php'">Cancel</button>
</div>
</fieldset>
</form>
</div>
</div>
		<!--footer-->
		</div><!-- /container -->
		<div class="container footer">
			<p>
				Designed and built with all the love in the world at <a href="http://www.cs.york.ac.uk/" target="_blank">Department of Computer Science</a>, <a href="http://www.york.ac.uk/" target="_blank">The University of York</a> by <a href="mailto: sy595@cs.york.ac.uk" target="_blank">Sheng Yu</a>.<br>
				Powered by <a href="http://jquery.com/" target="_blank">jQuery</a>, <a href="https://github.com/twitter/bootstrap" target="_blank">Bootstrap</a>, <a href="http://code.google.com/p/html5shim/" target="_blank">html5shim</a>, <a href="http://code.google.com/p/google-code-prettify/" target="_blank">	
		google-code-prettify</a>, <a href="http://tablesorter.com/docs/" target="_blank">tablesorter</a>. Licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a>.
			</p>
		</div>
	</body>
</html>
<!--/footer-->