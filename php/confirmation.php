<?php

/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

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
    
        
$answer .= '<div class="heading">
			<h2>Enrollment Complete!</h2>
		</div>
		<h2>
			<span class="confirmationText">Thank you! You have registered';
$answer .= " for $_POST[program]!</span>
		</h2>
";
		
$answer .= '<div class="childImg">
			<img alt="Reviews" ';
			
$answer .= " src=\"/~jadrn046/proj2-b/php/_myImages_/$_POST[photo]\" />";
			
$answer .= ' </div>';
$answer .= '<div class="contactInfo">';
$answer .= "	<hr />
			<hr />
			<h3>Child Info</h3>
			<hr />
			<hr />
			<table>
				<tr>
					<td><strong>Name</strong></td>
					<td>$_POST[childFirstName] $_POST[childMiddleName] $_POST[childLastName]</td>
				</tr>
				<tr>
					<td><strong>Nickname</strong></td>
					<td>$_POST[childNickName]</td>
				</tr>
				<tr>
					<td><strong>Gender</strong></td>
					<td>$_POST[gender]</td>
				</tr>
				<tr>
					<td><strong>Birthdate</strong></td>
					<td>$_POST[dob]</td>
				</tr>
				<tr>
					<td><strong>Medical Conditions</strong></td>
					<td>$_POST[medicalConditions]</td>
				</tr>
				<tr>
					<td><strong>Diet</strong></td>
					<td>$_POST[splDietryReq]</td>
				</tr>
			</table>

			<hr />
			<hr />

			<h3>Parent contact</h3>
			<hr />
			<hr />
			<table>
				<tr>
					<td><strong>Name</strong></td>
					<td>$_POST[parentFirstName] $_POST[parentMiddleName] $_POST[parentLastName]</td>
				</tr>
				<tr>
					<td><strong>Relationship</strong></td>
					<td>$_POST[relationship]</td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td>$_POST[email]</td>
				</tr>
				<tr>
					<td><strong>Address</strong></td>
					<td>$_POST[addressLine1] $_POST[addressLine2]</td>
				</tr>
				<tr>
					<td> </td>
					<td>$_POST[city], $_POST[state]- $_POST[postcode]</td>
				</tr>
				
				<tr>
					<td><strong>Primary phone</strong></td>
					<td>$_POST[pmArea]$_POST[pmPrefix]$_POST[pmPhone]</td>
				</tr>
				<tr>
					<td><strong>Secondary Phone</strong></td>
					<td>$_POST[phArea]$_POST[phPrefix]$_POST[phPhone]</td>
				</tr>
			</table>
			<hr />
			<hr />
			<h3>Emergency contact</h3>
			<hr />
			<hr />
			<table>
				<tr>
					<td><strong>Name</strong></td>
					<td>$_POST[secondaryContactName]</td>
				</tr>
				<tr>
					<td><strong>Phone</strong></td>
					<td>$_POST[scArea]$_POST[scPrefix]$_POST[scPhone]</td>
				</tr>
			</table> </div>";
			
$answer .= '<div class="clear"></div>';

$answer .='<a href="registrationForm.html" class="goBack">Go Back &raquo;</a><div class="clear"></div>';


echo $answer;

?>
