<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
class Article{

	var $filePath;
	
	function Article($getPath){
		$this->filePath = $getPath;
	}
	
	function getAllList($mode = null, $ordercolumn = null, $orderby = null){
	
		$returnVal = array();
		
		// read csv file
		if (($handle = fopen($this->filePath, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				if($mode == "display"){
					$setList = array("id" 			=> $data[0],
									 "title" 		=> $data[1],
									 "author" 		=> $data[2],
									 "top" 			=> $data[3],
									 "content" 		=> $data[4],
									 "files" 		=> $data[5],
									 "files_name" 	=> $data[6],
									 "date" 		=> $data[7],
									 "ip" 			=> $data[8],
									 "counts"		=> $data[9]);
					
					// set column
					if($ordercolumn == null){
						$setKey 	= $setList['id'];
						// check key
						if(array_key_exists($setKey, $returnVal)){
							$setKey = $setKey."_".date("YmdHisu");
						}
						// re-assign
						$returnVal[$setKey] = $setList;
					}else{
						try{
							$setKey 	= $setList[$ordercolumn];
							// check key
							if(array_key_exists($setKey, $returnVal)){
								$setKey = $setKey."_".date("YmdHisu");
							}
							// re-assign
							$returnVal[$setKey] = $setList;
						}catch(Exception $e){
							$setKey 	= $setList['id'];
							// check key
							if(array_key_exists($setKey, $returnVal)){
								$setKey = $setKey."_".date("YmdHisu");
							}
							// re-assign
							$returnVal[$setKey] = $setList;
						
						}
					}
					
					// set order
					if($orderby == null || $orderby == "asc"){
						ksort($returnVal);
					}else{
						krsort($returnVal);					
					}
					
					
				}else{				 
					$setList = array($data[0],
									 $data[1],
									 $data[2],
									 $data[3],
									 $data[4],
									 $data[5],
									 $data[6],
									 $data[7],
									 $data[8],
									 $data[9]);										 
					array_push($returnVal, $setList);
				}
			}
			fclose($handle);
		}
		
		return $returnVal;	
	}
	
	function getArticle($getId){
	
		$returnVal = array();
		
		$getList = $this->getAllList("display");
		
		try{
			$returnVal = $getList[$getId];
		}catch(Excepiton $e){
			
		}
		
		return $returnVal;	
	}
	
	function addNewArticle($newDataArray){
	
		$returnVal = false;
		try{		
			// update array
			$resultArray  = $this->getAllList();
			
			// check the last id
			$getSize   = count($resultArray);
			
			$getLastId = $resultArray[$getSize-1][0];
			
			$newDataArray[0] = $getLastId + 1;
			
			// add new data
			array_push($resultArray, $newDataArray);
			
			// put data into csv
			$fp = fopen($this->filePath, "w");

			foreach ($resultArray as $fields) {
				fputcsv($fp, $fields);
			}

			fclose($fp);
			
			$returnVal = true;
		}catch(Exception $e){
			
		}
		
		return $returnVal;	
	}
	
	function editArticle($newDataArray){
	
		$returnVal = false;
		try{
			$dataArray = array();
		
			// update array
			$resultArray  = $this->getAllList();
			
			// update exist data
			foreach($resultArray AS $existData){
				if($existData[0] == $newDataArray[0]){
					$existData[1] = $newDataArray[1];
					$existData[2] = $newDataArray[2];
					$existData[3] = $newDataArray[3];
					$existData[4] = $newDataArray[4];
					$existData[5] = $newDataArray[5];
					$existData[6] = $newDataArray[6];
					$existData[7] = $newDataArray[7];
					$existData[8] = $newDataArray[8];
					$existData[9] = $newDataArray[9];
				}
				
				array_push($dataArray, $existData);
			}
			
			// put data into csv
			$fp = fopen($this->filePath, "w");

			foreach ($dataArray as $fields) {
				fputcsv($fp, $fields);
			}

			fclose($fp);
			
			$returnVal = true;
		}catch(Exception $e){
			
		}
		
		return $returnVal;	
	}
}