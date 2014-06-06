<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
class Settings{

	var $filePath;
	var $fileContent;
	
	function Settings($getPath){
		$this->filePath = $getPath;
		
		// initial 
		$this->setInitial();
	}
	
	function setInitial(){
		// Read content
		$this->fileContent = file($this->filePath);
	}
	
	function getSettings(){
		$returnVal = array();
		
		try{
			// assign values
			list($returnVal['title'], 
				 $returnVal['filter'], 
				 $returnVal['stripslashes'], 
				 $returnVal['display_num'], 
				 $returnVal['display_page_num']) = $this->fileContent;
		}catch(Exception $e){
			
		}
		return $returnVal;
	}
}