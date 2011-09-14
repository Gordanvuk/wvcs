<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['t'])){
	$t=$_GET['t'];
}
else{
	$t=0;
}
if(isset($_GET['o'])){
	$o=$_GET['o'];
}

if(isset($o)){
	if($o=='delete'){
		delete_task($p);
		success('successfully delete the task');
	}
	if($o=='create'){
		
	}
	if($o=='move'){
		
	}
	if($o=='update'){
		
	}
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
	<h3 class="underline"><?php echo ucfirst($version_label_file).' of "'.$task_name;?>"&nbsp;&nbsp;<small>(<?php echo $file_number." ".$version_label_file;?>)</small></h3>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#task_file").tablesorter( {sortList: [[1,0]]} ); 
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
		echo '</td><td class="black">';
		echo $directory."<strong>".$name."</strong>";
		echo "</td><td>";
		echo $size;
		echo "</td><td>";
		echo operation_code($operation);
		echo "</td><td>";
		echo '['.time_uk($time).']';
		echo "</td><td>";
		echo $description;
		echo "</td></tr>";
	}
	echo '</table>';
	?>
	
	<h3 class="underline"><?php echo ucfirst($version_label_directory).' of "'.$task_name;?>"&nbsp;&nbsp;<small>(<?php echo $directory_number." ".$version_label_directory;?>)</small></h3>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#task_directory").tablesorter( {sortList: [[1,0],[2,0]]} ); 
		    } 
		);  
	</script>
	<table id="task_directory" class="zebra-striped">
	<thead>
	<th class="yellow">Ver</th>
	<th class="blue">Base</th>
	<th class="red">Name</th>
	<th class="green">Operation</th>
	<th class="green">Time</th>
	<th class="purple">Description</th>
	</thead>
	<?php
	for ($i = 0; $i < $directory_number; $i++) {
		$version=$db_array_task_directory[$i]['version'];
		$name=$db_array_task_directory[$i]['name'];
		$did_base=fetch_directory_full($db_array_task_directory[$i]['did_base']);
		$time=time_uk($db_array_task_directory[$i]['time']);
		$operation=$db_array_task_directory[$i]['type'];
		$description=$db_array_task_directory[$i]['description'];
		echo "<tr><td>";
		echo $version;
		echo "</td><td>";
		echo $did_base;
		echo '</td><td class="black">';
		echo "<strong>".$name."</strong>";
		echo "</td><td>";
		echo operation_code($operation);
		echo "</td><td>";
		echo '['.$time.']';
		echo "</td><td>";
		echo $description;
		echo "</td></tr>";
	}
	echo '</table>';
	?>
	
	<?php
}
?>


<?php
include 'style/footer.inc.php';
?>