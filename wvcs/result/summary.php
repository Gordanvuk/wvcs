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
		<title>Summary - </title>
	</head>
	<body>
		<div class="topbar">
			<div class="fill">
				<div class="container">
					<h3><a href="./">WVCS 1.0</a></h3>
					<ul>
						<li class="active"><a href="summary.php">Summary</a></li>
						<li><a href="summary.php">Group Projects</a></li>
					</ul>
					<form action="task_search.php" method="get">
						<input type="text" name="s" placeholder="search tasks">
					</form>
					<ul class="nav secondary-nav">
						<li><a href="project.php?private=1">My Private Projects</a></li>
						<li><a href="login_check.php?logout=1"><strong>Demo User</strong>&nbsp;&nbsp;Sign Out</a></li>
					</ul>
				</div><!-- /container -->
			</div><!-- /fill -->
		</div><!-- /topbar -->
		<div class="container main_content">
		<div class="page_icon float_right">
		<img class="page_icon" src="images/icon/summary.gif" alt="Summary" />
		</div>
		<div class="page-header">
			<h1>Summary <small></small></h1>
		</div>
		<!--/header-->	<div class="row">
	<div class="span8 columns">
	
	<!-- 1. Tasks Doing -->
		<h3 class="underline">Doing&nbsp;&nbsp;<small>(4 tasks)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#summary_task_doing").tablesorter( {sortList: [[4,0],[2,0],[3,1]]} ); 
		    } 
		);  
	</script>
	<table id="summary_task_doing" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="green">Due</th>
	<th class="orange">%</th>
	<th class="purple">Priority</th>
	</thead>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Coding</td><td class="black"><strong>Controller</strong></td>
		<td>[15 Sep 2011]</td><td>70%</td>
		<td>2</td>
		</tr>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Coding</td>
		<td class="black"><strong>Styles</strong></td>
		<td>[22 Sep 2011]</td>
		<td>50%</td>
		<td>1</td>
		</tr>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Documentation</td>
		<td class="black"><strong>Implementation</strong></td>
		<td>[1 Sep 2011]</td>
		<td>65%</td>
		<td>3</td>
		</tr>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Documentation</td>
		<td class="black"><strong>Design Part</strong></td>
		<td>[20 Sep 2011]</td>
		<td>80%</td>
		<td>2</td>
		</tr>
	</table>
		
	<!-- 2. Tasks To Do -->
		<h3 class="underline">To Do&nbsp;&nbsp;<small>(1 task)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#todo").tablesorter( {sortList: [[3,0],[2,0]]} ); 
		    } 
		);  
	</script>
	<table id="todo" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="green">Due</th>
	<th class="purple">Priority</th>
	</thead>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Documentation</td><td class="black"><strong>Figure re-draw</strong></td>
		<td>[15 Sep 2011]</td>
		<td>2</td>
		</tr>
	</table>
	
		
	<!-- 3. Tasks Waiting -->
		<h3 class="underline">Waiting&nbsp;&nbsp;<small>(1 task)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#waiting").tablesorter( {sortList: [[3,0],[2,0]]} ); 
		    } 
		);  
	</script>
	<table id="waiting" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="purple">Priority</th>
	<th class="yellow">Waiting for</th>
	</thead>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Coding</td><td class="black"><strong>Testing</strong></td>
		<td>2</td>
		<td>Controller</td>
		</tr>
		<tr class="td_link" onclick="location.href='task.php?t=2'">
		<td class="black">Documentation</td>
		<td class="black"><strong>Conclusion</strong></td>
		<td>1</td>
		<td>Implementation</td>
		</tr>
	</table>
		
	
	<!-- 4. Tasks Finished -->
		<h3 class="underline">Finished&nbsp;&nbsp;<small>(2 tasks)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#summary_finished").tablesorter( {sortList: [[3,1]]} ); 
		    } 
		);  
	</script>
	<table id="summary_finished" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="green">Ver</th>
	<th class="purple">Last commit</th>
	</thead>
		<tr class="td_link" onclick="location.href='task.php?t=2'"><td class="black">Coding</td><td class="black"><strong>Function Libraries</strong></td><td>2</td><td>[1 Sep 2011]</td></tr>
<tr class="td_link" onclick="location.href='task.php?t=2'"><td class="black">Documentation</td><td class="black"><strong>Design Part</strong></td><td>7</td><td>[1 Sep 2011]</td></tr>	</table>
		
	
	
	</div>
	<div class="span8 columns">
	<!-- 5. Projects Leading -->
		<h3 class="underline">Leading project&nbsp;&nbsp;<small>(1 task)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#p1").tablesorter( {sortList: [[2,0],[1,0]]} ); 
		    } 
		);  
	</script>
	<table id="p1" class="zebra-striped">
	<thead>
	<th class="blue">Project</th>
	<th class="green">Due</th>
	<th class="purple">Priority</th>
	</thead>
		<tr class="td_link" onclick="location.href='project.php?p=1'">
		<td class="black">Coding</td>
		<td>[21 Sep 2011]</td>
		<td>1</td>
		</tr>
		<tr class="td_link" onclick="location.href='project.php?p=2'">
		<td class="black">Documentation</td>
		<td>[15 Sep 2011]</td>
		<td>2</td>
		</tr>
	</table>
	
	<!-- 6. Private Projects -->
	
	
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