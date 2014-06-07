<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
 // include configuration file
 include_once("config/config.php");
 // include setting file
 include_once("class/settings.php");
 // include library file
 include_once("class/lib.php");
 // include auth file
 include_once("class/auth.php");
 
 session_start();
 
 $getData		= $_POST;
 $getSettings 	= new Settings($config_setting_file_path);
 $cpsub			= $getSettings->getSettings();
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']); 
 $getAuth 		= new Auth($config_account_data, $getLib);
 // current page
 $website_current_page = "登入"; 
 
 // get title
 $website_title = $getLib->setFilter($cpsub['title']). "-" .$website_current_page;
  
 // set add function
 $getResult = $getAuth->setLogin($getData);
 
 if($getResult['status'] == true || $_SESSION['login'] == "1"){	
	$success_msg_array = $getResult['msg'];
	$rPage = "./manage.php";
	echo $getLib->getRedirect($rPage);
 }else{
	$error_msg_array   = $getResult['msg'];
	$getAuth->clearAuth();
 }

?>
		

<!DOCTYPE html>
<html lang="zh-tw">
  <head>
    <title><?=$website_title;?></title>
	<meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
	<div class="container">
		<div class="page-header">
		  <h1><a href="./"><?=$getLib->setFilter($cpsub['title']);?></a> <small><?=$website_current_page;?></small></h1>
		</div>
		<div class="navbar">
			<p class="navbar-text navbar-right"><a href="index.php">回首頁</a></p>
		</div>
		<div class="panel panel-default login">
			<div class="panel-body">
				<?php $getLib->showErrorMsg($error_msg_array);?>
				<?php $getLib->showSuccessMsg($success_msg_array);?>
				<form class="form-horizontal" role="form" action="login.php" method="post">
				  <div class="form-group">
					<label for="admin_username" class="col-lg-2 control-label">帳號</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="cpsub_username" name="cpsub_username" placeholder="請輸入帳號">
					</div>
				  </div>
				  <div class="form-group">
					<label for="admin_password" class="col-lg-2 control-label">密碼</label>
					<div class="col-lg-10">
					  <input type="password" class="form-control" id="cpsub_password" name="cpsub_password"  placeholder="請輸入密碼">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
					  <button type="submit" class="btn btn-default" name="send" value="send">登入</button>
					</div>
				  </div>
				</form>
			</div>
		</div>
	</div>
		<div class="footer">
			C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
		</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
  </body>
</html>