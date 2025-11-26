<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/ico" href="../../media/icons/nichivi-logo.ico">
    <title>DOM | Tube Assembly</title>
    <link rel="stylesheet" href="pnddesign.css">
</head>
<body>

    <nav>
        <div id="nav-title">
            <div id="company">
                <div>
                    <img width="35" src="../../media/icons/nichivi_logo_white.png" alt="logo">
                </div>
                <div id="company-name-container">
                    <div id="company-name">
                        NICHIVI PHILIPPINES CORPORATION
                    </div>                    
                </div>                
            </div>

            <div id="line-nav"></div>
            <div id="site-title">
                <div>
                    DOM - PRODUCTION OUTPUT AND DOWNTIME MONITORING
                </div>
                <div id="production_line_name">
                    Loading...
                </div> 
            </div>
        </div>
        <button id="menu-toggle">☰</button>
        <div id="fullscreen-button">
            <div id="fullscreen-icon">
                <span class="corner top-left"></span>
                <span class="corner top-right"></span>
                <span class="corner bottom-left"></span>
                <span class="corner bottom-right"></span>
            </div>
        </div>
        <div id="nav-buttons">
            <button class="nav-btns">
                Dashboard
            </button>
            <button class="nav-btns">
                History Data
            </button>
            <button class="nav-btns">
                SWP
            </button>
            <button class="nav-btns">
                Video Tutorial
            </button>
        </div>
    </nav>
    <div id="dashboard-container">
        
        <div id="details">
            <div id="details-container">
                <div id="product-container">
                    <div id="product-picture">
                        <img id="pic" width="200" height="100"  src="../../media/img/ahh.png"> 
                    </div> 
                    <div id="product">
                        <div id="product-part">
                            <h4>Part Number:</h4> &nbsp; <h4>-</h4>
                        </div>
                        <div id="product-details">  
                            <span>Model:</span> <span>-</span>
                            <span>Delivery Date:</span> <span>-</span>
                            <span>Balance:</span> <span>-</span>
                            <span>Cycle Time:</span> <span>-</span>
                            <span>Manpower:</span> <span>-</span>
                            <span>Cycle Time as of:</span> <span>-</span>
                            <span>Production Hours:</span> <span>-</span>
                            <span>Expiration Date:</span> <span>-</span>
                        </div>
                    </div>

                </div>
                <div id="staffs-container">
                    <div id="line-leader" class="line-staff">
                        <div class="person-details">
                            <div class="picture-box">
                                
                            </div>
                            <div class="infos">
                                <div class="name">Raven</div>
                                <div class="person-title">
                                    Line Leader
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="prod-staff" class="line-staff">
                        <div class="person-details">
                            <div class="picture-box">
                                
                            </div>
                            <div class="infos">
                                <div class="name">1</div>
                                <div class="person-title">
                                    Process 3
                                </div>
                            </div>
                        </div>
                        <div class="person-details">
                            <div class="picture-box">
                                
                            </div>
                            <div class="infos">
                                <div class="name">2</div>
                                <div class="person-title">
                                    Process 2
                                </div>
                            </div>
                        </div>
                        <div class="person-details">
                            <div class="picture-box">
                                
                            </div>
                            <div class="infos">
                                <div class="name">3</div>
                                <div class="person-title">
                                    Final
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="center-contents">
            <div id="production-table">
                <div id="table-data-container" class="data-container">
                    <table id="quota-data-table" class="data-table">
                        <tr>
                            <th colspan="4" class="actual-title">PLAN</th>
                            <th colspan="6" class="actual-title">ACTUAL</th>
                        </tr>

                        <tr>
                            <th class="actual-header">TIME</th>
                            <th class="actual-header">CYCLE TIME</th>
                            <th class="actual-header">MINUTES</th>
                            <th class="actual-header">PLAN OUTPUT <br><span>(Per hour)</span></th>
                            <th class="actual-header">ACTUAL <br> OUTPUT</th>
                            <th class="actual-header">PERCENTAGE</th>
                            <th class="actual-header">TOTAL</th>
                            <th class="actual-header">DOWNTIME <br>(MINS)</th>
                            <th class="actual-header">NG <br> QUANTITY</th>
                            <th class="actual-header">REMARKS</th>  
                        </tr>

                        </tr>
                            <tr>
                                <td>06:00 - 07:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>07:00 - 08:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>08:00 - 09:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>09:00 - 10:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>10:00 - 11:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>11:00 - 12:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>12:00 - 13:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>13:00 - 14:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>14:00 - 15:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>15:00 - 16:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>16:00 - 17:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>17:00 - 18:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>18:00 - 19:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                            <td>19:00 - 20:00</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <div class="percent-bar-data" data-percent="0">
                                    0%
                                </div>
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>   
                    </table>
                </div>        
            </div>
            <div id="graph-table">
                <div id="graph-table-container">
                    <div id="graph-header">
                        PRODUCTION GRAPH
                    </div>
                    <div id="graph"></div>

                    <!-- ✅ Legend Section -->
                    <div id="graph-legend">
                        <div class="legend-item">
                            <span class="legend-color green"></span>
                            <span class="legend-text">Target Reached</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color red"></span>
                            <span class="legend-text">Incomplete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="bottom-contents">
            <div id="btm-container">
                <div id="downtime-graph-container">
                    <div id="downtime-graph-header" class="bottom-header">DOWNTIME GRAPH (Per Hour)</div>

                    <div id="downtime-graph">
                        <!-- Times 06:00 to 19:00 -->
                        <div class="bar2-row" data-time="06:00">
                            <div class="time-label">06:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="07:00">
                            <div class="time-label">07:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="08:00">
                            <div class="time-label">08:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="09:00">
                            <div class="time-label">09:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="10:00">
                            <div class="time-label">10:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="11:00">
                            <div class="time-label">11:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="12:00">
                            <div class="time-label">12:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>


                        <div class="bar2-row" data-time="13:00">
                            <div class="time-label">13:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="14:00">
                            <div class="time-label">14:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="15:00">
                            <div class="time-label">15:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="16:00">
                            <div class="time-label">16:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="17:00">
                            <div class="time-label">17:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="18:00">
                            <div class="time-label">18:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="19:00">
                            <div class="time-label">19:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>
                    </div>
                </div>


                <div id="summary">
                    <div id="summary-container">
                        <div id="plan-summary">
                            <div id="planned-summary-container">
                                <div id="planned-summary-header" class="bottom-header2">
                                    PLANNED SUMMARY
                                </div>
                                <div id="planned-summary-body" class="summary-body">
                                    <span>PLAN PRODUCTION HOURS:</span>
                                    <span>-</span>
                                    <span>PLAN OUTPUT:</span>
                                    <span>-</span>
                                    <span>PLAN MANPOWER:</span>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>
                        <div id="actual-summary">
                            <div id="actual-summary-container">
                                <div id="actual-summary-header" class="bottom-header2">
                                    ACTUAL SUMMARY
                                </div>
                                <div id="actual-summary-body" class="summary-body">
                                    <span>ACTUAL PRODUCTION HOURS:</span>
                                    <span>-</span>
                                    <span>ACTUAL OUTPUT:</span>
                                    <span>-</span>
                                    <span>ACTUAL MANPOWER:</span>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div id="overview-container">
                        <span>BREAKTIME:</span> <span>1h 40m</span>
                        <span>TOTAL DOWNTIME:</span> <span>-</span>
                        <span>GOOD QUANTITY:</span> <span>-</span>
                        <span>TOTAL NG:</span> <span>-</span>
                    </div>

                </div>

                <div id="pie-graph">
                    <div id="dandt">
                        <span id="time">--:-- --</span>
                        <span id="date">-- --, ----</span>
                    </div>

                    <div id="pie-graphs">
                        <div class="pie-text">0%</div>
                    </div>                        


                    <button id="save-btn">Save Data</button>
                </div>
            </div>
        </div>
    </div>

<!--
    <div id="data_container">
        <div id="output_container">
            <table id="actual_output_table">
                <thead>
                    <tr>
                        <th colspan="11"> <span>PRODUCTION MONITORING</span> <button class="button-81" role="button" onclick="showDown()">Downtime</button></th>

                    </tr>
                    <tr>
                        <th colspan="5">PLAN</th>
                        <th colspan="3">ACTUAL <button onclick="showEditform()">EDIT</button> </th>
                        <th> <button onclick="show_ng_form()">ADD</button> </th>
                    </tr>
                    <tr>
                        <th>TIME</th>
                        <th>CYCLE TIME</th>
                        <th>MIN</th>
                        <th>PLAN OUTPUT/HR</th>
                        <th>TOTAL PLAN OUTPUT</th>
                        <th>ACTUAL OUTPUT/HR</th>
                        <th>TOTAL OUTPUT</th>
                        <th>ACHIEVE OUTPUT/HR</th>
                        <th>NG-QTY</th>
                    </tr>
                </thead>
                <tbody style="font-size:15px;">

                </tbody>
            </table>
        </div>  -->


        <!--<div id="downtime_container">
            <table id="downtime_data_table">
                <thead>
                    <tr>
                        <th id="downtime_title" colspan="7"> <span>DOWNTIME MONITORING</span> <button class="button-81" role="button" onclick="showProd()">Production</button></th>
                    </tr>
                    <tr>
                        <th>TIME</th>
                        <th>PROCESS</th>
                        <th>DETAILS</th>
                        <th>ACTION</th>
                        <th>DOWNTIME</th>
                        <th>PIC</th>
                        <th>REMARKS</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div> -->


    </div>
    
</body>

<script src="pnd.js"></script>

</html>