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
	<div class="alert-message info">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> Directory not exist or have not any changes, please create before use.</p>
    </div>
	<?php ;
}
else{
	
	//directory change history list/table
	?>
	<h3><?php echo ucfirst($version_title).' of "'.$directory_name;?>"&nbsp;&nbsp;<small>(<?php echo $directory_change_number." ".$version_title;?>)</small></h3>
	<script type="text/javascript">
		$(document).ready(function() 
		    { 
		        $("table#directory_changes").tablesorter( {sortList: [[0,1]]} ); 
		    } 
		);  
	</script>
	<table id="directory_changes" class="zebra-striped">
	<thead>
	<th class="yellow">Ver</th>
	<th class="blue">Base</th>
	<th class="red">Name</th>
	<th class="green">Operation</th>
	<th class="green">Time</th>
	<th class="purple">Description</th>
	</thead>
	<?php
	for ($i = 0; $i < $directory_change_number; $i++) {
		$version=$db_array[$i]['version'];
		$name=$db_array[$i]['name'];
		$did_base=fetch_directory_full($db_array[$i]['did_base']);
		$time=time_uk($db_array[$i]['time']);
		$operation=$db_array[$i]['type'];
		$description=$db_array[$i]['description'];
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
}
?>


<?php
include 'style/footer.inc.php';
?>