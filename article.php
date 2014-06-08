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
 $getId			= $_GET['id'];
 // set Article
 $getArticle 	= new Article($config_upload_folder, $config_article_file_path, $getLib);
 // add view counts
 $getArticleResult = $getArticle->addViewCounts($getId);
 // get single article
 $getArticleResult = $getArticle->getArticle($getId);
 
 if($getArticleResult['status'] == true){ 
	$getArticleData		= $getArticleResult['data'];
	// get colum values
	$article_title 		= $getArticleData['title'];
	$article_author 	= $getArticleData['author'];
	$article_date 		= $getArticleData['date'];
	$article_content 	= $getArticleData['content'];
	$article_counts 	= $getArticleData['counts'];
	$article_files 		= explode(",", $getArticleData['files']);
	$article_files_name	= explode(",", $getArticleData['files_name']);
	
	if($getArticleData['top'] == "1"){
		$article_top = " checked";
	}else{
		$article_top = "";			
	}

 }else{ 
	$return_page = "./index.php";
	echo $getLib->showAlertMsg("參數錯誤");
	echo $getLib->getRedirect($return_page);
 }
 
 
 // current page
 $website_current_page = "閱讀文章"; 
 
 // get title
 $website_title = $getLib->setFilter($cpsub['title']). "-" .$website_current_page. "-" .$article_title;
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
			<p class="navbar-text navbar-right"><a href="index.php">回首頁</a></p>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title"><?=$article_title;?></h3>
		  </div>
		  <div class="panel-body"><?=$article_content;?></div>
		  <ul class="list-group">
		  <?php
			if(count($article_files) > 0 && $getLib->checkVal($article_files[0])){
		  ?>
			<li class="list-group-item">附件下載
				<ul class="list-group">
				<?php
					// show files
					$count = 0;
					foreach($article_files AS $fileData){
				?>
						<li class="list-group-item">
							<a href="<?=$config_upload_folder.$fileData;?>" target="_blank">
							<span class="glyphicon glyphicon-cloud-download pull-left download_icon"></span>
							<?=$article_files_name[$count];?>
							</a>
						</li>
				<?php
						$count++;
					}
				?>
				</ul>
			</li>
		  <?php
			}
		  ?>
			<li class="list-group-item">發佈人：<?=$article_author;?><br>發佈日期：<?=$article_date;?><span class="pull-right">觀看人數：<?=$article_counts;?></span></li>
		  </ul>
		</div>
	</div>
	<?=$getTmp->setFooter();?>
  </body>
</html>