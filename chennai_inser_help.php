<?php 
include_once('my_ilp_db.php'); 
$emp_id =$_POST['emp_id'];
$emp_name = $_POST['emp_name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$query15 = $_POST['query'];
$data = array();

if(isset($emp_id))
{
	$query = "SELECT emp_id FROM emp_reg WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
$query5 = "SELECT emp_id FROM ilpassistance WHERE emp_id='$emp_id'";
$result5 = mysql_query($query5,$connection);
$rows5 = mysql_num_rows($result5);
$status="1";
if($rows==1 && $rows5==0)
{

$sql = "INSERT INTO ilpassistance(emp_id,emp_name,email,contact,status,notice) VALUES('$emp_id','$emp_name','$email','$contact',$status,'$query15')"; 
$result2 = mysql_query($sql,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result2)
{
$data[]=array(
"message"=>"Thank you and be safe"
);
}
else
{
$data[]=array(
"message"=>"Error submitting your response"
);	
}
}
else{
	
	$data[]=array(
"message"=>"Response already submitted"
);
}
//header('content-type:application/json');
echo json_encode(array('data'=> $data));
  
  
}
 mysql_close($connection);
?>