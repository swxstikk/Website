<?php
	include('header.php');
	include('env.php');
	
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
			BMI Calculator
			<small>Health</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><a href="#"> BMI</a></li>
			
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box box-warning">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-7" style="margin-top:10px;">
							<h4><span class="label label-primary">Weight <strong><span class ='' id="la_value">56</span></strong> kgs.</span></h4>
							<input type="text" data-slider="true" value="56" data-slider-range="5,200" data-slider-step=".5" data-slider-snap="true" id="la">
							<h4><span class="label label-danger">Height <strong><span class =''  id="nm_value">160</span> </strong> cm</span></h4>
							<input type="text" data-slider="true" value="160" data-slider-range="20,200" data-slider-step="1" data-slider-snap="true" id="nm">
						</div>
						<div class="alert alert-info col-md-4" style="margin-top:10px;">									  
							<center><strong>BMI Value</strong> <BR>
							<button type="button" class="btn btn-warning btn-lg" id='tbl_bmi'></button></center>
						</div>
						<BR><BR><BR>
						<div class='col-md-12'>
							<table class='table'>
								<thead>
									<tr>
										<th>BMI Index</th>
										<th>Meaning</th>
									</tr>
								</thead>
								
								<tbody>
									<tr id='row_1'>
										<td>Less Than 15</td>
										<td>Very severely underweight</td>
									</tr>
									<tr id='row_2'>
										<td>15.0 - 16.0</td>
										<td>Severely underweight</td>
									</tr>
									<tr id='row_3'>
										<td>16.0 - 18.4</td>
										<td>Underweight</td>
									</tr>
									<tr id='row_4'>
										<td>18.5 - 24.9</td>
										<td>Normal</td>
									</tr>
									<tr id='row_5'>
										<td>25 - 29.9</td>
										<td>Overweight</td>
									</tr>
									<tr id='row_6'>
										<td>30 - 34.9</td>
										<td>Obese Class I (Moderately obese)</td>
									</tr>
									<tr id='row_7'>
										<td>35 - 39.9</td>
										<td>Obese Class II (Severely obese)</td>
									</tr>
									<tr id='row_8'>
										<td>Above 40</td>
										<td>Obese Class III (Very severely obese)</td>
									</tr>
									
								</tbody>
							</table>						
						</div><!-- /.col -->
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

</div>
<!-- /.wrapper -->

<?php include('footer.php'); ?>

<script type="text/Javascript">	
		$(document).ready(function(){
			$("#la").bind(
				"slider:changed", function (event, data) {				
					$("#la_value").html(data.value.toFixed(0)); 
					calculateBMI();
				}
			);

			$("#nm").bind(
				"slider:changed", function (event, data) {				
					$("#nm_value").html(data.value.toFixed(0)); 
					calculateBMI();
				}
			);
			
			$("#roi").bind(
				"slider:changed", function (event, data) {				
					$("#roi_value").html(data.value.toFixed(2)); 
					calculateBMI();
				}
			);
			
			$("#cp").bind(
				"slider:changed", function (event, data) {				
					$("#cp_value").html(data.value.toFixed(0)); 
					calculateBMI();
				}
			);
			function calculateBMI(){
				var weight = $("#la_value").html();
				var height = parseInt($("#nm_value").html())/100;
				var bmi = weight / (height * height);
				
				var type = "Normal";
				var pos = "";
				if (bmi < 15){
					type= "Very severely underweight";
					pos="row_1";
				}else if(bmi <=16){
					type= "Severely underweight";
					pos="row_2";
				}else if(bmi <=18.4){
					type= "Underweight";
					pos="row_3";
				}else if(bmi <=24.9){
					type= "Normal";
					pos="row_4";
				}else if(bmi <=29.9){
					type= "Overweight";
					pos="row_5";
				}else if(bmi <=34.9){
					type= "Obese Class I (Moderately obese)";
					pos="row_6";
				}else if(bmi <=39.9){
					type= "Obese Class II (Severely obese)";
					pos="row_7";
				}else{
					type= "Obese Class III (Very severely obese)";
					pos="row_8";
				}
				$("tr").removeClass('label-success');
				$("#tbl_bmi").html("<H1>"+ bmi.toFixed(1) + "</h1><small>"+type+"</small>");
				$("#"+pos).addClass('label-success');
			}
			calculateBMI();

		});
		
		
	</script>
