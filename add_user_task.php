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
			Add Task
			<small>Add Workout Details</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li a href="manage_user_task.php">Manage Task</a></li>
			<li class="active"><a href="#">Add Feedback</a></li>
			
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box box-warning">
			
				<form action="" id="user-task" name="user-task" method="post">
					<div class="row">
						<div class="col-sm-6">
							<?php 
								$query_member = "SELECT U.*,R.display_name FROM users AS U INNER JOIN role_user AS RU
									ON RU.user_id= U.id
									INNER JOIN roles AS R ON R.id = RU.role_id
									WHERE R.name='member' AND deleted_at IS NULL";
									if($_SESSION['id'] != 1){
										$query_member.=" AND U.id='{$_SESSION['id']}'";
									}
								$exe_member = mysqli_query($conn,$query_member);
							?>
							<div class="form-group">
								<label class="control-label">Choose Member</label>
								<select class="form-control required" id="member" name="member">
									<option  value="">Select Member</option>
									<?php
										while($row1 = mysqli_fetch_assoc($exe_member)){
											echo '<option value="'.$row1["id"].'">'.$row1['name'].'</option>';
										}
									?>
								</select>
								<p class="help-block"></p>
							</div>
										
						</div>
						<div class="col-sm-6">
							
						</div>
						<!-- /.col -->
					</div>
					<div class='row'>
						<div class='col-sm-2 pull-right'>
							<a class='btn btn-warning' href='javascript:void(0);' onclick='addWorkoutDiv();'>Add More Workout</a>
						</div>
					</div>
					<div class="row" id="WorkoutDetails">
						<div id='excercise_0'>
							<fieldset>
								<legend>WorkOut  1:
									<a class='btn btn-danger pull-right' onclick='$("#excercise_0").remove();' href="javascript:void(0);">Delete </a>
								</legend>
								<?php 
									$query_category = "select * from workout_category where sts=0 and (deleted_at is null or deleted_at='')";
									$exe_category = mysqli_query($conn,$query_category);
								?>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="control-label">Choose Workout</label>
										<select class="form-control required" id="workout-0" name="workout-0">
											<option value="">Select</option>
											<?php
												while($row1 = mysqli_fetch_assoc($exe_category)){
													echo '<option value="'.$row1["id"].'">'.$row1['workout_name'].'</option>';
												}
											?>
										</select>
										<p class="help-block"></p>
									</div>	
								</div>	
								<div class="col-sm-4">
									<div class="form-group">
										<label class="control-label">Workout Cycle</label>
										<input type="text" class="form-control required" id="excerCycle-0" name="excerCycle-0" placeholder="Workout Cycle ...">
										<p class="help-block"></p>
									</div>	
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="control-label">Cycle Repeatation</label>
										<input type="text" class="form-control" id="excerRepeat-0" name="excerRepeat-0" placeholder="Workout Repeatation ...">
										<p class="help-block"></p>
									</div>	
								</div>
							</fieldset>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
								<a class="btn btn-primary waves-effect" id='saveTask' onclick="saveTask(<?php  ?>)" >Save User Task</a>
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

