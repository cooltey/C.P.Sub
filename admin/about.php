<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2025/05/19
 */
	
	// get json information
	$aboutData	= json_decode(file_get_contents($config_about_author));
	$label_color = array("default", "primary", "info", "danger", "success");
?>
	<div class="jumbotron">
	  <div class="container">
		<h1>感謝您的使用</h1>
		<hr></hr>
		<p>
		歡迎前往 GitHub 頁面查看版本資訊：<a href="https://github.com/cooltey/C.P.Sub" target="_blank">https://github.com/cooltey/C.P.Sub</a>
		</p>
	  </div>
	</div>