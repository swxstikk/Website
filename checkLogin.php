<?php 
	include('env.php');
	//print_r($_POST);
	
	if(isset($_POST)){
		$validate_user = "select * from users where email='{$_POST['email']}' and password='".base64_encode($_POST['password'])."'";
		$exe_validate_user = mysqli_query($conn,$validate_user);
		
		if(mysqli_num_rows($exe_validate_user)>0){
			$rowVal = mysqli_fetch_array($exe_validate_user);
			$_SESSION['id'] = $rowVal['id'];
			$_SESSION['studentcode'] = $rowVal['STUDENTCODE'];
			$_SESSION['email'] = $rowVal['email'];
			header('Location:dashboard.php');
			
		}else{
			
		}
		
	}
?>