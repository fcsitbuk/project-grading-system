<?php
$db = new mysqli("localhost", "root", "", "inspired_android");
//$db = new mysqli("localhost", "root", "", "inspired_android");


if($db->error){
	die("Sorry, server is down. try again later");
}
?>