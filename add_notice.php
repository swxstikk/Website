<?php
	include('header.php');
	include('env.php');
	if(isset($_SESSION['id'])){
?>
<div class="wrapper">
	<?php 
	include('top_header.php');
	include('main_sidebar.php');
	
  ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Add Notice
			<small></small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="manage_notice.php"> Manage Notice</a></li>
			<li class="active"><a href="#">Add Notice</a></li>
			
		  </ol>
		</section>
		<?php	
			//print_r($_SESSION);
			if(isset($_GET['msg'])){
				if($_GET['msg'] == 'err'){?>
					<div class="box-body">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							Please fill all the required Data of Form.
						</div> 
					</div>
		<?php	} 
			}

		?>
		<!-- Main content -->
		<section class="content">
			<div class="box box-warning">
				<form action="" id="add-notice" name="add-notice" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="control-label" >Title</label>
								<input type="text" class="form-control required" id="notice_title" name="notice_title" placeholder="Notice Title ...">
								<p class="help-block"></p>
							</div>
										
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Status</label>
								<select class="form-control required" id="status" name="status">
									<option value="">Select status</option>
									<option value="1">Locked</option>
									<option value="0">Unlocked</option>
								</select>
								<p class="help-block"></p>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<div class="row">
						<div class="col-sm-12">
						  
							<div class="box-header" style="margin:10px;">
							  <h3 class="box-title">Body
								<small></small>
							  </h3>
							  <!-- /. tools -->
							</div>
							<!-- /.box-header -->
							<div class="box-body pad" style="margin:10px;">
								<textarea id="notice_body" name="notice_body" rows="10" cols="80" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
														
								</textarea>
							</div>
						  
						  <!-- /.box -->
						</div>
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
								<a class="btn btn-primary waves-effect" id='saveNotice' >Save Notice</a>
						</div>
					</div>
				</form>
			</div>
			
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /.wrapper -->

<?php include('footer.php'); 
	}else{
		header('Location:index.php');
	}
?>
<script>
  $(function () {
    
    //bootstrap WYSIHTML5 - text editor
	$('.textarea').wysihtml5()
    
  })
</script>

