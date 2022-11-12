<?php
   require_once('connection.php'); 
 @$inv_num = $_GET['sup_ID'];
 @$supId = $_GET['description'];
 @$price = $_GET['date'];
 
 @$splmentID = $_GET['ModCode'];
  //@$qty = $_GET['qty'];


 //echo $price;
//print
//exit();
 //}
 //}
 
       
       	
        $query = "SELECT ModCode, Description
                  FROM moduleinfo";
		$qry = $db->prepare($query);
		$qry->execute();
		$supplement = $qry->fetchAll();
		$qry->closeCursor();
		
       $query = "SELECT *
         FROM moduleinfo 
		 WHERE ModCode = :ModCode";
		$qry = $db->prepare($query);
		$qry->bindValue(':ModCode',$splmentID);
		$qry->execute();
		$suplDetail = $qry->fetchAll();
		$qry->closeCursor();
		
	
 // insert exm for student		
       function addSupl($inv_num, $supId, $price ){
	    global $db;
	     $query = "INSERT INTO file
		 (ModCode, moduleDescription, DateExam)
		  VALUES 
		  (:ModCode, :moduleDescription, :DateExam)";
	     $qry = $db->prepare($query);
		  $qry->bindValue(':ModCode', $inv_num);
		  $qry->bindValue(':moduleDescription', $supId);
		  $qry->bindValue(':DateExam', $price);
		  // $qry->bindValue(':Item_Quantity', $qty);
		  $qry->execute();
		  $qry->closeCursor();
    }
  // executes when buy button click on the user view
  if (htmlspecialchars(filter_input(INPUT_GET,'submit') == "add")){
	  //	echo $qty  ;	
	  
	 
		
		// add exam
		 addSupl($inv_num, $supId, $price);
		echo'<div id= "wrapper" class="">
         <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">X</button>
         <strong>Submitted!</strong> Exam successFully added.
         </div>';

         require_once('select.php');
		 
		  
		  // $updatedStockNumber = 0;
		  // updateStock($qty, $stock, $updatedStockNumber);
 // }
	//  else{		
 //        addSupl($inv_num, $supId, $price);
	// 	echo'<div id= "wrapper" class="">
 //         <div class="alert alert-success alert-dismissible">
 //         <button type="button" class="close" data-dismiss="alert">X</button>
 //         <strong>Submitted!</strong> supplement successFully added.
 //         </div>';
		 // updateStock($qty, $stock, $updatedStockNumber);
	 } 
 

?>