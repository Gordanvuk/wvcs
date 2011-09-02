<?php 
include 'libraries/style.lib.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--header-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Language" content="en" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Version Control, Cloud, Task-oriented, Project, Teamwork" />
		<meta name="author" content="Sheng Yu, sy595@cs.york.ac.uk" />
		<meta name="description" content="WVCS 1.0; Working in the Cloud: Web-based Version Control System for Task-oriented Group and Individual Projects">
		<link rel="stylesheet" type="text/css" href="style/bootstrap-1.1.1.css" />
		<link rel="stylesheet" type="text/css" href="style/common.css" />
		<script type="text/javascript" src="style/jquery-1.6.2.min.js"></script> 
		<script type="text/javascript" src="style/jquery.tablesorter.min.js"></script>
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements --> 
		<!--[if lt IE 9]>
			<script src="style/html5.js"></script>
		<![endif]--> 
		<title><?php page_title('html');?></title>
	</head>
	<body>
		<div class="topbar">
			<div class="fill">
				<div class="container">
					<h3><a href="./"><?php echo $system_name_short.' '.$system_version;?></a></h3>
					<ul>
						<li<?php active('summary.php');?>><a href="#">Summary</a></li>
						<li<?php active('project.php');?>><a href="#">Group Projects</a></li>
					</ul>
					<form action="">
						<input type="text" placeholder="Search">
					</form>
					<ul class="nav secondary-nav">
						<li<?php active('private');?>><a href="#">My Private Projects</a></li>
						<li<?php active('message.php');?>><a href="#">My Messages</a></li>
						<li><?php right_align();?></li>
					</ul>
				</div><!-- /container -->
			</div><!-- /fill -->
		</div><!-- /topbar -->
		<div class="container">
		<div class="page-header">
			<h1><?php page_title('main');?> <small><?php page_title('sub');?></small></h1>
		</div>
		</div><!-- /container -->
		<div class="container">
		<!--/header-->