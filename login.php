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
 // include article file
 include_once("class/article.php");
 // include page file
 include_once("class/page.php");
 
 $getSettings 	= new Settings($config_setting_file_path);
 $cpsub			= $getSettings->getSettings();
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 // current page
 $website_current_page = "登入"; 
 
 // get title
 $website_title = $getLib->setFilter($cpsub['title']). "-" .$website_current_page;
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
		<form class="form-horizontal" role="form" action="manage.php" method="post">
		  <div class="form-group">
			<label for="admin_username" class="col-lg-2 control-label">帳號</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="請輸入帳號">
			</div>
		  </div>
		  <div class="form-group">
			<label for="admin_password" class="col-lg-2 control-label">密碼</label>
			<div class="col-lg-10">
			  <input type="password" class="form-control" id="admin_password" name="admin_password"  placeholder="請輸入密碼">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <div class="checkbox">
				<label>
				  <input type="checkbox" name="admin_remeberme"> 記住我
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default">登入</button>
			</div>
		  </div>
		</form>
	</div>
		<div class="footer">
			C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
		</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
  </body>
</html>