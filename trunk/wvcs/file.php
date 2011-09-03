<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['f'])){
	$f=$_GET['f'];
}
else{
	$f=0;
}
if(fetch_file($f)==FALSE){
}
else{
	//file name, last commit time, page title, page sub title
	$db_array=fetch_file($f);
	$file_name=$db_array[0]['name'];
	$file_last_update=time_uk($db_array[0]['time']);
	$page_title=$file_name;
	$page_title_sub="last commit : ".$file_last_update;
	$file_change_number=count($db_array);
}
include 'style/header.inc.php';
?>
<?php 
if(fetch_file($f)==FALSE){
	echo "File not exist or have not any changes, please create before use";
}
else{
	//navigation bar
	echo "<h6>Project <small> -&gt; </small>Task<small> -&gt; </small>File</h6>";
	
	//file change history list/table
	?>
	<div class="row">
	<div class="span4 columns">operations</div>
	<div class="span12 columns">
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
	<th class="red">File Name</th>
	<th class="blue">Directory</th>
	<th class="blue">Size</th>
	<th class="green">Operation</th>
	<th class="green">Time</th>
	<th class="purple">Description</th>
	</thead>
	<?php
	for ($i = 0; $i < $file_change_number; $i++) {
		$version=$db_array[$i]['version'];
		$name=$db_array[$i]['name'];
		$directory=$db_array[$i]['did'];
		$size=$db_array[$i]['size'];
		$operation=$db_array[$i]['type'];
		$time=$db_array[$i]['time'];
		$description=$db_array[$i]['description'];
		echo "<tr><td>";
		echo $version;
		echo "</td><td>";
		echo $name;
		echo "</td><td>";
		echo $directory;
		echo "</td><td>";
		echo $db_array[$i]['size'];
		echo "</td><td>";
		echo $operation;
		echo "</td><td>";
		echo $time;
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