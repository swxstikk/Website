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
		if($_GET['id']!=''){
		$edit_id = $_GET['id'];
		$get_data = "SELECT U.*,SA.*,RU.role_id,RU.user_id,R.display_name FROM users AS U INNER JOIN role_user AS RU
			ON RU.user_id= U.id
			INNER JOIN roles AS R ON R.id = RU.role_id
			INNER JOIN studentapplicantdata AS SA ON SA.STUDENTCODE=U.STUDENTCODE
			WHERE  (U.deleted_at IS NULL OR U.deleted_at='') AND U.id='".$edit_id."'";
		$exe_data = mysqli_query($conn,$get_data);
		$rowVal = mysqli_fetch_array($exe_data);
		}
	}
  ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			<?php if($edit_id==''){ echo "Add";} else { echo "  Edit";} ?> Users
			<small>Register User</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="manage_user.php"> Manage User</a></li>
			<li class="active"><a href="#"> <?php if($edit_id==''){ echo "Add";} else { echo " Edit";} ?> Users</a></li>
			
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
				//print_r($_SESSION);
				?>
				<form action="" id="user-registration" name="user-registration" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="control-label" for="inputSuccess">First Name</label>
								<input type="text" class="form-control required" id="fname" name="fname" placeholder="First Name ..." 
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENTFNAME'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label" >Last Name</label>
								<input type="text" class="form-control required" id="lname" name="lname" placeholder="Last Name ..."
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENTLNAME'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Password</label>
								<input type="password" class="form-control required" id="password" name="password" placeholder="Password ..." 
								value ="<?php if($edit_id!=''){ echo base64_decode($rowVal['password']);} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Address Line-1</label>
								<input type="text" class="form-control required" id="address1" name="address1" placeholder="House/Flat No, Colony ..."
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENT_PARMANENT_ADDLINE1'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Address Line-3</label>
								<input type="text" class="form-control" id="address3" name="address3" placeholder="Landmark ..."
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENT_PARMANENT_ADDLINE3'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Pincode</label>
								<input type="text" class="form-control required" id="pin" name="pin" placeholder="Pincode ..." onkeypress="return digits(this, event, true, false);"
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENT_PARMANENT_PINCODE'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<?php 
								$query_role = "select * from STOREPICK where STORE_ID='BGR'";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Blood Group</label>
								<select class="form-control required" id="blood_grp" name="blood_grp">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){
											?>
											<option value="<?php echo $row1["PICK_ID"];?>" 
											<?php 
											if($edit_id!=''){
												if($rowVal['STDENTBGROUP'] == $row1["PICK_ID"]){

												echo 'selected="selected"'; }
											}
											?> >
											
											<?php echo $row1['PICK_TEXT'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<?php 
								$query_role = "select * from STOREPICK where STORE_ID='GEND'";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Gender</label>
								<select class="form-control required" id="gender" name="gender">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){
											?>
											<option value="<?php echo $row1["PICK_ID"];?>" 
											<?php 
											if($edit_id!=''){
												if($rowVal['STUDENTSEX'] == $row1["PICK_ID"]){

												echo 'selected="selected"'; }
											}
											?> >
											
											<?php echo $row1['PICK_TEXT'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<?php 
								$query_role = "select * from STOREPICK where STORE_ID='NATI'";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Nationality</label>
								<select class="form-control required" id="nationality" name="nationality">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){
											?>
											<option value="<?php echo $row1["PICK_ID"];?>" 
											<?php 
											if($edit_id!=''){
												if($rowVal['STUDENTNATIONALITY'] == $row1["PICK_ID"]){

												echo 'selected="selected"'; }
											}
											?> >
											
											<?php echo $row1['PICK_TEXT'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							
							<?php 
								$query_role = "select * from roles where id!=1";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group ">
								<label class="control-label">User Role</label>
								<select class="form-control required"  id="role" name="role">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){?>
										
											<option value="<?php echo $row1["id"];?>" 
											<?php 
											if($edit_id!=''){
												if($rowVal['role_id'] == $row1["id"]){

												echo 'selected="selected"'; }
											}
											?> >
											
											<?php echo $row1['display_name'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Height<span style="color:red"> (Give Value in Cm only)</span></label>
								<input type="text" class="form-control required" id="height" name="height" placeholder="Height in CM ..." onkeypress="return digits(this, event, true, false);"
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENT_PHYSICAL_CHALLANGED'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Weight<span style="color:red"> (Give Value in KG only)</span></label>
								<input type="text" class="form-control required" id="weight" name="weight" placeholder="Weight in KG..." onkeypress="return digits(this, event, true, false);"
								value ="<?php if($edit_id!=''){ echo $rowVal['DISABLITY_TYPE'];} else { echo "";} ?>" onblur="getBMI();">
								<p class="help-block"></p>
							</div>
						</div>
						<div class="col-sm-6">
							<?php if($edit_id!=''){ ?>
							<div class="form-group ">
								<input type="hidden" id="studentcode" name="studentcode" class="form-control" 
								value ="<?php  echo $rowVal['STUDENTCODE']; ?>">
								<p class="help-block"></p>
							</div>
							<?php } ?>
							<div class="form-group ">
								<label class="control-label" for="inputSuccess">Middle Name</label>
								<input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name ..." 
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENTMNAME'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label" >Email</label>
								<input type="email" id="email" name="email" class="form-control required" placeholder="Email Id ..." 
								value ="<?php if($edit_id!=''){ echo $rowVal['email'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Mobile</label>
								<input type="text" class="form-control required" id="mobile" name="mobile" placeholder="Mobile ..." onkeypress="return digits(this, event, true, false);" 
								value ="<?php if($edit_id!=''){ echo $rowVal['mobile'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">Address Line-2</label>
								<input type="text" class="form-control" id="address2" name="address2" placeholder="Street, PO...." 
								value ="<?php if($edit_id!=''){ echo $rowVal['STUDENT_PARMANENT_ADDLINE2'];} else { echo "";} ?>">
								<p class="help-block"></p>
							</div>
							<?php 
								$query = "select * from statemst where deleted_at is null";
								$exe_query = mysqli_query($conn,$query);
							?>
							<div class="form-group ">
								<label class="control-label">State</label>
								<select class="form-control required" id="state" name="state">
									<?php
										while($row = mysqli_fetch_assoc($exe_query)){?>
											
											<option value="<?php echo $row["STATECD"];?>" 
											<?php if($edit_id!=''){
												if($rowVal['STUDENT_PARMANENT_STATE'] == $row["STATECD"]){

												echo 'selected="selected"'; }
											}	
											?> >
											
											<?php echo $row['STATENM'];?>
											</option>
								<?php 	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<div class="form-group">
								<label class="control-label">Date of Birth:</label>
								<div class="input-group">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" class="form-control date pull-right required" id="dob" name="dob" 
								value="<?php if($edit_id!=''){ echo $rowVal['STUDENT_DOB_MM']."/".$rowVal['STUDENT_DOB_DD']."/".$rowVal['STUDENT_DOB_YYYY']; }?>">
								</div>
								<!-- /.input group -->
								<p class="help-block"></p>
							</div>
							  <!-- /.form group -->
							<?php 
								$query_role = "select * from STOREPICK where STORE_ID='CAT'";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Caste Category</label>
								<select class="form-control required" id="category" name="category">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){
											?>
											<option value="<?php echo $row1["PICK_ID"];?>" 
											<?php 
											if($edit_id!=''){
											if($rowVal['STUDENTCATEGORY'] ==$row1["PICK_ID"]){

											echo 'selected="selected"'; }
											}
											?>>
											
											<?php echo $row1['PICK_TEXT'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<?php 
								$query_role = "select * from STOREPICK where STORE_ID='MAR'";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Marital Status</label>
								<select class="form-control required" id="marital_sts" name="marital_sts">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){ ?>
											
											<option value="<?php echo $row1["PICK_ID"];?>" 
											<?php 
											if($edit_id!=''){
											if($rowVal['MARITALSTATUS'] ==$row1["PICK_ID"]){

											echo 'selected="selected"'; }
											}
											?>>
											
											<?php echo $row1['PICK_TEXT'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<?php 
								$query_role = "select * from country_master";
								$exe_role = mysqli_query($conn,$query_role);
							?>
							<div class="form-group">
								<label class="control-label">Country</label>
								<select class="form-control required" id="country" name="country">
									<?php
										while($row1 = mysqli_fetch_assoc($exe_role)){
											?>
											<option value="<?php echo $row1["countrycd"];?>" 
											<?php 
											
											if($edit_id!=''){
											if($rowVal['STUDENT_PARMANENT_COUNTRY'] == $row1["countrycd"]){

											echo 'selected="selected"'; }
											}
											?>>
											
											<?php echo $row1['countrynm'];?>
											</option>
								<?php	}
									?>
								</select>
								<p class="help-block"></p>
							</div>
							<div class="form-group">
								<label class="control-label">User Lock</label>
								<select class="form-control required" id="lock" name="lock">
									<option value="1" <?php if($edit_id!=''){if($rowVal['sts']==1){echo 'selected="selected"';}}?>> Locked</option>
									<option value="0" <?php if($edit_id!=''){if($rowVal['sts']==0){echo 'selected="selected"';}}?>>Unlocked</option>
								</select>
								<p class="help-block"></p>
							</div>
							<div class="form-group ">
								<label class="control-label">BMI</label>
								<input type="text" class="form-control " id="bmi" name="bmi" placeholder="BMI.." readonly
								value ="<?php if($edit_id!=''){ echo $rowVal['DISABLITY_PERCENTAGE'];} else { echo "";} ?>" onblur="getBMI();">
								<p class="help-block"></p>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
								<a class="btn btn-primary waves-effect" id='addUser' onclick="saveUserDetails(<?php echo $edit_id; ?>)" ><?php if($edit_id!=''){ echo "Update";} else { echo "Add";} ?> User Details</a>
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
<script>
$(function() {
	// Date Picker
	$( '.date').datepicker({
		autoclose: true
	});
	if($('.date').val()==""){
		$('.date').datepicker({dateFormat: 'dd-mm-yy'}).datepicker('setDate', new Date());
	}else{
		$('.date').datepicker({dateFormat: 'dd-mm-yy'});
	}
});
</script>

