<?php
$con  = mysqli_connect("localhost","root","","oes");

 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT DISTINCT(ModCode) 'MODULE', COUNT(StudentNumber) AS 'TOTAL'
                                FROM `studentmodule` 
                                WHERE StudentNumber 
                                IN (SELECT StudentNumber FROM `studentinfo`)
                                GROUP BY MODULE HAVING TOTAL > 3";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['MODULE']  ;
            $sales[] = $row['TOTAL'];
        }
 
 
 }
 
 
?>