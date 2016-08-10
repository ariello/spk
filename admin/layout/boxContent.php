<div class="container-fluid" style="margin-top:20px;">
<?php
    if (!empty($_SESSION['message'])) {
?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4 flash_box">
        <div class="alert <?php echo (($_SESSION['error'] == false) ? 'alert-success' : 'alert-danger' );?>" style="text-align:center"><?php echo $_SESSION['message'];?></div>
    </div>
</div>
<?php
    }
?>