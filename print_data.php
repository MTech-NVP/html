<?php
header('Access-Control-Allow-Origin: *');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

</head>
<body>
  


  <title>Design Creator</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Design Creator</title>
  <style>

    * {
      font-family: Arial, Helvetica, sans-serif;
      box-sizing: border-box;
      margin: 0;padding: 0;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 5px;
      padding-left:20px;
    }
    .design-container {

      border: 1px solid #ddd;
      border-radius: 5px;

    }


    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    #prepared_img,#checked_img,#approved_img{
      width: 130px;
      height: 65px;

    }
    .sign-container{
      display:flex; 
      justify-content:center;
    }

    td{
	font-size:14px;
	font-weight:700;
    }

  </style>
</head>
<body>
  <button onclick="window.history.back()">Go Back</button>
  <button id = "captureButton">Record now</button>
  <div id="designContainer" class="design-container">
   <!--Main container-->
   <div style="
    display: flex; flex-direction:column;border-style:solid;
    width: 1987px;
    height: 1119px;
    border-radius: 3px;
    border-width: 5px;
    margin-left:5px;
    ">
<!--Main container-->
<!--**************************************************************************-->
<!--header-style-->
        <div style="
            display:flex;
            flex-direction:column;
        ">
<!--**************************************************************************-->
<!--header1-style-->
            <div style="display: flex; flex-direction:row; justify-content:space-between; margin:4px 5px 4px;">
                <div style="width: 500px; display:flex; flex-direction:row;">
                    <img src="nichivi-logo.jpg" width="200" height="50" alt="">
                    <h3 style="font-weight: 800;">ASSEMBLY SECTION</h3>
                </div>
                <div style="width:750px;">
                        <h2 style="text-decoration: underline;">PRODUCTION OUTPUT AND DOWNTIME MONITORING</h2>
                </div>
                    
                <div style="display:flex; flex-direction:row; width:500px; justify-content:space-between;">
                    <div style="width: 150px; height:100px; border-style:solid; display:flex;flex-direction:column;">
                      <div class="sign-container" style="width:145px; height:105px; border-bottom-style:solid;">
                      <?php
                 if (isset($_GET['image3'])) {
                      $imageUrl3 = urldecode($_GET['image3']);
                    echo "<img id = 'approved_img' src='$imageUrl3' alt='Transferred Image'>";
                 } else {
                    echo "<p>No image1 was passed.</p>";
                 }
                      ?>   
                      </div>
                      <div style="width: 145; height:35px; text-align:center; font-weight:900;font-size:16px;">
                        <span>Approved</span>
                      </div>
                    </div>
                    <div style="width: 150px; height:100px; border-style:solid; display:flex;flex-direction:column;">
                      <div class="sign-container" style="width:145px; height:105px; border-bottom-style:solid;">
                      <?php
                 if (isset($_GET['image1'])) {
                      $imageUrl1 = urldecode($_GET['image1']);
                    echo "<img id = 'checked_img' src='$imageUrl1' alt='Transferred Image'>";
                 } else {
                    echo "<p>No image1 was passed.</p>";
                 }
                      ?>   
                      </div>
                      <div style="width: 145; height:35px; text-align:center; font-weight:900;font-size:16px;">
                        <span>Checked</span>
                      </div>
                    </div>
                    <div style="width: 150px; height:100px; border-style:solid; display:flex;flex-direction:column;">
                      <div class="sign-container" style="width:145px; height:105px; border-bottom-style:solid;">
                      <?php
                 if (isset($_GET['image'])) {
                      $imageUrl = urldecode($_GET['image']);
                    echo "<img id = 'prepared_img' src='$imageUrl' alt='Transferred Image'>";
                 } else {
                    echo "<p>No image was passed.</p>";
                 }
    ?>
                      </div>
                      <div style="width: 145; height:35px; text-align:center; font-weight:900;font-size:16px;">
                  
                        <span>Prepared</span>
                      </div>
                    </div>
                </div>
            </div>
<!--header1-style-->
<!--**************************************************************************-->
<!--header2-style-->
            
            <div style="width: 100%; height:100px; border-bottom-style:solid; display:flex;flex-direction:row; justify-content:space-between;">
              <!--1-->
              <div style="display:flex; flex-direction:column;
              justify-content:space-around; font-size:16px; font-weight:600; margin-left:35px;
               ">
                <div>
                  <span style="display:grid; grid-template-columns:55px 180px;">LINE: <p id="lines" style="width: 200px; border-bottom-style:solid; text-align:center;box-sizing: border-box;margin: 0;padding: 0;  " id ="lines"></p></span>
                </div>
                <div>
                  <span style="display:grid; grid-template-columns:55px 180px;">DATE: <p id="date"style="width: 200px; border-bottom-style:solid; text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
              </div>
              <!--1-->
              <!--***************************************************-->
              <!--2-->
              <div style="display:flex; flex-direction:column;
              justify-content:space-around; font-size:16px; font-weight:600;
               ">
              <div>
                  <span style="display:grid; grid-template-columns:90px 180px;">MODEL: <p id="model" style="width: 200px; border-bottom-style:solid;text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p> </span>
                </div>
                <div >
                  <span style="display:grid; grid-template-columns:90px 180px;" >PART NO.: <p id="part_no" style="width: 200px; border-bottom-style:solid; text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
              </div>
              <!--2-->
              <!--***************************************************-->
             <!--3-->
              <div style="border-style:solid; width:200px; height:130px;  margin-top:-50px;">
                <img src="" alt="PICTURE_PRODUCT">
              </div>
              <!--3-->
              <!--***************************************************-->
              <!--4-->
              <div style="display:flex; flex-direction:column;
              justify-content:space-around; font-size:16px; font-weight:600; margin-right:-40px; 
               ">
                <div>
                  <span  style="display:grid; grid-template-columns:120px 200px;" >DEL.DATE:<p id="del_date"style="width: 200px; border-bottom-style:solid;text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
                <div>
                  <span style="display:grid; grid-template-columns:120px 200px;" >BALANCE:<p  id="balance"style="width: 200px; border-bottom-style:solid; text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
                <div>
                  <span style="display:grid; grid-template-columns:120px 200px;" >MANPOWER: <p id="manpower" style="width: 200px; border-bottom-style:solid;text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p> </span>
                </div>
              </div>
              <!--4-->
              <!--***************************************************-->
              <!--5-->
              <div style="display:flex; flex-direction:column;
              justify-content:space-around; font-size:16px; font-weight:600; margin-right:30px;
               ">
                <div>
                  <span style="display:grid; grid-template-columns:90px 200px;" >CT.AS.OF:<p id="ctasof" style="width: 200px; border-bottom-style:solid;text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
                <div>
                  <span style="display:grid; grid-template-columns:90px 200px;" >EXP.DEL: <p  id="expdate"style="width: 200px; border-bottom-style:solid;text-align:center;box-sizing: border-box;margin: 0;padding: 0;"></p></span>
                </div>
              </div>
              <!--5-->
              <!--***************************************************-->
            </div>
        </div>
<!--header-style2-->
<!--****************************************************************************-->       
<!--header-style-->
<!--content-body-->
        <div>
          <table style="width: 100%; box-sizing: border-box;margin: 0;padding: 0;">
            <thead>
              <tr >
                 <th style="width: 585px; border-right: 0.5px solid; box-sizing: border-box;margin: 0;padding: 0;font-size:14px;"><span>PRODUCTION</span></th>
                <th style="width: 100px; border-right: 0.5px solid; box-sizing: border-box;margin: 0;padding: 0;font-size:14px;">TOTAL
                </th>
                <th style="border-bottom:none; font-size:20px;border-style:none; height:25px; box-sizing: border-box;margin: 0;padding: 0;">
                  <span >
                    DOWNTIME MONITORING
                  </span>
                </th>
                <th >
                  <h3>

                  </h3>
                </th>
              </tr>
            </thead>
            
          </table>
  <!--***********************************************************************-->
          
  <!--********************************************************************************-->
          <table style="width: 100%; text-align:center;box-sizing: border-box;margin: 0;padding: 0;">
            <thead>
              <tr>
                <th style="width: 316px; border-right:0.5px solid; border-top: 0.5px solid; height:25px; box-sizing: border-box;margin: 0;padding: 0;"><span>PLAN</span></th>
                <th style="width: 268px; border-top: 0.5px solid; border-right: 0.5px solid; height:25px; box-sizing: border-box;margin: 0;padding: 0;"><span>ACTUAL</span></th>
                <th style="width:99.5px; border-top: none; border-bottom-style:none; border-right: 0.5px solid; border-left:0.5 solid; height:25px;box-sizing: border-box;margin: 0;padding: 0;font-size:14px;"><span>NG</span></th>
                <th style="border-bottom:none;box-sizing: border-box;margin: 0;padding: 0;"></th>
              </tr>
            </thead>

          </table>
  <!--**********************************************************************************-->
          <table style="width: 100%; border-collapse:collapse; font-size:10px;box-sizing: border-box;margin: 0;padding: 0;">
            <thead>
              <tr>
                <th style="border-right:0.5px solid; width:91px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0; ">TIME</th>
                <th style="border-right:0.5px solid; width:50px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">CYCLE TIME</th>
                <th style="border-right:0.5px solid; width:34px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">MIN</th>
                <th style="border-right:0.5px solid; width:70px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">PLAN OUTPUT/HR</th>
                <th style="border-right:0.5px solid; width:72px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">TOTAL PLAN OUTPUT / HR</th>
                <th style="border-right:0.5px solid; width:100px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">ACTUAL OUTPUT / HR</th>
                <th style="border-right:0.5px solid; width:99px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;" > TOTAL ACTUAL OUTPUT/ HR</th>
                <th style="border-right:0.5px solid; width:70px; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">ACHIEVE / HR</th>
                <th style="width: 101.5px;  border-top: 0.5px solid; border-bottom:0.5px solid;font-size:14px;">QTY</th>
                <th style="border-right:0.5px solid; border-left:0.5px solid; border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">PROCESS</th>
                <th style="border-right:0.5px solid;  border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">DETAILS</th>
                <th style="border-right:0.5px solid;  border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">ACTION</th>
                <th style="width:150px;border-right:0.5px solid;  border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">DOWNTIME</th>
                <th style="width:180px;border-right:0.5px solid;  border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">PIC</th>
                <th style="border-right:0.5px solid;  border-top: 0.5px solid; border-bottom:0.5px solid;box-sizing: border-box;margin: 0;padding: 0;">REMARKS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">6AM-7AM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan1" style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="hr_print1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="hrtotal_print1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;" ></td>
                <td id ="hrachieve1" style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "totalng1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "detail1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "act1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="pic1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="remarks1"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
              </tr>
              <tr>
                <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">7AM-8AM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id = "plan2" style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "total_plan2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="hrachieve2" style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "totalng2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="pic2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks2"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">8AM-9AM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks3"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">9AM-10AM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks4"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
              <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">10AM-11AM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks5"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
              <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">11AM-12NN</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks6"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
              <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">12NN-1PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks7"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
              <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">1PM-2PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks8"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
              <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">2PM-3PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks9"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td  style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">3PM-4PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks10"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0;text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">4PM-5PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id = "plan11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks11"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">5PM-6PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id = "plan12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks12"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td  style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700;font-family:Verdana, Geneva, Tahoma, sans-serif;">6PM-7PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks13"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">7PM-8PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks14"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td  style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0;text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">8PM-9PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks15"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>
              <tr>
                <td  style="border:1px solid black; height:30px; box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">9PM-10PM</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">231.76</td>
                <td style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;">60</td>
                <td id ="plan16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="total_plan16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hr_print16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrtotal_print16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "hrachieve16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id ="totalng16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "process16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "details16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "action16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "downtime16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "pic16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>
                <td id = "remarks16"style="border:1px solid black; height:30px;box-sizing: border-box;margin: 0;padding: 0; text-align:center; font-weight:700; font-family:Verdana, Geneva, Tahoma, sans-serif;"></td>

              </tr>

            </tbody>
          </table>
  <!---*******************************************************************************************-->

        </div>
        <div style = "display:grid; grid-template-columns:40% 40% 20%; height:300px; margin:0; box-sizing: border-box; padding:0;">
            <!-- PRODUCTION GRAPH-->
          <div style=" padding:5px;">
              <div style="width:100%;border:2px solid black; height:100%; margin:0; box-sizing: border-box; padding:0;">
                <canvas style="margin:0; box-sizing: border-box; padding:0;" id="printchart" width="500" height="220" ></canvas>
              </div>
          </div>
            <!-- PRODUCTION GRAPH END -->
  <!--******************************************************************************************-->
            <!-- downtime graph -->
          <div style=" padding:5px;">
             <div style="width:100%; border:2px solid black; height:100%; margin:0; box-sizing: border-box; padding:0;">
                 <canvas style="margin:0; box-sizing: border-box; padding:0;" id="down_chart_print" width="500" height="220" ></canvas>
             </div>
          </div>
            <!-- downtime graph end -->
<!--******************************************************************************************-->
          <div style=" padding:5px;">
            <div style="width:100%; border:2px solid black; height:100%; margin:0; box-sizing: border-box; padding:0;">
              <div style="display:flex;justify-content:center;align-items:center;height:48px;text-align: center; border-bottom:2px solid black; margin:0; box-sizing: border-box; padding:0;">
                <span style="text-align:center; font-weight: bold; font-size:25px;">SUMMARY</span>
              </div>  
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%; ">
                <div style=" border-right: 2px solid black;border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px;font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> TOTAL OUTPUT:</div>
                <div id = "total_output_sum" style="border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px;font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> TOTAL NG:</div>
                <div id = "total_ng_sum" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> GOOD QTY:</div>
                <div id = "good_sum" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box;padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> TOTAL.PROD.HRS:</div>
                <div id ="total_prod_sum" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> TOTAL DOWNTIME:</div>
                <div id = "total_downtime_sum"style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************--> 
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black; padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> ACTUAL.PROD.HRS:</div>
                <div id = "actual_sum" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style="border-right: 2px solid black;border-bottom: 2px solid black; text-align:center;padding-top:5px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> ACTUAL.MANPOWER:</div>
                <div id = "manpower_sum"style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:30px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>
              <!--**********************************************************************-->
              <div style="display:grid; grid-template-columns:70% 30%;">
 		<div style=" border-bottom:1px solid black;border-right: 2px solid black; padding-top:5px; text-align:center;height:32px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> BREAKTIME:</div>
                <div id = "breaktime_sum" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:32px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>  

              <div style="display:grid; grid-template-columns:70% 30%;">
                <div style=" border-bottom:1px solid black;border-right: 2px solid black; padding-top:5px; text-align:center;height:32px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"> ACHIEVE TODAY:</div>
                <div id = "achieve_day" style="border-bottom: 2px solid black;padding-top:5px; text-align:center;height:32px; font-weight:bold; font-size:15px; margin:0; box-sizing: border-box; padding-top:5px;"></div>
              </div>  

            </div>    
          </div>
        </div>
    </div>

      
  </div>
  
<script>

</script>
  <script>

/*    let designIndex = localStorage.getItem('designIndex') ? parseInt(localStorage.getItem('designIndex')) : 0;

    function saveDesign() {
      const designContent = document.getElementById('designContainer').outerHTML;
      if (designContent.trim()) {
        designIndex++;
        localStorage.setItem('designContent_' + designIndex, designContent);
        localStorage.setItem('designIndex', designIndex);
        alert('Design saved successfully!');
        
        // Optionally clear the design container
        document.getElementById('designContainer').innerHTML = '';
      } else {
        alert('Please create some design content.');
      }
    }

    */


    document.getElementById('captureButton').addEventListener('click', function() {
      html2canvas(document.getElementById('designContainer')).then(canvas => {
        // Convert canvas to Base64
        const base64Image = canvas.toDataURL('image/png');
        // Send to server
        sendToServer(base64Image);
      });

    });

    function sendToServer(base64Image) {
      const partno  = document.getElementById('part_no').textContent;
      const line = document.getElementById('lines').textContent;
      const total_output  = document.getElementById('total_output_sum').textContent;
      const totalng = document.getElementById('total_ng_sum').textContent;
      const goodqty  = document.getElementById('good_sum').textContent;
      const totalprod = document.getElementById('total_prod_sum').textContent;
      const totaldowntime  = document.getElementById('total_downtime_sum').textContent;
      const actualprod = document.getElementById('actual_sum').textContent;
      const manpower = document.getElementById('manpower_sum').textContent;
      const breaktime = document.getElementById('breaktime_sum').textContent;
      const achieved = document.getElementById('achieve_day').textContent;



      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'capture_image.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log('Image saved successfully');
         //   alert('Successfully record the data');
          } else {
            console.error('Error saving image:', xhr.responseText);
          }
        }
      };
      xhr.send(`image=${encodeURIComponent(base64Image)}`);
      

      const actualReset ={
        data_hr:0,
        totalData_hr:0,
        achieve_data:0
      }
      const downtimeReset = {
        process:'-',
        details:'-',
        time_elapse:'-',
        action:'-',
        pics:'-',
        remarks:'-',
        timeCount:0
      }
      const dataSum = {
        sumOfdata:0,
        good_sum:0,
        achieve_day:0
      }
      const resetng = {
        ng1:0,
        ng2:0,
        ng3:0,
        ng4:0,
        ng5:0,
        ng6:0,
        ng7:0,
        ng8:0,
        ng9:0,
        ng10:0,
        ng11:0,
        ng12:0,
        ng13:0,
        ng14:0          
	
        };



      const sendHistory_data = {
	part_no:partno,
        lines:line,	
	total_output:total_output,
	totalngs:totalng,
	totalprod:totalprod,
	goodqty:goodqty,
        totaldowntime:totaldowntime,
 	actualprod:actualprod,
	manpower:manpower,
	breaktime:breaktime,
	achieved:achieved

      }



      var urlEncodedData1 = Object.keys(actualReset)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(actualReset[key]))
        .join('&');

    var xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "reset_actual.php", true);
    xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr1.onreadystatechange = function() {
        if (xhr1.readyState === XMLHttpRequest.DONE) {
            if (xhr1.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                //alert("Actual data is reset");
                console.log("Actual data is reset")
            } else {
                alert("Error: " + xhr1.status);
            }
        }
    };
    xhr1.send(urlEncodedData1);

    var urlEncodedData2 = Object.keys(downtimeReset)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(downtimeReset[key]))
        .join('&');

    var xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "reset_downtime.php", true);
    xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
              //  alert("Data was successfully recorded.");
                console.log("downtime data is reset")
            } else {
                alert("Error: " + xhr2.status);
            }
        }
    };
    xhr2.send(urlEncodedData2);

    var urlEncodedData3 = Object.keys(dataSum)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataSum[key]))
        .join('&');

    var xhr3 = new XMLHttpRequest();
    xhr3.open("POST", "reset_datasum.php", true);
    xhr3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr3.onreadystatechange = function() {
        if (xhr3.readyState === XMLHttpRequest.DONE) {
            if (xhr3.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
               // alert("reset the summary.");
                console.log("sum_count is reset")
            } else {
                alert("Error: " + xhr3.status);
            }
        }
    };
    xhr3.send(urlEncodedData3);


    var urlEncodedData4 = Object.keys(sendHistory_data)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(sendHistory_data[key]))
        .join('&');

    var xhr4 = new XMLHttpRequest();
    xhr4.open("POST", "send_history_data.php", true);
    xhr4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr4.onreadystatechange = function() {
        if (xhr4.readyState === XMLHttpRequest.DONE) {
            if (xhr4.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
               // alert("reset the summary.");
                console.log("send to history_data dbs")
            } else {
                alert("Error: " + xhr4.status);
            }
        }
    };
    xhr4.send(urlEncodedData4);


    var urlEncodedData5 = Object.keys(resetng)
      .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(resetng[key]))
        .join('&');

    var xhr5 = new XMLHttpRequest(resetng);
    xhr5.open("POST", "reset_ngs.php", true);
    xhr5.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr5.onreadystatechange = function() {
        if (xhr5.readyState === XMLHttpRequest.DONE) {
            if (xhr5.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
               // alert("reset the summary.");
                console.log("reset_ngs dbs");
            } else {
                alert("Error: " + xhr5.status);
            }
        }
    };
    xhr5.send(urlEncodedData5);

     alert("Data recorded!");
     window.location.href = "lcd_rev_code1.php";

    }


  </script>

<script>
  function displayTrig(){
  setInterval(function(){
    fetch('getTrigdata.php').then(function(response){

    return response.json();

    }).then(function(data){
      //countValue.innerText = JSON.stringify(data.viewcount,2,null);
     // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
     $('#trigger_value').text(data.trigData.TRIGG);

    }).catch(function(error){
        console.log(error);
    });
    
},1000);


}


 function prodtime_6am7am(){

    setInterval(function(){
        fetch('actual1.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print1").text(data.countPerHr.countPerHr);
         $("#hrtotal_print1").text(data.countPerHr.countTol);
         $("#hrachieve1").text(data.achieved.achieved+"%");

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

 function prodtime_7am8am(){

    setInterval(function(){
        fetch('actual2.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print2").text(data.countPerHr.countPerHr);
         $("#hrtotal_print2").text(data.countPerHr.countTol);
         $("#hrachieve2").text(data.achieved.achieved+"%");

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_8am9am(){
    setInterval(function(){
        fetch('actual3.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print3").text(data.countPerHr.countPerHr);
         $("#hrtotal_print3").text(data.countTol.countTol);
         $("#hrachieve3").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_9am10am(){
    setInterval(function(){
        fetch('actual4.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print4").text(data.countPerHr.countPerHr);
         $("#hrtotal_print4").text(data.countTol.countTol);
         $("#hrachieve4").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_10am11am(){
    setInterval(function(){
        fetch('actual5.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print5").text(data.countPerHr.countPerHr);
         $("#hrtotal_print5").text(data.countTol.countTol);
         $("#hrachieve5").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_11am12nn(){
    setInterval(function(){
        fetch('actual6.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print6").text(data.countPerHr.countPerHr);
         $("#hrtotal_print6").text(data.countTol.countTol);
         $("#hrachieve6").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_12nn1pm(){
    setInterval(function(){
        fetch('actual7.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print7").text(data.countPerHr.countPerHr);
         $("#hrtotal_print7").text(data.countTol.countTol);
         $("#hrachieve7").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_1pm2pm(){
    setInterval(function(){
        fetch('actual8.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print8").text(data.countPerHr.countPerHr);
         $("#hrtotal_print8").text(data.countTol.countTol);
         $("#hrachieve8").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_2pm3pm(){
    setInterval(function(){
        fetch('actual9.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print9").text(data.countPerHr.countPerHr);
         $("#hrtotal_print9").text(data.countTol.countTol);
         $("#hrachieve9").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_3pm4pm(){
    setInterval(function(){
        fetch('actual10.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print10").text(data.countPerHr.countPerHr);
         $("#hrtotal_print10").text(data.countTol.countTol);
         $("#hrachieve10").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_4pm5pm(){
    setInterval(function(){
        fetch('actual11.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print11").text(data.countPerHr.countPerHr);
         $("#hrtotal_print11").text(data.countTol.countTol);
         $("#hrachieve11").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_5pm6pm(){
    setInterval(function(){
        fetch('actual12.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print12").text(data.countPerHr.countPerHr);
         $("#hrtotal_print12").text(data.countTol.countTol);
         $("#hrachieve12").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_6pm7pm(){
    setInterval(function(){
        fetch('actual13.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print13").text(data.countPerHr.countPerHr);
         $("#hrtotal_print13").text(data.countTol.countTol);
         $("#hrachieve13").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_7pm8pm(){
    setInterval(function(){
        fetch('actual14.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#hr_print14").text(data.countPerHr.countPerHr);
         $("#hrtotal_print14").text(data.countTol.countTol);
         $("#hrachieve14").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

// downtime function

function downtime1(){
    setInterval(function(){
        fetch('downtime1.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process1").text(data.process.process);
         $("#detail1").text(data.details.details);
         $("#action1").text(data.action.Act);
         $("#downtime1").text(data.downtime.time_Elapse);
         $("#pic1").text(data.pic.Pics);
        $("#remarks1").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime2(){
    setInterval(function(){
        fetch('downtime2.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process2").text(data.process.process);
         $("#details2").text(data.details.details);
         $("#action2").text(data.action.Act);
         $("#downtime2").text(data.downtime.time_Elapse);
         $("#pic2").text(data.pic.Pics);
        $("#remarks2").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime3(){
    setInterval(function(){
        fetch('downtime3.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process3").text(data.process.process);
         $("#details3").text(data.details.details);
         $("#action3").text(data.action.Act);
         $("#downtime3").text(data.downtime.time_Elapse);
         $("#pic3").text(data.pic.Pics);
        $("#remarks3").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime4(){
    setInterval(function(){
        fetch('downtime4.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process4").text(data.process.process);
         $("#details4").text(data.details.details);
         $("#action4").text(data.action.Act);
         $("#downtime4").text(data.downtime.time_Elapse);
         $("#pic4").text(data.pic.Pics);
        $("#remarks4").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime5(){
    setInterval(function(){
        fetch('downtime5.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process5").text(data.process.process);
         $("#details5").text(data.details.details);
         $("#action5").text(data.action.Act);
         $("#downtime5").text(data.downtime.time_Elapse);
         $("#pic5").text(data.pic.Pics);
        $("#remarks5").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime6(){
    setInterval(function(){
        fetch('downtime6.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process6").text(data.process.process);
         $("#details6").text(data.details.details);
         $("#action6").text(data.action.Act);
         $("#downtime6").text(data.downtime.time_Elapse);
         $("#pic6").text(data.pic.Pics);
        $("#remarks6").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime7(){
    setInterval(function(){
        fetch('downtime7.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process7").text(data.process.process);
         $("#details7").text(data.details.details);
         $("#action7").text(data.action.Act);
         $("#downtime7").text(data.downtime.time_Elapse);
         $("#pic7").text(data.pic.Pics);
        $("#remarks7").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime8(){
    setInterval(function(){
        fetch('downtime8.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process8").text(data.process.process);
         $("#details8").text(data.details.details);
         $("#action8").text(data.action.Act);
         $("#downtime8").text(data.downtime.time_Elapse);
         $("#pic8").text(data.pic.Pics);
        $("#remarks8").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime9(){
    setInterval(function(){
        fetch('downtime9.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process9").text(data.process.process);
         $("#details9").text(data.details.details);
         $("#action9").text(data.action.Act);
         $("#downtime9").text(data.downtime.time_Elapse);
         $("#pic9").text(data.pic.Pics);
        $("#remarks9").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime10(){
    setInterval(function(){
        fetch('downtime10.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process10").text(data.process.process);
         $("#details10").text(data.details.details);
         $("#action10").text(data.action.Act);
         $("#downtime10").text(data.downtime.time_Elapse);
         $("#pic10").text(data.pic.Pics);
        $("#remarks10").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime11(){
    setInterval(function(){
        fetch('downtime11.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process11").text(data.process.process);
         $("#details11").text(data.details.details);
         $("#action11").text(data.action.Act);
         $("#downtime11").text(data.downtime.time_Elapse);
         $("#pic11").text(data.pic.Pics);
        $("#remarks11").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime12(){
    setInterval(function(){
        fetch('downtime12.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process12").text(data.process.process);
         $("#details12").text(data.details.details);
         $("#action12").text(data.action.Act);
         $("#downtime12").text(data.downtime.time_Elapse);
         $("#pic12").text(data.pic.Pics);
        $("#remarks12").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime13(){
    setInterval(function(){
        fetch('downtime13.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process13").text(data.process.process);
         $("#details13").text(data.details.details);
         $("#action13").text(data.action.Act);
         $("#downtime13").text(data.downtime.time_Elapse);
         $("#pic13").text(data.pic.Pics);
        $("#remarks13").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime14(){
    setInterval(function(){
        fetch('downtime14.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process14").text(data.process.process);
         $("#details14").text(data.details.details);
         $("#action14").text(data.action.Act);
         $("#downtime14").text(data.downtime.time_Elapse);
         $("#pic14").text(data.pic.Pics);
        $("#remarks14").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}



function getData(){
  setInterval(function(){
    fetch('product_details_print.php').then(function(response){

    return response.json();

    }).then(function(data){
     $('#part_no').text(data.partno.PART_NO);
     $('#lines').text(data.LINE_NO.LINENO);
     $("#model").text(data.model.model_product);
     $("#del_date").text(data.delDate.del_date);
     $('#balance').text(data.balance.BALANCE);
     $('#date').text(data.dates.CREATEDATE);
     $('#manpower').text(data.manpower.manpower_line);
     $('#ctasof').text(data.ctasof.CT_AS_OF);
     $('#expdate').text(data.expdate.EXP_DATE);

    }).catch(function(error){
        console.log(error);
    });
  },1000);
}
function Prod_plan(){
  setInterval(function(){
    fetch('displayPrintPlan.php').then(function(response){

    return response.json();

    }).then(function(data){
      //countValue.innerText = JSON.stringify(data.viewcount,2,null);
     // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
     $('#plan1').text(data.planp1.plan1);
     $("#plan2").text(data.planp2.plan2);
     $("#plan3").text(data.planp3.plan3);
     $("#plan4").text(data.planp4.plan4);
     $("#plan5").text(data.planp5.plan5);
     $("#plan6").text(data.planp6.plan6);
     $("#plan7").text(data.planp7.plan7);
     $("#plan8").text(data.planp8.plan8);
     $("#plan9").text(data.planp9.plan9);
     $("#plan10").text(data.planp10.plan10);
     $("#plan11").text(data.planp11.plan11);
     $("#plan12").text(data.planp12.plan12);
     $("#plan13").text(data.planp13.plan13);
     $("#plan14").text(data.planp14.plan14);
       // countValue.textContent = dataviewcount;
     
    }).catch(function(error){
        console.log(error);
    });
    
},1000);

}

function Prod_plan_tols(){
  setInterval(function(){
    fetch('print_totalPlan.php').then(function(response){

    return response.json();

    }).then(function(data){
     
     $("#total_plan1").text(data.planpt1.PLANT1);
     $("#total_plan2").text(data.planpt2.PLANT2);
     $("#total_plan3").text(data.planpt3.PLANT3);
     $("#total_plan4").text(data.planpt4.PLANT4);
     $("#total_plan5").text(data.planpt5.PLANT5);
     $("#total_plan6").text(data.planpt6.PLANT6);
     $("#total_plan7").text(data.planpt7.PLANT7);
     $("#total_plan8").text(data.planpt8.PLANT8);
     $("#total_plan9").text(data.planpt9.PLANT9);
     $("#total_plan10").text(data.planpt10.PLANT10);
     $("#total_plan11").text(data.planpt11.PLANT11);
     $("#total_plan12").text(data.planpt12.PLANT12);
     $("#total_plan13").text(data.planpt13.PLANT13);
     $("#total_plan14").text(data.planpt14.PLANT14);
       // countValue.textContent = dataviewcount;

    }).catch(function(error){
        console.log(error);
    });
    
},1000);


}




function downtime1(){
    setInterval(function(){
        fetch('get_data_downtime.php').then(function(response){
    
        return response.json();
      }).then(function(data){
            $("#process1").text(data.process_1.process);
            $("#detail1").text(data.details_1.details);
            $("#act1").text(data.action1.Act);
            $("#downtime1").text(data.downtime1.time_Elapse);
            $("#pic1").text(data.pic_1.Pics);
            $("#remarks1").text(data.remark_1.remark);
            
    // countValue.textContent = dataviewcount;
    
    }).catch(function(error){
      console.log(error);
    });
    
    },1000);
}

function summaryData(){
    setInterval(function(){
        fetch('get_print_sum.php').then(function(response){
    
        return response.json();
      }).then(function(data){
        
        $("#total_output_sum").text(data.totalData.total_output_data); 
        $("#total_ng_sum").text(data.total_ng_data.total_ng_data); 
        $("#good_sum").text(data.goodData.goodQty_data); 
        $("#total_prod_sum").text(data.totalProd.totalProdhr_data); 
        $("#total_downtime_sum").text(data.totaldown.totalDowntime_data); 
        $("#actual_sum").text(data.actualhr.actualProdhr_data);     
        $("#manpower_sum").text(data.actualman.actualManpower_data);
        $("#breaktime_sum").text(data.breaktime.breakTime_data); 
        $("#achieve_day").text(data.achieveday.achieveToday_data); 
    // countValue.textContent = dataviewcount;
    
    }).catch(function(error){
      console.log(error);
    });
    
    },1000);
}

function displayNgs(){
    setInterval(function(){
        fetch('displayngs.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#totalng1").text(data.ng1.ng1);
         $("#totalng2").text(data.ng2.ng2);
         $("#totalng3").text(data.ng3.ng3);
         $("#totalng4").text(data.ng4.ng4);
         $("#totalng5").text(data.ng5.ng5);
         $("#totalng6").text(data.ng6.ng6);
         $("#totalng7").text(data.ng7.ng7);
         $("#totalng8").text(data.ng8.ng8);
         $("#totalng9").text(data.ng9.ng9);
         $("#totalng10").text(data.ng10.ng10);
         $("#totalng11").text(data.ng11.ng11);
         $("#totalng12").text(data.ng12.ng12);
         $("#totalng13").text(data.ng13.ng13);
         $("#totalng14").text(data.ng14.ng14);        
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}



  document.addEventListener("DOMContentLoaded", (event) =>{  
      getData(); 
      prodtime_6am7am();
      prodtime_7am8am();
      prodtime_8am9am();
      prodtime_9am10am();
      prodtime_10am11am();
      prodtime_11am12nn();
      prodtime_12nn1pm();
      prodtime_1pm2pm();
      prodtime_2pm3pm();
      prodtime_3pm4pm();
      prodtime_4pm5pm();
      prodtime_5pm6pm();
      prodtime_6pm7pm();
      prodtime_7pm8pm();
    // downtime call
      downtime1();
      downtime2();
      downtime3();
      downtime4();
      downtime5();
      downtime6();
      downtime7();
      downtime8();
      downtime9();
      downtime10();
      downtime11();
      downtime12();
      downtime13();
      downtime14();
      displayNgs();
     // prod6_7am();
     // prodtime_7am8am();
      summaryData();
     // displayTrig();
      Prod_plan();
      Prod_plan_tols();
      //downtime1();
      fetchData();
	fetchPlanData();

      fetchDataDh();
      setInterval(fetchData,2000);
      setInterval(fetchDataDh,2000);
    });
  
</script>

<script>
let copiedPlan = [];
//const loadingIndicator = document.getElementById('loading'); // Uncomment this if you have a loading element

// Create the initial chart
const ctx = document.getElementById('printchart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Production data',
            data: [],
            backgroundColor: [],
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Show loading indicator
//function showLoading() {
  //  loadingIndicator.style.display = 'block';
//}

// Hide loading indicator
//function hideLoading() {
  //  loadingIndicator.style.display = 'none';
//}

function fetchData() {
//    showLoading();
    fetch('data_prod_chart.php')
        .then(response => response.json())
        .then(data => {
    //        hideLoading();
            if (data.labels.length !== data.datas.length) {
                console.error('Data inconsistency between labels and values.');
                return;
            }

            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.datas;

            if (copiedPlan.length > 0) {
                if (copiedPlan.length !== data.datas.length) {
                    console.error('Mismatch between copiedPlan and production data length.');
                    return;
                }

                // Set colors based on comparison
                chart.data.datasets[0].backgroundColor = data.datas.map((value, index) => {
                    console.log(`Comparing production value: ${value} with target: ${copiedPlan[index]}`);
                    return Number(value) >= Number(copiedPlan[index]) ? '#28A745' : 'red';
                });
            } else {
                console.error('copiedPlan array is empty.');
            }

            chart.update();
        })
        .catch(error => {
  //          hideLoading();
            console.error('Error fetching data:', error);
            alert('Failed to fetch data: ' + error.message);
        });
}

function fetchPlanData() {
   // showLoading();
    fetch('getarrayplan.php')
        .then(response => response.json())
        .then(data => {
       //     hideLoading();
            if (!data.datas || data.datas.length === 0) {
                throw new Error('Plan data is empty or invalid.');
            }

            copiedPlan = [...data.datas];
            fetchData();
        })
        .catch(error => {
     //       hideLoading();
            console.error('Error fetching plan data:', error);
            alert('Failed to fetch plan data: ' + error.message);
        });
}


const ctxhD = document.getElementById('down_chart_print').getContext('2d');
const chartD = new Chart(ctxhD,{
        type:'bar',
        data:{
            labels:[],
            datasets:[{
                label:'Downtime',
                data:[],
                backgroundColor:'red',
                broderColor:'rgba(75,192,192,1)',
                borderWidth:1
            }]
        },
        options:{
            scales:{
                y:{
                    beginAtZero:true
                }
            }
        }
    });

    function fetchDataDh(){
        fetch('barchart_print_downtime.php')
            .then(response=>response.json())
            .then(data=>{
                chartD.data.labels = data.labels;
                chartD.data.datasets[0].data=data.time_datas;
                chartD.update();
            })    
            .catch(error=>console.error('Error fetching data:',error));        
    }

</script>
</body>
</html>
