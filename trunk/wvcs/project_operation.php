<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['p'])){
	$p=$_GET['p'];
}
else{
	$p=0;
}
if(isset($_GET['o'])){
	$o=$_GET['o'];
}

if(isset($o)){
	if($o=='delete'){
		delete_project($p);
		success('successfully delete the project');
	}
	if($o=='create'){
		if(isset($_POST['name'])){
			$uid=$_SESSION ["user"] ["uid"];
			$name=$_POST['name'];
			$priority=$_POST['priority'];
			$start=time_db($_POST['start']);
			$end=time_db($_POST['end']);
			$description=$_POST['description'];
			$tid=create_task($p, $uid, $name, $priority, $start, $end, $description);
			goto_url("task.php?t=$tid");		
		}
		else{
			error('empty task name');
		}
	}
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
	<ul class="tabs">
	<li><a href="project.php?p=<?php echo $p;?>">Project tasks list</a></li>
	<li><a href="project_info.php?p=<?php echo $p;?>">Information</a></li>
	<li class="active"><a href="project_operation.php?p=<?php echo $p;?>">Operations</a></li>
	</ul>
	<div class="row">
	<div class="span8 columns">
		<p><a href="project_operation.php?o=delete&p=<?php echo $p;?>">Delete this project</a></p>
    </div>
	<div class="span8 columns">
		<form action="project_operation.php?o=create&p=<?php echo $p;?>" method="post">
		<fieldset><legend>Create a new task</legend>
		<div class="clearfix">
 			<label>task name</label>
			<div class="input">
				<input class="xlarge" id="name" name="name" size="30" type="text" />
			</div>
		</div>
		
		<div class="clearfix">
			<label>priority</label>
			<div class="input">
				<select name="priority" id="priority">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              	</select>
			</div>
		</div>

		<div class="clearfix">
			<label>duration</label>
			<div class="input">
				<div class="inline-inputs">
                <input class="medium_small" type="text" id="start" name="start" value="<?php echo time_this();?>">
                to
                <input class="medium_small" type="text" id="end" name="end" value="<?php echo time_this();?>">
              </div></div>
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
}
?>


<?php
include 'style/footer.inc.php';
?>