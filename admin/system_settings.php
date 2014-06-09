<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2014/6/9
 */
 
 // transfer data
 $getData = $_POST;
  
 $selector_array			= array("0" => "否", "1" => "是");
 
 $getResult = $getSettings->updateSettings($getData, $getLib);
 
 if($getResult['status'] == true){	
	$success_msg_array = $getResult['msg'];
	$new_msg = "若設定未更新，請<a href=\"./manage.php?p=system_settings\">按此</a>重新載入";
	array_push($success_msg_array, $new_msg);
	
	// update setting lib
	$getSettings 	= new Settings($config_setting_file_path);
	$cpsub			= $getSettings->getSettings();
 }else{
	$error_msg_array   = $getResult['msg'];
 }
 
 
 // get setting data
 $system_title 				= $getLib->setFilter($cpsub['title']);
 $system_filter 			= $getLib->setFilter($cpsub['filter']);
 $system_stripslashes 		= $getLib->setFilter($cpsub['stripslashes']);
 $system_display_num 		= $getLib->setFilter($cpsub['display_num']);
 $system_display_page_num 	= $getLib->setFilter($cpsub['display_page_num']);
?>
		<?php $getLib->showErrorMsg($error_msg_array);?>
		<?php $getLib->showSuccessMsg($success_msg_array);?>
		
		<form class="form-horizontal" role="form" action="manage.php?p=system_settings" method="post">
		  <div class="form-group">
			<label for="system_title" class="col-lg-2 control-label">公告系統標題</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="system_title" name="system_title" placeholder="公告系統標題" value="<?=$system_title;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="system_filter" class="col-lg-2 control-label">是否過濾 HTML 語法？</label>
			<div class="col-lg-10">
			  	<select class="form-control" name="system_stripslashes">
				<?php
					foreach($selector_array AS $oKey => $oVal){
						$selected = "";
						
						if($oKey == $system_stripslashes){
							$selected = "selected";
						}
					?>						
						<option value="<?=$oKey;?>" <?=$selected;?>><?=$oVal;?></option>
					<?php
					}
				?>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="system_filter" class="col-lg-2 control-label">是否過濾去除反斜線(如果您無法更改伺服器設定時)？</label>
			<div class="col-lg-10">
			  	<select class="form-control" name="system_filter">
				  <?php
					foreach($selector_array AS $oKey => $oVal){
						$selected = "";
						
						if($oKey == $system_filter){
							$selected = "selected";
						}
					?>						
						<option value="<?=$oKey;?>" <?=$selected;?>><?=$oVal;?></option>
					<?php
					}
				  ?>
				</select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="system_display_number" class="col-lg-2 control-label">每頁文章顯示數量</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="system_display_number" name="system_display_number" placeholder="請輸入數字" value="<?=$system_display_num;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="system_display_page_number" class="col-lg-2 control-label">頁數顯示數量</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="system_display_page_number" name="system_display_page_number" placeholder="請輸入數字" value="<?=$system_display_page_num;?>">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default" name="send" value="send">儲存</button>
			</div>
		  </div>
		</form>