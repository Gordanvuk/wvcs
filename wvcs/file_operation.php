<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['f'])){
	$f=$_GET['f'];
}
else{
	$f=0;
}
if(fetch_file_change($f)==FALSE){
}
else{
	//file name, last commit time, page title, page sub title
	$db_array=fetch_file_change($f);
	$db_array_file=fetch_file($f);
	$file_name=$db_array[0]['name'];
	$file_last_update=time_uk($db_array[0]['time']);
	$page_title=$file_name;
	$page_title_sub="last commit : [".$file_last_update."]";
	$file_change_number=count($db_array);
	if ($file_change_number<=1){
		$version_title="version";
	}
	else {
		$version_title="versions";
	}
}
include 'style/header.inc.php';
?>
<?php 
if(fetch_file_change($f)==FALSE){
	?>
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> File not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	
	//file change history list/table
	?>
	<h3 class="underline"><?php echo '"'.$file_name;?>"&nbsp;&nbsp;<small>(<?php echo $file_change_number." ".$version_title;?>)</small></h3>
	<p><?php echo $db_array_file[0]['description'];?></p>
	
	<?php
}
?>


<?php
include 'style/footer.inc.php';
?>