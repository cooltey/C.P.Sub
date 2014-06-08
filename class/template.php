<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
class Template{
	
	function Template(){
	}
	
	function setHeader($title){
		?>
		    <title><?=$website_title;?></title>
			<meta charset="utf-8"> 
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- Bootstrap -->
			<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="css/custom.css" rel="stylesheet" media="screen">
			<!-- Jquery -->
			<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
			<script src="js/bootstrap.min.js"></script>	
			<script src="js/manage.js"></script>
		<?php
	}
	
	function setFooter(){
		?>
			<div class="footer">
				C.P.Sub 公告系統 V5.0 Powered by <a href="http://www.cooltey.org" target="_blank">Cooltey</a>
			</div>
		<?php
	}
}