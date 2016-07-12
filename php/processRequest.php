<?php
  
  /* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

require_once('phpHelper.php');



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  
}

$program=test_input($_POST[program]);
if(empty($program)){
echo 'Program name is required';
exit;
}

$programId = getProgramId($program);

if($programId==-1){
echo 'Invalid Program is choosen';
exit;
}

$parentFirstName=test_input($_POST[parentFirstName]);
if(empty($parentFirstName)){
echo 'Parent first name is required';
exit;
}

$parentLastName=test_input($_POST[parentLastName]);
if(empty($parentLastName)){
echo 'Parent last name is required';
exit;
}

$pmArea=test_input($_POST[pmArea]);
$pmPrefix=test_input($_POST[pmPrefix]);
$pmPhone=test_input($_POST[pmPhone]);
if( empty($pmArea) || empty($pmPrefix) || empty($pmPhone) ){
echo 'Primary phone number is required';
exit;
}elseif (!is_numeric($pmArea) || !is_numeric($pmPrefix) || !is_numeric($pmPhone)){
 echo 'Primary phone can have only numeric values. Please enter numbers';
 exit;
}elseif ( strlen($pmArea)!=3 || strlen($pmPrefix)!=3  || strlen($pmPhone)!=4) {
echo 'Primary phone number seems invalid!.Area code should have 3 digits, prefix 3 digits and phone 4 digits. ex:619-777-7866';
 exit;
}

$phArea=test_input($_POST[phArea]);
$phPrefix=test_input($_POST[phPrefix]);
$phPhone=test_input($_POST[phPhone]);
if(empty($phArea) && empty($phPrefix) && empty($phPhone)){
	/* do nothing */
}elseif( (!empty($phArea) && !empty($phPrefix) && !empty($phPhone) )){
	if (!is_numeric($phArea) || !is_numeric($_POST[phPrefix]) || !is_numeric($phPhone)){
 		echo 'Secondary phone can have only numeric values. Please enter numbers';
 		exit;
	}elseif ( strlen($phArea)!=3 || strlen($phPrefix)!=3  || strlen($phPhone)!=4) {
		echo 'Secondary phone number seems invalid!.Area code should have 3 digits, prefix 3 digits and phone 4 digits. ex:619-777-7866';
		exit;
	}
}else{
	echo 'Secondary phone is incomplete. Please fill in the numeric values';
 	exit;
}

$email=test_input($_POST[email]);
if(empty($email)){
echo 'Parent email is required';
exit;
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      /* check if e-mail address is well-formed */
       echo 'Invalid email format'; 
       exit;
}
    
$relationship=test_input($_POST[relationship]);
if(empty($relationship)){
echo 'Parent relationship to child is required';
exit;
}

$addressLine1=test_input($_POST[addressLine1]);
if(empty($addressLine1)){
echo 'Parent address is required';
exit;
}

$city=test_input($_POST[city]);
if(empty($city)){
echo 'City is required';
exit;
}

$state=test_input($_POST[state]);
if(empty($state)){
    echo 'State is required';
    exit;
}elseif(strlen($state) != 2) {
    echo "The STATE field must have exactly two characters, not ".
        strlen($state).", the value $state is invalid.";
    exit;
}elseif(!isValidStateAbbr($state)){
    echo 'Invalid state abbrevation. Please enter a valid one';
    exit;
}
 
function isValidStateAbbr($state) {
	$stateList = array("AK", "AL", "AR", "AZ", "CA", "CO", "CT", "DC",
			"DE", "FL", "GA", "GU", "HI", "IA", "ID", "IL", "IN", "KS",
			"KY", "LA", "MA", "MD", "ME", "MH", "MI", "MN", "MO", "MS", "MT",
			"NC", "ND", "NE", "NH", "NJ", "NM", "NV", "NY", "OH", "OK", "OR",
			"PA", "PR", "RI", "SC", "SD", "TN", "TX", "UT", "VA", "VT", "WA",
			"WI", "WV", "WY");
	$arr_length = count($stateList);
	for ($i = 0; $i < $arr_length; $i++)
		if (strcasecmp($stateList[$i] , trim($state))==0)
			return true;
	return false;
}

$postcode=test_input($_POST[postcode]);
if(empty($postcode)){
    echo 'Zipcode is required';
    exit;
}elseif(!is_numeric($postcode)) {
    echo "Zip code cannot have characters. The ZIP field must be a five digit integer, the value $postcode is invalid.";
    exit;
}elseif (strlen($postcode) != 5) {
    echo "The ZIP field must have exactly five digits, not ".
        strlen($postcode).", the value $postcode is invalid.";
    exit;
} 
 
$childFirstName=test_input($_POST[childFirstName]);   
if(empty($childFirstName)){
echo 'Child first name is required';
exit;
}

$childLastName=test_input($_POST[childLastName]); 
if(empty($childLastName)){
echo 'Child last name is required';
exit;
}

$childNickName=test_input($_POST[childNickName]); 
if(empty($childNickName)){
echo 'Child Nickname is required';
exit;
}

if(isDup($_POST)) {  
    echo("Duplicate! Same child cannot be enrolled again.");
    exit;
}


if(empty($_POST[photo])){
echo 'Photo of child is required';
exit;
}elseif(strlen()>15){
echo 'Filename of photo including extension cannot contain more than 15 characters';
exit;
}else{
	$extn = substr($_POST[photo],-4);
	if(!(strcasecmp($extn,".jpg")==0 || strcasecmp($extn,".png")==0)){
		echo 'Please upload the image in jpg or png format only';
		exit;
	}

}

$gender=test_input($_POST[gender]);
if(empty($gender)){
echo 'Gender of child is required';
exit;
}


$dob=test_input($_POST[dob]);
if(empty($dob)){
echo 'Birth date of child is required. Enter in mm/dd/yyyy format';
exit;
} 

$dobArr = explode('/', $dob);
if (!(preg_match("/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/", $dob))) {
    echo 'Invalid date format. Please enter date in mm/dd/yyyy';
    exit;
}elseif(!checkdate($dobArr[0],$dobArr[1],$dobArr[2])){
    echo 'Invalid date. Please enter a valid one';
    exit;
}else{
	$date2 = $dobArr[2].'-'.$dobArr[0].'-'.$dobArr[1];
	$age = floor( (time() - strtotime($date2)) / (60 * 60 * 24 * 365.25));
	if($age <12 || $age >18){
    		echo 'Only children of age 12 to 18 are elligible for the course';
    		exit;
	}
}


$secondaryContactName=test_input($_POST[secondaryContactName]);
if(empty($secondaryContactName)){
echo 'Emergency contact name is required';
exit;
}

$scArea=test_input($_POST[scArea]);
$scPrefix=test_input($_POST[scPrefix]);
$scPhone=test_input($_POST[scPhone]);
if( empty($scArea) || empty($scPrefix) || empty($scPhone) ){
echo 'Emergency contact number is required';
exit;
}elseif (!is_numeric($scArea) || !is_numeric($scPrefix) || !is_numeric($scPhone)){
 echo 'Emergency contact number can have only numeric values. Please enter numbers';
 exit;
}elseif ( strlen($scArea)!=3 || strlen($scPrefix)!=3  || strlen($scPhone)!=4) {
echo 'Emergency contact number seems invalid!.Area code should have 3 digits, prefix 3 digits and phone 4 digits. ex:619-777-7866';
 exit;
}

 if(isDup($_POST)) {  
    echo("Duplicate! Same child cannot be enrolled again.");
    exit;
}



$parentId = checkUniqueParent($_POST); 

$primaryPh = $pmArea.$pmPrefix.$pmPhone;
$secondaryPh = $phArea.$phPrefix.$phPhone;
$emergencyPh = $scArea.$scPrefix.$scPhone;

$con = get_db_connection();
/* For names */
$parentFirstName = mysqli_real_escape_string($con, $parentFirstName);
$parentMiddleName = mysqli_real_escape_string($con, $_POST[parentMiddleName]);
$parentLastName = mysqli_real_escape_string($con, $parentLastName);
$childFirstName = mysqli_real_escape_string($con, $childFirstName);
$childMiddleName = mysqli_real_escape_string($con, $_POST[childMiddleName]);
$childLastName = mysqli_real_escape_string($con, $childLastName );
$childNickName = mysqli_real_escape_string($con, $childNickName);
$secondaryContactName = mysqli_real_escape_string($con, $secondaryContactName);

/* For address */
$addressLine1 = mysqli_real_escape_string($con, $addressLine1);
$addressLine2 = mysqli_real_escape_string($con, $_POST[addressLine2]);
$city = mysqli_real_escape_string($con, $city);

/* Child additional info */
$medicalConditions = mysqli_real_escape_string($con, $_POST[medicalConditions]);
$splDietryReq = mysqli_real_escape_string($con, $_POST[splDietryReq]);
$photo = mysqli_real_escape_string($con, $_POST[photo]);

mysqli_close($con);
 
 if($parentId==-1){
	$addParentQuery = "INSERT INTO parent (first_name, middle_name, last_name, address1, ";
	$addParentQuery .= "address2, city, state, zip, primary_phone, secondary_phone, email) VALUES(";
	$addParentQuery .= "'$parentFirstName', '$parentMiddleName', '$parentLastName', '$addressLine1', '$addressLine2', '$city', '$state',";
	$addParentQuery .= "'$postcode', '$primaryPh', '$secondaryPh', '$email'"; 
	$addParentQuery .= ");";
 
	$parentId = do_ajax_insertion($addParentQuery);
  } 


$dobArr = explode('/', $dob);
$dateOfBirth = "$dobArr[2]-$dobArr[0]-$dobArr[1]";

$addChildQuery = "INSERT INTO child (parent_id, relation, first_name, middle_name, ";
$addChildQuery .= "last_name, nickname, image_filename, gender, birthdate, conditions, diet, emergency_name, emergency_phone) VALUES(";
$addChildQuery .= "'$parentId', '$relationship','$childFirstName', '$childMiddleName', '$childLastName', '$childNickName', '$photo', '$gender',";
$addChildQuery .= "'$dateOfBirth', '$medicalConditions', '$splDietryReq',  '$secondaryContactName', '$emergencyPh'"; 
$addChildQuery .= ");";


$childId = do_ajax_insertion($addChildQuery);


$addEnrollmentQuery = "INSERT INTO enrollment VALUES ('$programId', '$childId');";

 
$enrollmentId = do_ajax_insertion($addEnrollmentQuery);

echo 'confirmation success';

?>
