<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2017/7/8
 */
 
 session_start();

 // Global Values
 // 以陣列形式呈現
 $config_account_data = array();
 
 $add_user	= array("username" => "admin", // 帳號
					"password" => "admin", // 密碼
					"nickname" => "管理員" // 管理員
					); 
 array_push($config_account_data, $add_user);
 
 // 若需增加數量，請在陣列中新增即可
 // 新增完需利用 array_push 加入陣列
 
 // 範例
 /*******
 $add_user	= array("username" => "user1", // 帳號
					"password" => "user1", // 密碼
					"nickname" => "使用者1" // 管理員
					); 
 array_push($config_account_data, $add_user);
 ********/
 
 
 // 預設檔案路徑
 $config_default_folder = "db";
 
 // 預設檔案路徑
 $config_setting_file_path = $config_default_folder. "/settings.txt";
 
 // 預設檔案路徑
 $config_article_file_path = $config_default_folder. "/article.txt";

 // 預設檔案路徑
 $config_ip_file_path = $config_default_folder. "/ip.txt";
  
 // 預設上傳資料夾路徑
 $config_upload_folder = "./upload/";
 
 // 關於作者
 $config_about_author = "http://www.cooltey.org/cpsub/json/about_json.php";
 
 $config_current_version = "v5.21";
 $config_current_update  = "2017/4/6";