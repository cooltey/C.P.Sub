<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
	
	// get json information
	$aboutData	= json_decode(file_get_contents($config_about_author));
	$label_color = array("default", "primary", "info", "danger", "success");
?>
	<div class="jumbotron">
	  <div class="container">
		<h1>感謝您的使用</h1>
		<?php			
			echo "<hr></hr>";
			echo "<p>". $aboutData->msg ."</p>";			
			echo "<hr></hr>";
			echo "<p class=\"small_font\">最新版本：". $aboutData->latest_version;
			if($aboutData->latest_version != $config_current_version){
				echo "<a href=\"".$aboutData->project_link."\" target=\"_blank\" class=\"label label-warning margin_box\">前往下載最新版本</a>";
			}
			echo "<p class=\"small_font\">更新日期：". $aboutData->latest_update ."</p>";
			echo "<p class=\"small_font\">作者：". $aboutData->author ."</p>";
			$count = 0;
			foreach($aboutData->links AS $linkKey => $linkVal){
				echo "<a class=\"btn btn-".$label_color[$count]." btn-lg margin_box small_font\" href=\"". $linkVal ."\" target=\"_blank\">". $linkKey ."</a>";
				$count++;
			}
		?>
	  </div>
	</div>