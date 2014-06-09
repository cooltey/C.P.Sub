<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
  
 $getData		= $_POST;
 $getFile 		= $_FILES;
 // set Article
 $getArticle 	= new Article($config_upload_folder, $config_article_file_path, $getLib);
 $getId			= $_GET['id'];
 
 // set add function
 $getResult = $getArticle->editArticle($getData, $getFile);
 
 if($getResult['status'] == true){	
	$success_msg_array = $getResult['msg'];
 }else{
	$error_msg_array   = $getResult['msg'];
 }
 
 // get single article
 $getArticleResult = $getArticle->getArticle($getId);
 if($getArticleResult['status'] == true){ 
	$getArticleData		= $getArticleResult['data'];
	// get colum values
	$article_title 		= $getLib->setFilter($getArticleData['title']);
	$article_author 	= $$getLib->setFilter(getArticleData['author']);
	$article_date 		= $getLib->setFilter($getArticleData['date']);
	$article_content 	= $getLib->setFilter($getArticleData['content']);
	$article_files 		= explode(",", $getArticleData['files']);
	$article_files_name	= explode(",", $getArticleData['files_name']);
	
	if($getArticleData['top'] == "1"){
		$article_top = " checked";
	}else{
		$article_top = "";			
	}
 }else{ 
	$return_page = "./manage.php?p=article_list";
	echo $getLib->showAlertMsg("參數錯誤");
	echo $getLib->getRedirect($return_page);
 }
 
 
?>
		<?php $getLib->showErrorMsg($error_msg_array);?>
		<?php $getLib->showSuccessMsg($success_msg_array);?>
		
		<!--CK Editor -->
		<script src="js/ckeditor/ckeditor.js"></script>
	    <script src="js/ckeditor/adapters/jquery.js"></script>
		<!--CK Editor -->
		<form class="form-horizontal" role="form" action="manage.php?p=article_edit&id=<?=$getId;?>" method="post" enctype="multipart/form-data">
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
								<div class="list-group-item">
								    <a href="<?=$config_upload_folder.$getLib->setFilter($fileData);?>" target="_blank"><?=$getLib->setFilter($article_files_name[$count]);?></a>
									<input type="hidden" value="<?=$getLib->setFilter($fileData);?>" name="article_file_remain[]">
									<input type="hidden" value="<?=$getLib->setFilter($article_files_name[$count]);?>" name="article_file_name_remain[]">
								    <label class="pull-right">刪除檔案
										<input type="checkbox" value="<?=$count;?>" name="article_file_del[]">
									</label>
								</div>
								
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
			<label for="article_file" class="col-lg-2 control-label">發佈時間</label>
			<div class="col-lg-10">
				<input type="text" name="article_date" value="<?=$article_date;?>" class="form-control auto_selectbar" > (年-月-日 時:分:秒) 
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
			  <button type="submit" class="btn btn-default" name="send" value="send">更新</button>
			</div>
		  </div>
		</form>