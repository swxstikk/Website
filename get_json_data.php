<?PHP
	Session_start();
	header("Content-Type: application/json");
	
	switch($_GET['typ']){
		case 'login':
			checkLogin();
		break;
		case 'addUser':
			addUserDetails();
		break;
		case 'saveFeeds':
			saveFeedback();
		break;
		case 'saveTip':
			saveHealthTip();
		break;
		case 'saveNotice':
			saveNotice();
		break;
		case 'saveWorkout':
			saveWorkout();
		break;
		case 'saveQuestionare':
			saveEnquiry();
		break;
		case 'savePermission':
			addPermission();
		break;
		case 'updateReport':
			updateTaskReport();
		break;
		case 'saveTask':
			saveUserTask();
		break;
		
	}
	function checkLogin(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			
			$validate_user = "select U.id,U.STUDENTCODE,U.email,U.name as UNAME,RU.user_id,RU.role_id,R.name as role_name
			from users as U inner join role_user as RU 
			on U.id = RU.user_id inner join roles as R on RU.role_id = R.id 
			where email='{$_POST['email']}' and password='".base64_encode($_POST['password'])."'";
			$exe_validate_user = mysqli_query($conn,$validate_user);
			
			if(mysqli_num_rows($exe_validate_user)>0){
				$rowVal = mysqli_fetch_array($exe_validate_user);
				$_SESSION['id'] 			= $rowVal['id'];
				$_SESSION['studentcode'] 	= $rowVal['STUDENTCODE'];
				$_SESSION['email'] 			= $rowVal['email'];
				$_SESSION['name'] 			= $rowVal['UNAME'];
				$_SESSION['role_name'] 		= $rowVal['role_name'];
				$data['message']			= "Logged In Successfully";
				$data['intended_url']		= "dashboard.php";
				$data['status']=TRUE;
				
			}else{
				$data['status']=FALSE;
				$data['message']="Invalid Login Credential";
			}
			
			echo json_encode($data);
			exit;
		}
	}
	
	function addUserDetails(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			$msg='';
			if(!empty($_POST['fname']) && $_POST['fname']!=''){
				$fname = $_POST['fname'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['lname']) && $_POST['lname']!=''){
				$lname = $_POST['lname'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['password']) && $_POST['password']!=''){
				$password = base64_encode($_POST['password']);
			}else{
				$msg='err';
			}
			if(!empty($_POST['address1']) && $_POST['address1']!=''){
				$address1 = $_POST['address1'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['pin']) && $_POST['pin']!=''){
				$pin = $_POST['pin'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['mobile']) && $_POST['mobile']!=''){
				$mobile = $_POST['mobile'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['role']) && $_POST['role']!=''){
				$role = $_POST['role'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['email']) && $_POST['email']!=''){
				$email = $_POST['email'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['state']) && $_POST['state']!=''){
				$state = $_POST['state'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['dob']) && $_POST['dob']!=''){
				$dob = $_POST['dob'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['blood_grp']) && $_POST['blood_grp']!=''){
				$blood_grp = $_POST['blood_grp'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['gender']) && $_POST['gender']!=''){
				$gender = $_POST['gender'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['nationality']) && $_POST['nationality']!=''){
				$nationality = $_POST['nationality'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['category']) && $_POST['category']!=''){
				$category = $_POST['category'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['marital_sts']) && $_POST['marital_sts']!=''){
				$marital_sts = $_POST['marital_sts'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['country']) && $_POST['country']!=''){
				$country = $_POST['country'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['height']) && $_POST['height']!=''){
				$height = $_POST['height'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['weight']) && $_POST['weight']!=''){
				$weight = $_POST['weight'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['bmi']) && $_POST['bmi']!=''){
				$bmi = $_POST['bmi'];
			}else{
				$msg='err';
			}
			
			if($_POST['lock']!=''){
				$lock = $_POST['lock'];
			}else{
				$msg='err';
			}
			if(!empty($_POST['mname']) && $_POST['mname']!=''){
				$mname = $_POST['mname'];
			}else{
				$mname='';
			}
			if(!empty($_POST['address2']) && $_POST['address2']!=''){
				$address2 = $_POST['address2'];
			}else{
				$address2='';
			}
			if(!empty($_POST['address3']) && $_POST['address3']!=''){
				$address3 = $_POST['address3'];
			}else{
				$address3='';
			}
			$today = date("Y-m-d H:i:s"); 
			$name = $fname." ".$mname." ".$lname;
			$user_id='';
			$oper ='insert into';
			$dt_colmn ='created_at';
			$count =0;
			$std_code='';
			$name = trim(preg_replace('/\s+/',' ', $name));
			$data=array();
			
			if($_GET['id']!=''){
				$user_id = $_GET['id'];
				$oper ='update';
				$dt_colmn ='updated_at';
			}
			
			if($msg==''){
				if($user_id==''){
					$chk_user= "select * from users where email='".$email."'";
					$exe_chk_user = mysqli_query($conn,$chk_user);
					$count = mysqli_num_rows($exe_chk_user);
					$get_parameter ="select * from PARAMETER where PARAM='STUDENTROLLDATA'";
					$exe_param = mysqli_query($conn,$get_parameter);
					while($rowFetch = mysqli_fetch_array($exe_param)){
						$std_code = str_pad($rowFetch['STNO'],$rowFetch['NUMBERPAD'],'0',STR_PAD_LEFT);
						$std_code = $rowFetch['PREFIX'].$std_code;
					}
				}
				
				if($count>0){
					$msg = 'duplicate';
					$data['status']=FALSE;
					$data['intended_url']="add_user.php";
					$data['message']=$msg;
				}else{
					$insert_user = $oper;
					$insert_applicant =$oper;
					$insert_role =$oper;
					$time=strtotime($dob);
					$dd = date("d",$time);
					$mm = date("m",$time);
					$yy = date("Y",$time);
					$insert_applicant .= " studentapplicantdata set
							STUDENTFNAME 					= '{$fname}',
							STUDENTMNAME 					= '{$mname}',
							STUDENTLNAME 					= '{$lname}',
							STUDENT_DOB_DD 					= $dd,
							STUDENT_DOB_MM 					= $mm,
							STUDENT_DOB_YYYY 				= $yy,
							STDENTBGROUP 					= '{$blood_grp}',
							STUDENTSEX	 					= '{$gender}',
							STUDENTCATEGORY					= '{$category}',
							STUDENTNATIONALITY				= '{$nationality}',
							STUDENT_PARMANENT_ADDLINE1 		= '{$address1}',
							STUDENT_PARMANENT_ADDLINE2 		= '{$address2}',
							STUDENT_PARMANENT_ADDLINE3 		= '{$address3}',
							STUDENT_PARMANENT_COUNTRY 		= '{$country}',
							STUDENT_PARMANENT_STATE 		= '{$state}',
							STUDENT_PARMANENT_PINCODE 		= '{$pin}',
							MARITALSTATUS			 		= '{$marital_sts}',
							STUDENT_PHYSICAL_CHALLANGED		= '{$height}',
							DISABLITY_TYPE			 		= '{$weight}',
							DISABLITY_PERCENTAGE	 		= '{$bmi}',
							$dt_colmn 						= '{$today}'
					";
					if($_GET['id']!=''){
						$insert_applicant .=" where STUDENTCODE = '{$_POST['studentcode']}'";
					}else{
						$insert_applicant .=" ,STUDENTCODE = '{$std_code}'";
					}	
					$exe_insert_applicant = mysqli_query($conn,$insert_applicant);
					if(mysqli_affected_rows($conn)>0){
						$insert_id='';
						$insert_user .= " users set 
								username 	= '{$email}',
								name 		= '{$name}',
								email 		= '{$email}',
								password 	= '{$password}',
								$dt_colmn 	= '{$today}',
								sts	 		= '{$lock}',
								ip 			= '{$_SERVER["REMOTE_ADDR"]}',
								mobile 		= '{$mobile}',
								
						";
						if($_GET['id']!=''){
							$insert_user .=" STUDENTCODE = '{$_POST['studentcode']}' where id = '{$_GET['id']}'";
						}else{
							$insert_user .=" STUDENTCODE = '{$std_code}'";
						}
						
						$exe_insert_user = mysqli_query($conn,$insert_user);
						$insert_id = mysqli_insert_id($conn);
						$insert_id=mysqli_insert_id($conn);

							$id1='';
							$insert_role .= " role_user set 
									role_id		= '{$role}'
							";
							if($_GET['id']!=''){
								$insert_role .="  where user_id = '{$_GET['id']}'";
							}else{
								$insert_role .=" ,user_id = '{$insert_id}'";
							}	
							
							$exe_insert_role = mysqli_query($conn,$insert_role);
							if($_GET['id']==''){
								$update_param = "update PARAMETER set STNO=STNO+1 where PARAM='STUDENTROLLDATA'";
								$exe_update = mysqli_query($conn,$update_param);
							}
							$msg = 'succ';
							$data['status']=TRUE;
							$data['intended_url']="manage_user.php";
							$data['message']=$msg;
							
						}
					}
				}
			}else{
				$data['status']=FALSE;
				$data['intended_url']="add_user.php";
				$data['message']=$msg;
			}
			echo json_encode($data);
			exit;
		}
	}
	
	function saveFeedback(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			if(isset($_GET['length'])) {
				$len =  $_GET['length'];
				for($i=0; $i<=$len;$i++){
					$new_date = date("Y-m-d H:i:s"); 
					$insert_feed = "insert into workout_feedback set
						user_id = '{$_POST['member']}',
						trainer_id = '{$_SESSION['id']}',
						workout_suggested = '{$_POST['workout-'.$i]}',
						no_times = '{$_POST['excerCycle-'.$i]}',
						repeat_cycle = '{$_POST['excerRepeat-'.$i]}',
						feedback = '{$_POST['feedback']}',
						created_at = '{$new_date}'
					";
					$exe_feed = mysqli_query($conn,$insert_feed);
					if(mysqli_affected_rows($conn)>0){
						$data['status']=TRUE;
						$data['intended_url']="manage_feedback.php";
						$data['message']="Data Added Successfully";
					}else{
						$data['status']=FALSE;
						$data['message']="err";
					}			
					
				}
			}
			echo json_encode($data);
			exit;
		}
		
	}
	function saveHealthTip(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			//print_r($_POST);
			$new_date = date("Y-m-d H:i:s"); 
			$insert_tips = "insert into daily_tips set
				tips_title = '{$_POST['tip_title']}',
				tips_body = '{$_POST['tip_body']}',
				tips_by = '{$_SESSION['id']}',
				sts = '{$_POST['status']}',
				created_at = '{$new_date}'
			";
			$exe_tips = mysqli_query($conn,$insert_tips);
			if(mysqli_affected_rows($conn)>0){
				$data['status']=TRUE;
				$data['intended_url']="manage_health_tips.php";
				$data['message']="succ";
			}else{
				$data['status']=FALSE;
				$data['message']="err";
			}
			echo json_encode($data);
			exit;
		}
		
	}
	function saveNotice(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			//print_r($_POST);
			$new_date = date("Y-m-d H:i:s"); 
			$insert_notice = "insert into notice_mst set
				notice_title = '{$_POST['notice_title']}',
				notice_body = '{$_POST['notice_body']}',
				notice_by = '{$_SESSION['id']}',
				sts = '{$_POST['status']}',
				created_at = '{$new_date}'
			";
			$exe_tips = mysqli_query($conn,$insert_notice);
			if(mysqli_affected_rows($conn)>0){
				$data['status']=TRUE;
				$data['intended_url']="manage_health_tips.php";
				$data['message']="succ";
			}else{
				$data['status']=FALSE;
				$data['message']="err";
			}
			echo json_encode($data);
			exit;
		}
		
	}
	function saveWorkout(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			//print_r($_POST);
			$new_date = date("Y-m-d H:i:s"); 
			$insert_notice = "insert into workout_category set
				body_id = '{$_POST['body_id']}',
				workout_name = '{$_POST['excer_name']}',
				workout_desc = '{$_POST['excer_desc']}',
				sts = '{$_POST['status']}',
				created_at = '{$new_date}'
			";
			$exe_tips = mysqli_query($conn,$insert_notice);
			if(mysqli_affected_rows($conn)>0){
				$data['status']=TRUE;
				$data['intended_url']="manage_excercise.php";
				$data['message']="succ";
			}else{
				$data['status']=FALSE;
				$data['message']="err";
			}
			echo json_encode($data);
			exit;
		}
		
	}
	
	function saveEnquiry(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			//print_r($_POST);
			$new_date = date("Y-m-d H:i:s"); 
			$insert_enquiry = "insert into enquiry_mst set
				subject = '{$_POST['topic']}',
				Requestor = '{$_POST['fname']}',
				email = '{$_POST['email1']}',
				contact = '{$_POST['mobile']}',
				question = '{$_POST['question']}',
				sts = 0,
				created_at = '{$new_date}'
			";
			$exe_enquiry = mysqli_query($conn,$insert_enquiry);
			if(mysqli_affected_rows($conn)>0){
				$data['status']=TRUE;
				$data['message']="Request Posted Successfully";
			}else{
				$data['status']=FALSE;
				$data['message']="Something Went Wrong. Please try after again";
			}
			echo json_encode($data);
			exit;
		}
		
	}
	function addPermission(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			//print_r($_POST);
			$new_date = date("Y-m-d H:i:s"); 
				$per_id='';
				$oper ='insert into';
				$dt_colmn ='created_at';
				$count =0;
				
				if($_GET['id']!=''){
					$per_id = $_GET['id'];
					$oper ='update';
					$dt_colmn ='updated_at';
				}
				
				
				if($per_id==''){
					$chk_entry= "select * from permissions where name='".$_POST['pname']."'";
					$exe_entry = mysqli_query($conn,$chk_entry);
					$count = mysqli_num_rows($exe_entry);
					
				}
				if($count>0){
					$msg = 'duplicate';
					$data['status']=FALSE;
					$data['intended_url']="add_permission.php";
					$data['message']=$msg;
				}else{
					$insert_permi = $oper;
					$insert_permi .= " permissions set
						name = '{$_POST['pname']}',
						display_name = '{$_POST['dname']}',
						description = '{$_POST['descp']}',
						$dt_colmn = '{$new_date}'
					";
					if($_GET['id']!=''){
						$insert_permi .=" where id='{$per_id}'";
					}
					$exe_permi = mysqli_query($conn,$insert_permi);
					if(mysqli_affected_rows($conn)>0){
						$data['status']=TRUE;
						$data['intended_url']="manage_permission.php";
						$data['message']="succ";
					}else{
						$data['status']=FALSE;
						$data['message']="err";
					} 
				}
			echo json_encode($data);
			exit;
		}
		
	}
	
	function updateTaskReport(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			$new_date = date("Y-m-d H:i:s");
			
			$sel_data  = "select * from  workout_feedback AS WF where id='".$_GET['id']."'";
			$exe_data = mysqli_query($conn,$sel_data);
			$count = mysqli_num_rows($exe_data);
			if($count>0){
				$rowData =  mysqli_fetch_array($exe_data);
				$insrt_user_task ="insert into user_workout set
				user_id='{$rowData['user_id']}',
				task_cate_id='{$rowData['workout_suggested']}',
				time_period='{$rowData['no_times']}',
				loop_period='{$rowData['repeat_cycle']}',
				created_at='{$new_date}'
				";
				$exe_user_task = mysqli_query($conn,$insrt_user_task);
				$imm_id = mysqli_insert_id($conn);
				if($imm_id>0){
					$update_task ="update workout_feedback set completion='".$_POST['level']."' where id='".$_GET['id']."'";
					$exe_update_task = mysqli_query($conn,$update_task);
					
					$data['status']=TRUE;
					$data['intended_url']="manage_report.php";
					$data['message']="succ";
				}else{
					$data['status']=FALSE;
					$data['intended_url']="manage_report.php";
					$data['message']="err";
				}
			}
				
			echo json_encode($data);
			exit;
		}
		
	}
	
	function saveUserTask(){
		include('env.php');
		if(isset($_POST) && count($_POST)>0) {
			if(isset($_GET['length'])) {
				$len =  $_GET['length'];
				for($i=0; $i<=$len;$i++){
					$new_date = date("Y-m-d H:i:s"); 
					$insert_task = "insert into user_workout set
						user_id = '{$_POST['member']}',
						task_cate_id = '{$_POST['workout-'.$i]}',
						time_period = '{$_POST['excerCycle-'.$i]}',
						loop_period = '{$_POST['excerRepeat-'.$i]}',
						created_at = '{$new_date}'
					";
					$exe_task = mysqli_query($conn,$insert_task);
					if(mysqli_affected_rows($conn)>0){
						$data['status']=TRUE;
						$data['intended_url']="manage_user_task.php";
						$data['message']="Data Added Successfully";
					}else{
						$data['status']=FALSE;
						$data['message']="err";
					}			
					
				}
			}
			echo json_encode($data);
			exit;
		}
		
	}
?>