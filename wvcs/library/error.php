<?php
include 'libraries/general.lib.php';

include 'style/header.php';
if(isset($_GET['msg'])){
echo '<span class="error">'.$_GET['msg'].'</span>';

}
include 'style/footer.php';
?>