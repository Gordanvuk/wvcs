<?php 
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(!isset($_GET['fc']) or !isset($_GET['fn'])){
}
else{
	$fc=$_GET['fc'];
	$fn=$_GET['fn'];
	header("Content-type:application");
	header("Content-Disposition: attachment; filename=$fn");
	//file_name是预设下载时的文件名，可使用变量。
	readfile("files/$fc");
	//file是实际存放在你硬盘中要被下載的文档，可使用变量。
	exit(0);
} 
?> 