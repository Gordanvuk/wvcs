<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['t'])){
	$t=$_GET['t'];
}
else{
	$t=0;
}
if(fetch_task_history($t)==FALSE or fetch_task($t)==FALSE){
}
else{
	//task name, start/end time, page title, page sub title
	$db_array_task_history=fetch_task_history($t);
	$db_array_task=fetch_task($t);
	$db_array_task_file=fetch_task_file($t);
	$db_array_task_directory=fetch_task_directory($t);
	$task_name=$db_array_task[0]['name'];
	$task_start=time_uk($db_array_task[0]['start']);
	$task_end=time_uk($db_array_task[0]['end']);
	$page_title=$task_name;
	$page_title_sub="[".$task_start."] &rarr; [".$task_end."]";
	$directory_number=count($db_array_task_directory);
	$file_number=count($db_array_task_file);
	if ($file_number<=1){
		$version_label_file="file";
	}
	else {
		$version_label_file="files";
	}
	if ($directory_number<=1){
		$version_label_directory="directory";
	}
	else {
		$version_label_directory="directories";
	}
}
include 'style/header.inc.php';
?>
<?php 
if(fetch_task_file($t)==FALSE){
	?>
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> File related to this task not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	
	//task related file list/table
	?>
	<h3 class="underline"><?php echo '"'.$task_name;?>"&nbsp;&nbsp;<small>(<?php echo $file_number." ".$version_label_file;?>)</small></h3>
	<p><?php echo $db_array_task[0]['description']; ?></p>	
<?php
}
?>


<?php
include 'style/footer.inc.php';
?>