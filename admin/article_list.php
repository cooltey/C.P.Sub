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
 
 $getLib 		= new Lib($cpsub['filter'], $cpsub['stripslashes']);
 $getArticle 	= new Article($config_article_file_path);
 
 // get article list					
 $getListArray = $getArticle->getAllList("display", "id", "desc");
?>
		<div class="panel panel-default">
			<table class="table table-hover">
			  <thead>
				<tr>
					<th width="5%">編號</th>
					<th width="55%">標題</th>
					<th width="10%">觀看次數</th>
					<th width="10%">日期</th>
					<th width="10%">發佈人</th>
					<th width="5%">編輯</th>
					<th width="5%">刪除</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					foreach($getListArray AS $getKey => $getVal){
						$article_id 		= $getVal['id'];
						$article_title 		= $getVal['title'];
						$article_author 	= $getVal['author'];
						$article_counts 	= number_format($getVal['counts']);
						$article_date 		= date("Y/m/d", strtotime($getVal['date']));
				?>
					<tr>
						<td><?=$getVal['id'];?></td>
						<td><a href="article.php"><?=$article_title;?></a></td>
						<td><?=$article_counts;?></td>
						<td><?=$article_date ;?></td>
						<td><?=$article_author;?></td>
						<td><a href="?p=article_edit&id=<?=$article_id;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
						<td><a href="?p=article_del&id=<?=$article_id;?>"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
				<?php
					}
				?>
			  </tbody>
			</table>
		</div>
		<ul class="pagination pull-right">
		  <li class="disabled"><a href="#">&laquo;</a></li>
		  <li class="active"><a href="#">1</a></li>
		  <li><a href="#">2</a></li>
		  <li><a href="#">3</a></li>
		  <li><a href="#">4</a></li>
		  <li><a href="#">5</a></li>
		  <li><a href="#">&raquo;</a></li>
		</ul>