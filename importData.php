<?php
 include("inc/db_connect.php");
 
    session_start();


    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

        if(is_uploaded_file($_FILES['file']['tmp_name'])){

             $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            

            fgetcsv($csvFile);
   
            while(($line = fgetcsv($csvFile)) !== FALSE){
             
                $emp_code   = $line[0];
                $emp_name  = $line[1];
                $department  = $line[2];
                $age = $line[3];
                $experience = $line[4];
               
                
                    $db_connect->query("INSERT INTO emp_details (emp_code, emp_name, department, age, experience) VALUES ('".$emp_code."', '".$emp_name."', '".$department."', '".$age."', '".$experience."')");
                
            }
            
 
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }

header("Location: employee_details.php".$qstring);
	?>						
							