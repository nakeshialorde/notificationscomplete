<?php
session_start();
if(isset($_POST["email"])){
	$data=array(
		"grant_type"=>"password",
		"userName"=>$_POST['email'],
		"password"=>$_POST['password']
	);
	//$jsonData = json_encode($data);
	$opts=array(
		'http'=>array(
			'method'=>"POST",
			'header'=>"Content-type: application/x-www-form-urlencoded\r\n",
			'content'=>http_build_query($data)
		)
	);
	
	$httpData = http_build_query($data);
	$ch = curl_init('https://e-solutionsgroup.com:8080/token');                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $httpData);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
	curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/x-www-form-urlencoded',                                                                                
		'Content-Length: ' . strlen($httpData))                                                                       
	);
	
	$result = curl_exec($ch);
	
	/*echo print_r($result);*/
	
	if(strlen($result)>0){
		$jsonResult = json_decode($result);
		$roles = explode(',',$jsonResult->roles);
		if(isset($jsonResult->access_token) && in_array("COBAdmin",$roles)){
			session_start();
			$_SESSION["token"] = $jsonResult->access_token;
			$_SESSION["fullName"] = $jsonResult->fullName;
			$_SESSION["lastLogin"] = $jsonResult->lastLogin;
			header("Location: https://cobadmin.azurewebsites.net/loggedin/");
		}
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>COB Admin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href='css/style.css'>
</head>
<body>
	<div id="pageContainer">
		<div id="loginBox">
			<div id="loginHeader">
				<div id="logo"></div>	
			</div>
			<form  id="loginForm" class="accountForm" action="index.php" method="POST" >
				<div id="loginTitle">COB Administrator Portal </div>
				<div class="inputRow form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
				</div>
				<div class="inputRow form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
				</div>
				<div class="buttonRow form-group">
					<input type="submit" class="btn btn-default btn-green btn-block" value="Log In" />
				</div>

				<div class="inputRow">
					<a href="account.php"> Register for access </a>
				</div>
			</form>
		</div>
	</div>
</body>

</html>