<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost","root","","oes");

$sqlQuery = "SELECT
                        COUNT(ModCode) 'TOTAL_COUNT',
                        DAYNAME(DateExam) 'SUBMIT_DAY'
                        FROM `exam_output`
                        WHERE NULLIF(DateExam,' ') IS NOT NULL
                        GROUP BY SUBMIT_DAY";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>