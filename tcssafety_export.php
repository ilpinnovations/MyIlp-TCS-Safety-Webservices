<?php
$DB_Server = "localhost"; 
$DB_Username = "jeet"; 
$DB_Password = "J@447788"; 
$DB_DBName = "schedulingnew"; 
$DB_TBLName = "ilpassistance"; 
$xls_filename = 'TCS_Safety.xls';
$sql = "SELECT emp_id AS 'Employee ID',emp_name AS 'Employee Name',contact AS 'Contact',email AS 'Email ID',notice AS 'Query',time AS 'DATE',attended_status AS 'Status' FROM ilpassistance";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());

$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());

$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");
$sep = "\t"; 
for ($i = 0; $i<mysql_num_fields($result); $i++) {
  echo mysql_field_name($result, $i) . "\t";
}
print("\n");
while($row = mysql_fetch_row($result))
{
  $schema_insert = "";
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      $schema_insert .= "NULL".$sep;
    }
    elseif ($row[$j] != "") {
      $schema_insert .= "$row[$j]".$sep;
    }
    else {
      $schema_insert .= "".$sep;
    }
  }
  $schema_insert = str_replace($sep."$", "", $schema_insert);
  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
  $schema_insert .= "\t";
  print(trim($schema_insert));
  print "\n";
}
?>