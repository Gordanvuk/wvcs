<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(!user_logged_in()){
}
else{
	$u=user_logged_in();
	//read user information and his/her tasks, page title, page sub title
	$db_array_user=fetch_user($u);
	$db_array_fetch_user_task=fetch_user_task($u);
	$page_title="Summary";
	$page_title_sub="";
	$tasks_number=count($db_array_fetch_user_task);
	
	//Task Doing
	$array_task_doing=array();
	for ($i = 0; $i < $tasks_number; $i++) {
		$tid=$db_array_fetch_user_task[$i]['tid'];
		if (fetch_task_doing($tid)){
			$array_task_doing_index=count($array_task_doing);
			$array_task_doing[$array_task_doing_index]=$db_array_fetch_user_task[$i];
		}
	}
	$array_task_doing_number=count($array_task_doing);
	if ($array_task_doing_number<=1) {
		$array_task_doing_number_label="task";
	} 
	else {
		$array_task_doing_number_label="tasks";
	}
	
	//Task To Do
	$array_task_ready=array();
	for ($i = 0; $i < $tasks_number; $i++) {
		$tid=$db_array_fetch_user_task[$i]['tid'];
		if (fetch_task_ready($tid) and !fetch_task_finished($tid) and !fetch_task_predecessor_wait($tid)){
			$array_task_ready_index=count($array_task_ready);
			$array_task_ready[$array_task_ready_index]=$db_array_fetch_user_task[$i];
		}
	}
	$array_task_ready_number=count($array_task_ready);
	if ($array_task_ready_number<=1) {
		$array_task_ready_number_label="task";
	} 
	else {
		$array_task_ready_number_label="tasks";
	}
	
	//Task Waiting
	$array_task_waiting=array();
	for ($i = 0; $i < $tasks_number; $i++) {
		$tid=$db_array_fetch_user_task[$i]['tid'];
		if (fetch_task_ready($tid) and fetch_task_predecessor_wait($tid)){
			$array_task_waiting_index=count($array_task_waiting);
			$array_task_waiting[$array_task_waiting_index]=$db_array_fetch_user_task[$i];
		}
	}
	$array_task_waiting_number=count($array_task_waiting);
	if ($array_task_waiting_number<=1) {
		$array_task_waiting_number_label="task";
	} 
	else {
		$array_task_waiting_number_label="tasks";
	}
	
	//Task Finished
	$array_task_finished=array();
	for ($i = 0; $i < $tasks_number; $i++) {
		$tid=$db_array_fetch_user_task[$i]['tid'];
		if (fetch_task_finished($tid)){
			$array_task_finished_index=count($array_task_finished);
			$array_task_finished[$array_task_finished_index]=$db_array_fetch_user_task[$i];
		}
	}
	$array_task_finished_number=count($array_task_finished);
	if ($array_task_finished_number<=1) {
		$array_task_finished_number_label="task";
	} 
	else {
		$array_task_finished_number_label="tasks";
	}
	
	//Leading Project
	$array_project_leading=array();
	
	
	//Private Project
	$array_project_private=array();
	
	
	
	
}
include 'style/header.inc.php';
?>
<?php 
if(!user_logged_in()){
	?>
	<!-- error message -->
	<div class="alert-message error">
        <a class="close" href="login.php">×</a>
        <p><strong>Oops!</strong> Please sign in.</p>
    </div>
	<?php ;
}
else{
	?>
	<div class="row">
	<div class="span8 columns">
	
	<!-- 1. Tasks Doing -->
	<?php if ($array_task_doing_number>=1) { ?>
	<h3 class="underline">Doing&nbsp;&nbsp;<small>(<?php echo $array_task_doing_number.' '.$array_task_doing_number_label;?>)</small></h3>
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
		<?php
	for ($i = 0; $i < $array_task_doing_number; $i++) {
		$tid=$array_task_doing[$i]['tid'];
		$array_project=fetch_task_project($array_task_doing[$i]['tid']);
		$project=$array_project[0]['name'];
		$task=$array_task_doing[$i]['name'];
		$end=date_uk($array_task_doing[$i]['end']);
		$array_task_doing_history=fetch_task_history($array_task_doing[$i]['tid']);
		$version=$array_task_doing_history[0]['version'];
		$percent=$array_task_doing_history[0]['percent'].'%';
		$priority=$array_task_doing[$i]['priority'];
		$status=task_status ($array_task_doing[$i]['tid']);
		echo '<tr class="td_link" onclick="location.href=\'task.php?t='.$tid.'\'"><td class="black">';
		echo $project;
		echo '</td><td class="black">';
		echo "<strong>".$task."</strong>";
		echo "</td><td>";
		echo "[".$end."]";
		echo "</td><td>";
		echo $percent;
		echo "</td><td>";
		echo $priority;
		echo "</td></tr>";
	}
	
	?>
	</table>
	<?php } ?>
	
	<!-- 2. Tasks To Do -->
	
	<?php if ($array_task_ready_number>=1) { ?>
	<h3 class="underline">Available to start&nbsp;&nbsp;<small>(<?php echo $array_task_ready_number.' '.$array_task_ready_number_label;?>)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#summary_task_todo").tablesorter( {sortList: [[3,0],[2,0]]} ); 
		    } 
		);  
	</script>
	<table id="summary_task_todo" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="green">Due</th>
	<th class="purple">Priority</th>
	</thead>
		<?php
	for ($i = 0; $i < $array_task_ready_number; $i++) {
		$tid=$array_task_ready[$i]['tid'];
		$array_project=fetch_task_project($array_task_ready[$i]['tid']);
		$project=$array_project[0]['name'];
		$task=$array_task_ready[$i]['name'];
		$end=date_uk($array_task_ready[$i]['end']);
		$array_task_ready_history=fetch_task_history($array_task_ready[$i]['tid']);
		$priority=$array_task_ready[$i]['priority'];
		$status=task_status ($array_task_ready[$i]['tid']);
		echo '<tr class="td_link" onclick="location.href=\'task.php?t='.$tid.'\'"><td class="black">';
		echo $project;
		echo '</td><td class="black">';
		echo "<strong>".$task."</strong>";
		echo "</td><td>";
		echo "[".$end."]";
		echo "</td><td>";
		echo $priority;
		echo "</td></tr>";
	}
	?>
	</table>
	<?php } ?>
	
	<!-- 3. Tasks Waiting -->
	<?php if ($array_task_waiting_number>=1) { ?>
	<h3 class="underline">Waiting for predecessor&nbsp;&nbsp;<small>(<?php echo $array_task_waiting_number.' '.$array_task_waiting_number_label;?>)</small></h3>
	<!-- tablesorter loader -->
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#summary_waiting").tablesorter( {sortList: [[2,0]]} ); 
		    } 
		);  
	</script>
	<table id="summary_waiting" class="zebra-striped">
	<thead>
	<th class="red">Project</th>
	<th class="blue">Task</th>
	<th class="green">Due</th>
	<th class="purple">Priority</th>
	</thead>
		<?php
	for ($i = 0; $i < $array_task_waiting_number; $i++) {
		$tid=$array_task_waiting[$i]['tid'];
		$array_project=fetch_task_project($array_task_waiting[$i]['tid']);
		$project=$array_project[0]['name'];
		$task=$array_task_waiting[$i]['name'];
		$end=date_uk($array_task_waiting[$i]['end']);
		$array_task_waiting_history=fetch_task_history($array_task_waiting[$i]['tid']);
		$priority=$array_task_waiting[$i]['priority'];
		$status=task_status ($array_task_waiting[$i]['tid']);
		echo '<tr class="td_link" onclick="location.href=\'task.php?t='.$tid.'\'"><td class="black">';
		echo $project;
		echo '</td><td class="black">';
		echo "<strong>".$task."</strong>";
		echo "</td><td>";
		echo "[".$end."]";
		echo "</td><td>";
		echo $priority;
		echo "</td></tr>";
	}
	?>
	</table>
	<?php } ?>
	
	
	<!-- 4. Tasks Finished -->
	<?php if ($array_task_finished_number>=1) { ?>
	<h3 class="underline">Finished&nbsp;&nbsp;<small>(<?php echo $array_task_finished_number.' '.$array_task_finished_number_label;?>)</small></h3>
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
		<?php
	for ($i = 0; $i < $array_task_finished_number; $i++) {
		$tid=$array_task_finished[$i]['tid'];
		$array_project=fetch_task_project($array_task_finished[$i]['tid']);
		$project=$array_project[0]['name'];
		$task=$array_task_finished[$i]['name'];
		$array_task_finished_history=fetch_task_history($array_task_finished[$i]['tid']);
		$version=$array_task_finished_history[$i]['version'];
		$time=date_uk($array_task_finished_history[$i]['time']);
		echo '<tr class="td_link" onclick="location.href=\'task.php?t='.$tid.'\'"><td class="black">';
		echo $project;
		echo '</td><td class="black">';
		echo "<strong>".$task."</strong>";
		echo "</td><td>";
		echo $version;
		echo "</td><td>";
		echo "[".$time."]";
		echo "</td></tr>";
	}
	?>
	</table>
	<?php } ?>
	
	
	
	</div>
	<div class="span8 columns">
	<!-- 5. Projects Leading -->
	<!-- 6. Private Projects -->
	
	
	</div>
	
	
	</div>
<?php
}
?>


<?php
include 'style/footer.inc.php';
?>