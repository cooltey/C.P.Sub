<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
 // include configuration file
 include_once("config/config.php");
 // include setting file
 include_once("config/settings.php");
 // include library file
 include_once("class/lib.php");
 // include article file
 include_once("class/article.php");
 
 $getData		= $_GET;
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 $getArticle 	= new Article($config_article_file_path);
 $getId			= $_GET['id'];
 
 // check id
 if(filter_has_var(INPUT_GET, "id")){
	if(filter_var($getId, FILTER_VALIDATE_INT)){
		$getId = intval($getLib->setFilter($getId));
		
		// get article data
		$getArticleData = $getArticle->getArticle($getId);
		
		if(empty($getArticleData)){		
			$return_page = "./manage.php?p=article_list";
			echo $getLib->showAlertMsg("參數錯誤");
			echo $getLib->getRedirect($return_page);	
		}else{
			$article_title 		= $getArticleData['title'];
			$article_author 	= $getArticleData['author'];
			if($getArticleData['top'] == "1"){
				$article_top = " checked";
			}else{
				$article_top = "";			
			}
			$article_content 	= $getArticleData['content'];
			$article_files 		= explode(",", $getArticleData['files']);
			$article_files_name	= explode(",", $getArticleData['files_name']);
		}
	}else{
		$return_page = "./manage.php?p=article_list";
		echo $getLib->showAlertMsg("參數錯誤");
		echo $getLib->getRedirect($return_page);	
	}
 }else{
	$return_page = "./manage.php?p=article_list";
	echo $getLib->showAlertMsg("參數錯誤");
	echo $getLib->getRedirect($return_page);
 }
?>
		<!--CK Editor -->
		<script src="js/ckeditor/ckeditor.js"></script>
	    <script src="js/ckeditor/adapters/jquery.js"></script>
		<!--CK Editor -->
		<form class="form-horizontal" role="form" action="manage.php?p=add" method="post">
		  <div class="form-group">
			<label for="article_title" class="col-lg-2 control-label">標題</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="article_title" name="article_title" placeholder="標題" value="<?=$article_title;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">發佈單位</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="article_author" name="article_author" placeholder="發佈單位" value="<?=$article_author;?>">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <div class="checkbox">
				<label>
				  <input type="checkbox" name="article_top" value="1" <?=$article_top;?>> 置頂
				</label>
			  </div>
			</div>
		  </div>
		   <div class="form-group">
			<label for="article_file" class="col-lg-2 control-label">上傳附件</label>
			<div class="col-lg-10">
				<input type="file" name="article_file[]" id="article_file">
				<p class="help-block cursor-pointer" id="add_more_file"><span class="glyphicon glyphicon-plus"></span>添加更多附件</p>
				<?php
					if(count($article_files) > 0 && $getLib->checkVal($article_files[0])){
				?>
						<div class="list-group">
						  <a class="list-group-item active">
							檔案列表
						  </a>
						<?php
							// show files
							$count = 0;
							foreach($article_files AS $fileData){
							?>
								<div class="list-group-item"><a href="#"><?=$article_files_name[$count];?></a><span class="glyphicon glyphicon-remove pull-right"></span></div>
								<input type="hidden" value="<?=$fileData;?>" name="article_file_remain[]">
							<?php
								$count++;
							}
						?>
						</div>
				<?php
					}
				?>
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">文章內容</label>
			<div class="col-lg-10">
			  	<textarea name="article_content" class="ckeditor"><?=$article_content;?></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default">發佈</button>
			</div>
		  </div>
		</form>