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
		delete_task($t);
		success('successfully delete the task');
	}
	if($o=='createf'){
		if(isset($_POST['name'])){
			$uid=$_SESSION ["user"] ["uid"];
			$name=$_POST['name'];
			$directory=$_POST['directory'];
			$description=$_POST['description'];
			$fid=create_file($uid, $t, $name, $directory, $fid, $description);
			goto_url("task.php?t=$t");		
		}
		else{
			error('empty task name');
		}
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
	
	//task related file list/table
	?>
	<h3 class="underline"><?php echo '"'.$task_name;?>"&nbsp;&nbsp;<small>(<?php echo $file_number." ".$version_label_file;?>)</small></h3>
	<ul class="tabs">
	<li><a href="task.php?t=<?php echo $t;?>">Task file list</a></li>
	<li><a href="task_info.php?t=<?php echo $t;?>">Information</a></li>
	<li class="active"><a href="task_operation.php?t=<?php echo $t;?>">Operations</a></li>
	</ul>
	<div class="row">
	<div class="span8 columns">
		<p><a href="task_operation.php?o=delete&t=<?php echo $t;?>">Delete this task</a></p>
		<p><a href="task_operation.php?o=prioroity&t=<?php echo $t;?>">Set priority of this task</a></p>
		<p><a href="task_operation.php?o=predecessor&t=<?php echo $t;?>">Set predecessor task</a></p>
    </div>
	<div class="span8 columns">
		<form action="task_operation.php?o=createf&t=<?php echo $t;?>" method="post">
		<fieldset><legend>Create or upload a new file</legend>
		<div class="clearfix">
 			<label>file name</label>
			<div class="input">
				<input class="xlarge" id="name" name="name" size="30" type="text" />
			</div>
		</div>
		
		<div class="clearfix">
			<label>directory</label>
			<div class="input">
				<input class="xlarge" id="directory" name="directory" size="30" type="text" />
			</div>
		</div>

		<div class="clearfix">
			<label>choose file</label>
			<div class="input">
				<input class="input-file" id="fileInput" name="fileInput" type="file">
            </div>
		</div>

		<div class="clearfix">
			<label>description</label>
			<div class="input">
              <textarea class="xlarge" id="description" name="description"></textarea>
              <span class="help-block">
              </span>
            </div>
		</div>
		
		<div class="actions">
		<button type="submit" class="btn large primary">Create</button>
		&nbsp;
		<button type="reset" class="btn large" onclick="location.href='summary.php'">Cancel</button>
		</div>
		</fieldset>
		</form>
		
		
		</div>
	</div>


<?php
include 'style/footer.inc.php';
?>