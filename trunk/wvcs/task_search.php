<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['s'])){
	$s=$_GET['s'];
}
else{
	$s=0;
}
if(fetch_task_search($s)==FALSE){
}
else{
	//project name, start/end time, page title, page sub title
	$db_array_task=fetch_task_search($s);
	$db_array_task_history=fetch_task_history_search($s);
	$page_title="Search Results";
	$project_task_history_number=count($db_array_task_history);
	if ($project_task_history_number<=1){
		$tasks_title="result";
	}
	else {
		$tasks_title="results";
	}
}
include 'style/header.inc.php';
?>
<?php 
if(!isset($db_array_task_history) or $db_array_task_history==FALSE){
	?>
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> Cannot find any task about "<?php echo $s; ?>".</p>
    </div>
	<?php ;
}
else{
	//task history list/table
	?>
	<div class="row">
	<div class="span3 columns">operations</div>
	<div class="span13 columns">
	<h3 class="underline"> Task Search&nbsp;&nbsp;<small>(<?php echo $project_task_history_number." ".$tasks_title;?>)</small></h3>
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
		echo "[".$start."] -&gt; [".$end."]";
		echo "</td><td>";
		echo $priority;
		echo "</td><td>";
		echo $status;
		echo "</td></tr>";
	}
	echo '</table></div></div>';
}
?>


<?php
include 'style/footer.inc.php';
?>