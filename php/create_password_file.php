<?php

/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

if($_GET) exit;
if($_POST) exit;

$salt = '$1$hy23@@u7Q'; #12 characters starting with $1$

$users = array('cs545','sravikumar','jesse');
$pass = array('fall2014','123abc','abc123');

for($i=0; $i<count($users); $i++) 
	if(CRYPT_MD5)
		echo $users[$i].'='.crypt($pass[$i],$salt)."\n";
?>
