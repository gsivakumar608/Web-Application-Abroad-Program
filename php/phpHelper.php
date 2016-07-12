<?php

/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

function get_db_connection() {
	$server = 'opatija.sdsu.edu:3306';
	$user = 'jadrn046';
	$password = 'plastic';
	$database = 'jadrn046';  	
	
	if(!($db = mysqli_connect($server, $user, $password, $database))) {
		write_error_page(mysqli_error($db));
		exit;
		}
	return $db;
	}
        
function isDup($arr) {
    $status;
     $db = get_db_connection();
    
    
   
    $sql = "SELECT id FROM parent where email='$arr[email]' AND primary_phone='$arr[pmArea]$arr[pmPrefix]$arr[pmPhone]'";
    $sql .= ";";
    
    $result = mysqli_query($db, $sql);
    $row_cnt = $result->num_rows;
   
   
    if($row_cnt>=1){
   	 $row = mysqli_fetch_assoc($result); 
         $getChildSQL = "SELECT first_name, last_name FROM child where parent_id='$row[id]'";
    	 $childRecords = mysqli_query($db, $getChildSQL);
   
   	 while($child = mysqli_fetch_array($childRecords)) {
   		 if(strcasecmp($child[0],$arr[childFirstName])==0 && strcasecmp($child[1],$arr[childLastName])==0){
    			 $status = true;
     			 return $status;
    		  }
         }
	 
         $status = false;
    }else
        $status = false;

    mysqli_close($db);
   /* file_put_contents('log.txt',$sql);*/
    return $status; 
   
    }
    
   function checkUniqueParent($arr){
     $parentId;
    $db = get_db_connection();
    
    $sql = "SELECT id FROM parent where email='$arr[email]' AND primary_phone='$arr[pmArea]$arr[pmPrefix]$arr[pmPhone]'";
    $sql .= ";";
    
    $result = mysqli_query($db, $sql);
    $row_cnt = $result->num_rows;
    
    if($row_cnt >= 1){
    	 $row = mysqli_fetch_assoc($result);
	 $parentId = $row[id];
    }
    else 
	$parentId = -1;

    mysqli_close($db);
    return $parentId;
   	
   }
         
function do_insertion($query) {      
	$db = get_db_connection();
        if(!($result = mysqli_query($db, $query))) {
            write_error_page(mysqli_error($db));
          } #end if
	 mysqli_close($db);		
	}
        
function do_ajax_insertion($query) {      
	$db = get_db_connection();
        if(!($result = mysqli_query($db, $query))) {
            echo mysqli_error($db);
            exit;
          } #end if 
	  
	  $id = mysqli_insert_id($db);     
	    
	mysqli_close($db);
	return $id;		
	}  
	
function getProgramId($program){
    $programId;
    $db = get_db_connection();
    
    $sql = "SELECT id FROM program where description='$program'";
    $sql .= ";";
    
    $result = mysqli_query($db, $sql);
    $row_cnt = $result->num_rows;
    
    if($row_cnt >= 1){
    	 $row = mysqli_fetch_assoc($result);
	 $programId = $row[id];
    }
    else 
	$programId = -1;
    
     mysqli_close($db);
     return $programId;
}      	

function generateProgramReport(){
	$reportString;
	$beginningSpanish=$advancedSpanish=$conversationalSpanish=$advConversationalSpanish=$grammarAndComposition=$culturalTreasure=" ";
	
	$sql = "SELECT p.description as 'program', c.first_name as 'first_name',";
	$sql .= "c.last_name as 'last_name', c.nickname as 'nickname',";
	$sql .= "TIMESTAMPDIFF(YEAR, c.birthdate, '2014-06-02') as 'age' ";
	$sql .= "FROM enrollment e join  child c join program p on e.child_id=c.id and e.program_id=p.id ";
	$sql .= "order by p.id;";
	
	$db = get_db_connection();
	$result = mysqli_query($db, $sql);
        $row_cnt = $result->num_rows;
	
	if($row_cnt>=1){
		
	 while($record = mysqli_fetch_array($result)) {
	 	switch($record[program]){
			case "Beginning Spanish" : $beginningSpanish.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
			case "Advanced Spanish" : $advancedSpanish.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
			case "Conversational Spanish" : $conversationalSpanish.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
			case "Advanced Conversational Spanish" : $advConversationalSpanish.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
			case "Spanish Grammar and Composition" : $grammarAndComposition.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
			case "Cultural Treasures of Mexico" : $culturalTreasure.='
		<tr>
		     <td>'.$record[first_name].'</td> 
		     <td>'.$record[last_name].'</td> 
		     <td>'.$record[nickname].'</td> 
		     <td>'.$record[age].'</td> 
		 </tr>';
				break;
				
		}
	 
   		
         }
	
	
	$reportString='<div class="heading">
			<h2>Program Report</h2>
		</div> ';
	
	if(!($beginningSpanish==" ")){
		$reportString.=generateTable('Beginning Spanish', $beginningSpanish); 
	}
	
	if(!($advancedSpanish==" ")){
		$reportString.=generateTable('Advanced Spanish', $advancedSpanish); 
	}
	
	if(!($conversationalSpanish==" ")){
		$reportString.=generateTable('Conversational Spanish', $conversationalSpanish); 
	}
	
	if(!($advConversationalSpanish==" ")){
		$reportString.=generateTable('Advanced Conversational Spanish', $advConversationalSpanish); 
	}
	
	if(!($grammarAndComposition==" ")){
		$reportString.=generateTable('Spanish Grammar and composition', $grammarAndComposition); 
	}
	
	if(!($culturalTreasure==" ")){
		$reportString.=generateTable('Cultural treasures of Mexico', $culturalTreasure); 
	}
	
	
	}else{
		$reportString = "<p>No records to display</p>";	
	}
   
	
	$db = $db = get_db_connection();
	mysqli_close($db);
	return $reportString;

}

function generateTable($program, $reportStr){

$programStr='<h1>'.$program.'</h1>'.'
		<table border="1" class="tableStyle">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Nickname</th>
				<th>Age</th>
			</tr>'.$reportStr.'</table>';
	return $programStr;	
}
function generateAllParticipantReport(){
	$reportString;
	
	
	
	$sql = "SELECT p.description as 'program', pr.first_name as 'parent_first_name', pr.middle_name as 'parent_middle_name', pr.last_name as 'parent_last_name',";
	$sql .= "pr.address1 as 'addr1', pr.address2 as 'addr2', pr.city as 'city',pr.state as 'state', pr.zip as 'zip',";
	$sql .= " pr.primary_phone as 'primary_phone', pr.secondary_phone as 'secondary_phone', pr.email as 'email', ";
	$sql .= " c.relation as 'relation', c.first_name as 'child_first_name', c.middle_name as 'child_middle_name',";
	$sql .= " c.last_name as 'child_last_name', c.nickname as 'nickname', c.image_filename as 'img', ";
	$sql .= " case c.gender when 'M' then 'Male' when 'F' then 'Female' end as 'gender', DATE_FORMAT(c.birthdate, '%m/%d/%Y') as 'bday', c.conditions as 'conditions', c.diet as 'diet',";
	$sql .= " c.emergency_name as 'emergency_name', c.emergency_phone as 'emergency_phone'";
	$sql .= " FROM enrollment e join child c join program p join parent pr ";
	$sql .= " on e.program_id=p.id and e.child_id=c.id and c.parent_id=pr.id ";
	$sql .= " order by c.last_name;";
	
		
	$db = get_db_connection();
	$result = mysqli_query($db, $sql);
        $row_cnt = $result->num_rows;
	
	if($row_cnt>=1){
		$reportString='<div class="heading">
			<h2>All Participants Report</h2>
		</div>';		
	 while($record = mysqli_fetch_array($result)) {
	 	
		
		
$reportString .= '<div class="childImg">
			<img alt="'.$record['img'].'" ';
			
$reportString .= ' src="/~jadrn046/proj2-b/php/_myImages_/'.$record['img'].'" />';
			
$reportString .= ' </div>';
$reportString .= '<div class="contactInfo">';
$reportString .= '	<hr />
			<hr />
			<h3>Child Info</h3>
			<hr />
			<hr />
			<table>
				<tr>
					<td><strong>Name</strong></td>
					<td>'.$record['child_first_name'].' '.$record['child_middle_name'].' '.$record['child_last_name'].'</td>
				</tr>
				<tr>
					<td><strong>Nickname</strong></td>
					<td>'.$record['nickname'].'</td>
				</tr>
				<tr>
					<td><strong>Gender</strong></td>
					<td>'.$record['gender'].'</td>
				</tr>
				<tr>
					<td><strong>Birthdate</strong></td>
					<td>'.$record['bday'].'</td>
				</tr>
				<tr>
					<td><strong>Medical Conditions</strong></td>
					<td>'.$record['conditions'].'</td>
				</tr>
				<tr>
					<td><strong>Diet</strong></td>
					<td>'.$record['diet'].'</td>
				</tr>
				<tr>
					<td><strong>Program</strong></td>
					<td>'.$record['program'].'</td>
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
					<td>'.$record['parent_first_name'].' '.$record['parent_middle_name'].' '.$record['parent_last_name'].'</td>
				</tr>
				<tr>
					<td><strong>Relationship</strong></td>
					<td>'.$record['relation'].'</td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td>'.$record['email'].'</td>
				</tr>
				<tr>
					<td><strong>Address</strong></td>
					<td>'.$record['addr1'].' '.$record['addr2'].'</td>
				</tr>
				<tr>
					<td> </td>
					<td>'.$record['city'].' '.$record['state'].' '.$record['zip'].'</td>
				</tr>
				
				<tr>
					<td><strong>Primary phone</strong></td>
					<td>'.$record['primary_phone'].'</td>
				</tr>
				<tr>
					<td><strong>Secondary Phone</strong></td>
					<td>'.$record['secondary_phone'].'</td>
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
					<td>'.$record['emergency_name'].'</td>
				</tr>
				<tr>
					<td><strong>Phone</strong></td>
					<td>'.$record['emergency_phone'].'</td>
				</tr>
			</table> </div>';
			
$reportString .= '<div class="clear"></div>';



			
		$reportString.='<hr/>';
         }
	
	}else{
		$reportString = "<p>No records to display</p>";	
	}
   
	
	$db = $db = get_db_connection();
	mysqli_close($db);
	return $reportString;

}
		
function write_error_page($message) {
print <<< EOF
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>An Error has occurred</title>
    <style>
        h1, h2, h3 { text-align: center; }
    </style>
    <script src=""></script>
</head>
<body>
EOF;
print "<h2>Sorry, an unrecoverable error was encountered.<br />\n";
print $message;	
print "</body></html>\n";
exit;  /* terminates this script and any others that called it.*/
}
	
?>	
