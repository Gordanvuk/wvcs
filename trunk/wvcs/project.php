<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['p'])){
	$p=$_GET['p'];
}
else{
	$p=0;
}
if(isset($_GET['private'])){
	$private=$_GET['private'];
	if (isset($_SESSION['user']['uid'])){
		goto_url($after_login_redirect);
	}
}
else{
	$private=0;
}
if(fetch_project($p)==FALSE){
}
else{
	//project name, start/end time, page title, page sub title
	$db_array=fetch_project($p);
	$db_array_task=fetch_project_task($p);
	$db_array_task_history=fetch_project_task_history($p);
	$project_name=$db_array[0]['name'];
	$project_start=time_uk($db_array[0]['start']);
	$project_end=time_uk($db_array[0]['end']);
	$project_description=time_uk($db_array[0]['description']);
	$page_title=$project_name;
	$page_title_sub="[".$project_start."] &rarr; [".$project_end."]";
	$project_task_history_number=count($db_array_task_history);
	if ($project_task_history_number<=1){
		$tasks_title="task";
	}
	else {
		$tasks_title="tasks";
	}
}
include 'style/header.inc.php';
?>
<?php 
if(fetch_project($p)==FALSE){
	?>
	<div class="alert-message info">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> Project not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	//task history list/table
	?>
	<h3 class="underline"><?php echo ucfirst($tasks_title).' of "'.$project_name;?>"&nbsp;&nbsp;<small>(<?php echo $project_task_history_number." ".$tasks_title;?>)</small></h3>
	<ul class="tabs">
	<li class="active"><a href="project.php?p=<?php echo $p;?>">Project tasks list</a></li>
	<li><a href="project_info.php?p=<?php echo $p;?>">Information</a></li>
	<li><a href="project_operation.php?p=<?php echo $p;?>">Operations</a></li>
	</ul>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#project_tasks").tablesorter( {sortList: [[3,1]]} ); 
		    } 
		);  
	</script>
	<table id="project_tasks" class="zebra-striped">
	<thead>
	<th class="red">Task</th>
	<th class="blue">User</th>
	<th class="green">Duration</th>
	<th class="orange">Priority</th>
	<th class="purple">Status</th>
	</thead>
	<?php
	for ($i = 0; $i < $project_task_history_number; $i++) {
		$tid=$db_array_task[$i]['tid'];
		$task=$db_array_task[$i]['name'];
		$start=time_uk($db_array_task[$i]['start']);
		$end=time_uk($db_array_task[$i]['end']);
		$array_user=fetch_user($db_array_task[$i]['uid']);
		$user=$array_user[0]['name_nickname'].' ('.$array_user[0]['name_first'].' '.$array_user[0]['name_last'].')';
		$priority=$db_array_task[$i]['priority'];
		$status=task_status($db_array_task[$i]['tid']);
		echo '<tr class="td_link" onclick="location.href=\'task.php?t='.$tid.'\'"><td class="black">';
		echo "<strong>".$task."</strong>";
		echo "</td><td>";
		echo $user;
		echo "</td><td>";
		echo "[".$start."] &rarr; [".$end."]";
		echo "</td><td>";
		echo $priority;
		echo "</td><td>";
		echo $status;
		echo "</td></tr>";
	}
	echo '</table>';
}
?>


<?php
include 'style/footer.inc.php';
?>