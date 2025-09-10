<?php
// Check if form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = "123"; // Your MySQL password
    $dbname = "lcd_dbs"; // Your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $process = $_POST['process'];
    $detail = $_POST['detail'];
    $Act = $_POST['action'];
    $pic = $_POST['pic'];
    $remark = $_POST['remark'];
    $time_occur = $_POST['time_occur'];
    $downtime = $_POST['downtime'];
    $time_num = $_POST['time_num'];

    if (!empty($time_occur)) {
        // SQL query to fetch existing data
        $sql = "SELECT process, details, time_Elapse, Act, Pics, remark, time_num FROM downtime_data WHERE time_occur ='$time_occur'";
        $resultSet = $conn->query($sql);

        // Initialize temporary variables
        $temp_details = '';
        $temp_process = '';         
        $temp_downtime = '';
        $temp_action = '';
        $temp_remark = '';
        $temp_timenum = '';
        $temp_pic = '';

        if ($resultSet && $data = $resultSet->fetch_assoc()) {
            $temp_details = $data['details'];
            $temp_process = $data['process'];
            $temp_downtime = $data['time_Elapse'];
            $temp_action = $data['Act'];
            $temp_remark = $data['remark'];
            $temp_timenum = $data['time_num'];
            $temp_pic = $data['Pics'];
            if($temp_details == '-'){
		   $updated_details = $detail;
		   $updated_process =  $process;
   		   $updated_downtime =  $downtime;
      		   $updated_action =  $Act;
                   $updated_remark =  $remark;
                   $updated_timenum =  $time_num;
                   $updated_pic =  $pic;	
	
              }else{
		   $updated_details = $temp_details." " . "/" ." ". $detail;
   		   $updated_process = $temp_process ." " . "/" ." ". $process;
                   $updated_downtime = $temp_downtime ." " . "/" ." ".  $downtime;
                   $updated_action = $temp_action ." " . "/" ." ".  $Act;
                   $updated_remark = $temp_remark ." " . "/" ." ".  $remark;
                   $updated_timenum = $temp_timenum + $time_num;
                   $updated_pic = $temp_pic ." " . "/" ." ".  $pic;

		}
        }
    }

    // Update data by concatenating new values with existing values
/*
    $updated_details = $temp_details . "/" . $detail;
    $updated_process = $temp_process . "/" . $process;
    $updated_downtime = $temp_downtime . "/" . $downtime;
    $updated_action = $temp_action . "/" . $Act;
    $updated_remark = $temp_remark . "/" . $remark;
    $updated_timenum = $temp_timenum + $time_num;
    $updated_pic = $temp_pic . "/" . $pic;
*/
    // SQL query to update the data
    $sql = "UPDATE downtime_data SET process='$updated_process', details='$updated_details', Act='$updated_action', Pics='$updated_pic', time_occur='$time_occur', remark='$updated_remark', time_Elapse='$updated_downtime', time_num='$updated_timenum' WHERE time_occur = '$time_occur'";

    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
