<?php 
$pattern="/^[a-zA-Z0-9\.\-\!+]+@[a-zA-Z+]+\.[a-zA-Z-]+$/";
$email="jelena!p@hotmail.com";
echo preg_match($pattern, $email); 

?>