<?php
/**
 * Model: C.P.Sub 公告系統
 * Author: Cooltey Feng
 * Lastest Update: 2013/10/15
 */
 
 // Read content
 $get_settings = file($config_setting_file_path);
 
 // set new array of settings
 $cpsub = array();
 
 // assign values
 list($cpsub['title'], $cpsub['filter'], $cpsub['stripslashes'], $cpsub['display_num'], $cpsub['display_page_num']) = $get_settings;