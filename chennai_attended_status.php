 <?php
 include_once('iBuzzer/my_ilp_db.php'); 
$id= $_REQUEST['id'];
$state= $_REQUEST['status'];
if($state==1)
{

	$sql = "UPDATE ilpassistance SET attended='0',attended_status='Unattended' WHERE emp_id='$id'";
    $query = mysql_query($sql);
    $reusult = mysql_fetch_assoc($query);
   $result12 = mysql_query("SELECT * FROM ilpassistance WHERE status='1' ", $connection);
  echo " <div id='my_table' class='span5'>
   <div class='row'>
    <div class='col-md-6'> <h4>Employees who need assistance</h4></div>
    <div class='col-md-6'>
    <div  style='float:right'>
    <a href='tcssafety_export.php' class='btn btn-primary'>Download Excel</a>
    
    </div>
    </div>
  </div>
<form  method='POST' name='contact-form1' id='contact-form' class='contact-form'>";                          
$result12 = mysql_query("SELECT * FROM ilpassistance WHERE status='1' ", $connection);
echo "<table class='table table-striped'>
<tr>
<th>Employee ID</th>
<th>Name</th>
<th>Contact</th>
<th>Email</th>
<th>Query</th>
<th>Date & Time</th>
<th>Status</th>
</tr>";
while($row12= mysql_fetch_array($result12)) {
	$attendedstatus=$row12['attended'];
	$id=$row12['emp_id'] ;
	$status = $row12['attended'] ;
	$timeStamp = $row12['time'];
$timeStamp = date( "D,jMY", strtotime($timeStamp));
echo "<tr>
<td><h4>" . $row12['emp_id'] . "</h4></td>
<td><h4>" . $row12['emp_name'] . "</h4></td>
<td><h4>" . $row12['contact'] . "</h4></td>
<td><h4>" . $row12['email'] . "</h4></td>
<td><h4>" . $row12['notice'] . "</h4></td>
<td><h4>" . $timeStamp . "</h4></td>
";
if($row12['attended']=="1")
{
	
	echo "<td><button type='button' class='btn btn-success' onClick='hello(". $id .",".$status.")'>Attended </button></td>";

	}
else{
	
	echo "<td><button type='button' class='btn btn-danger' onClick='hello(". $id .",".$status.")'>Unattended </button></td>";
}
echo"</tr>";
}

echo "</table>
 </form></div>";
	}
else if($state==0)
{
	
	$sql = "UPDATE ilpassistance SET attended='1' ,attended_status='Attended' WHERE emp_id='$id'";

    $query = mysql_query($sql);

    $reusult = mysql_fetch_assoc($query);
	 $result12 = mysql_query("SELECT * FROM ilpassistance WHERE status='1' ", $connection);
  echo " <div id='my_table' class='span5'>
                 <div class='row'>
    <div class='col-md-6'> <h4>Employees who need assistance</h4></div>
    <div class='col-md-6'>
    <div  style='float:right'>
    <a href='tcssafety_export.php' class='btn btn-primary'>Download Excel</a>
    
    </div>
    </div>
  </div>     
        
                                    <form  method='POST' name='contact-form1' id='contact-form' class='contact-form'>";
                           
$result12 = mysql_query("SELECT * FROM ilpassistance WHERE status='1' ", $connection);
echo "<table class='table table-striped'>
<tr>
<th>Employee ID</th>
<th>Name</th>
<th>Contact</th>
<th>Email</th>
<th>Query</th>
<th>Date & Time</th>
<th>Status</th>
</tr>";
while($row12= mysql_fetch_array($result12)) {
	$attendedstatus=$row12['attended'];
	$id=$row12['emp_id'] ;
	$status = $row12['attended'] ;
	$timeStamp = $row12['time'];
$timeStamp = date( "D,jMY", strtotime($timeStamp));
echo "<tr>
<td><h4>" . $row12['emp_id'] . "</h4></td>
<td><h4>" . $row12['emp_name'] . "</h4></td>
<td><h4>" . $row12['contact'] . "</h4></td>
<td><h4>" . $row12['email'] . "</h4></td>
<td><h4>" . $row12['notice'] . "</h4></td>
<td><h4>" . $timeStamp . "</h4></td>
";
if($row12['attended']=="1")
{
	
	echo "<td><button type='button' class='btn btn-success' onClick='hello(". $id .",".$status.")'>Attended </button></td>";

	}
else{
	
	echo "<td><button type='button' class='btn btn-danger' onClick='hello(". $id .",".$status.")'>Unattended </button></td>";
}
echo"</tr>";
}

echo "</table>
 </form>
</div>";

	}
    
?>