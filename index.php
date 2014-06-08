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
 // include template file
 include_once("class/template.php");
 
 $getSettings 	= new Settings($config_setting_file_path);
 $cpsub			= $getSettings->getSettings();
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 $getTmp 		= new Template();
 
 
 // set Article
 $getArticle 	= new Article($config_upload_folder, $config_article_file_path, $getLib);
 $page    	= $_GET['page'];
 // get article list					
 $getListArray  = $getArticle->getAllList("display", "id", "desc");
 $getListSum    = count($getListArray);
 // set pager 
 $many	 		= $cpsub['display_num'];
 $display 		= $cpsub['display_page_num'];
 $total	 		= $getListSum;
 $pagename		= "?p=article_list&";
 $getPage 		= new Pager($page, $many, $display, $total, $pagename);
 $pageStart  	= intval($getPage->startVar);
 $pageMany  	= intval($getPage->manyVar);
 
 // current page
 $website_current_page = "首頁"; 
 
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
					<th width="5%">編號</th>
					<th width="55%">標題</th>
					<th width="10%">觀看次數</th>
					<th width="10%">日期</th>
					<th width="10%">發佈人</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					$count = 0;
					foreach($getListArray AS $getKey => $getVal){
						if($count >= $pageStart && $count < ($pageMany+$pageStart)){
							$article_id 		= $getVal['id'];
							$article_title 		= $getVal['title'];
							$article_author 	= $getVal['author'];
							$article_counts 	= number_format($getVal['counts']);
							$article_date 		= date("Y/m/d", strtotime($getVal['date']));
				?>
						<tr>
							<td><?=$getVal['id'];?></td>
							<td><a href="article.php?id=<?=$getVal['id'];?>"><?=$article_title;?></a></td>
							<td><?=$article_counts;?></td>
							<td><?=$article_date ;?></td>
							<td><?=$article_author;?></td>
						</tr>
				<?php
						}
						$count++;
					}
				?>
			  </tbody>
			</table>
		</div>
		<?php
			$getPage->getPageControler();
		?>
	</div>
	<?=$getTmp->setFooter();?>
  </body>
</html>