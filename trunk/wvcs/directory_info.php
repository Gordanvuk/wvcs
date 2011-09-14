<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['d'])){
	$d=$_GET['d'];
}
else{
	$d=0;
}
if(fetch_directory_change($d)==FALSE){
}
else{
	//directory name, last commit time, page title, page sub title
	$db_array=fetch_directory_change($d);
	$db_array_dir=fetch_directory($d);
	$directory_name=$db_array[0]['name'];
	$directory_last_update=time_uk($db_array[0]['time']);
	$page_title=$directory_name;
	$page_title_sub="last commit : [".$directory_last_update."]";
	$directory_change_number=count($db_array);
	if ($directory_change_number<=1){
		$version_title="version";
	}
	else {
		$version_title="versions";
	}
}
include 'style/header.inc.php';
?>
<?php 
if(fetch_directory_change($d)==FALSE){
	?>
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> Directory not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	
	//directory change history list/table
	?>
	<h3><?php echo '"'.$directory_name;?>"&nbsp;&nbsp;<small>(<?php echo $directory_change_number." ".$version_title;?>)</small></h3>
	<p><?php echo $db_array_dir[0]['description']; ?></p>	
	<?php
}
?>


<?php
include 'style/footer.inc.php';
?>