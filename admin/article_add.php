<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2014/6/9
 */
 
$getArticle 	= new Article($config_upload_folder, $config_article_file_path, $config_ip_file_path, $getLib); 
 
 // transfer data
 $getData = $_POST;
 $getFile = $_FILES;
  
 // check CSRF
 if (isset($getData)) {
	$getCSRF->checkToken($getData);
 }
 
 // set add function
 $getResult = $getArticle->addNewArticle($getData, $getFile);
 
 if($getResult['status'] == true){	
	$success_msg_array = $getResult['msg'];
 	$error_msg_array = array();
	unset($getData);
 }else{
 	$success_msg_array = array();
	$error_msg_array   = $getResult['msg'];
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
			  	<input type="text" class="form-control" id="article_title" name="article_title" placeholder="標題" value="<?=@$getLib->setFilter($getData['article_title']);?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">發佈單位</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="article_author" name="article_author" placeholder="發佈單位" value="<?=@$getLib->setFilter($getData['article_author']);?>">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <div class="checkbox">
				<label>
				  <?php
					if(isset($getData['article_top']) && $getData['article_top'] == "1"){
						$checked = "checked";
					}else{
						$checked = "";
					}
				  ?>
				  <input type="checkbox" name="article_top" value="1" <?=$checked;?>> 置頂
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_file" class="col-lg-2 control-label">上傳附件</label>
			<div class="col-lg-10">
				<input type="file" name="article_file[]" id="article_file" class="form-control" >
				<p class="help-block cursor-pointer" id="add_more_file"><span class="glyphicon glyphicon-plus"></span>添加更多附件</p>
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_file" class="col-lg-2 control-label">發佈時間</label>
			<div class="col-lg-10">
				<input type="text" name="article_date" value="<?=date("Y-m-d H:i:s");?>" class="form-control auto_selectbar" > (年-月-日 時:分:秒) 
			</div>
		  </div>
		  <div class="form-group">
			<label for="article_author" class="col-lg-2 control-label">文章內容</label>
			<div class="col-lg-10">
			  	<textarea name="article_content" class="ckeditor"><?=@$getLib->setFilter($getData['article_content']);?></textarea>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default" name="send" value="send">發佈</button>
			</div>
		  </div>
		  <?php echo $getCSRF->genTokenField();?>
		</form>