<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2014/6/9
 */
  
 $getData		= $_POST;
 $getFile 		= $_FILES;
 // set Article
 $getArticle 	= new Article($config_upload_folder, $config_article_file_path, $getLib);
 $getId			= $_GET['id'];
 
 // set add function
 $getResult = $getArticle->delArticle($getId);
 $msg 		= $getResult['msg'][0];
 // return to list
 $rPage = "./manage.php?p=article_list"; 
 echo $getLib->showAlertMsg($msg);
 echo $getLib->getRedirect($rPage);
 
?>