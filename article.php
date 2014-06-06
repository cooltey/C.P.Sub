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
 $website_current_page = "閱讀文章"; 
 
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
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">假一天明天、後天全台灣放假一天明天、後天全台灣放假一天 </h3>
		  </div>
		  <div class="panel-body">
		  最近詐騙利用我們名號詐騙 請確認是我們商家.避免受騙

本賣場一次性消費滿三千 送隨機遊戲乙組 不得挑選 實際使用為準

下單前購買規則/任何付款方式/收發件速度=必讀關於我均有說明
目前只接受超商代碼繳款 其餘不接受其他繳費
申請方式 詳讀關於我中灰底紅字 簡易教學 若無法配合請勿下單
注意 若不配合關於我規則 是無法取件商品 購買後務必配合規則
如果您想購買的商品不在賣場裡 歡迎您洽詢我們
		  </div>
		  <ul class="list-group">
			<li class="list-group-item">附件下載
				<ul class="list-group">
				  <li class="list-group-item">
					<span class="glyphicon glyphicon-cloud-download pull-right"></span>
					123
				  </li>
				</ul>
			</li>
			<li class="list-group-item">發佈人：註冊組<br>發佈日期：2013/10/13<span class="pull-right">觀看人數：12,345</span></li>
		  </ul>
		</div>
	</div>
		<div class="footer">
			C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
		</div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>	
  </body>
</html>