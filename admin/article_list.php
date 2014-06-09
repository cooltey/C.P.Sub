<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
 // set Article
 $getArticle 	= new Article($config_upload_folder, $config_article_file_path, $getLib);
 $page    	= $_GET['page'];
 // get article list					
 $getListArray  = $getArticle->getAllList("display", "id", "desc");
 $getListSum    = count($getListArray);
 // set pager 
 $many	 		= $cpsub['display_num'];
 $display 		= $cpsub['display_page_num'];
 $total	 		= $getListSum;
 $pagename		= "?p=article_list&";
 $getPage 		= new Pager($page, $many, $display, $total, $pagename);
 $pageStart  	= intval($getPage->startVar);
 $pageMany  	= intval($getPage->manyVar);
 
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
					$count = 0;
					foreach($getListArray AS $getKey => $getVal){
						if($count >= $pageStart && $count < ($pageMany+$pageStart)){
							$article_id 		= $getLib->setFilter($getVal['id']);
							$article_title 		= $getLib->setFilter($getVal['title']);
							$article_author 	= $getLib->setFilter($getVal['author']);
							$article_counts 	= number_format($getLib->setFilter($getVal['counts']));
							$article_date 		= date("Y/m/d", strtotime($getLib->setFilter($getVal['date'])));
							if($getVal['top'] == "1"){
								$article_top = "<span class=\"label label-default margin_box\">置頂</span>";
							}else{
								$article_top = "";
							}
				?>
						<tr>
							<td><?=$getVal['id'];?></td>
							<td><?=$article_top;?><a href="article.php?id=<?=$getVal['id'];?>"><?=$article_title;?></a></td>
							<td><?=$article_counts;?></td>
							<td><?=$article_date ;?></td>
							<td><?=$article_author;?></td>
							<td><a href="?p=article_edit&id=<?=$article_id;?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
							<td><a href="?p=article_del&id=<?=$article_id;?>"><span class="glyphicon glyphicon-trash"></span></a></td>
						</tr>
				<?php
						}
						$count++;
					}
				?>
			  </tbody>
			</table>
		</div>
		<?php
			$getPage->getPageControler();
		?>