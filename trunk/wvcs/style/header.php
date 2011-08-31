<?php include 'libraries/style.lib.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--header-->
<head>
<meta http-equiv="Content-Language" content="en" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Version Control, Cloud, Task-oriented, Project, Teamwork" />
<meta name="author" content="Sheng Yu, sy595@cs.york.ac.uk" />
<meta name="description" content="WVCS 1.0; Working in the Cloud: Web-based Version Control System for Task-oriented Group and Individual Projects">
<link rel="stylesheet" type="text/css" href="style/bootstrap-1.1.1.css" />
<link rel="stylesheet" type="text/css" href="style/common.css" />
<title>WVCS 1.0</title>
</head>
<body>
<div class="topbar">
	<div class="fill">
		<div class="container">
			<h3><a href="#">WVCS 1.0</a></h3>
			<ul>
				<li<?php active('summary');?>><a href="#">Summary</a></li>
				<li<?php active('project');?>><a href="#">Group Projects</a></li>
			</ul>
			<form action=""><input type="text" placeholder="Search"></form>
			<ul class="nav secondary-nav">
				<li<?php active('private');?>><a href="#">My Private Projects</a></li>
				<li<?php active('message');?>><a href="#">My Messages</a></li>
				<li><a href="#">Log out</a></li>
			</ul>
		</div>
	</div><!-- /fill -->
</div><!-- /topbar -->
<!--end header-->