<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['p'])){
	$p=$_GET['p'];
}
else{
	$p=0;
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
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> Project not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	//task history list/table
	?>
	<h3 class="underline"><?php echo '"'.$project_name;?>"&nbsp;&nbsp;<small>(<?php echo $project_task_history_number." ".$tasks_title;?>)</small></h3>
	
	<p><?php echo $db_array[0]['description']; ?></p>	
		
<?php	
}
?>


<?php
include 'style/footer.inc.php';
?>