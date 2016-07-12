<?php

/* Shubha Ravikumar, FNU Account: jadrn046
CS545, Fall 2014
Project 2b  */

    $UPLOAD_DIR = '_myImages_/';
    $COMPUTER_DIR = '/home/jadrn046/public_html/proj2-b/php/_myImages_/';
    $fname = $_FILES['photo']['name'];
    

    if(file_exists("$UPLOAD_DIR".$fname))  {
        
	echo 'DUPLICATE';
	exit;
        }
    elseif($_FILES['photo']['error'] > 0) {
    	$err = $_FILES['photo']['error'];	
       
	if($err == 1)
		
		echo 'LARGE';
		exit;
        }     
    else {
   
        move_uploaded_file($_FILES['photo']['tmp_name'], "$UPLOAD_DIR".$fname);
       /* echo "Success!</br >\n";
        echo "The filename is: ".$fname."<br />";
        echo "The type is: ".$_FILES['photo']['type']."<br />";
        echo "The size is: ".$_FILES['photo']['size']."<br />";
        echo "The tmp filename is: ".$_FILES['photo']['tmp_name']."<br />";  
        echo "The basename is: ".basename($fname)."<br />";  
	*/
    } 
    
    
    $d = dir($COMPUTER_DIR);
    while($fname = $d->read()) {
        $data[$fname] = stat($fname);
        }
    foreach($data as $fname => $fvalue) {
        if($fname == "." || $fname == "..") {
            ;
            }
        else {
           
        }
    }   
    
    echo 'SUCCESS';
    ?>     
    
