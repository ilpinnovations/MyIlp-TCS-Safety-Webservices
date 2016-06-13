<?php
include_once('iBuzzer/my_ilp_db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TCS Safety First</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="pace.js"></script>
 <link href="pace.css" rel="stylesheet" />
  <script>
  function hello(id,status)
  {	
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  document.getElementById("my_table").innerHTML = xmlhttp.responseText;
	}
  }
xmlhttp.open("GET","chennai_attended_status.php?id="+id+"&status="+status,true);
xmlhttp.send();

	  }
  </script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1>TCS Safety First - MyILP</h1>
    
  </div>
  
<div class="row">
     <div class="tabbable">
                
                    <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#help" data-toggle="tab">Urgent</a></li>
                       <!--- <li ><a href="#safe" data-toggle="tab">Safe</a></li>--->
                    </ul>
                 
                    <div class="tab-content">
                        <div class="tab-pane fade in" id="safe">
                        <div class="row">
                        
                        <div class="span5">
                        
                          <form id="contact-form" class="contact-form" action="" method="post">
                      <?php  
$result11 = mysql_query("SELECT * FROM ilpassistance WHERE status='0' ", $connection);

echo "<table class='table table-striped'>
<td><h4>Safe Employees</h4></td>";
echo "<tr>
<th>Employee ID</th>
<th>Name</th>
<th>Email</th>
</tr>";
while($row11= mysql_fetch_array($result11)) {
echo "<tr>
<td><h4>" . $row11['emp_id'] . "</h4></td>
<td><h4>" . $row11['emp_name'] . "</h4></td>
<td><h4>" . $row11['email'] . "</h4></td>
</tr>";
}

echo "</table>";


  ?>
            	
               
            </form>
                        </div>
                        
                        </div>
                        </div>
                         <div class="tab-pane fade in active" id="help">
                          <div class="row">
                          
                          <div id="my_table" class="span5">
                          <div class="row">
    <div class="col-md-6"> <h4>Employees who need assistance</h4></div>
    <div class="col-md-6">
    <div  style="float:right">
    <a href="tcssafety_export.php" class="btn btn-primary">Download Excel</a>
    
    </div>
    </div>
  </div>
                      
        <?php
                      echo "  <form  method='POST' name='contact-form1' id='contact-form' class='contact-form'>";
                           
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
 </form>";


  ?>
            	
                    
                        </div>
                        
                        
                          </div>
                         
                            
                        </div>
                        
                     
                    </div>
                            
				</div>
           
            <!-- End Tabs -->
          
  </div>
</div>


</body>
</html>
