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
	$db_array=fetch_task_history($t);
	$db_array_task=fetch_task($t);
	$db_array_task_file=fetch_task_file($t);
	$task_name=$db_array_task[0]['name'];
	$task_start=time_uk($db_array_task[0]['start']);
	$task_end=time_uk($db_array_task[0]['end']);
	$page_title=$task_name;
	$page_title_sub="[".$task_start."] -&gt; [".$task_end."]";
	$file_number=count($db_array_task_file);
	if ($file_number<=1){
		$version_title="file";
	}
	else {
		$version_title="files";
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
	//navigation bar
	echo "<h5>Project <small> -&gt; </small>Task</h5>";
	
	//task related file list/table
	?>
	<div class="row">
	<div class="span3 columns">operations</div>
	<div class="span13 columns">
	<h3><?php echo $task_name;?> <small><?php echo $file_number." ".$version_title;?></small></h3>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#task_file").tablesorter( {sortList: [[4,1]]} ); 
		    } 
		);  
	</script>
	<table id="task_file" class="zebra-striped">
	<thead>
	<th class="yellow">Ver</th>
	<th class="red">Location & File Name</th>
	<th class="blue">Size</th>
	<th class="green">Operation</th>
	<th class="green">Time</th>
	<th class="purple">Description</th>
	</thead>
	<?php
	for ($i = 0; $i < $file_number; $i++) {
		$fid=$db_array_task_file[$i]['fid'];
		$version=$db_array_task_file[$i]['version'];
		$name=$db_array_task_file[$i]['name'];
		$directory=fetch_directory_full($db_array_task_file[$i]['did']);
		$size=file_size_convert($db_array_task_file[$i]['size']);
		$operation=$db_array_task_file[$i]['type'];
		$time=$db_array_task_file[$i]['time'];
		$description=$db_array_task_file[$i]['description'];
		echo '<tr class="td_link" onclick="location.href=\'file.php?f='.$fid.'\'"><td>';
		echo $version;
		echo '</td><td class="red">';
		echo $directory."<strong>".$name."</strong>";
		echo "</td><td>";
		echo $size;
		echo "</td><td>";
		echo $operation;
		echo "</td><td>";
		echo time_uk($time);
		echo "</td><td>";
		echo $description;
		echo "</td></tr>";
	}
	echo '</table></div></div>';
}
?>


<?php
include 'style/footer.inc.php';
?>