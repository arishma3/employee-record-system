<?php include("./inc/db_connect.php"); ?>
<head>
<style>
#employee {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#employee td, #employee th {
  border: 1px solid #ddd;
  padding: 8px;
}
#add{
   font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
.signout , .add{
	border : none;
  background-color: #52d1d1b0; /* Green */
  color: white;
  padding: 6px 6px;
  text-align: left;
 float: right;

  font-size: 16px;
}


#employee tr:nth-child(even){background-color: #f2f2f2;}

#employee tr:hover {background-color: #ddd;}
#title { color :#04aa6d; text-align:center;font-family: Arial, Helvetica, sans-serif;}
#employee th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<table id="employee">
<div id="title">EMPLOYEE DETAILS</div>
<tr>
<input type="button" onclick="window.open('add_employee.php')" class="add" style=" margin-left:10px;" name="add_employee" value="ADD DETAILS">

<input class="signout" type="button" name="signout" onclick="window.open('logout.php')" value="LOGOUT">
</tr>
  <tr>
    <th>SI No</th>
    <th>Employee Code</th>
    <th>Employee Name</th>
	<th>Department</th>
	<th>Age</th>
	<th>Experience in the organization</th>
  </tr>
  <?php
					$getemp = mysqli_query($db_connect, "SELECT * FROM emp_details ORDER BY id ASC");
					$getempcount = mysqli_num_rows($getemp);
					if($getempcount >= 1 ){
								while($fetch = mysqli_fetch_assoc($getemp)){
									$id = $fetch['id'];
									$emp_code = $fetch['emp_code'];
									$emp_name = $fetch['emp_name'];
									$department = $fetch['department'];
									$age = $fetch['age'];
									$experience = $fetch['experience'];
				
  echo'<tr>
    <td>'.$id.'</td>
    <td>'.$emp_code.'</td>
    <td>'.$emp_name.'</td><td>'.$department.'</td><td>'.$age.'</td><td>'.$experience.'</td></tr>';
					}}
								else {
								echo 'No employee record found';
							}
							
							if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Employee data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
</table>

<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">

    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div>

    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="submit" value="IMPORT">
        </form>
    </div>

</div>
  
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}

</script>
	
							

</body>
			
				
				
				
					