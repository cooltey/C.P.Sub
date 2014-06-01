<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */

 // Global Values
 // 管理員 使用者名稱
 $admin_user_name = "admin";
 // 管理員 使用者密碼
 $admin_user_password = "admin";
 // 管理員 暱稱
 $admin_user_nickname = "管理員";
 
 // 附屬使用者
 // 以陣列形式呈現
 $user_name 	= array();
 $user_password = array();
 $user_nickname = array();
 
 // 若需增加數量，請在中括號內新增數字即可。
 // 例如：$user_name[1] = "user1"; $user_password[1] = "passwd"; $user_nickname[1] = "姓名"
 $user_name[0] 		= "user1";
 $user_password[0] 	= "passwd";
 $user_nickname[0] 	= "姓名1";
 
 $user_name[1] 		= "user2";
 $user_password[1] 	= "passwd";
 $user_nickname[1] 	= "姓名2";
 
 
 // 預設檔案路徑
 $config_default_folder = "db";
 
 // 預設檔案路徑
 $config_setting_file_path = $config_default_folder. "/settings.txt";
 
 // 預設檔案路徑
 $config_article_file_path = $config_default_folder. "/article.txt";
  
 // 預設上傳資料夾路徑
 $config_upload_folder = "./upload/";