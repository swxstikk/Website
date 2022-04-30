<?php
	include('env.php');
	include('header.php');
	if(isset($_SESSION['id'])){
?>

<div class="wrapper">

  <?php 
	include('top_header.php');
	include('main_sidebar.php');
	include('main_body.php');
	include('footer.php');
	//include('right_sidebar.php');
  ?>

</div>
<!-- ./wrapper -->
	<?php }else{
		header('Location:index.php');
	}

	?>