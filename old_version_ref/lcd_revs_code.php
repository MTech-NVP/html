<php 
include_once("connection_db.php");

?>


<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style_lcd.css">
    <title>Monitoring Screen</title>
    <style>


         #ngform{
		display:none;

		}

	.ng-container{
		  position:absolute;
		  background-color: #fff;
 		  border-radius: 10px;
 		  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
 		  width: 500px;
		  height: 500px;
		  padding: 0; 		 
 		  margin: 200px 520px 400px;

	
	}

	.ng-dis{
		display:grid;
		grid-template-columns:30% 70%;
		margin-top:10px;
	}
	.btn_ng{
		 width: auto;
		 display: flex;
 		 justify-content: center;
 		 align-items: center;
	       	margin-top:10px;

	}
	.btnngsub{

		width: 150px;
		height: 60px;
		background-color: #3664FF; /* Primary blue color */
		border: none;	
		border-radius: 10px;
		color: white;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;	
		transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        	}

	.addng,.viewng{

		width: 100px;
                height: 20px;
                background-color: #3664FF; /* Primary blue color */
                border: none;   
                border-radius: 10px;
                color: white;
                padding: 2px 2px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 12px;
                cursor: pointer;        
                transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
		margin-right:5px;
		}
	#viewng_details_cont{
		width:550px;
		max-height:200px;
		border:1px solid black;
		position:absolute;
		left:300px;
		top:250px;
		background-color:white;
		text-align:center;
		display:none;

	}
	
	#viewng_details_cont table{

		 text-align: center;
   		 font-weight: 800;
    	    	font-family: 'Times New Roman', Times, serif;
   		 border-collapse: collapse;
		height:500px;
	
	
	}
	 #keyboard_container{
 		display:none;
	
	}
	 .keyboard {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 10px;
            width: 660px;
            margin-top: 20px;
	    position:absolute;	
	    border:1px solid #3664FF;
	    background-color:white;
	    border-radius: 10px;
	    padding:5px;
	    margin-left:1050px;
	    margin-top:350px;
	    
        }

        .key {
            padding: 15px;
            text-align: center;
            border: 1px solid #888;
            border-radius: 5px;
            cursor: pointer;
	    background-color: #3664FF;
	    color:white;
        }

        .key:hover {
            background-color: #bbb;
        }

        input {
            width: 100%;
            font-size: 18px;
	    padding:0px;
        }

	 td{
	   font-size:14px;

        }


	.summary-content{
		width:305px;
	
	}
	.graph-sum{

		display:grid;
		grid-template-columns:80% 20%;

		}
	.graph-content{

		width:1250px;


		}

        .graph-data{

                display:grid;
                grid-template-columns:52% 48%;

                }
	.production-graph{

		width:640px;
		margin-right:10px;
	}

       .production-graph-data{

                width:640px;

        }

	.container_status{
	
		display:grid;
		grid-template-columns:130px 50px;		
		align-items:center;
		padding-top:30px;

		}
	.indicate_status{
	        background-color:#28A745;
                width:50px;
                height:50px;
                border-radius:50%;
		 animation: pulse 1.5s infinite;

	}

@keyframes pulse {
    0% {
        transform: scale(1) rotate(0deg);
    }
    50% {
        transform: scale(1.1) rotate(5deg);
    }
    100% {
        transform: scale(1) rotate(0deg);
    }
}
	.upper-div{
		display:grid;	
		grid-template-columns: 15% 15% 40% 30%;
		align-items:center;
	
	}
	

    </style>
</head>
<body>
    
        
    <div id = "main_history" class="history_main_con">
        <div class="his-header">
            <div>
                <button onclick="back()" class="back_button">BACK</button>
            </div>
            <div>
                <h1>PRODUCTION AND DOWNTIME HISTORY</h1>
            </div>
            <div>

            </div>

        </div>
        <div class="content_data">
             <div class="left_his">
                <div class="his_prod_graph">
                    <div>
                        <h2 style = " display:flex;justify-content:center;  height:50px;align-items:center; ">
                            Production graph history</h2>
                        <div style="width: 570px; height:400px;">
                            <canvas id ="history_prod_chart" width="570" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="his_down_graph">
                    <div >
                        <h2 style = "display:flex;justify-content:center;  height:50px;align-items:center;">Downtime graph history</h2>
                        <div style="width: 570px; height:400px;">
                            <canvas id ="history_down_chart" width="570" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="right_his">
                <table id = "dataTable" >
                    <thead>
                    <tr style="background-color: #3664FF; color:#fff; height:40px; font-weight:800;">
                        <th >NO</th>
                        <th>PART NO.</th>
                        <th>LINE</th>
                        <th>TOTAL OUPUT</th>
                        <th>TOTAL NG</th>
                        <th>GOOD QTY</th>
                        <th>TOTAL PROD HRS</th>
                        <th>TOTAL DOWNTIME</th>
                        <th>ACTUAL PROD HRS</th>
                        <th>ACTUAL MAN</th>
                        <th>BREAKTIME</th>
                        <th>ACHIEVE/DAY</th>
                        <th>DATE</th>
                    </tr>
                    </thead>


                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
            
    </div>
    <div class="big-border" id="lcd_data">
        
        <!--upper-div-start-->
        <div class="upper-div">
            <div style="margin-top: 30px; width:350px" >
                <img  style="height: 60px; width: 200px;" class="logo"src="nichivi-logo.jpg">
            </div>
	    <div class = "container_status">
                <span style = "font-size:18px; font-weight:600;">Line status:</span>
		<div class = "indicate_status" id = "status"></div>
	    </div>



            <div class="main-title">
                <h1>Production and Downtime Monitoring</h1>
                
            </div>
            
            <div class="btns-category">
                <div class="history-production-div">
                     <button onclick="history()" class="history-production-button">GO TO HISTORY</button>
                </div>

                <div class="SWP-div">
                    <button class="swp-button">SWP</button>
                </div>

                <div class="guide-div">
                    <button class="guide-button">GUIDE VIDEO</button>
                </div>


            </div>
      

             <!--upper-div-end

            -->
        </div>
        <!--upper-div-end-->
        <!--timer_form start-->
	
       <form id = "ngform">
	   <div class="ng-container">
		<div style = "text-align:center">
		    <h2>NG QTY FORM </h2>
		</div>
		
		<div class = "ng-dis" style ="margin-left:10px;">
		   <label>Time:<label>
		   <select  class = "select_drop" name = "time" id ="time_value" >
			<option value ="1">6am-7am</option>
			<option value ="2">7am-8am</option>
                        <option value ="3">8am-9am</option>
                        <option value ="4">9am-10am</option>
                        <option value ="5">10am-11am</option>
                        <option value ="6">11am-12nn</option>
			<option value ="7">12nn-1pm</option>
                        <option value ="8">1pm-2pm</option>
                        <option value ="9">2pm-3pm</option>
                        <option value ="10">3pm-4pm</option>
                        <option value ="11">4pm-5pm</option>
                        <option value ="12">5pm-6pm</option>
			<option value ="13">6pm-7pm</option>
			<option value ="14">7pm-8pm</option>
		   </select>
		</div>

		 <div class ="ng-dis" style ="margin-left:10px;">
                   <label>NG QTY:<label>
                   <select class = "select_drop" name = "ngqty" style = "margin-left:10px;" id ="ng_qty">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                   </select> 
		</div>

                <div class ="ng-dis">
                    <label>NG TYPE:</label>
                    <select name="ngtype1" class="select_drop" id="ngtype_1">
                        <option>slanted cut</option>
                        <option>short tube</option>
                        <option>long tube</option>
                        <option>No clamp</option>
                    </select>
                </div>
                <div class="ng-dis">
                    <label>NG TYPE:</label>
                    <select name="ngtype2" class="select_drop" id="ngtype_2">
                        <option>slanted cut</option>
                        <option>short tube</option>
                        <option>long tube</option>
                        <option>No clamp</option>
                    </select>
                </div>

                <div class="ng-dis">
                    <label>NG TYPE:</label>
                    <select name="ngtype3" class="select_drop" id="ngtype_3">
                        <option>slanted cut</option>
                        <option>short tube</option>
                        <option>long tube</option>
                        <option>No clamp</option>
                    </select>
                </div>
	        <div class ="btn_ng">
		  <button class = "btnngsub" type ="submit" onclick ="submitng()">Submit</button>
		</div>          

	   </div>
	</form>
    <div id = "keyboard_container">	
	
    <div class="keyboard">
    <div class="key" onclick="addToInput('q')">q</div>
    <div class="key" onclick="addToInput('w')">w</div>
    <div class="key" onclick="addToInput('e')">e</div>
    <div class="key" onclick="addToInput('r')">r</div>
    <div class="key" onclick="addToInput('t')">t</div>
    <div class="key" onclick="addToInput('y')">y</div>
    <div class="key" onclick="addToInput('u')">u</div>
    <div class="key" onclick="addToInput('i')">i</div>
    <div class="key" onclick="addToInput('o')">o</div>
    <div class="key" onclick="addToInput('p')">p</div>

    <div class="key" onclick="addToInput('a')">a</div>
    <div class="key" onclick="addToInput('s')">s</div>
    <div class="key" onclick="addToInput('d')">d</div>
    <div class="key" onclick="addToInput('f')">f</div>
    <div class="key" onclick="addToInput('g')">g</div>
    <div class="key" onclick="addToInput('h')">h</div>
    <div class="key" onclick="addToInput('J')">J</div>
    <div class="key" onclick="addToInput('k')">k</div>
    <div class="key" onclick="addToInput('l')">l</div>

    <div class="key" onclick="addToInput('z')">z</div>
    <div class="key" onclick="addToInput('x')">x</div>
    <div class="key" onclick="addToInput('c')">c</div>
    <div class="key" onclick="addToInput('v')">v</div>
    <div class="key" onclick="addToInput('b')">b</div>
    <div class="key" onclick="addToInput('n')">n</div>
    <div class="key" onclick="addToInput('m')">m</div>
    <div class="key" onclick="addToInput(' ')">Space</div>
    <div class="key" onclick="deleteFromInput()">Delete</div>
    <div class="key" onclick="clearInput()">Clear</div>
    </div>
   </div>
        <form id = "downtime_data" >
            <div  id = "con_time" class="con_timer" >
                <div class="title_form_downtime_timer">
                    <h1>Downtime Form</h1>
                </div>
                <div class="form-top-margin">
                    <label>Time Occur:</label>
                    <select name = "time_occur" class="select_drop" >
                        <option>6am-7am</option>
                        <option>7am-8am</option>
                        <option>8am-9am</option>
                        <option>9am-10am</option>
                        <option>10am-11am</option>
                        <option>11am-12nn</option>
                        <option>12nn-1pm</option>
                        <option>1pm-2pm</option>
                        <option>2pm-3pm</option>
                        <option>3pm-4pm</option>
                        <option>4pm-5pm</option>
                        <option>5pm-6pm</option>
                        <option>6pm-7pm</option>
                        <option>7pm-8pm</option>
                    </select>

                 </div>
                <div class="form-top-margin">
                    <label>Process:</label>
                    <select name = "process" class="select_drop" style="padding:0;" >
                        <option>Auto insertion(L-joint/EPDM)</option>
                        <option>Grommet/tube taping</option>
                        <option>Clamp taping tube & feeder</option>
                        <option>Clamp taping tube</option>
                        <option>Final inspection</option>
                        <option>Puting feeder/clamp</option>
                        <option>Auto cutting tube/insertion tube</option>
            

                    </select> 
		   <!-- <input style ="padding:3px;" type="text" id="input1" name = "process" placeholder="Input field " onclick="setActiveInput('input1')" /> -->
		    	
                </div>
                <div class="form-top-margin">
                    <label>Details:</label>
                  <!--  <select name="detail" class="select_drop">
                        <option>Damage1</option>
                        <option>Damage2</option>
                    </select> -->
		   <input style ="padding:3px;" type="text" id="input2" name = "detail" placeholder="Input field " onclick="setActiveInput('input2')"  />
                </div>
                <div class="form-top-margin">
                    <label>Action:</label>
                  <!--  <select name ="action" class="select_drop">
                        <option>action1</option>
                        <option>action2</option>
                    </select> -->
	       	<input style ="padding:3px;" type="text" id="input3" name ="action" placeholder="Input field " onclick="setActiveInput('input3')"  />
                </div>
                <div class="form-top-margin">
                <label>Downtime:</label> 
                    <input id = "timer_record" type="text" name = "downtime" required>
                </div>
                <div class="form-top-margin">
                <label>PIC:</label>
                   <!-- <select name = "pic" class="select_drop">
                        <option>pic1</option>
                        <option>pic2</option>
                    </select> -->
		 <input style ="padding:3px;"  type="text" id="input4" name ="pic" placeholder="Input field " onclick="setActiveInput('input4')" />
                </div>
                <div class="form-top-margin">
                <label>Remarks:</label>
                 <!--   <select name = "remark" class="select_drop">
                        <option>remark1</option>
                        <option>remark2</option>
                    </select> -->
		  <input style ="padding:3px;"  type="text" id="input5" name="remark" placeholder="Input field " onclick="setActiveInput('input5')" />
                </div>
                <div id = "error_msg"></div>
                <div  class="btn_sub_downtime">
                    <button type = "submit"  value = "Update data" onclick="submit_Data_timer()">Submit data</button>
                </div>
                <input style = "display:none;"  type="number" id = "number_time" name = "time_num">
            </div>
        </form>
	<div id ="viewng_details_cont">
	    <div style ="background-color: #3664FF; display:grid; grid-template-columns:1fr 40px; height:50px; align-items:center;">
		<h2> NG DETAILS</h2>
                <button style = "border:none; font-size:18px; background-color:#3664FF; color:white; height:30px;" onclick = "exitngTable()">X</button>

	   </div>
	  <table id = "ng_data">
		<thead>
    <tr>
        <th colspan="1">No.</th>
        <th>Time</th>
        <th>NG QTY</th>
        <th colspan="3">NGTYPE</th>
    </tr>
    <tr>
        <th></th> <!-- Empty cell for No. -->
        <th></th> <!-- Empty cell for Time -->
        <th></th> <!-- Empty cell for NG QTY -->
        <th>1</th>
        <th>2</th>
        <th>3</th>
    </tr>
</thead>



	   <tbody>		
	   </tbody>
	  </table>
	</div>    
        
        
        <!--timer_form end-->
        <!--content-div-start-->
        <div class="content-div">
            <!--left-content-start-->
            <div class="left-content">
                 <!--production-div-start-->
              <!--  <div class="production-div">
                    <div class="production-downtime-title">
<!--
                        <div style="border-right:none ;width: 885px; text-align: center; 
                         border-right-style:solid;
                          ">
                            <h2 >PRODUCTION</h2>
                        </div>
                        <div style="width: 400px; text-align: center;">   
                            <h2>DOWNTIME</h2>
                        </div>
                        
 -->                       

                    <table>
                        <tr>
                            <th class="production-class" style= "border-right:none;">PRODUCTION</th>
                            <th class="downtime-class" style ="width:400px;">DOWNTIME</th>
                        </tr>
                    </table>

                    </div>
                    <div class="plan-actual">
                        <div class="plan-actual-title">
                            <table class="title-table-plan-actual">
                                <tr>
                                    <th class="plan" style ="border-right:none;">PLAN</th>
                                    <th class="actual" style="border-right:none;">ACTUAL</th>
                                    <th class="extra">
					<div style="margin-left:5px;display:flex; justify-content:flex-start;"> 
                                          <button class = "viewng"onclick="viewng()">View Ng details</button>
				   	  <button class = "addng" onclick="addng()">Add NG?</button>
					</div>
				   </th>
                                </tr>
                            </table>
                            
                            
                        </div>

                    </div>
                    <div class="table-header-production">
		
                <--        <table class="table-data" style="background-color: #3664FF; color:white;">
                            <tr>
                                <th style="width: 100px; height: 30px;  ">Time</th>
                                <th>Cycle time</th>
                                <th style="width: 50px;">MIN</th>
                                <th>Plan output/hr</th>
                                <th>Total plan output</th>
                                <th>Actual output/hr</th>
                                <th>Total output</th>
                                <th>Achieved(%)</th>
                                <th>NG-QT</th>
                                <th >PROCESS</th>
                                <th>DETAILS</th>
                                <th >ACTION</th>
                                <th>DOWNTIME</th>
                                <th>PIC</th>
                                <th>REMARKS</th>
                            </tr>

                            <tr>
                                <td>6AM-7AM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan1">0</td>
                                <td id = "total_p1">0</td>
                                <td id = "prod_count_1">0</td>
                                <td id = "prod_total_count1">0</td>
                                <td id = "achieve_1">0</td>
                                <td id = "totalng1">0</td>
                                <td id  = "process1">-</td>
                                <td id = "detail1">-</td>
                                <td id = "act1">-</td>
                                <td id = "downtime1">-</td>
                                <td id = "pic1">-</td>
                                <td id ="remark1">-</td>
                            </tr>
                            <tr>
                                <td>7AM-8AM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan2">0</td>
                                <td id = "total_p2">0</td>
                                <td id = "prod_count_2">0</td>
                                <td id = "prod_total_count2">0</td>
                                <td id = "achieve2">0</td>
                                <td id = "totalng2">0</td>
                                <td id  = "process2"-></td>
                                <td id = "detail2">-</td>
                                <td id = "act2">-</td>
                                <td id = "downtime2">-</td>
                                <td id= "pic2">-</td>
                                <td id ="remark2">-</td>
                            </tr>
                            <tr>
                                <td>8AM-9AM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan3">0</td>
                                <td id = "total_p3">0</td>
                                <td id = "prod_count_3">0</td>
                                <td id = "prod_total_count3">0</td>
                                <td id = "achieve3">0</td>
                                <td id = "totalng3">0</td>
                                <td id  = "process3">-</td>
                                <td id = "detail3">-</td>
                                <td id = "act3">-</td>
                                <td id = "downtime3">-</td>
                                <td id= "pic3">-</td>
                                <td id ="remark3">-</td>
                            </tr>
                            <tr>
                                <td>9AM-10AM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan4">0</td>
                                <td id = "total_p4">0</td>
                                <td id = "prod_count_4">0</td>
                                <td id = "prod_total_count4">0</td>
                                <td id = "achieve4">0</td>
                                <td id = "totalng4">0</td>
                                <td id  = "process4">-</td>
                                <td id = "detail4">-</td>
                                <td id = "act4">-</td>
                                <td id = "downtime4">-</td>
                                <td id= "pic4">-</td>
                                <td id ="remark4">-</td>
                            </tr>
                            <tr>
                                <td>10AM-11AM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan5">0</td>
                                <td id = "total_p5">0</td>
                                <td id = "prod_count_5">0</td>
                                <td id = "prod_total_count5">0</td>
                                <td id = "achieve5">0%</td>
                                <td id = "totalng5">0</td>
                                <td id  = "process5">-</td>
                                <td id = "detail5">-</td>
                                <td id = "act5">-</td>
                                <td id = "downtime5">-</td>
                                <td id= "pic5">-</td>
                                <td id ="remark5">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>11AM-12NN</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan6">0</td>
                                <td id = "total_p6">0</td>
                                <td id = "prod_count_6">0</td>
                                <td id = "prod_total_count6">0</td>
                                <td id = "achieve6">0%</td>
                                <td id = "totalng6">0</td>
                                <td id  = "process6">-</td>
                                <td id = "detail6">-</td>
                                <td id = "act6">-</td>
                                <td id = "downtime6">-</td>
                                <td id= "pic6">-</td>
                                <td id ="remark6">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>12NN-1PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan7">0</td>
                                <td id = "total_p7">0</td>
                                <td id = "prod_count_7">0</td>
                                <td id = "prod_total_count7">0</td>
                                <td id = "achieve7">0%</td>
                                <td id = "totalng7">0</td>
                                <td id  = "process7">-</td>
                                <td id = "detail7"></td>
                                <td id = "act7">-</td>
                                <td id = "downtime7">-</td>
                                <td id= "pic7">-</td>
                                <td id ="remark7">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>1PM-2PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan8">0</td>
                                <td id = "total_p8">0</td>
                                <td id = "prod_count_8">0</td>
                                <td id = "prod_total_count8">0</td>
                                <td id = "achieve8">0%</td>
                                <td id = "totalng8">0</td>
                                <td id  = "process8">-</td>
                                <td id = "detail8">-</td>
                                <td id = "act8">-</td>
                                <td id = "downtime8">-</td>
                                <td id= "pic8">-</td>
                                <td id ="remark8">-</td>
                            </tr>

                            </tr>
                            <tr>
                                <td>2PM-3PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan9">0</td>
                                <td id = "total_p9">0</td>
                                <td id = "prod_count_9">0</td>
                                <td id = "prod_total_count9">0</td>
                                <td id = "achieve9">0%</td>
                                <td id = "totalng9">0</td>
                                <td id  = "process9">-</td>
                                <td id = "detail9">-</td>
                                <td id = "act9">-</td>
                                <td id = "downtime9">-</td>
                                <td id= "pic9">-</td>
                                <td id ="remark9">-</td>
                            </tr>
                            </tr>                        
                            <tr>
                                <td>3PM-4PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan10">0</td>
                                <td id = "total_p10">0</td>
                                <td id = "prod_count_10">0</td>
                                <td id = "prod_total_count10">0</td>
                                <td id = "achieve10">0%</td>
                                <td id = "totalng10">0</td>
                                <td id  = "process10">-</td>
                                <td id = "detail10">-</td>
                                <td id = "act10">-</td>
                                <td id = "downtime10">-</td>
                                <td id= "pic10">-</td>
                                <td id ="remark10">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>4PM-5PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan11">0</td>
                                <td id = "total_p11">0</td>
                                <td id = "prod_count_11">0</td>
                                <td id = "prod_total_count11">0</td>
                                <td id = "achieve11">0%</td>
                                <td id = "totalng11">0</td>
                                <td id  = "process11">-</td>
                                <td id = "detail11">-</td>
                                <td id = "act11">-</td>
                                <td id = "downtime11">-</td>
                                <td id= "pic11">-</td>
                                <td id ="remark11">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>5PM-6PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan12">0</td>
                                <td id = "total_p12">0</td>
                                <td id = "prod_count_12">0</td>
                                <td id = "prod_total_count12">0</td>
                                <td id = "achieve12">0%</td>
                                <td id = "totalng12">0</td>
                                <td id  = "process12">-</td>
                                <td id = "detail12">-</td>
                                <td id = "act12">-</td>
                                <td id = "downtime12">-</td>
                                <td id= "pic12">-</td>
                                <td id ="remark12">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>6PM-7PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan13">0</td>
                                <td id = "total_p13">0</td>
                                <td id = "prod_count_13">0</td>
                                <td id = "prod_total_count13">0</td>
                                <td id = "achieve13">0%</td>
                                <td id = "totalng13">0</td>
                                <td id  = "process13">-</td>
                                <td id = "detail13">-</td>
                                <td id = "act13">-</td>
                                <td id = "downtime13">-</td>
                                <td id= "pic13">-</td>
                                <td id ="remark13">-</td>
                            </tr>
                            </tr>
                            <tr>
                                <td>7PM-8PM</td>
                                <td>231</td>
                                <td>60</td>
                                <td id = "plan14">0</td>
                                <td id = "total_p14">0</td>
                                <td id = "prod_count_14">0</td>
                                <td id = "prod_total_count14">0</td>
                                <td id = "achieve14">0%</td>
                                <td id = "totalng14">0</td>
                                <td id  = "process14">-</td>
                                <td id = "detail14">-</td>
                                <td id = "act14">-</td>
                                <td id = "downtime14">-</td>
                                <td id= "pic14">-</td>
                                <td id ="remark14">-</td>
                            </tr>
                            </tr>




                        
                        </table> -->
                    </div>
                </div>
                 

            
                 <div class="graph-sum">
                 <!--graph-start-->
                    <div class="graph-content">
                        <div class="graph-title">
                            <h2>PRODUCTION & DOWNTIME GRAPH</h2>
                        </div>
                        <div class="graph-data">
                            <div class="production-graph">
                                <div class="production-graph-data">                            
                                    <canvas id = "chart" width="620" height="345"></canvas>
                                </div>
                                <div class="production-graph-title">
                                    <span>PRODUCTION</span>
                                </div>

                            </div>
                            <div class="downtime-graph">
                                <div class="downtime-graph-data">
                                    <canvas id = "downtime_chart" width="585"height = "345">

                                    </canvas>
                                </div>
                                <div class="downtime-graph-title">
                                    <span>
                                        DOWNTIME
                                    </span>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                  <!--graph-end-->
                  <div class="summary-content">
                        <div class="summ-title">
                            <h2>SUMMARY</h2>
                        </div>
                        <div class="sum-data">
                            <div>
                                <span class="sum_indi">
                                    TOTAL OUPUT:
                                </span>
                                <span id = "total_output"></span>
                                
                            </div>

                            <div>
                                <span class="sum_indi">
                                    TOTAL NG:
                                </span>
                                <span id = "total_NG">0</span>
                            </div>

                            <div>
                                <span class="sum_indi">
                                    GOOD QTY:
                                </span>
                                <span id = "good_qty"></span>
                            </div>

                            <div>
                                <span class="sum_indi">
                                    TOTAL PROD.HRS:
                                </span>
                                <span id= "totalProd_hr">8.83</span>
                            </div>

                            <div>
                                <span class="sum_indi">
                                    TOTAL DOWNTIME:
                                </span>
                                <span id = "total_downtime_data"></span>
                            </div>

                            <div>
                                <span class="sum_indi">
                                    ACTUAL PROD.HRS:
                                </span>
                                <span id = "actualProd_hr">8.83</span>
                            </div>

                            <div>
                                <span class="sum_indi">
                                    ACTUAL MANPOWER:
                                </span>
                                <span id = "actual_manpower">2</span>
                            </div>
                            <div>
                                <span class="sum_indi">
                                    BREAKTIME:
                                </span>
                                <span id="breaktime">1:40</span>
                            </div>
                            <div>
                                <span class="sum_indi">
                                    ACHIEVED/DAY(%):              
                                </span>
                                <span id = "AchieveToday"></span>
                            </div>

                            <div style="border-bottom-style:none; text-align:center;">
                                <button  id = "buttonSave" onclick="submitData()" class="save-data-btn">
                                    SAVE DATA
                                </button>
                                
                    
                            </div>
                        </div>
                  </div>
                 </div>


            </div>
            <!--left-content-end-->
            <!--right-content-start-->
            <div class="right-content">
                <div class="sign-content">
                    <div class="signatures">
                        <h2>Signatures</h2>
                    </div>

                    <div class="sign-person">

                        <div id="approved" style="margin-left: 2px;">
                            <div class = "selc_sign">
                                <div>
                                <img id="signa_approved" src="" alt="pic" style="width: 80px; height:70px; margin-left:5px;" >
                                </div>
                                
                                <select name="" id="approve_drop" >
                                    <option value="">Approved</option>
                                    <option value="1">Cera R.</option>
                                    
                                    
                                </select>
                                

                            </div>
                            
                        </div>  
                        <div id="checked">
                                <div class = "selc_sign">
                                    <div>
                                    <img id="signa_checked" src="" alt="pic" style="width: 85px; height:70px; margin-left:5px;" >
                                    </div>
                                    <select name="" id="check_dropdown">
                                        <option value="">Checked</option>
                                        <option value="1">Rhoda G.</option>
                                        
                                    </select>
                                </div>
                            
                        </div>
                        <div id="prepared">
                            <div class = "selc_sign">
                                     <div>
                                    <img id="signa_prepared" src="" alt="pic" style="width: 85px; height:70px; margin-left:5px;" >
                                    </div>
                                    <select name="" id="prepared_dropdown">
                                        <option value="">Prepared</option>
                                        <option value="1">Rio R.M.</option>

                                    </select>
                            </div>
                             
                        </div>

                    </div>

                    <div class="sign-category">
                        <span> Approved</span>
                        <span>Checked</span>
                        <span>Prepared</span>
                    </div>
                       
                </div>
                <div class="details-div">
                    <div class="picture-product">
                         
                    </div>
                    <div class="details">
                        
                    <div class="details" id="recordListing">
                       <div class="info-alignment">
                            <span>PART NO.:</span>
                            <select id = "plan_data" onchange="send_plan()">
                                    <option  id = "partno" value="" selected="selected" >Select Part.No</option>
                                        <?php
                                        $sql = "SELECT id ,part_no,line, model, date_created FROM details_product";
                                        $resultset = mysqli_query($conn, $sql);
                                        while( $rows = mysqli_fetch_assoc($resultset) ) { 
                                        ?>
                                        <option value="<?php echo $rows["id"]; ?>"><?php echo $rows["part_no"]; ?></option>
                                        <?php }	?>
                                    </select>
                        </div>
                        <div class="info-alignment">
                            <span>LINE:</span>
                            <div id = "line"></div>
                        </div>
                        <div class="info-alignment">
                            <span>MODEL:</span>
                            <div id = "model"></div>
                        </div>
                        <div class="info-alignment">
                            <span>DATE:</span>
                            <div id = "date"></div>
                        </div>
                        <div class="info-alignment">
                            <span>DEL.DATE:</span>
                            <div id = "del_date"></div>
                        </div class="info-alignment">
                        <div class="info-alignment">
                            <span>BALANCE:</span>
                            <div id = "balance"></div>
                        </div>
                        <div class="info-alignment">
                            <span>MANPOWER:</span>
                            <div id = "manpower"></div>
                        </div>
                        <div class="info-alignment">
                            <span>CT AS OF:</span>
                            <div id = "ct_as_of"></div>
                        </div>
                        <div class="info-alignment">
                            <span>EXP DATE:</span>
                            <div id = "expdate"></div>
                            
                        </div>
                    </div>
                   
                       
                    </div>
                        
                </div>
                <div class="timer-div">
                    <div class="timer-title">
                        <h2>DOWNTIME TIMER</h2>
                    </div>
                    <div class="timer">

                        <div class="time-content" id = "timer">
                            00:00:00
                        </div>
                        <div class="timer-btn">
                            <button onclick="startTimer()">Start</button>
                            <button onclick="stopTimer()">Stop</button>
                        </div>
                    </div>
                </div>

            </div>
            <!--right-content-end-->
        </div>  
        <!--content-div-end-->
    </div>
    <script>

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="drop_data.js"></script>
    <script src="dowtime_data.js"></script>
    <script src="bar_chart.js"></script>  
    <script src="actual_data.js"></script>
    <script src ="ngsend.js"></script>  
 <!--   <script src="script/printedData.js"></script> -->
    <script src= "signatures.js"></script>
   <script src = "save_data.js"></script>
   <script src="history.js"></script>   
   <script src = "ngdetails_display.js"></script>
    <script>
	signal = 0;

         function send_plan(){

                var selectedValue = document.getElementById("plan_data").value;

                var xhr = new XMLHttpRequest();
                    xhr.open("POST", "check_plan.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                           xhr.onreadystatechange = function () {
                                 if (xhr.readyState === 4 && xhr.status === 200) {
                                         // alert("Response from server: " + xhr.responseText);
                                         console.log("Response from server: " + xhr.responseText);
                                 }
                           };
                                 xhr.send("dropdownValue=" + encodeURIComponent(selectedValue));
                }

	function submitng(){
		signal = 1;	
		const selectElement = document.getElementById('time_value');
		const selectedValue = selectElement.value;
		const selectedText = selectElement.options[selectElement.selectedIndex].text;

		console.log("Selected Value:", selectedValue);
		console.log("Selected Text:", selectedText);
		const ngqty =document.getElementById('ng_qty').value;
		const ngtype_1= document.getElementById('ngtype_1').value;
		const ngtype_2= document.getElementById('ngtype_2').value;
		const ngtype_3= document.getElementById('ngtype_3').value;
		
//		console.log(time_txt);
		console.log(ngqty)
                console.log(ngtype_1);
                console.log(ngtype_2);
		console.log(ngtype_3);
   		 const dataToSend = {
       			 time: selectedText,
       			 time_val: selectedValue,
       			 ngqtys: ngqty,
      			 ngtype1:ngtype_1,
			 ngtype2:ngtype_2,
			 ngtype3:ngtype_3
   			 };
		const signalValue ={
			submit_sig:signal

			}

		const ngtimevalue = {
			time_val:selectedValue
			
			}

    // Convert data to URL-encoded string
		    var urlEncodedData = Object.keys(dataToSend)
       			 .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataToSend[key]))
        		 .join('&');

   			 var xhr = new XMLHttpRequest();
   			 xhr.open("POST", "sendNgdetails.php", true);
   			 xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  		         xhr.onreadystatechange = function() {
       			 if (xhr.readyState === XMLHttpRequest.DONE) {
           		   if (xhr.status === 200) {
               			 // alert("Data submitted successfully: " + xhr.responseText);
               			 console.log("data  is recorded");
           		 } else {
               			 alert("Error: " + xhr.status);
           		 }
       		 }
   	 };
   	 xhr.send(urlEncodedData);

                    var urlEncodedData1 = Object.keys(signalValue)
                         .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(signalValue[key]))
                         .join('&');

                         var xhr1 = new XMLHttpRequest();
                         xhr1.open("POST", "signal.php", true);
                         xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                         xhr1.onreadystatechange = function() {
                         if (xhr1.readyState === XMLHttpRequest.DONE) {
                           if (xhr1.status === 200) {
                                 // alert("Data submitted successfully: " + xhr.responseText);
                                 console.log("data  is recorded");
                         } else {
                                 alert("Error: " + xhr1.status);
                         }
                 }
         };

        xhr1.send(urlEncodedData1);

	

                    var urlEncodedData2 = Object.keys(ngtimevalue)
                         .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(ngtimevalue[key]))
                         .join('&');

                         var xhr2 = new XMLHttpRequest();
                         xhr2.open("POST", "timeVal.php", true);
                         xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                         xhr2.onreadystatechange = function() {
                         if (xhr1.readyState === XMLHttpRequest.DONE) {
                           if (xhr1.status === 200) {
                                 // alert("Data submitted successfully: " + xhr.responseText);
                                 console.log("ng time val:"+selectedValue);
                         } else {
                                 alert("Error: " + xhr2.status);
                         }
                 }
         };
         xhr2.send(urlEncodedData2);










	console.log("ng button is click");
	alert("NG successfully submitted");
	document.getElementById('ngform').style.display = "none";	
	}


let activeInputId = null;

// Set the active input field
function setActiveInput(inputId) {
    activeInputId = inputId;
}

// Add the clicked character to the active input field
function addToInput(value) {
    if (activeInputId) {
        const inputField = document.getElementById(activeInputId);
        inputField.value += value;
    }
}

// Delete the last character from the active input field
function deleteFromInput() {
    if (activeInputId) {
        const inputField = document.getElementById(activeInputId);
        inputField.value = inputField.value.slice(0, -1);
    }
}

// Clear the text in the active input field
function clearInput() {
    if (activeInputId) {
        const inputField = document.getElementById(activeInputId);
        inputField.value = "";
    }
}



	function addng(){
			document.getElementById('ngform').style.display ='block';
		}
	function back(){

    		document.getElementById('lcd_data').style.display = "flex";
    		document.getElementById('main_history').style.display = "none";
		}  
   	 function history(){
       		 document.getElementById('lcd_data').style.display = "none";
       		 document.getElementById('main_history').style.display = "block";;
     		 }  

	function exitngTable(){

		document.getElementById('viewng_details_cont').style.display='none';	
	
		}
	function viewng(){
		document.getElementById('viewng_details_cont').style.display ='block';
	
		}

   </script>

    
  <script>

/*   
$(document).ready (function() {
    $('#approve_drop').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'approved_data.php?id=' + selectedValue;
            $('#signa_approved').attr('src', imageUrl);
             
            $('#approved').show();
        } else {
            $('#approved').show();
        }
    });
});

$(document).ready(function() {
    $('#check_dropdown').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'checked_sign.php?id=' + selectedValue;
            $('#signa_checked').attr('src', imageUrl);
            var imageUrlc = document.getElementById("signa_checked").src;

            $('#checked').show();
        } else {
            $('#checked').show();
        }
    });
});

$(document).ready(function() {
    $('#prepared_dropdown').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'prepared_sign.php?id=' + selectedValue;
            $('#signa_prepared').attr('src', imageUrl);
            $('#prepared').show();
            var imageUrll = document.getElementById("signa_prepared").src;
            //window.location.href = "web7.php?image=" + encodeURIComponent(imageUrll);
        } else {
            $('#prepared').show();
        }
    });
});

function send_plan(){

    var selectedValue = document.getElementById("plan_data").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_plan.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           // alert("Response from server: " + xhr.responseText);
           console.log("Response from server: " + xhr.responseText);
        }
    };
    xhr.send("dropdownValue=" + encodeURIComponent(selectedValue));

}



    function history(){
        document.getElementById('lcd_data').style.display = "none";
        document.getElementById('main_history').style.display = "block";
        document.getElementById('designContainer').display ="none";
        document.getElementById('captureButton').display = "none";
      }  

    function back(){
         document.getElementById('lcd_data').style.display = "flex";
         document.getElementById('main_history').style.display = "none";
         document.getElementById('designContainer').display ="none";
         document.getElementById('captureButton').display = "none";
      }
   
      function submitData() {

    const copyPartno = document.getElementById("plan_data").value;
    const copyLine = document.getElementById('line').textContent;
    const copyModel = document.getElementById('model').textContent;
    const copyDate = document.getElementById('date').textContent;
    const copyDel_date = document.getElementById('del_date').textContent;
    const copyBalance = document.getElementById('balance').textContent;
    const copyManpower = document.getElementById('manpower').textContent;
    const copyctAsof = document.getElementById('ct_as_of').textContent;
    const copyExpdate = document.getElementById('expdate').textContent;
    const totalOutput = document.getElementById("total_output").textContent;
    const totalNg = document.getElementById("total_NG").textContent;
    const goodQty = document.getElementById("good_qty").textContent;
    const totalProdhrs = document.getElementById("totalProd_hr").textContent;
    const totalDowntime = document.getElementById("total_downtime_data").textContent;
    const actualProdhrs = document.getElementById("actualProd_hr").textContent;
    const actualManpower = document.getElementById("actual_manpower").textContent;
    const breakTime = document.getElementById("breaktime").textContent;
    const achieveDay = document.getElementById("AchieveToday").textContent;
    const line_no = document.getElementById("line").innerHTML;
    const part_no = document.getElementById("plan_data").value;
    //////////
    const pland1 = document.getElementById("plan1").textContent;
    const pland2 = document.getElementById("plan2").textContent;
    const pland3 = document.getElementById("plan3").textContent;
    const pland4 = document.getElementById("plan4").textContent;
    const pland5 = document.getElementById("plan5").textContent;
    const pland6 = document.getElementById("plan6").textContent;
    const pland7 = document.getElementById("plan7").textContent;
    const pland8 = document.getElementById("plan8").textContent;
    const pland9 = document.getElementById("plan9").textContent;
    const pland10 = document.getElementById("plan10").textContent;
    const pland11 = document.getElementById("plan11").textContent;
    const pland12 = document.getElementById("plan12").textContent;
    const pland13 = document.getElementById("plan13").textContent;
    const pland14 = document.getElementById("plan14").textContent;
    /////////
    const total_hr1 = document.getElementById('total_p1').textContent; 
    const total_hr2 = document.getElementById('total_p2').textContent; 
    const total_hr3 = document.getElementById('total_p3').textContent; 
    const total_hr4 = document.getElementById('total_p4').textContent; 
    const total_hr5 = document.getElementById('total_p5').textContent; 
    const total_hr6 = document.getElementById('total_p6').textContent; 
    const total_hr7 = document.getElementById('total_p7').textContent; 
    const total_hr8 = document.getElementById('total_p8').textContent; 
    const total_hr9 = document.getElementById('total_p9').textContent; 
    const total_hr10 = document.getElementById('total_p10').textContent; 
    const total_hr11 = document.getElementById('total_p11').textContent; 
    const total_hr12 = document.getElementById('total_p12').textContent; 
    const total_hr13 = document.getElementById('total_p13').textContent; 
    const total_hr14 = document.getElementById('total_p14').textContent;   
    ////////////////////////////////////
    const processd1 = document.getElementById('process1').textContent;
    const processd2 = document.getElementById('process2').textContent;
    const processd3 = document.getElementById('process3').textContent;
    const processd4 = document.getElementById('process4').textContent;
    const processd5 = document.getElementById('process5').textContent;
    const processd6 = document.getElementById('process6').textContent;
    const processd7 = document.getElementById('process7').textContent;
    const processd8 = document.getElementById('process8').textContent;
    const processd9 = document.getElementById('process9').textContent;
    const processd10 = document.getElementById('process10').textContent;
    const processd11 = document.getElementById('process11').textContent;
    const processd12 = document.getElementById('process12').textContent;
    const processd13 = document.getElementById('process13').textContent;
    const processd14 = document.getElementById('process14').textContent;
    ////////////////
    const detail_data1 = document.getElementById('detail1').textContent;
    const detail_data2 = document.getElementById('detail2').textContent;
    //////////////
    const act_data1 = document.getElementById('act1').textContent;
    const act_data2 = document.getElementById('act2').textContent;
    ////////////////////
    const downtime_data1 = document.getElementById('downtime1').textContent;
    const downtime_data2 = document.getElementById('downtime2').textContent;
    /////////////////////////
    const pic_data1 = document.getElementById('pic1').textContent;
    const pic_data2 = document.getElementById('pic2').textContent;
    const pic_data3 = document.getElementById('pic3').textContent;
    const pic_data4 = document.getElementById('pic4').textContent;
    const pic_data5 = document.getElementById('pic5').textContent;
    const pic_data6 = document.getElementById('pic6').textContent;
    const pic_data7 = document.getElementById('pic7').textContent;
    const pic_data8 = document.getElementById('pic8').textContent;
    const pic_data9 = document.getElementById('pic9').textContent;
    const pic_data10 = document.getElementById('pic10').textContent;
    const pic_data11 = document.getElementById('pic11').textContent;
    const pic_data12 = document.getElementById('pic12').textContent;
    const pic_data13 = document.getElementById('pic13').textContent;
    const pic_data14 = document.getElementById('pic14').textContent;
    /////////////////////////////////////
    const remark_data1 = document.getElementById('remark1').textContent;
    const remark_data2 = document.getElementById('remark2').textContent;
    const remark_data3 = document.getElementById('remark3').textContent;
    const remark_data4 = document.getElementById('remark4').textContent;
    const remark_data5 = document.getElementById('remark5').textContent;
    const remark_data6 = document.getElementById('remark6').textContent;
    const remark_data7 = document.getElementById('remark7').textContent;
    const remark_data8 = document.getElementById('remark8').textContent;
    const remark_data9 = document.getElementById('remark9').textContent;
    const remark_data10 = document.getElementById('remark10').textContent;
    const remark_data11 = document.getElementById('remark11').textContent;
    const remark_data12 = document.getElementById('remark12').textContent;
    const remark_data13 = document.getElementById('remark13').textContent;
    const remark_data14 = document.getElementById('remark14').textContent;
    //////////////////////////////////////////////
    const totalOutput_sum = document.getElementById('total_output').textContent;
    const goodQty_sum = document.getElementById('good_qty').textContent;
    const totalProdhr_sum = document.getElementById('totalProd_hr').textContent;
    const totalDowntime_sum = document.getElementById('total_downtime_data').textContent;
    const actualProdhr_sum = document.getElementById('actualProd_hr').textContent;
    const actualManpower_sum = document.getElementById('actual_manpower').textContent;
    const breakTime_sum = document.getElementById('breaktime').textContent;
    const achieveToday_sum = document.getElementById('AchieveToday').textContent;
    // Data to be sent
    const dataToSend = {
        total_output: totalOutput,
        totalNG: totalNg,
        Goodqty: goodQty,
        totalprodHrs: totalProdhrs,
        totaldownTime: totalDowntime,
        actualProdHrs: actualProdhrs,
        actualmanPower: Number(actualManpower),
        breaktime: breakTime,
        line_no: line_no,
        part_no: part_no,
        achd: achieveDay
    };
    // Convert data to URL-encoded string
    var urlEncodedData = Object.keys(dataToSend)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataToSend[key]))
        .join('&');

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "saveData.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // alert("Data submitted successfully: " + xhr.responseText);
                console.log("data  is recorded");
            } else {
                alert("Error: " + xhr.status);
            }
        }
    };
    xhr.send(urlEncodedData);
///////////////////////////////
const planData={
        plan1:pland1,
        plan2:pland2,
        plan3:pland3,
        plan4:pland4,
        plan5:pland5,
        plan6:pland6,
        plan7:pland7,
        plan8:pland8,
        plan9:pland9,
        plan10:pland10,
        plan11:pland11,
        plan12:pland12,
        plan13:pland13,
        plan14:pland14
    }
    var urlEncodedData2 = Object.keys(planData)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(planData[key]))
        .join('&');

    var xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "send_plan_data.php", true);
    xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
              //  alert("successfuly save plan data");
              console.log("plan data  is recorded");
            } else {
                alert("Error: " + xhr2.status);
            }
        }
    };
    xhr2.send(urlEncodedData2);

    const totalPlan = {
        totalhr1:total_hr1,
        totalhr2:total_hr2,
        totalhr3:total_hr3,
        totalhr4:total_hr4,
        totalhr5:total_hr5,
        totalhr6:total_hr6,
        totalhr7:total_hr7,
        totalhr8:total_hr8,
        totalhr9:total_hr9,
        totalhr10:total_hr7,
        totalhr11:total_hr7,
        totalhr12:total_hr7,
        totalhr13:total_hr13,
        totalhr14:total_hr14

    }
    var urlEncodedData3 = Object.keys(totalPlan)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(totalPlan[key]))
        .join('&');
    var xhr3 = new XMLHttpRequest();
    xhr3.open("POST", "totalPlan_print.php", true);
    xhr3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr3.onreadystatechange = function() {
        if (xhr3.readyState === XMLHttpRequest.DONE) {
            if (xhr3.status === 200) {
                console.log("total plan data  is recorded");

            } else {
                alert("Error: " + xhr3.status);
            }
        }
    };
    xhr3.send(urlEncodedData3);
    ////////////////////////////////////////////////////////////////////
    const process = {
        process1:processd1,
        process2:processd2,
        
        process3:processd3,
        process4:processd4,
        process5:processd5,
        process6:processd6,
        process7:processd7,
        process8:processd8,
        process9:processd9,
        process10:processd10,
        process11:processd11,
        process12:processd12,
        process13:processd13,
        process14:processd14
        
    };

    var urlEncodedData4 = Object.keys(process)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(process[key]))
        .join('&');

    var xhr4 = new XMLHttpRequest();
    xhr4.open("POST", "processData.php", true);
    xhr4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr4.onreadystatechange = function() {
        if (xhr4.readyState === XMLHttpRequest.DONE) {
            if (xhr4.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                //alert("process data  is record");
                console.log("process data  is recorded");

            } else {
                alert("Error: " + xhr4.status);
            }
        }
    };
    xhr4.send(urlEncodedData4);
    ///////////////////////////////////////////
    const details = {
        detail1:detail_data1,
        detail2:detail_data2

    }
    var urlEncodedData5 = Object.keys(details)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(details[key]))
        .join('&');

    var xhr5 = new XMLHttpRequest();
    xhr5.open("POST", "details_data.php", true);
    xhr5.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr5.onreadystatechange = function() {
        if (xhr5.readyState === XMLHttpRequest.DONE) {
            if (xhr5.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
               // alert("details data  is recorded");
               console.log("details data  is recorded");
            } else {
                alert("Error: " + xhr5.status);
            }
        }
    };
    xhr5.send(urlEncodedData5);
    /////////////////////////////////////////////////////////
    const action = {
        act1:act_data1,
        act2:act_data2

    }
    var urlEncodedData6 = Object.keys(action)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(action[key]))
        .join('&');

    var xhr6 = new XMLHttpRequest();
    xhr6.open("POST", "action_data.php", true);
    xhr6.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr6.onreadystatechange = function() {
        if (xhr6.readyState === XMLHttpRequest.DONE) {
            if (xhr6.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                //alert("action data  is recorded");
                console.log("action  is recorded");

            } else {
                alert("Error: " + xhr6.status);
            }
        }
    };
    xhr6.send(urlEncodedData6);
    ////////////////////

    const downtime = {
        downtime1:downtime_data1,
        downtime2:downtime_data2

    }
    var urlEncodedData7 = Object.keys(downtime)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(downtime[key]))
        .join('&');

    var xhr7 = new XMLHttpRequest();
    xhr7.open("POST", "downtimeData.php", true);
    xhr7.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr7.onreadystatechange = function() {
        if (xhr7.readyState === XMLHttpRequest.DONE) {
            if (xhr7.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
              //  alert("downtime data  is recorded");
              console.log("downtime data  is recorded");

            } else {
                alert("Error: " + xhr7.status);
            }
        }
    };
    xhr7.send(urlEncodedData7);
    ///////////////////////////////////////////
    const personIncharge = {
        pic1:pic_data1,
        pic2:pic_data2

    }
    var urlEncodedData8 = Object.keys(personIncharge)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(personIncharge[key]))
        .join('&');

    var xhr8 = new XMLHttpRequest();
    xhr8.open("POST", "picData.php", true);
    xhr8.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr8.onreadystatechange = function() {
        if (xhr8.readyState === XMLHttpRequest.DONE) {
            if (xhr8.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                //alert("PIC data  is recorded");
                console.log("pic data  is recorded");

            } else {
                alert("Error: " + xhr8.status);
            }
        }
    };
    xhr8.send(urlEncodedData8);
/////////////////////
const remarks_datas = {
        remark1:remark_data1,
        remark2:remark_data2
    }
    var urlEncodedData9 = Object.keys(remarks_datas)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(remarks_datas[key]))
        .join('&');

    var xhr9 = new XMLHttpRequest();
    xhr9.open("POST", "remarkData.php", true);
    xhr9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr9.onreadystatechange = function() {
        if (xhr9.readyState === XMLHttpRequest.DONE) {
            if (xhr9.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                //alert("remarks data  is recorded");
                console.log("remarks data  is recorded");

            } else {
                alert("Error: " + xhr9.status);
            }
        }
    };
    xhr9.send(urlEncodedData9);
/////////////////////////////////////////////////////////////////////////////////
const summary_datas = {
        total_output_data:totalOutput_sum,
        total_ng_data:totalNg,
        goodQty_data:goodQty_sum,
        totalProdhr_data:totalProdhr_sum,
        totalDowntime_data: totalDowntime_sum,
        actualProdhr_data:actualProdhr_sum,
        actualManpower_data:actualManpower_sum,
        breakTime_data:breakTime_sum,
        achieveToday_data:achieveToday_sum

    }
var urlEncodedData10 = Object.keys(summary_datas)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(summary_datas[key]))
        .join('&');

    var xhr10 = new XMLHttpRequest();
    xhr10.open("POST", "summaryData.php", true);
    xhr10.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr10.onreadystatechange = function() {
        if (xhr10.readyState === XMLHttpRequest.DONE) {
            if (xhr10.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                alert("The data was successfully saved.");

            } else {
                alert("Error: " + xhr10.status);
            }
        }
    };
    xhr10.send(urlEncodedData10);

/////////////////////////////////////////////////////////////////////////////////
    const dataToSend1 = {
        CopyPartno: copyPartno,
        CopyLine: copyLine,
        CopyModel: copyModel,
        CopyDate: copyDate,
        CopyDel_date: copyDel_date,
        CopyBalance: copyBalance,
        CopyManpower: copyManpower,
        CopyctAsof: copyctAsof,
        CopyExpdate: copyExpdate
    };

    var urlEncodedData1 = Object.keys(dataToSend1)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataToSend1[key]))
        .join('&');

    var xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "copyOfdata.php", true);
    xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr1.onreadystatechange = function() {
        if (xhr1.readyState === XMLHttpRequest.DONE) {
            if (xhr1.status === 200) {
                // After both data sets are sent successfully, redirect with both image URLs
                var imageUrll = document.getElementById("signa_prepared").src;
                var imageUrl2 = document.getElementById("signa_checked").src;
                var imageUrl3 = document.getElementById("signa_approved").src;
                window.location.href = "web7.php?image=" + encodeURIComponent(imageUrll) + "&image1=" + encodeURIComponent(imageUrl2)+ "&image3=" + encodeURIComponent(imageUrl3);
            } else {
                alert("Error: " + xhr1.status);
            }
        }
    };
    xhr1.send(urlEncodedData1);

    

}

*/

</script>
<script>
/*
    function updateTable() {
    let i = 0;
    var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_data_sum.php", true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    var tableBody = document.querySelector("#dataTable tbody");
                    tableBody.innerHTML = "";  // Clear existing data           
                    data.forEach(function(row) {
                        var tr = document.createElement("tr");
                        i++; 
                        tr.innerHTML = `
                            <td>${i}</td>
                            <td>${row.Partno}</td>
                            <td>${row.line_no}</td>
                            <td>${row.total_output}</td>
                            <td>${row.total_ng}</td>
                            <td>${row.good_qty}</td>
                            <td>${row.total_prod_hrs}</td>
                            <td>${row.total_downtime}</td>
                            <td>${row.actual_prod_hrs}</td>
                            <td>${row.manpower}</td>
                            <td>${row.breaktime}</td>
                            <td>${row.achieve_per_day}</td>
                            <td>${row.day_created}</td>
                        `;
                        tableBody.appendChild(tr);
                    });
                } else {
                    console.error("Failed to fetch data: " + xhr.status);
                }
            };
            xhr.send();
        }

    setInterval(updateTable, 1000);

        // Initial data fetch when the page loads
        window.onload = updateTable;
const ctxhp = document.getElementById('history_prod_chart').getContext('2d');
const charthp = new Chart(ctxhp,{
        type:'bar',
        data:{
            labels:[],
            datasets:[{
                label:'Output',
                data:[],
                backgroundColor:'#3664FF',
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

    function fetchDataph(){
        fetch('barchart_his_prod.php')
            .then(response=>response.json())
            .then(data=>{
                charthp.data.labels = data.dates;
                charthp.data.datasets[0].data=data.datas;
                charthp.update();
            })    
            .catch(error=>console.error('Error fetching data:',error));        
    }
    fetchDataph();
    setInterval(fetchDataph,2000);

    ///////////
    
    const ctxhd = document.getElementById('history_down_chart').getContext('2d');
    const charthd = new Chart(ctxhd,{
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
    function fetchDatadh(){
        fetch('barchart_his_down.php')
            .then(response=>response.json())
            .then(data=>{
                charthd.data.labels = data.dates;
                charthd.data.datasets[0].data=data.datas;
                charthd.update();
            })    
            .catch(error=>console.error('Error fetching data:',error));        
    }
    fetchDatadh();
    setInterval(fetchDatadh,2000);


    
*/

</script>
<script>

/*
  
function printData(){
    window.location.href = "web7.php";
}
function backTolcd(){

    document.getElementById('pdf-container').style.display ="none";
    document.getElementById('captureButton').style.display = "none";
    document.getElementById('lcd_data').style.display = "flex";
    document.getElementById('main_history').style.display = "none";
    document.getElementById('backtolcd').style.display = "none";
}  



    document.addEventListener("DOMContentLoaded", (event) =>{  
        getData(); 
        prod6_7am();
    //    displayTrig();
        fetchDataph();
        fetchDataDh();
        setInterval(fetchDataph,2000);
        setInterval(fetchDataDh,2000);

      });
*/

</script>
</body>
</html>
<style>
.guide-button,.Send-data, #captureButton,#backtolcd{
width: 150px;
height: 60px;
background-color: #3664FF; /* Primary blue color */
border: none;
border-radius: 10px;
color: white;
padding: 10px 20px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
cursor: pointer;
transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
}


#prepared_print,#checked_print,#approved_print{
    width: 85px;
    height: 40px;
    margin-left: 35px;
}
body{
  font-family: Arial, sans-serif;
  margin: 20px;
}
.right_his{
    overflow-y: scroll; 
    height: 1000px;
    border: 1px solid #ccc;
}
</style>

