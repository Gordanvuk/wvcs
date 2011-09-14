<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['s'])){
	$s=$_GET['s'];
}
else{
	$s=0;
}
include 'style/header.inc.php';
?>
<?php 
if(isset($_GET['s'])){
	?>
	<div class="alert-message success">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Well done!</strong> <?php echo $s?></p>
    </div>
	<?php
}

include 'style/footer.inc.php';
?>