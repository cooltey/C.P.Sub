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
		<div class="panel panel-default">
			<table class="table table-hover">
			  <thead>
				<tr>
					<th width="7%">編號</th>
					<th width="63%">標題</th>
					<th width="10%">觀看次數</th>
					<th width="5%">日期</th>
					<th width="5%">發佈人</th>
					<th width="5%">編輯</th>
					<th width="5%">刪除</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
					<td><a href="?p=edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
					<td><a href="?p=del"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
					<td><span class="glyphicon glyphicon-pencil"></span></td>
					<td><span class="glyphicon glyphicon-trash"></span></td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
					<td><span class="glyphicon glyphicon-pencil"></span></td>
					<td><span class="glyphicon glyphicon-trash"></span></td>
				</tr>
				<tr>
					<td>1</td>
					<td><a href="article.php">測試標題</a></td>
					<td>3,410</td>
					<td>2013/06/01</td>
					<td>Cooltey</td>
					<td><span class="glyphicon glyphicon-pencil"></span></td>
					<td><span class="glyphicon glyphicon-trash"></span></td>
				</tr>
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