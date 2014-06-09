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
 // include auth file
 include_once("class/auth.php");
 // include template file
 include_once("class/template.php");
 
 session_start();
 
 $getSettings 	= new Settings($config_setting_file_path);
 $cpsub			= $getSettings->getSettings();
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 $getAuth 		= new Auth($config_account_data, $getLib);
 $getTmp 		= new Template($config_current_version);
 
 
 // check file status
 $getLib->checkFileStatus($config_default_folder);
 $getLib->checkFileStatus($config_article_file_path);
 
 // get page val
 $p = $getLib->setFilter($_GET['p']);
 
 if(!$getLib->checkVal($p)){
	$p = "about";
 }
  
 // check auth
 $getAuth->checkAuth($_COOKIE, $_SESSION, $p);
 
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
	<?=$getTmp->setHeader($website_title);?>
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
			  <li <?=$getLib->toggleMenu($p, "logout");?>><a href="?p=logout">登出</a></li>
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
	<?=$getTmp->setFooter();?>
  </body>
</html>