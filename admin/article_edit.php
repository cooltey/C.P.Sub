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
 
?>
		<!--CK Editor -->
		<script src="js/ckeditor/ckeditor.js"></script>
	    <script src="js/ckeditor/adapters/jquery.js"></script>
		<!--CK Editor -->
		<form class="form-horizontal" role="form" action="manage.php?p=add" method="post">
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
				  <input type="checkbox" name="article_top"> 置頂
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
			  <button type="submit" class="btn btn-default">發佈</button>
			</div>
		  </div>
		</form>