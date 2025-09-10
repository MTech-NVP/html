<?php
include_once("../config/connection_db.php");
if($_REQUEST['empid']) {
	$sql = "SELECT id,part_no,line, model,del_date,prod_hrs,balance,man_power,ct_as_of,exp_date,prod_hrs,plan_1,plan_2,plan_3,plan_4,plan_5,plan_6,plan_7,plan_8,plan_9,plan_10,plan_11,plan_12,plan_13,plan_14 FROM details_product WHERE id='".$_REQUEST['empid']."'";
	$resultSet = mysqli_query($conn, $sql);	
	$empData = array();
	while( $emp = mysqli_fetch_assoc($resultSet) ) {
		$empData = $emp;
	}
	echo json_encode($empData);
} else {
	echo 0;	
}
?>
