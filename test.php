<?php

//test case 
for($i = 0; $i < 2000; $i++){
	file_get_contents("http://127.0.0.1/C.P.Sub/article.php?id=2");
	file_get_contents("http://127.0.0.1/C.P.Sub/article.php?id=1");
}