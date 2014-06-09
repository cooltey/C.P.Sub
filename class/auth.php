<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2014/6/9
 */
 
class Auth{
	
	var $accountData;
	var $getLib;
	
	function Auth($account_data, $getLib){
		$this->accountData 	= $account_data;
		$this->getLib 		= $getLib;
	}
	
	function setLogin($getData){
	
		$returnVal = array("status" => false, "msg" => array());
		
		try{
			if($this->getLib->checkVal($getData['send'])){

				// set get values
				$msg_array 					= array();
				$return_status				= false;
				$cpsub_username 			= $this->getLib->setFilter($getData['cpsub_username']);
				$cpsub_password		 		= $this->getLib->setFilter($getData['cpsub_password']);
				
				// check values
				if(!filter_has_var(INPUT_POST, "cpsub_username") || !$this->getLib->checkVal($cpsub_username)){
					$error_msg = "請輸入帳號";
					array_push($msg_array, $error_msg);
				}

				// check values
				if(!filter_has_var(INPUT_POST, "cpsub_password") || !$this->getLib->checkVal($cpsub_password)){
					$error_msg = "請輸入密碼";
					array_push($msg_array, $error_msg);
				}			
				
				// check
				if(count($msg_array) == 0){
					try{
					
						// start check 
						foreach($this->accountData AS $aData){
							if($aData['username'] == $cpsub_username){
								if($aData['password'] == $cpsub_password){
								
									$_SESSION['login'] 				= "1";
									$_SESSION['cpsub_username'] 	= $aData['username'];
									$_SESSION['cpsub_password'] 	= $aData['password'];
									$_SESSION['cpsub_nickname'] 	= $aData['nickname'];
									
									$success_msg = "登入成功！";
									array_push($msg_array, $success_msg);
									
									// set status
									$return_status = true;
								}else{
									$error_msg = "密碼錯誤";
									array_push($msg_array, $error_msg);								
								}
							}else{							
								$error_msg = "查無帳號";
								array_push($msg_array, $error_msg);
							}
						}
					
					}catch(Exception $e){
						$error_msg = "登入失敗 <br />{$e}";
						array_push($msg_array, $error_msg);
					}
				}
			}
		}catch(Exception $e){		
			$error_msg = "登入失敗 <br />{$e}";
			array_push($msg_array, $error_msg);
		}
		
		$returnVal = array("status" => $return_status, "msg" => $msg_array);
		
		return $returnVal;	
	}
	
	// check auth
	function checkAuth($cookie, $session, $page){
	    if(!preg_match("/login/", $page)){		
			if($this->getLib->checkVal($cookie)){
				$username 	= $this->getLib->setFilter($cookie['cpsub_username']);	
				$password	= $this->getLib->setFilter($cookie['cpsub_password']);
				
				if($this->getLib->checkVal($username)){		
					$login 	  					= "1";				
					$session['login'] 			= $login;
					$session['cpsub_username']  = $username;
				}
			}
			
			if($this->getLib->checkVal($session)){			
				$login 	  	= $this->getLib->setFilter($session['login']);			
				$username 	= $this->getLib->setFilter($session['cpsub_username']);
			}
			$rPage	  	= "./login.php?re={$page}";
			if($this->getLib->checkVal($login) && $this->getLib->checkVal($username)){
			
				if($login == "1" && !preg_match("/logout/", $page)){
					// do nothing
					
				}else{
					$this->clearAuth();
					echo $this->getLib->getRedirect($rPage);
					exit;
				}
			}else{
			   $this->clearAuth();
			   echo $this->getLib->getRedirect($rPage);		
			   exit;	
			}
		}
	}
	
	function clearAuth(){
		setcookie ("cpsub_username", 	"", time() - 1296000, "/");
		session_destroy();
	}
}