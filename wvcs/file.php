<?php
include 'libraries/initial.inc.php';
include 'libraries/file.lib.php';

if(get_file(2)==FALSE){
}
else{
	//file name, last commit time, page title, page sub title
	$db_array=get_file(1);
	$file_name=$db_array[0]['name'];
	$file_last_update=time_uk($db_array[0]['time']);
	$page_title=$file_name;
	$page_title_sub="last commit : ".$file_last_update;
}

include 'style/header.inc.php';

if(get_file(2)==FALSE){
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
	<script type="text/javascript" src="style/jquery.tablesorter.min.js"></script>
	<script type="text/javascript">
		$(function() {
		$("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
		});
	</script>
	<table class="zebra-striped">
	<tr>
	<th>Version</th>
	<th>File Name</th>
	<th>Size</th>
	<th>Operation</th>
	<th>Time</th>
	<th>Description</th>
	</tr>
	<?php 
	echo '</table></div></div>';
	 
	
}
?>


<?php
include 'style/footer.inc.php';
?>