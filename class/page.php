<?php
 /**
 *  Project: Egg to Go
 *  Last Modified Date: 2014/6/9
 *  Developer: Cooltey Feng
 *  File: class/lib.php
 *  Description: Library for control basic function
 */
 
class Pager{
		var $pageVar 	= 0;
		var $manyVar 	= 10;
		var $startVar 	= 0;
		var $displayVar = 5;
		var $pageNameVar;
		var $totalVar;
		
		function Pager($page, $many, $display, $total, $pagename){
			$page 		= strip_tags(intval($page));
			$many 		= strip_tags(intval($many));
			$display 	= strip_tags(intval($display));
			$total 	= strip_tags(intval($total));
			
			if($page == "" || $page == "1" || $page <= "0"){
				$start = 0;
			}else{
				$start = ($page- 1)*$many;
			}
				
			$this->pageVar 		= $page;
			$this->manyVar 		= $many;
			$this->startVar 	= $start;
			$this->displayVar 	= $display;
			$this->totalVar		= $total;
			$this->pageNameVar  = $pagename;
		}
		
		function getPageControler(){
			 // pages
             $total 		= ceil($this->totalVar/$this->manyVar);
			 $now 			= $this->pageVar;
			 $displayNum 	= $this->displayVar;
			 $many			= $this->manyVar;
			 $current_page  = $this->pageNameVar;
			 echo "<ul class=\"pagination pull-right\">";
			 
			 if($now == "" || $now == "1" || $now <= "0"){
            	 $new_now = 1;
                 }else{
                    $new_now = $now;
                    $head_page = $new_now - 1;
                    $new_url = ereg_replace("page={$now}", "", $org_url);
                 }
                 if(($now-$new_now) > $displayNum)
                 {
                    $head = $now - $displayNum;
                    $last = $total - $displayNum;
                 }
				  if($now > 1 && (($total-$last)+1) > $displayNum && $total > $displayNum){
						echo "<li><a href={$current_page}page=1>最前頁...</a></li>";
				  }
				 
				  $totalDisplay = false;
                  for($i=(1+$head); $i<(($total-$last)+1); $i++)
                  {
                    if(!(($i - $new_now) > $displayNum || ($new_now - $i) > $displayNum))
                    {
                        if($i == $new_now)
                        {
                          echo "<li class=\"active\"><span>{$i}<span class=\"sr-only\">(current)</span></span></li>";
                        }else{
                           echo "<li><a href={$current_page}page={$i}>{$i}</a></li>";
						   if($i == $total || $i == ($total-1)){
							$totalDisplay = true;
						   }
                        }
                     }

                  }
				  if($now != $total && $total > $displayNum && $totalDisplay == false){
						echo "<li><a href={$current_page}page={$total}>...最終頁</a></li>";
				  }
			   echo "</ul>";

		}
		
		function getPageLibControler(){
			 // pages
             $total 		= ceil($this->totalVar/$this->manyVar);
			 $now 			= $this->pageVar;
			 $displayNum 	= $this->displayVar;
			 $many			= $this->manyVar;
			 $current_page  = $this->pageNameVar;
			 echo "<ul class=\"pagination pull-right\">";
			 
			 if($now == "" || $now == "1" || $now <= "0"){
            	 $new_now = 1;
                 }else{
                    $new_now = $now;
                    $head_page = $new_now - 1;
                    $new_url = ereg_replace("page={$now}", "", $org_url);
                 }
                 if(($now-$new_now) > $displayNum)
                 {
                    $head = $now - $displayNum;
                    $last = $total - $displayNum;
                 }				 
				  $totalDisplay = false;
                  for($i=(1+$head); $i<(($total-$last)+1); $i++)
                  {
                    if(!(($i - $new_now) > $displayNum || ($new_now - $i) > $displayNum))
                    {
                        if($i == $new_now)
                        {
                          echo "<li class=\"active\"><span>{$i}<span class=\"sr-only\">(current)</span></span></li>";
                        }else{
                           echo "<li><span class=\"ajax_page_btn\" page={$i}>{$i}</span></li>";
						   if($i == $total || $i == ($total-1)){
							$totalDisplay = true;
						   }
                        }
                     }

                  }
			   echo "</ul>";

		}
		
		function getPageControlerForFront(){
			 // pages
             $total 		= ceil($this->totalVar/$this->manyVar);
			 $now 			= $this->pageVar;
			 $displayNum 	= $this->displayVar;
			 $many			= $this->manyVar;
			 $current_page  = $this->pageNameVar;
			 echo "<div class=\"wp-pagenavi\">";
			 
			 if($now == "" || $now == "1" || $now <= "0"){
            	 $new_now = 1;
                 }else{
                    $new_now = $now;
                    $head_page = $new_now - 1;
                    $new_url = ereg_replace("page={$now}", "", $org_url);
                 }
                 if(($now-$new_now) > $displayNum)
                 {
                    $head = $now - $displayNum;
                    $last = $total - $displayNum;
                 }
				 
				  $totalDisplay = false;
                  for($i=(1+$head); $i<(($total-$last)+1); $i++){
                    if(!(($i - $new_now) > $displayNum || ($new_now - $i) > $displayNum)){
                        if($i == $new_now){
                          echo "<span class=\"current\">{$i}</span>";
                        }else{
                           echo "<a href={$current_page}page={$i} class=\"page larger\">{$i}</a>";
						   if($i == $total || $i == ($total-1)){
							$totalDisplay = true;
						   }
                        }
                     }

                  }
			   echo "</div>";

		}
	
}