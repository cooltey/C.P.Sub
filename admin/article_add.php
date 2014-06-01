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
 
 $getLib = new Lib($cpsub['filter'], $cpsub['stripslashes']);
 
 // transfer data
 $getData = $_POST;
 $getFile = $_FILES;
 
 $display_message = "";
 $execute_result  = null;
 
 // check the submit btn has been submitted
 if($getLib->checkVal($getData['send'])){
	$error_msg_array = array();
 
    // check file status
	$getLib->checkFileStatus($config_default_folder);
	$getLib->checkFileStatus($config_article_file_path);

	// set get values
	$error_msg_array = array();
	$success_msg_array = array();
	$article_title 				= $getLib->setFilter($getData['article_title']);
	$article_author 			= $getLib->setFilter($getData['article_author']);
	$article_top 				= $getLib->setFilter($getData['article_top']);
	$article_content 			= $getLib->setFilter($getData['article_content']);
	$article_date				= date("Y-m-d H:i:s");
	$article_ip					= $getLib->getIp();
	
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
	
	if($getLib->checkVal($article_top)){
		$article_top = "0";
	}
	
	// set upload
	$uploadResult = $getLib->fileUpload($getFile, "article_file", $config_upload_folder);
	
	$getTotalUploadFiles = count($getFile['article_file']['name']);

	if($getLib->checkVal($getFile['article_file']['name'][0])){
		if($uploadResult['status'] != true){
			$error_msg = "上傳檔案錯誤，請檢查您的檔案！".$getTotalUploadFiles;
			array_push($error_msg_array, $error_msg);
		}else{
			$article_files = implode(",", $uploadResult);
		}
	}
	
	// 進行資料庫存取
	if(count($error_msg_array) == 0){
		try{
			// result array
			$resultArray  = array();
			
			// read csv file
			$csvIndex = 1;
			if (($handle = fopen($config_article_file_path, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
					$columnArray = array($csvIndex,
										$data[0],
										$data[1],
										$data[2],
										$data[3],
										$data[4],
										$data[5],
										$data[6]);			
					$csvIndex++;
					
					array_push($resultArray, $columnArray);
				}
				fclose($handle);
			}
			
			// add new data
			$columnArray = array($csvIndex,
								$article_title,
								$article_author,
								$article_top,
								$article_content,
								$article_files,
								$article_date,
								$article_ip);
			array_push($resultArray, $columnArray);
			
			// put data into csv
			$fp = fopen($config_article_file_path, "w");

			foreach ($resultArray as $fields) {
				fputcsv($fp, $fields);
			}

			fclose($fp);
			
			$success_msg = "新增文章成功！";
			array_push($success_msg_array, $success_msg);
		
		}catch(Exception $e){
			$error_msg = "資料庫錯誤 <br />{$e}";
			array_push($error_msg_array, $error_msg);
		}
	}
 }

?>
		<?php $getLib->showErrorMsg($error_msg_array);?>
		<?php $getLib->showSuccessMsg($success_msg_array);?>
		
		<!--CK Editor -->
		<script src="js/ckeditor/ckeditor.js"></script>
	    <script src="js/ckeditor/adapters/jquery.js"></script>
		<!--CK Editor -->
		<form class="form-horizontal" role="form" action="manage.php?p=article_add" method="post" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="article_title" class="col-lg-2 control-label">標題</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="article_title" name="article_title" placeholder="標題">
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">發佈單位</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="article_author" name="article_author" placeholder="發佈單位">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <div class="checkbox">
				<label>
				  <input type="checkbox" name="article_top" value="1"> 置頂
				</label>
			  </div>
			</div>
		  </div>
		   <div class="form-group">
			<label for="article_file" class="col-lg-2 control-label">上傳附件</label>
			<div class="col-lg-10">
				<input type="file" name="article_file[]" id="article_file">
				<p class="help-block cursor-pointer" id="add_more_file"><span class="glyphicon glyphicon-plus"></span>添加更多附件</p>
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">文章內容</label>
			<div class="col-lg-10">
			  	<textarea name="article_content" class="ckeditor"></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default" name="send" value="send">發佈</button>
			</div>
		  </div>
		</form>