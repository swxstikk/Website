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
			Add Workout
			<small>Different Workout Type</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="manage_excercise.php"> Manage Workouts</a></li>
			<li class="active"><a href="#">Add Workout</a></li>
			
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box box-warning">
			
			
				<form action="" id="add-workout" name="add-workout" method="post">
					<div class="row">
						<div class="col-sm-6">
							<?php 
								$query_tpe = "select * from workout_for where sts=0 AND deleted_at IS NULL";
								$exe_type = mysqli_query($conn,$query_tpe);
							?>
							<div class="form-group">
								<label class="control-label">Workout For</label>
								<select class="form-control required" id="body_id" name="body_id">
									<option  value="">Select</option>
									<?php
										while($row1 = mysqli_fetch_assoc($exe_type)){
											echo '<option value="'.$row1["id"].'">'.$row1['body_part'].'</option>';
										}
									?>
								</select>
								<p class="help-block"></p>
							</div>
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
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="control-label">Workout Name</label>
								<input type="text" class="form-control required" id="excer_name" name="excer_name" placeholder="Workout Name ...">
								<p class="help-block"></p>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<div class="row">
						<div class="col-sm-12">
						  
							<div class="box-header" style="margin:10px;">
							  <h3 class="box-title">Workout Description
								<small></small>
							  </h3>
							  
							</div>
							<!-- /.box-header -->
							<div class="box-body pad" style="margin:10px;">
								<textarea id="excer_desc" name="excer_desc" rows="10" cols="80" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" >
														
								</textarea>
							</div>
						  
						  <!-- /.box -->
						</div>
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
								<a class="btn btn-primary waves-effect" id='saveExercise' >Save Workout</a>
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

