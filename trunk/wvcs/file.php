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
	<div class="alert-message info">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> File not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	
	//file change history list/table
	?>
	<h3 class="underline"><?php echo ucfirst($version_title).' of "'.$file_name;?>"&nbsp;&nbsp;<small>(<?php echo $file_change_number." ".$version_title;?>)</small></h3>
	<ul class="tabs">
	<li class="active"><a href="file.php?f=<?php echo $f;?>">File versions list</a></li>
	<li><a href="file_info.php?f=<?php echo $f;?>">Information</a></li>
	<li><a href="task_operation.php?t=<?php echo '1';?>">Operations</a></li>
	</ul>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#file_changes").tablesorter( {sortList: [[0,1]]} ); 
		    } 
		);  
	</script>
	<table id="file_changes" class="zebra-striped">
	<thead>
	<th class="yellow">Ver</th>
	<th class="red">Location & File Name</th>
	<th class="blue">Size</th>
	<th class="green">Operation</th>
	<th class="green">Time</th>
	<th class="purple">Description</th>
	</thead>
	<?php
	for ($i = 0; $i < $file_change_number; $i++) {
		$fcid=$db_array[$i]['fcid'];
		$version=$db_array[$i]['version'];
		$name=$db_array[$i]['name'];
		$directory=fetch_directory_full($db_array[$i]['did']);
		$size=file_size_convert($db_array[$i]['size']);
		$operation=$db_array[$i]['type'];
		$time=$db_array[$i]['time'];
		$description=$db_array[$i]['description'];
		echo '<tr class="td_link" onclick="location.href=\'download.php?fc='.$fcid.'&fn='.$name.'\'"><td>';
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
}
?>


<?php
include 'style/footer.inc.php';
?>