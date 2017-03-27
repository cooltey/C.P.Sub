<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2014/6/10
 */
 
class Lib{
	
	// 過濾文字設定
	var $set_filter = "0";
	// 去除反斜線
	var $set_stripslashes = "1";
	// 轉換字元
	var $set_htmlspecialchars = "1";
	
	function Lib($get_filter, $get_stripslahes){
		$this->set_filter 		= $get_filter;
		$this->set_stripslashes = $get_stripslahes;
	}
	
	// 簡易文字過濾
	function setFilter($get_string, $adv = false){
		$returnVal = $get_string;
		
		if($this->set_filter == "1"){
			$returnVal = strip_tags($returnVal);
		}
		
		if($this->set_stripslashes  == "1"){
			$returnVal = stripslashes($returnVal);
		}


		if($this->set_htmlspecialchars  == "1"){
			$returnVal = htmlspecialchars($returnVal);
		}

		if($adv == true){
			$returnVal =  htmlentities($returnVal, ENT_QUOTES, 'UTF-8');
		}
		
		return $returnVal;
	}
	
	// 檢查是否有數值
	function checkVal($get_val){
	
		$returnVal = false;
		
		if(isset($get_val) && $get_val != ""){
			$returnVal = true;
		}
		
		return $returnVal;
	}
	
	// check data status
	function checkFileStatus($get_val){
		
		$returnVal = false;
		
		// 確認是否有檔案
		if(is_file($get_val) || is_dir($get_val)){
			// 確認權限
			$get_premission = substr(decoct(fileperms($get_val)), 2);
		    if($get_premission != "0777"){
				@chmod($get_val, 0777);
			}
			$returnVal = true;
		}
		
		return $returnVal;
	}
	
	// get the path
	function checkAdminPath($page){
		$returnVal = null;
	 
		// default page path
		$admin_page_folder = "admin/";
		
		// check file exist	
		if(is_file($admin_page_folder.$page.".php")){
			$returnVal = $admin_page_folder.$page.".php";
		}
		
		return $returnVal;
	}
	
	// Success Msg
	function showSuccessMsg($get_msg_array){
		
		if(count($get_msg_array) > 0 && is_array($get_msg_array)){
			?>
				<div class="alert alert-success">
			<?php
				foreach($get_msg_array AS $showMsg){
				?>
				<li><?php echo $showMsg;?></li>
				<?php
				}
			?>		
				</div>
			<?php
		}
	}
	
	// Error Msg
	function showErrorMsg($get_error_array){
		
		if(count($get_error_array) > 0 && is_array($get_error_array)){
			?>
				<div class="alert alert-danger">
			<?php
				foreach($get_error_array AS $errorMsg){
				?>
				<li><?php echo $errorMsg;?></li>
				<?php
				}
			?>		
				</div>
			<?php
		}
	}
	
	// success dialog
	function showAlertMsg($get_string){
		$returnVal = $get_string;
		if($this->checkVal($returnVal)){
			$returnVal = "<script> alert('{$get_string}'); </script>";
		}
		
		return $returnVal;
	}
		
	// success dialog
	function getRedirect($get_string){
		$returnVal = $get_string;
		if($this->checkVal($returnVal)){
			$returnVal = "<script>window.location.href='{$get_string}'</script>";
		}
		
		return $returnVal;
	}	
	
	// for menu toggle
	function toggleMenu($page, $section){
		if(preg_match("/^{$section}/", $page)){
			echo "class=\"active\"";
		}
	}
	
	// general ip getter
	function getIp(){
		$ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
	
	// file upload
	function fileUpload($getFile, $input_name, $config_upload_folder){
		$returnVal = array("status" => false, "file" => array());
		
		$getTotalUploadFiles = count($getFile[$input_name]['name']);
	
		// execute upload process
		if($getTotalUploadFiles > 0){
			// upload loop
			for($i = 0; $i < $getTotalUploadFiles; $i++){
				if($this->checkVal($getFile[$input_name]['name'][$i])){
					// check file val
					if($getFile[$input_name]['error'][$i] == 0){
						$folder				 = $config_upload_folder;
				
						$file_tmp_name		 = $getFile[$input_name]['tmp_name'][$i];
						$file_display_name 	 = $this->setFilter($getFile[$input_name]['name'][$i]);
						$get_file_name_array = explode(".", $file_display_name);
						$get_file_subname    = $get_file_name_array[count($get_file_name_array)-1];
						$file_name		   	 = date("YmdHis").rand(0, 999).".".$get_file_subname;
						
						if(!file_exists($folder.$file_name) 
							&& $get_file_subname != "php"
							&& $get_file_subname != "asp"){
							try{
								move_uploaded_file($file_tmp_name, $folder.$file_name);
								
								$returnVal['status'] 		= true;								
								$returnVal['file'][$i]  	= $file_name;					
								$returnVal['file_name'][$i] = $file_display_name;
								
							}catch(Exception $e){		
							}
						}				
					}
				}
			}
		}
		
		return $returnVal;
	}
	
	
}