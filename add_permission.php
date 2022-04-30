<?php
	include('header.php');
	include('env.php');
	
?>
<div class="wrapper">
	<?php 
	include('top_header.php');
	include('main_sidebar.php');
	$edit_id='';
	if(isset($_GET['id'])){
		$edit_id = $_GET['id'];
		$get_data = "Select * from permissions where id='".$edit_id."'";
		$exe_data = mysqli_query($conn,$get_data);
		$rowVal = mysqli_fetch_array($exe_data);
	}
  ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			<?php if($edit_id==''){ echo "Add";} else { echo " Edit";} ?> Users Permission
			<small>Permmision to define for a user.</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="manage_permission.php"> Manage User Permission</a></li>
			<li class="active"><a href="#"><?phpif($edit_id==''){ echo "Add";} else { echo " Edit";} ?> Users Permission</a></li>
			
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box box-warning">
			<?php 
				if(isset($_GET['msg'])){
					if($_GET['msg'] == 'duplicate'){
						?>
						<div class="box-body">
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Error!</h4>
								Email Already Registered. Check user data again.
							</div> 
						</div>
				
			<?php 
					}
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
				<form action="" id="user-permission" name="user-permission" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="control-label" for="inputSuccess">Permmision Name</label>
								<input type="text" class="form-control required" id="pname" name="pname" placeholder="Permmision Name ..." 
								value ="<?php if($edit_id!=''){ echo $rowVal['name'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label" >Display Name</label>
								<input type="text" class="form-control required" id="dname" name="dname" placeholder="Display Name ..."
								value="<?php if($edit_id!=''){ echo $rowVal['display_name'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Description</label>
								<input type="text" class="form-control" id="descp" name="descp" placeholder="Description ..."
								value="<?php if($edit_id!=''){ echo $rowVal['description'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
								<a class="btn btn-primary waves-effect" id='addPermission' onclick="savePermission(<?php echo $edit_id; ?>)" ><?php if($edit_id!=''){ echo "Update";} else { echo "Add";} ?> User Permission</a>
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

<?php include('footer.php'); ?>