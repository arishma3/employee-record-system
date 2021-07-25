<?php   include("./inc/db_connect.php"); ?>
<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
$name_error="";$empcode_error="";$empcode_exists="";
if (isset($_POST['submit'])) {
$emp_name = mysqli_real_escape_string($db_connect, $_POST['emp_name']);
$emp_code = mysqli_real_escape_string($db_connect, $_POST['emp_code']);
$department = mysqli_real_escape_string($db_connect, $_POST['department']);
$dobirth = $_POST["dob"];
  $today = new DateTime('now');
  $joining_date = $_POST["joining_date"];
  $bday = new DateTime($_POST['dob']);
  $diff = $today->diff($bday);
  $age= $diff->y;
  $joining_date = new DateTime($_POST['joining_date']);   
  $interval = $joining_date->diff($today);
  $experience=$interval->format('%y years %m months and %d days');
 if (!preg_match("/^[a-zA-Z ]*$/",$emp_name)) {  
$name_error = "Name must contain only alphabets and space";
}
if (!preg_match("/^[A-Za-z0-9_-]*$/",$emp_code)) {
$empcode_error = "Employee code must contain only alphabets and numbers";
}      
$check=mysqli_query($db_connect, "SELECT * FROM emp_details WHERE emp_code = '".$emp_code."'");
  $getempcount = mysqli_num_rows($check);
if($getempcount >0 ) {
   $empcode_exists= "Employee code Already Exists";
}
if(!$name_error && !$empcode_error && !$empcode_exists)
{
if(mysqli_query($db_connect, "INSERT INTO emp_details(emp_code, emp_name, department ,age,experience) VALUES('" . $emp_code . "', '" . $emp_name . "', '" . $department . "', '" . $age . "','" . $experience . "')")) {

echo "<script type='text/javascript'>alert('Added Successfully!');window.location.href = 'employee_details.php'</script>";
//header("location: employee_details.php");

} else {
echo "Error: " . $sql . "" . mysqli_error($db_connect);
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD DETAILS</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
<h2>ADD DETAILS</h2>
</div>
<p>Please fill up the fields in the form</p>
<form action="add_employee.php" method="post">
<div class="form-group">
<label>Employee Name</label>
<input type="text" name="emp_name" class="form-control" value="" maxlength="50" required="">
<span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
</div>
<div class="form-group ">
<label>Employee Code</label>
<input type="text" name="emp_code" class="form-control" value="" maxlength="30" required="">
<span class="text-danger"><?php 
if (isset($empcode_error)){
echo $empcode_error;}else if(isset($empcode_exists)){echo $empcode_exists;} ?></span>
</div>
<div class="form-group">
<label>Department</label>
<input type="text" name="department" class="form-control" value="" maxlength="12" required="">
</div>
<div class="form-group">
<label>Date of birth</label>
<input type="date" name="dob" class="form-control" value="" required="">
</div>  
<div class="form-group">
<label>Joining Date</label>
<input type="date" name="joining_date" class="form-control" value="" required="">
</div>
<input type="submit" class="btn btn-primary" name="submit" value="submit">

</form>
</div>
</div>    
</div>
</body>
</html>

 