<?php
include 'libraries/initial.inc.php';
include 'libraries/project.lib.php';
if(isset($_GET['e'])){
	$e=$_GET['e'];
}
else{
	$e=0;
}
include 'style/header.inc.php';
?>
<?php 
if(isset($_GET['e'])){
	?>
	<div class="alert-message error">
        <a class="close" href="<?php echo $after_login_redirect; ?>">×</a>
        <p><strong>Oops!</strong> <?php echo $e?></p>
    </div>
	<?php
}

include 'style/footer.inc.php';
?>