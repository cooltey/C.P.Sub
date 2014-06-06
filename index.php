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
 $website_current_page = "首頁"; 
 
 // get title
 $website_title = $getLib->setFilter($cpsub['title']). "-" .$website_current_page;
 /* 
 // check dir
 $getLib->checkFileStatus($config_default_folder);
 
 // check file
 $getLib->checkFileStatus($config_article_file_path);
 */
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
			<p class="navbar-text navbar-right"><a href="login.php">管理</a></p>
			<form class="navbar-form navbar-right" role="search">
			  <div class="form-group">
				<input type="text" class="form-control" placeholder="輸入關鍵字">
			  </div>
			  <button type="submit" class="btn btn-default">搜尋</button>
			</form>
		</div>
		<div class="panel panel-default">
			<table class="table table-hover">
			  <thead>
				<tr>
					<th width="7%">編號</th>
					<th width="63%">標題</th>
					<th width="10%">觀看次數</th>
					<th width="10%">日期</th>
					<th width="10%">發佈人</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
				</tr>
			  </tbody>
			</table>
		</div>
		<ul class="pagination pull-right">
		  <li class="disabled"><a href="#">&laquo;</a></li>
		  <li class="active"><a href="#">1</a></li>
		  <li><a href="#">2</a></li>
		  <li><a href="#">3</a></li>
		  <li><a href="#">4</a></li>
		  <li><a href="#">5</a></li>
		  <li><a href="#">&raquo;</a></li>
		</ul>
	</div>
		<div class="footer">
			C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
		</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
  </body>
</html>