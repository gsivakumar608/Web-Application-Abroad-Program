<?php

/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

require_once('phpHelper.php');

$user = $_POST['user'];
$pass = $_POST['pass'];
$report = $_POST['report'];
$valid = false;

if(empty($user)){
echo 'INVALID_USERNAME';
exit;
}

if(empty($pass)){
echo 'INVALID_PASSWORD';
exit;
}

if(empty($report)){
echo 'INVALID_REPORT';
exit;
}

$raw_str = file_get_contents('passwords.dat');
$data = explode("\n",$raw_str);
foreach($data as $item) {
	$pair = explode('=',$item);
	if($user === $pair[0] && crypt($pass,$pair[1]) === $pair[1])
		$valid = true;
	}
if($valid){

	$reportString;
	if($report == 'report1'){
		$reportString = generateProgramReport();
		
		/*  select p.description, c.first_name, c.last_name, c.nickname,
		TIMESTAMPDIFF(YEAR, c.birthdate, CURDATE()) as 'age' from enrollment e join  child c join program p on e.child_id=c.id and e.program_id=p.id order by p.id;
*/
	}else{
	/* select p.description as 'program', pr.first_name as 'parent_first_name', pr.middle_name as 'parent_middle_name',pr.address1 as 'addr1', pr.address2 as 'addr2', pr.city as 'city',pr.state as 'state', pr.zip as 'zip', pr.primary_phone as 'primary_phone', pr.secondary_phone as 'secondary_phone', pr.email as 'email', c.relation as 'relation', c.first_name as 'child_first_name', c.middle_name as 'child_middle_name', c.last_name as 'child_last_name', c.nickname as 'nickname', c.image_filename as 'img', c.gender as 'gender', c.birthdate as 'bday', c.conditions as 'conditions', c.diet as 'diet', c.emergency_name as 'emergency_name', c.emergency_phone as 'emergency_phone' from enrollment e join child c join program p join parent pr on e.program_id=p.id and e.child_id=c.id and c.parent_id=pr.id order by c.last_name ;*/
		$reportString = generateAllParticipantReport();
	}
	
	
	
	
}else{
	echo "UNAUTHORIZED USER";
	exit;
	}
	
/* Generate Page */

$answer = '<div id="login">
	<a href="login.html" class="loginText">Login &raquo;</a>
</div>';
$answer .= '<div id="banner">';
$answer .= '<ul id="menu">';
$answer .= '<li><a href="index.html"> <span class="title">Home</span> <span	class="description">Explore us</span></a></li>';
$answer .= '<li><a href="aboutUs.html"> <span class="title">About</span> <span class="description">Learn about us</span></a></li>';
$answer .= '<li><a href="programs.html"> <span class="title">Program</span><span class="description">Get more info</span></a></li>';
$answer .= '<li><a href="registrationForm.html"> <span class="title">Enroll</span><span class="description">Lets get started</span>	</a></li>';
$answer .= '<li><a href="testimonials.html"> <span class="title">Reviews</span><span class="description">Make it yours</span></a></li>';
$answer .= '</ul>';
$answer .= '</div>';
$answer .= '<div id="container">';

$answer .=  $reportString;
$answer .='<a href="login.html" class="goBack">Go Back &raquo;</a><div class="clear"></div>';
echo $answer;
?>

