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
 
 $getData		= $_POST;
 $getFile 		= $_FILES;
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 $getArticle 	= new Article($config_article_file_path);
 $getId			= $_GET['id'];
 
 // check the submit btn has been submitted
 if($getLib->checkVal($getData['send'])){
	$error_msg_array = array();
 
    // check file status
	$getLib->checkFileStatus($config_default_folder);
	$getLib->checkFileStatus($config_article_file_path);

	// set get values
	$error_msg_array 			= array();
	$success_msg_array 			= array();
	$article_title 				= $getLib->setFilter($getData['article_title']);
	$article_author 			= $getLib->setFilter($getData['article_author']);
	$article_top 				= $getLib->setFilter($getData['article_top']);
	$article_content 			= $getLib->setFilter($getData['article_content']);
	$article_date				= date("Y-m-d H:i:s");
	$article_ip					= $getLib->getIp();	
	$article_files 				= array();
	$article_files_name			= array();
	$file_del_array				= $getData['article_file_del'];
	$file_remain				= $getData['article_file_remain'];
	$file_name_remain			= $getData['article_file_name_remain'];
	
	// check values
	if(!filter_has_var(INPUT_POST, "article_title") || !$getLib->checkVal($article_title)){
		$error_msg = "請輸入標題";
		array_push($error_msg_array, $error_msg);
	}
	
	if(!filter_has_var(INPUT_POST, "article_author") || !$getLib->checkVal($article_author)){
		$error_msg = "請輸入發佈單位";
		array_push($error_msg_array, $error_msg);
	}
	
	if(!filter_has_var(INPUT_POST, "article_content") || !$getLib->checkVal($article_content)){
		$error_msg = "請輸入內文";
		array_push($error_msg_array, $error_msg);
	}
	
	if(!$getLib->checkVal($article_top)){
		$article_top = "0";
	}
	
	// orgnize the upload column
	if(!empty($file_remain)){
		$count = 0;
		foreach($file_remain AS $fileData){
			// skip del file
			if(@in_array($count, $file_del_array)){
				// del file
				@unlink($config_upload_folder.$fileData);
			}else{
				// push data
				array_push($article_files, $fileData);
				array_push($article_files_name, $file_name_remain[$count]);
			}
			$count++;
		}
	}
	
	// set upload
	$uploadResult = $getLib->fileUpload($getFile, "article_file", $config_upload_folder);
	
	$getTotalUploadFiles = count($getFile['article_file']['name']);

	if($getLib->checkVal($getFile['article_file']['name'][0])){
		if($uploadResult['status'] != true){
			$error_msg = "上傳檔案錯誤，請檢查您的檔案！".$getTotalUploadFiles;
			array_push($error_msg_array, $error_msg);
		}else{
			// merge array
			$new_article_files_array 			= array_merge($article_files, $uploadResult['file']);
			$new_article_files_name_array 		= array_merge($article_files_name, $uploadResult['file_name']);
			$article_files 						= implode(",", $new_article_files_array);
			$article_files_name 				= implode(",", $new_article_files_name_array);
		}
	}else{
		$article_files 						= implode(",", $article_files);
		$article_files_name 				= implode(",", $article_files_name);
	}
	
	
	// 進行資料庫存取
	if(count($error_msg_array) == 0){
		try{
			
			// update new data
			$columnArray = array($getId,
								$article_title,
								$article_author,
								$article_top,
								$article_content,
								$article_files,
								$article_files_name,
								$article_date,
								$article_ip,
								0);
								
			$getArticle->editArticle($columnArray);
			
			$success_msg = "更新文章成功！";
			array_push($success_msg_array, $success_msg);
		
		}catch(Exception $e){
			$error_msg = "資料庫錯誤 <br />{$e}";
			array_push($error_msg_array, $error_msg);
		}
	}
	
 }
 
 // check id & show contents
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
								    <a href="<?=$config_upload_folder.$fileData;?>" target="_blank"><?=$article_files_name[$count];?></a>
									<input type="hidden" value="<?=$fileData;?>" name="article_file_remain[]">
									<input type="hidden" value="<?=$article_files_name[$count];?>" name="article_file_name_remain[]">
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