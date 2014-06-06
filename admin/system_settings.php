<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
 $system_title 				= $cpsub['title'];
 $system_filter 			= $cpsub['filter'];
 $system_stripslashes 		= $cpsub['stripslashes'];
 $system_display_num 		= $cpsub['display_num'];
 $system_display_page_num 	= $cpsub['display_page_num'];
 
 $selector_array			= array("0" => "否", "1" => "是");
?>
		<!--CK Editor -->
		<script src="js/ckeditor/ckeditor.js"></script>
	    <script src="js/ckeditor/adapters/jquery.js"></script>
		<!--CK Editor -->
		<form class="form-horizontal" role="form" action="manage.php?p=settings&act=update" method="post">
		  <div class="form-group">
			<label for="cpsub_title" class="col-lg-2 control-label">公告系統標題</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="cpsub_title" name="cpsub_title" placeholder="公告系統標題" value="<?=$system_title;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="cpsub_filter" class="col-lg-2 control-label">是否過濾 HTML 語法？</label>
			<div class="col-lg-10">
			  	<select class="form-control" name="cpsub_filter">
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
			<label for="cpsub_filter" class="col-lg-2 control-label">是否過濾去除反斜線(如果您無法更改伺服器設定時)？</label>
			<div class="col-lg-10">
			  	<select class="form-control" name="cpsub_filter">
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
			<label for="cpsub_display_number" class="col-lg-2 control-label">每頁文章顯示數量</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="cpsub_display_number" name="cpsub_display_number" placeholder="請輸入數字" value="<?=$system_display_num;?>">
			</div>
		  </div>
		  <div class="form-group">
			<label for="cpsub_display_page_number" class="col-lg-2 control-label">頁數顯示數量</label>
			<div class="col-lg-10">
			  	<input type="text" class="form-control" id="cpsub_display_page_number" name="cpsub_display_page_number" placeholder="請輸入數字" value="<?=$system_display_page_num;?>">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-lg-offset-2 col-lg-10">
			  <button type="submit" class="btn btn-default">儲存</button>
			</div>
		  </div>
		</form>