<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



    <!-- <link rel="stylesheet" href="../cssfile/sheet_style.css">-->
    <title>New Data Sheet</title>
</head>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: arial;
    }

    body,
    html {
        font-family: sans-serif;
        height: 1190px;
        width: 1850px;

    }

    .main-container {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        width: 1850px;
        height: 1190px;


    }

    .red-text {
        color: red;

    }

    .green-text {
        color: green;

    }

    .header-title-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        height: 50px;
        margin-right: -50px;

    }

    .title-sheet-container {
        text-align: center;
        font-size: 25px;
        font-weight: 900;
        height: 40px;
        margin-left: 42px;
    }

    .nichiv-logo-container img {
        width: 70px;
        height: 50px;

    }

    .nichiv-logo-container {
        display: flex;
        align-items: center;
        justify-content: space-around;
        width: 300px;
        font-size: 15px;
        font-weight: 900;
        margin-left: 20px;
        margin-top: 12px;

    }

    .name-company {
        display: flex;
        flex-direction: column;
    }

    .signatures-container {
        width: 600px;
        display: flex;
        flex-direction: row;
        margin-top: 58px;
        padding-left: 55px;
    }

    .sign {
        width: 150px;
        height: 100px;
        border: 1px solid #e0e0e0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .sign-by {
        border: 1px solid #e0e0e0;
        width: 150px;
        text-align: center;
        height: 30px;
        padding: 5px;
        font-size: 15px;
        font-weight: 700;
    }

    .header-details-product {
        margin-top: 100px;
        display: flex;
        flex-direction: row;
        width: 1850px;
        justify-content: space-around;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .sub-header {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }

    .prod-info {
        display: flex;
        flex-direction: row;
        gap: 5px;
        font-size: 17px;
        font-weight: 600;
    }

    .detail-prod-info {
        border-bottom: 2px solid rgb(5, 22, 40);
        width: 200px;
        text-align: center;
    }

    .img-prod,.img-prod img {
        width: 170px;
        height: 110px;
        border: 1px solid black;
    }
    img{
        object-fit:fill;

    }
    .table-header table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
        margin-top: 10px;
    }

    table,
    th,
    td {
        border: 1px solid #e0e0e0;
        border-collapse: collapse;
        padding: 2px;
        text-align: center;
    }

    table td {
        padding: 5px;
        font-size: 12px;
        font-weight: 700;

    }

    .row3 {
        width: 83px;
    }

    .row2 {
        font-size: 12px;
        font-weight: 700;
        height: 20px;
    }

    .row1-ng {
        width: 85px;
        font-size: 14px;
        font-weight: 700;
    }

    .row3-pic {
        width: 130px;
    }

    .row3-remark {
        width: 140px;
    }

    .table-header {
        padding: 3px;
    }

    .row1-production {
        font-size: 15px;
        font-weight: 800;
        height: 30px;
    }

    .row1-down {
        width: 500px;
        font-size: 27px;
        font-weight: 700px;
    }

    .graph-summa-container {
        display: grid;
        grid-template-columns: 40.7% 39.3% 20%;
        width: 100%;
        height: 400px;
        padding: 3px;
        margin-top: 20px;
    }

    .graph-summa-container>.production-graph,
    .downtime-graph,
    .summary-container {
        border: 1px solid #e0e0e0;
        width: 100%;
        border-radius: 5px;
    }

    .summary-container {
        border: 1px solid #e0e0e0;

    }

    .title-grp-sum {
        border: 1px solid #e0e0e0;
        height: 40px;
        text-align: center;
        padding: 8px;
        font-size: 20px;
        font-weight: 800;

    }

    #downtime1,
    #downtime2,
    #downtime3,
    #downtime4,
    #downtime5,
    #downtime6,
    #downtime7,
    #downtime8,
    #downtime9,
    #downtime10,
    #downttime11,
    #downtime12,
    #downtime13,
    #downtime14 {
        width: 100px;
    }

    #action1,
    #action2,
    #action3,
    #action4,
    #action5,
    #action6,
    #action7,
    #action8,
    #action9,
    #action10,
    #action11,
    #action12,
    #action13,
    #action14 {
        width: 230px;
    }

    .table-summary {
        width: 100%;
        border: 1px solid #e0e0e0;
    }

    .table-summary td {
        height: 40px;
        font-size: 15px;
        border: 1px solid #e0e0e0;
    }

    .data-grp {
        width: 100%;
        margin: auto;
    }

    .data-downtime-grp {
        width: 100%;

    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    button {
        border: none;
        width: 150px;
        height: 50px;
        font-size: 20px;
        font-weight: 600;
        background: linear-gradient(135deg, #4facfe, rgb(32, 75, 216));
        /* Vibrant blue gradient */
        box-shadow: 2px 3px 8px rgba(0, 0, 0, 0.1);
        /* Soft shadow for depth */
        color: white;
        /* White text for contrast */
        border-radius: 8px;
        /* Smooth rounded corners */
        cursor: pointer;
        /* Indicates interactivity */
        transition: background 0.3s ease, transform 0.2s ease;
        /* Smooth hover effect */
    }

    button:hover {
        background: linear-gradient(135deg, rgb(32, 75, 216), #4facfe);
        /* Gradient reverses on hover */
        transform: scale(1.05);
        /* Slight zoom effect */
    }
</style>

<body>
    <!--header-->
    <button id="captureButton">
        Submit record
    </button>
    <div class="main-container" id="productionData">
        <div class="header-container">
            <div class="header-title-container">
                <div class="nichiv-logo-container">
                    <img src="./public/assets/images/nichivi_logo.jpg" crossorigin="anonymous" alt="">

                    <div class="name-company">
                        <p>Nichivi Philippines Corps.</p>
                        <p>Assembly Section</p>
                    </div>
                </div>
                <div class="title-sheet-container">
                    <p>
                        Production and Downtime Monitoring (生産および稼働停止の監視)
                    </p>

                </div>
                <div class="signatures-container">
                    <div class="sign">
                        <div></div>
                        <div class="sign-by">
                            Approved
                        </div>
                    </div>
                    <div class="sign">
                        <div></div>
                        <div class="sign-by">
                            Checked
                        </div>
                    </div>
                    <div class="sign">
                        <div></div>
                        <div class="sign-by">
                            Prepared
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="header-details-product">
            <div class="sub-header">
                <div class="prod-info">
                    <span>LINE:</span>
                    <span class="detail-prod-info" id="lines"></span>
                </div>
                <div class="prod-info">
                    <span>DATE:<p></p></span>
                    <span class="detail-prod-info" id="date"></span>
                </div>
            </div>
            <div class="sub-header">
                <div class="prod-info">
                    <span>MODEL:<p></p></span>
                    <span class="detail-prod-info" id="model"></span>
                </div>
                <div class="prod-info">
                    <span>PARTNO:<p></p></span>
                    <span class="detail-prod-info" id="part_no"></span>
                </div>
            </div>
            <div class="sub-header">
                <div class="img-prod">
                    <img src="./public/assets/images/prod-pic.jpg" alt="product">
                </div>
            </div>
            <div class="sub-header">
                <div class="prod-info">
                    <span>DEL.DATE:<p></p></span>
                    <span class="detail-prod-info" id="del_date"></span>
                </div>

                <div class="prod-info">
                    <span>BALANCE:<p></p></span>
                    <span class="detail-prod-info" id="balance"></span>
                </div>

                <div class="prod-info">
                    <span>MANPOWER:<p></p></span>
                    <span class="detail-prod-info" id="manpower"></span>
                </div>
            </div>
            <div class="sub-header">
                <div class="prod-info">
                    <span>CT.AS.OF:<p></p></span>
                    <span class="detail-prod-info" id="ctasof"></span>
                </div>
                <div class="prod-info">
                    <span>EXP.DATE:<p></p></span>
                    <span class="detail-prod-info" id="expdate"></span>
                </div>
            </div>
        </div>
        <div class="table-header">
            <table>
                <thead>
                    <tr>
                        <th colspan="8" class="row1-production">PRODUCTION</th>
                        <th rowspan="3" class="row1-ng">NG QUANTITY</th>
                        <th colspan="6" rowspan="2" class="row1-down"> DOWNTIME MONITORING</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="row2">PLAN</th>
                        <th colspan="3" class="row2">ACTUAL</th>
                    </tr>
                    <tr>
                        <th class="row3">Time</th>
                        <th class="row3">Cycle time</th>
                        <th class="row3">Min</th>
                        <th class="row3">Plan output/Hr</th>
                        <th class="row3">Total plan output</th>
                        <th class="row3">Actual output</th>
                        <th class="row3">Total actual output</th>
                        <th class="row3">Achieved</th>
                        <th class="row3-process">Process</th>
                        <th class="row3-details">Details</th>
                        <th class="row3-Action">Action</th>
                        <th class="row3-down">Downtime</th>
                        <th class="row3-pic">PIC</th>
                        <th class="row3-remark">Remarks</th>
                    </tr>
                </thead>

        </div>
        <!--content-data-->
        <div class="data-container">
            <tbody>
                <tr>
                    <td>6AM-7AM</td>
                    <td id="cycle-time1">231.23</td>
                    <td id="mins1">60</td>
                    <td id="plan-per-hr1"></td>
                    <td id="total-plan-hr1"></td>
                    <td id="actual-per-hr1"></td>
                    <td id="total-actual-hr1"></td>
                    <td id="achieved1"></td>
                    <td id="NG1"></td>
                    <td id="process1"></td>
                    <td id="details1"></td>
                    <td id="action1"></td>
                    <td id="downtime1"></td>
                    <td id="pic1"></td>
                    <td id="remarks1"></td>
                </tr>
                <tr>
                    <td>7AM-8AM</td>
                    <td id="cycle-time2">231.23</td>
                    <td id="mins1">60</td>
                    <td id="plan-per-hr2"></td>
                    <td id="total-plan-hr2"></td>
                    <td id="actual-per-hr2"></td>
                    <td id="total-actual-hr2"></td>
                    <td id="achieved2"></td>
                    <td id="NG2"></td>
                    <td id="process2"></td>
                    <td id="details2"></td>
                    <td id="action2"></td>
                    <td id="downtime2"></td>
                    <td id="pic2"></td>
                    <td id="remarks2"></td>
                </tr>
                <tr>
                    <td>8AM-9AM</td>
                    <td id="cycle-time3">231.23</td>
                    <td id="mins3">60</td>
                    <td id="plan-per-hr3"></td>
                    <td id="total-plan-hr3"></td>
                    <td id="actual-per-hr3"></td>
                    <td id="total-actual-hr3"></td>
                    <td id="achieved3"></td>
                    <td id="NG3"></td>
                    <td id="process3"></td>
                    <td id="details3"></td>
                    <td id="action3"></td>
                    <td id="downtime3"></td>
                    <td id="pic3"></td>
                    <td id="remarks3"></td>
                </tr>
                <tr>
                    <td>9AM-10AM</td>
                    <td id="cycle-time4">231.23</td>
                    <td id="mins4">60</td>
                    <td id="plan-per-hr4"></td>
                    <td id="total-plan-hr4"></td>
                    <td id="actual-per-hr4"></td>
                    <td id="total-actual-hr4"></td>
                    <td id="achieved4"></td>
                    <td id="NG4"></td>
                    <td id="process4"></td>
                    <td id="details4"></td>
                    <td id="action4"></td>
                    <td id="downtime4"></td>
                    <td id="pic4"></td>
                    <td id="remarks4"></td>
                </tr>
                <tr>
                    <td>10AM-11AM</td>
                    <td id="cycle-time5">231.23</td>
                    <td id="mins5">60</td>
                    <td id="plan-per-hr5"></td>
                    <td id="total-plan-hr5"></td>
                    <td id="actual-per-hr5"></td>
                    <td id="total-actual-hr5"></td>
                    <td id="achieved5"></td>
                    <td id="NG5"></td>
                    <td id="process5"></td>
                    <td id="details5"></td>
                    <td id="action5"></td>
                    <td id="downtime5"></td>
                    <td id="pic5"></td>
                    <td id="remarks5"></td>
                </tr>
                <tr>
                    <td>11AM-12NN</td>
                    <td id="cycle-time6">231.23</td>
                    <td id="mins6">60</td>
                    <td id="plan-per-hr6"></td>
                    <td id="total-plan-hr6"></td>
                    <td id="actual-per-hr6"></td>
                    <td id="total-actual-hr6"></td>
                    <td id="achieved6"></td>
                    <td id="NG6"></td>
                    <td id="process6"></td>
                    <td id="details6"></td>
                    <td id="action6"></td>
                    <td id="downtime6"></td>
                    <td id="pic6"></td>
                    <td id="remarks6"></td>
                </tr>
                <tr>
                    <td>12NN-1PM</td>
                    <td id="cycle-time7">231.23</td>
                    <td id="mins7">60</td>
                    <td id="plan-per-hr7"></td>
                    <td id="total-plan-hr7"></td>
                    <td id="actual-per-hr7"></td>
                    <td id="total-actual-hr7"></td>
                    <td id="achieved7"></td>
                    <td id="NG7"></td>
                    <td id="process7"></td>
                    <td id="details7"></td>
                    <td id="action7"></td>
                    <td id="downtime7"></td>
                    <td id="pic7"></td>
                    <td id="remarks7"></td>
                </tr>
                <tr>
                    <td>1PM-2PM</td>
                    <td id="cycle-time8">231.23</td>
                    <td id="mins8">60</td>
                    <td id="plan-per-hr8"></td>
                    <td id="total-plan-hr8"></td>
                    <td id="actual-per-hr8"></td>
                    <td id="total-actual-hr8"></td>
                    <td id="achieved8"></td>
                    <td id="NG8"></td>
                    <td id="process8"></td>
                    <td id="details8"></td>
                    <td id="action8"></td>
                    <td id="downtime8"></td>
                    <td id="pic8"></td>
                    <td id="remarks8"></td>
                </tr>
                <tr>
                    <td>2PM-3PM</td>
                    <td id="cycle-time9">231.23</td>
                    <td id="mins9">60</td>
                    <td id="plan-per-hr9"></td>
                    <td id="total-plan-hr9"></td>
                    <td id="actual-per-hr9"></td>
                    <td id="total-actual-hr9"></td>
                    <td id="achieved9"></td>
                    <td id="NG9"></td>
                    <td id="process9"></td>
                    <td id="details9"></td>
                    <td id="action9"></td>
                    <td id="downtime9"></td>
                    <td id="pic9"></td>
                    <td id="remarks9"></td>
                </tr>
                <tr>
                    <td>3PM-4PM</td>
                    <td id="cycle-time10">231.23</td>
                    <td id="mins10">60</td>
                    <td id="plan-per-hr10"></td>
                    <td id="total-plan-hr10"></td>
                    <td id="actual-per-hr10"></td>
                    <td id="total-actual-hr10"></td>
                    <td id="achieved10"></td>
                    <td id="NG10"></td>
                    <td id="process10"></td>
                    <td id="details10"></td>
                    <td id="action10"></td>
                    <td id="downtime10"></td>
                    <td id="pic10"></td>
                    <td id="remarks10"></td>
                </tr>
                <tr>
                    <td>4PM-5PM</td>
                    <td id="cycle-time11">231.23</td>
                    <td id="mins11">60</td>
                    <td id="plan-per-hr11"></td>
                    <td id="total-plan-hr11"></td>
                    <td id="actual-per-hr11"></td>
                    <td id="total-actual-hr11"></td>
                    <td id="achieved11"></td>
                    <td id="NG11"></td>
                    <td id="process11"></td>
                    <td id="details11"></td>
                    <td id="action11"></td>
                    <td id="downtime11"></td>
                    <td id="pic11"></td>
                    <td id="remarks11">-</td>
                </tr>
                <tr>
                    <td>5PM-6PM</td>
                    <td id="cycle-time12">231.23</td>
                    <td id="mins12">60</td>
                    <td id="plan-per-hr12"></td>
                    <td id="total-plan-hr12"></td>
                    <td id="actual-per-hr12"></td>
                    <td id="total-actual-hr12"></td>
                    <td id="achieved12"></td>
                    <td id="NG12"></td>
                    <td id="process12"></td>
                    <td id="details12"></td>
                    <td id="action12"></td>
                    <td id="downtime12"></td>
                    <td id="pic12"></td>
                    <td id="remarks12"></td>
                </tr>
                <tr>
                    <td>6PM-7PM</td>
                    <td id="cycle-time13">231.23</td>
                    <td id="mins13">60</td>
                    <td id="plan-per-hr13"></td>
                    <td id="total-plan-hr13"></td>
                    <td id="actual-per-hr13"></td>
                    <td id="total-actual-hr13"></td>
                    <td id="achieved13"></td>
                    <td id="NG13"></td>
                    <td id="process13"></td>
                    <td id="details13"></td>
                    <td id="action13"></td>
                    <td id="downtime13"></td>
                    <td id="pic13"></td>
                    <td id="remarks13"></td>
                </tr>
                <tr>
                    <td>7PM-8PM</td>
                    <td id="cycle-time14">231.23</td>
                    <td id="mins14">60</td>
                    <td id="plan-per-hr14"></td>
                    <td id="total-plan-hr14"></td>
                    <td id="actual-per-hr14"></td>
                    <td id="total-actual-hr14"></td>
                    <td id="achieved14"></td>
                    <td id="NG14"></td>
                    <td id="process14"></td>
                    <td id="details14"></td>
                    <td id="action14"></td>
                    <td id="downtime14"></td>
                    <td id="pic14"></td>
                    <td id="remarks14"></td>
                </tr>
            </tbody>
            </table>
        </div>

        <div class="graph-summa-container">
            <div class="production-graph">
                <div class="title-grp-sum">
                    Production Graph
                </div>

                <div class="data-grp">
                    <canvas id="production-data-grp">

                    </canvas>
                </div>
            </div>
            <div class="downtime-graph">
                <div class="title-grp-sum">
                    Downtime Graph
                </div>
                <div class="data-downtime-grp">
                    <canvas height="155s" id="downtime-data-grp">

                    </canvas>
                </div>
            </div>
            <div class="summary-container">
                <div class="title-grp-sum">
                    Summary
                </div>
                <!-- /////////////////-->
                <table class="table-summary">
                    <tr>
                        <td>TOTAL OUTPUT:</td>
                        <td id="total_output_sum"></td>
                    </tr>
                    <tr>
                        <td>TOTAL NG:</td>
                        <td id="total_ng_sum"></td>
                    </tr>
                    <tr>
                        <td>GOOD QTY:</td>
                        <td id="good_sum"></td>
                    </tr>
                    <tr>
                        <td>TOTAL.PROD.HRS:</td>
                        <td id="total_prod_sum"></td>
                    </tr>
                    <tr>
                        <td>TOTAL DOWNTIME:</td>
                        <td id="total_downtime_sum"></td>
                    </tr>
                    <tr>
                        <td>ACTUAL.PROD.HRS:</td>
                        <td id="actual_sum"></td>
                    </tr>
                    <tr>
                        <td>ACTUAL MANPOWER:</td>
                        <td id="manpower_sum">3</td>
                    </tr>
                    <tr>
                        <td>BREAKTIME:</td>
                        <td id="breaktime_sum">1.40</td>
                    </tr>
                    <tr>
                        <td>ACHIEVED TODAY:</td>
                        <td id="achieve_day">1.40</td>
                    </tr>

                </table>

            </div>
        </div>
        <div style="letter-spacing:1px;font-size:10px; margin:5px 20px 5px 15px; width:auto; text-align:end; font-weight:800;">
            F-1-0085-02
        </div>
    </div>


    <script>
        document.getElementById('captureButton').addEventListener('click', function() {
            html2canvas(document.getElementById('productionData'), {
                scale: 2
            }).then(canvas => {
                // Convert canvas to Base64
                const base64Image = canvas.toDataURL('image/png');
                // Send to server
                sendToServer(base64Image);
            });

        });

        function sendToServer(base64Image) {
            const partno = document.getElementById('part_no').textContent;
            const line = document.getElementById('lines').textContent;
            const total_output = document.getElementById('total_output_sum').textContent;
            const totalng = document.getElementById('total_ng_sum').textContent;
            const goodqty = document.getElementById('good_sum').textContent;
            const totalprod = document.getElementById('total_prod_sum').textContent;
            const totaldowntime = document.getElementById('total_downtime_sum').textContent;
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


            const actualReset = {
                data_hr: 0,
                totalData_hr: 0,
                achieve_data: 0
            }
            const downtimeReset = {
                process: '-',
                details: '-',
                time_elapse: '-',
                action: '-',
                pics: '-',
                remarks: '-',
                timeCount: 0
            }
            const dataSum = {
                sumOfdata: 0,
                good_sum: 0,
                achieve_day: 0
            }
            const resetng = {
                ng1: 0,
                ng2: 0,
                ng3: 0,
                ng4: 0,
                ng5: 0,
                ng6: 0,
                ng7: 0,
                ng8: 0,
                ng9: 0,
                ng10: 0,
                ng11: 0,
                ng12: 0,
                ng13: 0,
                ng14: 0

            };

            const resetActualng = {
                ng: 0

            };

            const resetSetplan = {
                p1: 0,
                p2: 0,
                p3: 0,
                p4: 0,
                p5: 0,
                p6: 0,
                p7: 0,
                p8: 0,
                p9: 0,
                p10: 0,
                p11: 0,
                p12: 0,
                p13: 0,
                p14: 0

            };

            const resetTotalplan = {
                p1: 0,
                p2: 0,
                p3: 0,
                p4: 0,
                p5: 0,
                p6: 0,
                p7: 0,
                p8: 0,
                p9: 0,
                p10: 0,
                p11: 0,
                p12: 0,
                p13: 0,
                p14: 0

            };

            const sendHistory_data = {
                part_no: partno,
                lines: line,
                total_output: total_output,
                totalngs: totalng,
                totalprod: totalprod,
                goodqty: goodqty,
                totaldowntime: totaldowntime,
                actualprod: actualprod,
                manpower: manpower,
                breaktime: breaktime,
                achieved: achieved

            }

            const resetController = {
                currentCount:0,
                currentTime: 0,
                currentPlan: 0,
                previousPlan: 0,
                totalCount: 0

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
                        alert("Error: actual " + xhr1.status);
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
                        alert("Error: downtime " + xhr2.status);
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
                        alert("Error: sum " + xhr3.status);
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


            var urlEncodedData6 = Object.keys(resetActualng)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(resetActualng[key]))
                .join('&');

            var xhr6 = new XMLHttpRequest(resetActualng);
            xhr6.open("POST", "resetActualng.php", true);
            xhr6.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr6.onreadystatechange = function() {
                if (xhr6.readyState === XMLHttpRequest.DONE) {
                    if (xhr6.status === 200) {
                        // After both data sets are sent successfully, redirect with both image URLs
                        // alert("reset the summary.");
                        console.log("reset actual ng");
                    } else {
                        alert("Error: " + xhr6.status);
                    }
                }
            };
            xhr6.send(urlEncodedData6);


            var urlEncodedData7 = Object.keys(resetSetplan)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(resetSetplan[key]))
                .join('&');

            var xhr7 = new XMLHttpRequest(resetSetplan);
            xhr7.open("POST", "resetSetplan.php", true);
            xhr7.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr7.onreadystatechange = function() {
                if (xhr7.readyState === XMLHttpRequest.DONE) {
                    if (xhr7.status === 200) {
                        // After both data sets are sent successfully, redirect with both image URLs
                        // alert("reset the summary.");
                        console.log("reset set plan");
                    } else {
                        alert("Error: " + xhr7.status);
                    }
                }
            };
            xhr7.send(urlEncodedData7);


            var urlEncodedData8 = Object.keys(resetTotalplan)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(resetSetplan[key]))
                .join('&');

            var xhr8 = new XMLHttpRequest(resetTotalplan);
            xhr8.open("POST", "resetTotalplan.php", true);
            xhr8.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr8.onreadystatechange = function() {
                if (xhr8.readyState === XMLHttpRequest.DONE) {
                    if (xhr8.status === 200) {
                        // After both data sets are sent successfully, redirect with both image URLs
                        // alert("reset the summary.");
                        console.log("reset set plan");
                    } else {
                        alert("Error: " + xhr8.status);
                    }
                }
            };
            xhr8.send(urlEncodedData8);

            var urlEncodedData9 = Object.keys(resetController)
                .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(resetController[key]))
                .join('&');

            var xhr9 = new XMLHttpRequest(resetController);
            xhr9.open("POST", "resetController.php", true);
            xhr9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr9.onreadystatechange = function() {
                if (xhr9.readyState === XMLHttpRequest.DONE) {
                    if (xhr9.status === 200) {
                        // After both data sets are sent successfully, redirect with both image URLs
                        // alert("reset the summary.");
                        console.log("reset set controller ");
                    } else {
                        alert("Error: " + xhr9.status);
                    }
                }
            };
            xhr9.send(urlEncodedData9);

            alert("Data recorded!");
            window.location.href = "../public/lcd_rev_code1.php";

        }

        function actualOutput() {
            const interval = setInterval(() => {
                fetch('../sheets/getActualOutput.php', {
                        method: 'GET',
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            return response.text().then(text => {
                                console.error("Expected JSON, got:", text);
                                throw new Error('Invalid JSON response');
                            });
                        }

                        return response.json();
                    })
                    .then(data => {
                        if (!data || !data.success) {
                            console.error("API returned error:", data?.message || 'Unknown error');
                            return;
                        }

                        if (data.lines && Array.isArray(data.lines)) {
                            data.lines.forEach((line, index) => {
                                const i = line.id;
                                const prodCountEl = $("#actual-per-hr" + i);
                                const prodTotalEl = $("#total-actual-hr" + i);
                                const achieveEl = $("#achieved" + i);

                                if (prodCountEl.length) {
                                    prodCountEl.text(line.per_hr);
                                }

                                if (prodTotalEl.length) {
                                    prodTotalEl.text(line.total);
                                }

                                if (achieveEl.length) {
                                    achieveEl.text(line.achieved + '%');
                                }
                            });
                        }
                    })
                    .catch(err => {
                        console.error("Fetch error:", err);
                    });
            }, 2000);

            // Return interval ID so you can clear it later if needed
            return interval;
        }

        function actualDowntime() {
            const intervalDowntime = setInterval(() => {
                fetch('../sheets/getActualDowntime.php', {
                        method: 'GET',
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            return response.text().then(text => {
                                console.error("Expected JSON, got:", text);
                                throw new Error('Invalid JSON response');
                            });
                        }

                        return response.json();
                    })
                    .then(data => {
                        if (!data || !data.success) {
                            console.error("API returned error:", data?.message || 'Unknown error');
                            return;
                        }

                        if (data.lines && Array.isArray(data.lines)) {
                            data.lines.forEach((line, index) => {
                                const i = line.id;
                                const processData = $("#process" + i);
                                const detailsData = $("#details" + i);
                                const timeElapse = $("#downtime" + i);
                                const action = $("#action" + i);
                                const PersonIncharge = $("#pic" + i);
                                const remarks = $("#remarks" + i);
                               
                                if (processData.length) {
                                    processData.text(line.process);
                                }

                                if (detailsData.length) {
                                    detailsData.text(line.details);
                                }

                                if (timeElapse.length) {
                                    timeElapse.text(line.time_Elapse);
                                }
                                if (action.length) {
                                    action.text(line.Action);
                                }
                                if (PersonIncharge.length) {
                                    PersonIncharge.text(line.Pics);
                                }
                                if (remarks.length) {
                                    remarks.text(line.remark);
                                }
                            });
                        }
                    })
                    .catch(err => {
                        console.error("Fetch error:", err);
                    });
            }, 3000);

            // Return interval ID so you can clear it later if needed
            return intervalDowntime;
        }


        // Test function to check PHP endpoint manually
        function testPHPEndpoint() {
            console.log("Testing PHP endpoint manually...");
            fetch('../sheets/getActualDowntime.php')
                .then(response => response.text())
                .then(text => {
                    console.log("Manual test result:", text);
                })
                .catch(err => {
                    console.error("Manual test error:", err);
                });
        }

        // Usage:
        // testPHPEndpoint(); // Run this first to test
        // const intervalId = actualOutput(); // Then start the interval
        // clearInterval(intervalId); // To stop

        function getData() {
            setInterval(function() {
                fetch('product_details_print.php').then(function(response) {

                    return response.json();

                }).then(function(data) {
                    $('#part_no').text(data.partno.PART_NO);
                    $('#lines').text(data.LINE_NO.LINENO);
                    $("#model").text(data.model.model_product);
                    $("#del_date").text(data.delDate.del_date);
                    $('#balance').text(data.balance.BALANCE);
                    $('#date').text(data.dates.CREATEDATE);
                    $('#manpower').text(data.manpower.manpower_line);
                    $('#ctasof').text(data.ctasof.CT_AS_OF);
                    $('#expdate').text(data.expdate.EXP_DATE);

                }).catch(function(error) {
                    console.log(error);
                });
            }, 1000);
        }

        function Prod_plan() {
            setInterval(function() {
                fetch('displayPrintPlan.php').then(function(response) {

                    return response.json();

                }).then(function(data) {
                    //countValue.innerText = JSON.stringify(data.viewcount,2,null);
                    // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
                    $('#plan-per-hr1').text(data.planp1.plan1);
                    $("#plan-per-hr2").text(data.planp2.plan2);
                    $("#plan-per-hr3").text(data.planp3.plan3);
                    $("#plan-per-hr4").text(data.planp4.plan4);
                    $("#plan-per-hr5").text(data.planp5.plan5);
                    $("#plan-per-hr6").text(data.planp6.plan6);
                    $("#plan-per-hr7").text(data.planp7.plan7);
                    $("#plan-per-hr8").text(data.planp8.plan8);
                    $("#plan-per-hr9").text(data.planp9.plan9);
                    $("#plan-per-hr10").text(data.planp10.plan10);
                    $("#plan-per-hr11").text(data.planp11.plan11);
                    $("#plan-per-hr12").text(data.planp12.plan12);
                    $("#plan-per-hr13").text(data.planp13.plan13);
                    $("#plan-per-hr14").text(data.planp14.plan14);
                    // countValue.textContent = dataviewcount;

                }).catch(function(error) {
                    console.log(error);
                });

            }, 1000);

        }

        function Prod_plan_tols() {
            setInterval(function() {
                fetch('print_totalPlan.php').then(function(response) {

                    return response.json();

                }).then(function(data) {

                    $("#total-plan-hr1").text(data.planpt1.PLANT1);
                    $("#total-plan-hr2").text(data.planpt2.PLANT2);
                    $("#total-plan-hr3").text(data.planpt3.PLANT3);
                    $("#total-plan-hr4").text(data.planpt4.PLANT4);
                    $("#total-plan-hr5").text(data.planpt5.PLANT5);
                    $("#total-plan-hr6").text(data.planpt6.PLANT6);
                    $("#total-plan-hr7").text(data.planpt7.PLANT7);
                    $("#total-plan-hr8").text(data.planpt8.PLANT8);
                    $("#total-plan-hr9").text(data.planpt9.PLANT9);
                    $("#total-plan-hr10").text(data.planpt10.PLANT10);
                    $("#total-plan-hr11").text(data.planpt11.PLANT11);
                    $("#total-plan-hr12").text(data.planpt12.PLANT12);
                    $("#total-plan-hr13").text(data.planpt13.PLANT13);
                    $("#total-plan-hr14").text(data.planpt14.PLANT14);
                    // countValue.textContent = dataviewcount;

                }).catch(function(error) {
                    console.log(error);
                });

            }, 1000);
        }
        let copiedPlan = [];
        const ctx = document.getElementById('production-data-grp').getContext('2d');
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
                            // console.log(`Comparing production value: ${value} with target: ${copiedPlan[index]}`);
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
        const ctxhD = document.getElementById('downtime-data-grp').getContext('2d');
        const chartD = new Chart(ctxhD, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Downtime',
                    data: [],
                    backgroundColor: 'red',
                    broderColor: 'rgba(75,192,192,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        function fetchDataDh() {
            fetch('barchart_print_downtime.php')
                .then(response => response.json())
                .then(data => {
                    chartD.data.labels = data.labels;
                    chartD.data.datasets[0].data = data.time_datas;
                    chartD.update();
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function summaryData() {
            setInterval(function() {
                fetch('get_print_sum.php').then(function(response) {

                    return response.json();
                }).then(function(data) {

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

                }).catch(function(error) {
                    console.log(error);
                });

            }, 1000);
        }

        function displayNgs() {
            setInterval(function() {
                fetch('displayngs.php').then(function(response) {

                    return response.json();

                }).then(function(data) {
                    $("#NG1").text(data.ng1.ng1);
                    $("#NG2").text(data.ng2.ng2);
                    $("#NG3").text(data.ng3.ng3);
                    $("#NG4").text(data.ng4.ng4);
                    $("#NG5").text(data.ng5.ng5);
                    $("#NG6").text(data.ng6.ng6);
                    $("#NG7").text(data.ng7.ng7);
                    $("#NG8").text(data.ng8.ng8);
                    $("#NG9").text(data.ng9.ng9);
                    $("#NG10").text(data.ng10.ng10);
                    $("#NG11").text(data.ng11.ng11);
                    $("#NG12").text(data.ng12.ng12);
                    $("#NG13").text(data.ng13.ng13);
                    $("#NG14").text(data.ng14.ng14);
                }).catch(function(error) {
                    console.log(error);
                });

            }, 1000);

        }

        function checkValues(ids) {
            ids.forEach(id => {
                const element = document.getElementById(id);
                console.log(id)
                if (element) {
                    const value = parseInt(element.textContent) || 0;
                    console.log(value)
                    if (value < 100) {
                        element.classList.add("red-text");
                        element.classList.remove("green-text");
                    } else {

                        element.classList.add("green-text");
                        element.classList.remove("red-text");

                    }

                }

            });

        }

        function test(){
            const text = document.getElementById('achieved1').textContent;
            console.log(text)

        }

            


        document.addEventListener("DOMContentLoaded", (event) => {
            getData();
            actualOutput()
            actualDowntime()
            testPHPEndpoint()
            summaryData();
      
            Prod_plan();
            Prod_plan_tols();
            fetchPlanData();
            fetchData();
           
            test()
            fetchDataDh();
            setInterval(fetchData, 2000);
            setInterval(fetchDataDh, 2000);

            // setTimeout(() => {
            //     const elementIDs = ["achieved1", "achieved2", "achieved3", "achieved4", "achieved5", "achieved6", "achieved7", "achieved8", "achieved9", "achieved10", "achieved11", "achieved12", "achieved13", "achieved14"];
            //     checkValues(elementIDs);
                
            // }, 2000);


        });
    </script>

</body>

</html>