<?php
include_once('my_ilp_db.php');  
$result = "SELECT emp_id,emp_name,contact,email,notice,time FROM ilpassistance";
    function xlsBOF()
    {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
    }
    function xlsEOF()
    {
    echo pack("ss", 0x0A, 0x00);
    return;
    }
    function xlsWriteNumber($Row, $Col, $Value)
    {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
    }
    function xlsWriteLabel($Row, $Col, $Value )
    {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
    }
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=list.xls");
    header("Content-Transfer-Encoding: binary ");
    xlsBOF();
     
    xlsWriteLabel(0,0,"Heading1");
    xlsWriteLabel(0,1,"Heading2");
    xlsWriteLabel(0,2,"Heading3");
    $xlsRow = 1;
    while($row=mysql_fetch_array($result))
    {
    xlsWriteNumber($xlsRow,0,$row['emp_id']);
    xlsWriteLabel($xlsRow,1,$row['emp_name']);
    xlsWriteLabel($xlsRow,2,$row['email']);
    $xlsRow++;
    }
    xlsEOF();
    ?>