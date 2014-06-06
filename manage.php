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
 
 // check file status
 $getLib->checkFileStatus($config_default_folder);
 $getLib->checkFileStatus($config_article_file_path);
 
 // get page val
 $p = $getLib->setFilter($_GET['p']);
 
 if(!$getLib->checkVal($p)){
	$p = "about";
 }
 
 // get page folder
 $include_path = $getLib->checkAdminPath($p);

 // current page
 $website_current_page = "管理"; 
 
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
	<!-- Jquery -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  </head>
  <body>
	<div class="container">
		<div class="page-header">
		  <h1><a href="./"><?=$getLib->setFilter($cpsub['title']);?></a> <small><?=$website_current_page;?></small></h1>
		</div>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="navbar-header">
			<a class="navbar-brand" href="#">控制台</a>
		  </div>
		  <div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
			  <li <?=$getLib->toggleMenu($p, "article_add");?>><a href="?p=article_add">建立新公告</a></li>
			  <li <?=$getLib->toggleMenu($p, "article_list");?>><a href="?p=article_list">公告列表</a></li>
			  <li <?=$getLib->toggleMenu($p, "system_settings");?>><a href="?p=system_settings">系統管理</a></li>
			  <li <?=$getLib->toggleMenu($p, "about");?>><a href="?p=about">程式資訊</a></li>
			  <li <?=$getLib->toggleMenu($p, "logout");?>><a href="?p=logout">登出並回到首頁</a></li>
			</ul>
		  </div>
		</nav>
		<?php
			if($getLib->checkVal($include_path)){
				include($include_path) ;
			}else{
				$error_msg 			= "找不到網頁";
				$error_msg_array 	= array();
				array_push($error_msg_array, $error_msg);
				$getLib->showErrorMsg($error_msg_array);
			}
		?>
	</div>
		<div class="footer">
			C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
		</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
	<script src="js/manage.js"></script>
  </body>
</html>