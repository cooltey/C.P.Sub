<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2020/12/19
 */
 
class Settings{

	var $filePath;
	var $fileContent;
	
	function __construct($getPath){
		$this->filePath = $getPath;
	}
	
	function getFile(){
		// Read content
		$this->fileContent = file($this->filePath);
	}
	
	function updateSettings($getData, $getLib){
	
		$msg_array 					= array();
		$return_status				= false;
		$returnVal = array("status" => $return_status, "msg" => $msg_array);
		
		try{		
			// check the submit btn has been submitted
			 if(isset($getData['send']) && $getLib->checkVal($getData['send'])){

				// set get values
				$system_title 				= $getLib->setFilter($getData['system_title']);
				$system_filter 				= $getLib->setFilter($getData['system_filter']);
				$system_stripslashes 		= $getLib->setFilter($getData['system_stripslashes']);
				$system_display_num 		= $getLib->setFilter($getData['system_display_number']);
				$system_display_page_num	= $getLib->setFilter($getData['system_display_page_number']);
				$system_csrf_protection		= $getLib->setFilter($getData['system_csrf_protection']);
				
				// check values
				if(!filter_has_var(INPUT_POST, "system_title") || !$getLib->checkVal($system_title)){
					$error_msg = "請輸入標題";
					array_push($msg_array, $error_msg);
				}
				
				// check values
				if(!filter_has_var(INPUT_POST, "system_display_number") || !$getLib->checkVal($system_display_num)){
					$error_msg = "請輸入每頁顯示筆數";
					array_push($msg_array, $error_msg);
				}
				
				// check values
				if(!filter_has_var(INPUT_POST, "system_display_page_number") || !$getLib->checkVal($system_display_page_num)){
					$error_msg = "請輸入頁碼顯示筆數";
					array_push($msg_array, $error_msg);
				}
				
				// 進行資料庫存取
				if(count($msg_array) == 0){
					try{
					
						$fp = fopen($this->filePath, "w");
						fwrite($fp, $system_title."\n");
						fwrite($fp, $system_filter."\n");
						fwrite($fp, $system_stripslashes."\n");
						fwrite($fp, $system_display_num."\n");
						fwrite($fp, $system_display_page_num."\n");
						fwrite($fp, $system_csrf_protection);
						fclose($fp);
								
						$success_msg = "設定更新成功！";
						array_push($msg_array, $success_msg);
						
						$return_status = true;
					}catch(Exception $e){
						$error_msg = "資料庫錯誤 <br />{$e}";
						array_push($msg_array, $error_msg);
					}
				}
			}
		}catch(Exception $e){
		}
		
		$returnVal = array("status" => $return_status, "msg" => $msg_array);
		
		return $returnVal;
	}
	
	function getSettings(){
		$returnVal = array();
		
		try{
			// initial 
			$this->getFile();
			
			// assign values
			list($returnVal['title'], 
				 $returnVal['filter'], 
				 $returnVal['stripslashes'], 
				 $returnVal['display_num'], 
				 $returnVal['display_page_num'], 
				 $returnVal['csrf_protection']) = $this->fileContent;
				 
			// trim the data
			$returnVal['title'] 			= trim($returnVal['title']);
			$returnVal['filter'] 			= trim($returnVal['filter']);
			$returnVal['stripslashes'] 		= trim($returnVal['stripslashes']);
			$returnVal['display_num'] 		= trim($returnVal['display_num']);
			$returnVal['display_page_num'] 	= trim($returnVal['display_page_num']);
			$returnVal['csrf_protection'] 	= trim($returnVal['csrf_protection']);
		}catch(Exception $e){
			
		}

		return $returnVal;
	}
}