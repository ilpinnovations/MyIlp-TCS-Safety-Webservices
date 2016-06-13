<?php 
include_once('my_ilp_db.php'); 
$emp_id = $_GET['emp_id'];
$data = array();


if(isset($emp_id))
{
$query = "SELECT emp_id FROM emp_reg WHERE emp_id='$emp_id'";
$result = mysql_query($query,$connection);
$rows = mysql_num_rows($result);
$query5 = "SELECT emp_id FROM ilpassistance WHERE emp_id='$emp_id'";
$result5 = mysql_query($query5,$connection);
$rows5 = mysql_num_rows($result5);
$status="0";
if($rows==1 && $rows5==0)
{
	$query2 = "SELECT emp_name,emp_email FROM emp_reg WHERE emp_id='$emp_id'";
$result2 = mysql_query($query2,$connection);
$row2 = mysql_fetch_assoc($result2);
$email= $row2['emp_email'];
$name= $row2['emp_name'];

$sql2="INSERT INTO ilpassistance(emp_id,emp_name,email,status) VALUES('$emp_id','$name','$email',$status)";
$result3 = mysql_query($sql2,$connection) or die("Error in Selecting " . mysql_error($connection));
if($result3)
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