<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/ico" href="public/assets/images/nichivi-logo.ico">
    <link rel="stylesheet" href="public/assets/css/planner1.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>


<body>

    <nav class="side-nav" id="side-nav-menu">
        <div class="title-dashboard" id="title-with-dom-number">
            <div style="height: 25px;">
                <img width="35" height="25" src="public/assets/images/nichivi_logo_white.png" alt="logo">
            </div>
            <div style="height: 17px; display: flex;">
                <span style="font-size: 0.9rem;">NICHIVI PHILIPPINES CORPORATION</span>
            </div>
            <div class="line-nav"></div>
            <div class="prod-line-container">
                <span style="font-size: 0.8rem;">DIGITAL OUTPUT MONITORING - PLANNER</span>
                <span class="line-prod-number" id="prod-number" style="font-size: 0.7rem; display: none;">Loading...</span>
                <!-- C(equals value) done-->
            </div>
        </div>

        <div class="navbar-buttons" id="navigation-btn">
            <button class="nav-button1" id="navbutton1">Home</button>
            <div class="line-nav2"></div>
            <button class="nav-button1" id="navbutton2">Time-Based Data</button>
            <div class="line-nav2"></div>
            <button class="nav-button1" id="navbutton3">Data Entry</button>
            <div class="line-nav2"></div>
            <div class="dropdowndom">
                <button class="nav-button dropbtn" id="dropbtn">Select DOM</button>
                <div class="dropdown-content" id="dropdownMenu">
                    <button class="nav-button" data-ip="10.0.0.189">C4 DOM</button>
                    <button class="nav-button" data-ip="10.0.0.102">C7 DOM</button>
                    <button class="nav-button" data-ip="10.0.0.136">C9 DOM</button>
                    <button class="nav-button" data-ip="10.0.0.125">C9-1 DOM</button>
                    <button class="nav-button" data-ip="10.0.0.164">C10 DOM</button>
                </div>
            </div>
        </div>

    </nav> 

    <div class="container-data">

        <div id="home">
            <div id="home-container">
                <div id="home-name" style="font-weight:bold">
                    <span class="line-prod-main" style="font-weight:bold">Loading...</span> &nbsp;REAL-TIME MONITORING
                </div>

                <div id="dom-data-container">

                    <div class="DOM-graphs-data">
                        <div class="DOM-graphs-title">Tube Assembly Daily Production</div>

                        <div id="DOM-graphs-container"> 

                            <div class="per-dom-container" id="c4-cont">
                                <div class="bar-container">
                                    <span class="label">C4 Line:</span>
                                    <div class="bar-size">
                                        <div class="bar" data-width=""></div>
                                    </div>
                                </div> 
                                <div class="dom-info" id="c4-info">
                                    <div>Status: </div>
                                    <div>Product Model: </div>
                                    <div>Quota per day:</div>
                                    <div>Completion Rate:</div>
                                    <div>Downtime Count:</div>
                                    <div>DT Duration:</div>
                                </div>                               
                            </div>

                            <div class="per-dom-container" id="c7-cont">
                                <div class="bar-container">
                                    <span class="label">C7 Line:</span>
                                    <div class="bar-size">
                                        <div class="bar" data-width=""></div>
                                    </div>
                                </div>     
                                   <div class="dom-info" id="c7-info">
                                    <div>Status: </div>
                                    <div>Product Model: </div>
                                    <div>Quota per day:</div>
                                    <div>Completion Rate:</div>
                                    <div>Downtime Count:</div>
                                    <div>DT Duration:</div>
                                </div>                            
                            </div>

                            <div class="per-dom-container" id="c9-cont">
                                <div class="bar-container">
                                    <span class="label">C9 Line:</span>
                                    <div class="bar-size">
                                        <div class="bar" data-width=""></div>
                                    </div>
                                </div>  
                                <div class="dom-info" id="c9-info">
                                    <div>Status: </div>
                                    <div>Product Model: </div>
                                    <div>Quota per day:</div>
                                    <div>Completion Rate:</div>
                                    <div>Downtime Count:</div>
                                    <div>DT Duration:</div>
                                </div>                              
                            </div>

                            <div class="per-dom-container" id="c9-1-cont">
                                <div class="bar-container">
                                    <span class="label">C9-1 Line:</span>
                                    <div class="bar-size">
                                        <div class="bar" data-width=""></div>
                                    </div>
                                </div> 
                                <div class="dom-info" id="c9one-info">
                                    <div>Status: </div>
                                    <div>Product Model: </div>
                                    <div>Quota per day:</div>
                                    <div>Completion Rate:</div>
                                    <div>Downtime Count:</div>
                                    <div>DT Duration:</div>
                                </div>                                
                            </div>

                            <div class="per-dom-container" id="c10-cont">
                                <div class="bar-container">
                                    <span class="label">C10 Line:</span>
                                    <div class="bar-size">
                                        <div class="bar" data-width=""></div>
                                    </div>
                                </div> 
                                <div class="dom-info" id="c10-info">
                                    <div>Status: </div>
                                    <div>Product Model: </div>
                                    <div>Quota per day:</div>
                                    <div>Completion Rate:</div>
                                    <div>Downtime Count:</div>
                                    <div>DT Duration:</div>
                                </div>                                
                            </div>
                        </div>
                    </div>

                    <div id="dom-overview-container">
                    </div>
                       
                </div>
            </div>

            <footer class="footer">
                <p>Digital Output Monitoring (Version 1.9.1)</p>
                <p>© 2025 Nichivi Philippines Corporation (Manufacturing Technology) All Rights Reserved.</p>
            </footer>
        </div>

        <div id="dashboard-container">
            <div id="dashboard">

                <div class="graph-data-container">
                    <div class="graph-header">Production vs. Downtime</div>
                    <div class="dropdown-container">
                        <select class="dropdown" id="data-selector" onchange="updateChartData()">
                            <option value="monthly">Monthly Data</option>
                            <option value="yearly">Yearly Data</option>
                        </select>
                    </div>
                    <canvas id="graph-data" width="800" height="350"></canvas>
                </div>
                <div id="line">

                </div>

                <div class="download-production-data">
                    <table id="imagesTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Data Production</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div id="dataentry-container">
                <div id="input-data">

                    <div class="btns-form-container">
                        <nav class="btns-form">
                                <button onclick="showPlandata()" class="active">Create Plan<i class='fas fa-file-upload'></i></button>
                                <button onclick="showSwp()">Upload SWP <i class='fas fa-file-upload'></i></button>
                                <button onclick="showPic()">Person-in-Charge List <i class='fas fa-file-upload'></i></button>
                                <button onclick="showTablePlan()">List of Plans <i class='fas fa-file-upload'></i></button>
                        </nav>
                    </div>

                    <div id="line2"></div>
                    
                    <div id="form-container">
                        <form action="formhandler.inc.php" method="post">
                            
                            <div class="section-header" id="section-header1">Product Information</div>
                            <div class="product-info" id="product-tab">
                                <label for="part_no">Part Number:</label>
                                <input type="text" id="part_no" name="part_no" placeholder="Enter part number">

                                <label for="model">Model:</label>
                                <input type="text" id="model" name="model" placeholder="Enter model name">

                                <label for="line-label">Line:</label>
                                <input type="text" id="line-label" name="line" placeholder="Enter line name">

                                <label for="del_date">Delivery Date:</label>
                                <input type="date" id="del_date" name="del_date">

                                <label for="balance">Balance:</label>
                                <input type="number" id="balance" name="balance" placeholder="Enter balance">

                                <label for="man_power">Manpower:</label>
                                <input type="number" id="man_power" name="man_power" placeholder="Enter manpower count">

                                <label for="ct_as_of">Ct. as of:</label>
                                <input type="date" id="ct_as_of" name="ct_as_of">

                                <label for="exp_date">Exp. Date:</label>
                                <input type="date" id="exp_date" name="exp_date">

                                <div class="merged">
                                    <label for="prod_hrs">Production Hours:</label>
                                    <input type="text" id="prod_hrs" name="prod_hrs" placeholder="Enter Production Hours">
                                </div>
                            </div>
                                                
                            
                            
                            <div class="section-header" id="section-header2">Production Hours</div>
                            <div id="plan-hr-container">

                                <div class="plan-hr" id="plan-tab">
                                    <input type="number" name="plan1" placeholder="6am - 7am" />
                                    <input type="number" name="plan2" placeholder="7am - 8am" />
                                    <input type="number" name="plan3" placeholder="8am - 9am" />
                                    <input type="number" name="plan4" placeholder="9am - 10am" />
                                    <input type="number" name="plan5" placeholder="10am - 11am" />
                                    <input type="number" name="plan6" placeholder="11am - 12nn" />
                                    <input type="number" name="plan7" placeholder="12nn - 1pm" />
                                    <input type="number" name="plan8" placeholder="1pm - 2pm" />
                                    <input type="number" name="plan9" placeholder="2pm - 3pm" />
                                    <input type="number" name="plan10" placeholder="3pm - 4pm" />
                                    <input type="number" name="plan11" placeholder="4pm - 5pm" />
                                    <input type="number" name="plan12" placeholder="5pm - 6pm" />
                                    <input type="number" name="plan13" placeholder="6pm - 7pm" />
                                    <input type="number" name="plan14" placeholder="7pm - 8pm" /> 
                                </div>

                            </div>

                            <div class="submit-btn-container" id="submit-btn">
                                <button type="submit">Submit</button>
                            </div>
                        </form>

                        <div class="next-back-button-container">
                            <div class="next-btn-container" id="next-btn">
                                <button>Next</button>
                            </div> 
                            
                            <div class="back-btn-container" id="back-btn">
                                <button>Back</button>
                            </div> 
                        </div>
                    </div>

                    <div id="form-swp-container">
                        <div class="section-header" id="section-header3">Standard Working Procedure</div>
                        <div class="upload-swp-container">
                            
                            <!--
                            <label for="file" class="upload-label">
                                Select SWP File
                                    </label>
                                    <input type="file" name = "file" id="file" class="file-input" />
                                    <input type="submit" value = "Upload File" class="submit-button">
                                        Upload
                                    </>
                                </div>
                            </form>
                            -->
                            <form action="upload_file_swp.php" method="post" enctype="multipart/form-data">
                                <div class="upload-section">
                                    <label for="file">Select file:</label>
                                    <input type="file" name="file" id="file">
                                    <input type="submit" value="Upload File" id="swp-file-submitbtn">
                                </div>
                            </form>

                        </div>
                    </div>

                    <div id="form-pic-container">

                        
                        <div class="section-name">
                                <div class="section-header" id="section-header4" >List of Person-in-Charge
                                    <span class="line-prod-number2" style="font-size: 0.7rem; font-family:Arial"></span>
                                </div>
                        </div>

                        <div class="table-person-container">
                            <table id="table-person">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Latest Cert Date</th>
                                        <th>Re-Cert Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="btn-container">
                            <div class="updateBtn">
                                <button onclick="ShowUpdateForm()">
                                    Update
                                </button>
                            </div>

                            <div class="uploadPIC-Btn">
                                <button onclick="ShowUploadForm()">
                                    Add Person-in-Charge
                                </button>
                            </div>

                            <div class="deleteBtn">
                                <button onclick="ShowDeleteForm()">
                                    Delete
                                </button>
                            </div>
                        </div>

                    </div>

                    <div id="plan-table-container">
                        <div class="section-header" id="section-header5" >Planned Quota Per Day
                            <span class="line-prod-number3" style="font-size: 0.7rem; font-family:Arial"></span>
                        </div>


                        <div id="append-data-plan">
                        </div>

                        <div>
                            <form id="editForm">
                                <div class="info-prod-edit">
                                    <div class="header-edit-form">
                                        <span>Edit Table Form</span>
                                    </div>

                                    <div class="edit-field-input">
                                        <label for="planId">Plan number</label>
                                        <input type="text" id="planId" placeholder="Enter Plan number" readonly>

                                        <div class="edit-field-input">
                                            <label for="partno">Part Number</label>
                                            <input type="text" id="partno" name="part_no" placeholder="Enter Part number">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="model">Model</label>
                                            <input type="text" id="modelnumber" name="model" placeholder="Enter Model">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="line-edit">Line</label>
                                            <input type="text" id="line-edit" name="line" placeholder="Enter Line">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="delDate">Delivery Date</label>
                                            <input type="text" id="delDate" name="delDate">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="manpower">Manpower</label>
                                            <input type="text" id="manpower" name="manpower" placeholder="Enter Number Manpower">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="ctasof">CT.AS.OF</label>
                                            <input type="text" id="ctasof" name="ctasof">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="expdate">Exp.Date</label>
                                            <input type="text" id="expdate" name="expdate">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="prodhrs">Production Hours</label>
                                            <input type="text" id="prodhrs" name="prodhrs" placeholder="Enter Production Hours">
                                        </div>
                                    </div>

                                    <div class="table-plan-edit-form">
                                        <div class="edit-field-input">
                                            <label for="plan1">6am-7am</label>
                                            <input type="number" id="plan1" name="plan1" placeholder="6am-7am">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan2">7am-8am</label>
                                            <input type="number" id="plan2" name="plan2" placeholder="7am-8am">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan3">8am-9am</label>
                                            <input type="number" id="plan3" name="plan3" placeholder="8am-9am">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan4">9am-10am</label>
                                            <input type="text" id="plan4" name="plan4" placeholder="9am-10am">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan5">10am-11am</label>
                                            <input type="number" id="plan5" name="plan5" placeholder="10am-11am">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan6">11am-12nn</label>
                                            <input type="number" id="plan6" name="plan6" placeholder="11am-12nn">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan7">12nn-1pm</label>
                                            <input type="number" id="plan7" name="plan7" placeholder="12nn-1pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan8">1pm-2pm</label>
                                            <input type="number" id="plan8" name="plan8" placeholder="1pm-2pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan9">2pm-3pm</label>
                                            <input type="text" id="plan9" name="plan9" placeholder="2pm-3pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan10">3pm-4pm</label>
                                            <input type="number" id="plan10" name="plan10" placeholder="3pm-4pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan11">4pm-5pm</label>
                                            <input type="number" id="plan11" name="plan11" placeholder="4pm-5pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan12">5pm-6pm</label>
                                            <input type="number" id="plan12" name="plan12" placeholder="5pm-6pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan13">6pm-7pm</label>
                                            <input type="number" id="plan13" name="plan13" placeholder="6pm-7pm">
                                        </div>
                                        <div class="edit-field-input">
                                            <label for="plan14">7pm-8pm</label>
                                            <input type="number" id="plan14" name="plan14" placeholder="7pm-8pm">
                                        </div>
                                    </div>

                                    <div class="SubmitEditForm">
                                        <button type="submit">Submit</button>
                                    </div>
                            </form>
                        </div>
                        
                    </div>

                </div>           
        </div>
    
        <div class="operator-cover" id="operator-div">
            <div class="update-operator-container" id="update-operator-div">
                <button class="exit-btn" onclick="exitForm()">&times;</button>
                <div>
                    <h1>
                        Update Operator Menu
                    </h1>
                </div>
                <div class="input-group">
                    <input id="name-update" type="text" placeholder="Enter name ">
                </div>
                <div class="input-group">
                    <input id="role" type="text" placeholder="Enter Role ">
                </div>
                <div class="checkbox-container">
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Cutting</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Assembly</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Cutting</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Installation pad</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Manual Seimitsu</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Retainer Putting</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Manual Valve Check</span>
                    </div>
                    <div class="checkbox-input">
                        <input type="checkbox">
                        <span>Final Inspection</span>
                    </div>
                    <div class="date-input">
                        <label>Last Certification Date</label>
                        <input type="date">
                    </div>
                    <div class="date-input">
                        <label>Re-Certification Date</label>
                        <input type="date">
                    </div>
                </div>
                <div class="submit-update-btn">
                    <button onclick="submitUpdate() ">Submit</button>
                </div>
            </div>
        </div>

        <div class="operator-cover" id="upload-operator-div">
            <div class="upload-pic-container" id="pic-container-div">
                <button class="exit-btn" onclick="exitForm()">&times;</button>
                <form action="inserSigna.php" method="POST" enctype="multipart/form-data">
                    <div class="upload-section">
                        <label class="upload-label-pic">
                            Upload PIC Picture
                        </label>
                        <input type="file" name="picture" required>
                        <input type="text" name="ope-pic" placeholder="Enter Operator Name" required>
                        <input type="submit" value="Upload" class="submit-button">
                    </div>
                </form> 
            </div>            
        </div>

        <div class="operator-cover" id="delete-operator-div">
            <div class="DeleteContainer" id="DeleteContainer">
                <button class="exit-btn" onclick="exitDeleteForm()">&times;</button>
                <div class="title-delete-form">
                    <h2>Delete Form</h2> 
                </div>
                <div class="input-delete">
                    <input id="num-operator" type="number" placeholder="Enter Number Operator">
                </div>
                <div class="delete-btn-submit">
                    <button onclick="deleteOperator()">
                        Submit
                    </button>
                </div>
            </div>
        </div>

    </div> 

    <script src="/planner_fetch/planner_data.js"></script>

    <script> 
        document.addEventListener("DOMContentLoaded", () => {
            // Get the current IP from the page URL
            const currentIP = window.location.hostname; // e.g., "10.0.0.102"

            // Loop through each button and check if it matches
            document.querySelectorAll(".nav-button").forEach(button => {
                if (button.dataset.ip === currentIP) {
                    button.disabled = true; // disable matching button
                    button.style.opacity = "0.5"; // optional style
                    button.style.cursor = "not-allowed"; // optional visual feedback
                }
            });
        });
        
        const ctx = document.getElementById('graph-data').getContext('2d');

        let chartData = {
            monthly: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                        label: 'Production',
                        data: [120, 150, 100, 180, 130],
                        backgroundColor: '#007bff'
                    },
                    {
                        label: 'Downtime',
                        data: [30, 20, 40, 15, 25],
                        backgroundColor: 'red'
                    }
                ]
            },
            yearly: {
                labels: ['2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                        label: 'Production',
                        data: [1500, 1800, 1600, 1900, 1700],
                        backgroundColor: 'green'
                    },
                    {
                        label: 'Downtime',
                        data: [300, 250, 350, 200, 400],
                        backgroundColor: 'red'
                    }
                ]
            }
        };

        let chart = new Chart(ctx, {
            type: 'bar',
            data: chartData.monthly,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hours'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#555'
                        }
                    }
                }
            }
        });

        function updateChartData() {
            const selectedData = document.getElementById('data-selector').value;
            chart.data = chartData[selectedData];
            chart.options.scales.x.title.text = selectedData === 'monthly' ? 'Months' : 'Years';
            chart.update();
        }

        function downloadData(date, production) {
            const dataStr = `Date: ${date}\nProduction: ${production}`;
            const blob = new Blob([dataStr], {
                type: 'text/plain'
            });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `production_data_${date}.txt`;
            a.click();
            window.URL.revokeObjectURL(url);
        }

        document.getElementById("c4-cont").addEventListener("click", function() {
            window.location.href = "http://10.0.0.189/planner.php";
        });

        document.getElementById("c7-cont").addEventListener("click", function() {
            window.location.href = "http://10.0.0.102/planner.php";
        });

        document.getElementById("c9-cont").addEventListener("click", function() {
            window.location.href = "http://10.0.0.136/planner.php";
        });

        document.getElementById("c9-1-cont").addEventListener("click", function() {
            window.location.href = "http://10.0.0.125/planner.php";
        });

        document.getElementById("c10-cont").addEventListener("click", function() {
            window.location.href = "http://10.0.0.164/planner.php";
        });

        const dashboardNames = {
            "10.0.0.189": "TUBE ASSEMBLY: C4 PRODUCTION LINE",
            "10.0.0.102": "TUBE ASSEMBLY: C7 PRODUCTION LINE",
            "10.0.0.136": "TUBE ASSEMBLY: C9 PRODUCTION LINE",
            "10.0.0.125": "TUBE ASSEMBLY: C9-1 PRODUCTION LINE",
            "10.0.0.164": "TUBE ASSEMBLY: C10 PRODUCTION LINE",
            "localhost": "ADMINISTRATOR",
            "192.168.0.225": "TUBE ASSEMBLY: C4 PRODUCTION LINE"
        }

        const currentIP = window.location.hostname;

        const dashboardTitle = dashboardNames[currentIP] || "PRODUCTION LINE";
        
        document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector(".line-prod-main");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector(".line-prod-number");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector(".line-prod-number2");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector(".line-prod-number3");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });

        document.querySelector('.side-nav button:nth-child(1)').addEventListener('click', function() {
            document.getElementById('home').style.display = 'block';
            document.getElementById('dashboard-container').style.display = 'none';
            document.getElementById('dataentry-container').style.display = 'none';
            document.getElementById('prod-number').style.display = 'none';
            /*document.getElementById('title-with-dom-number').style.display = 'none';
            document.getElementById('side-nav-menu').style.justifyContent = 'center';
            document.getElementById('navigation-btn').style.margin = '0px 0px 0px 0px'; */
        });

        document.querySelector('.side-nav button:nth-child(3)').addEventListener('click', function() {
            
            document.getElementById('home').style.display = 'none';
            document.getElementById('dashboard-container').style.display = 'flex';
            document.getElementById('dataentry-container').style.display = 'none';
            document.getElementById('prod-number').style.display = 'block';
            /*document.getElementById('title-with-dom-number').style.display = 'flex';
            document.getElementById('side-nav-menu').style.justifyContent = 'space-between';
            document.getElementById('navigation-btn').style.margin = '0px 50px 0px 0px'; */
        });

        document.querySelector('.side-nav button:nth-child(5)').addEventListener('click', function() {
            
            document.getElementById('home').style.display = 'none';
            document.getElementById('dashboard-container').style.display = 'none';
            document.getElementById('dataentry-container').style.display = 'flex';
            document.getElementById('prod-number').style.display = 'block';
            /*document.getElementById('title-with-dom-number').style.display = 'flex';
            document.getElementById('side-nav-menu').style.justifyContent = 'space-between';
            document.getElementById('navigation-btn').style.margin = '0px 50px 0px 0px';*/
        });

        document.querySelector('.dropdown-content button:nth-child(1)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.189/planner.php";
        });
        document.querySelector('.dropdown-content button:nth-child(2)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.102/planner.php";
        });
        document.querySelector('.dropdown-content button:nth-child(3)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.136/planner.php";
        });
        document.querySelector('.dropdown-content button:nth-child(4)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.125/planner.php";
        });
        document.querySelector('.dropdown-content button:nth-child(5)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.164/planner.php";
        });

        const buttons = document.querySelectorAll('.btns-form button');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });

        function showSwp() {
            document.getElementById('form-pic-container').style.display = 'none';
            document.getElementById('form-swp-container').style.display = 'block';
            document.getElementById('form-container').style.display = 'none';
            document.getElementById('plan-table-container').style.display = 'none';
        }

        function showPlandata() {
            document.getElementById('form-pic-container').style.display = 'none';
            document.getElementById('form-swp-container').style.display = 'none';
            document.getElementById('form-container').style.display = 'block';
            document.getElementById('plan-table-container').style.display = 'none';
        }

        function showPic() {
            document.getElementById('form-pic-container').style.display = 'block';
            document.getElementById('form-swp-container').style.display = 'none';
            document.getElementById('form-container').style.display = 'none';
            document.getElementById('plan-table-container').style.display = 'none';
        }

        function showTablePlan() {
            document.getElementById('form-pic-container').style.display = 'none';
            document.getElementById('form-swp-container').style.display = 'none';
            document.getElementById('form-container').style.display = 'none';
            document.getElementById('plan-table-container').style.display = 'block';
            const planDiv = document.getElementById('append-data-plan');
            planDiv.scrollTop = 0;
        }

        document.querySelector('.next-btn-container button').addEventListener('click', function() {
            document.getElementById('section-header1').style.display = 'none';
            document.getElementById('product-tab').style.display = 'none';
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('back-btn').style.display = 'flex';
            document.getElementById('section-header2').style.display = 'block';
            document.getElementById('plan-tab').style.display = 'grid';
            document.getElementById('submit-btn').style.display = 'flex';
        });

        document.querySelector('.back-btn-container button').addEventListener('click', function() {
            document.getElementById('section-header1').style.display = 'flex';
            document.getElementById('product-tab').style.display = 'grid    ';
            document.getElementById('next-btn').style.display = 'flex';
            document.getElementById('back-btn').style.display = 'none';
            document.getElementById('section-header2').style.display = 'none';
            document.getElementById('plan-tab').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'none';
        });


        function openNav() {
            document.getElementById("mySidenav").style.width = "200px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        async function loadImages() {
            try {
                const response = await fetch('server_display.php');
                const images = await response.json();

                const tableBody = document.querySelector('#imagesTable tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                images.forEach(image => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td id="date-prod">${image.date}</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <img  style ="width:50px; 
                                  height:15px;"src="data:image/png;base64,${image.image_data}" alt="Captured Image"/>
                        </td>
                        <td><button id="downloaddata-btn" style= "width: 150px; 
                                    padding: 5px 10px; 
                                    background-color: #007bff; 
                                    color: #ffffff; border: none; 
                                    border-radius: 6px; 
                                    font-size: 0.8rem; 
                                    font-weight: 700; 
                                    transition: background 0.3s;
                                    cursor: pointer;"onclick="convertToPDF('${image.image_data}')">Download Data
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading images:', error);
            }
        }

        async function loadPerson() {
            try {
                const response = await fetch('person_display_server.php');
                const persons = await response.json();

                const tableBody = document.querySelector('#table-person tbody');
                tableBody.innerHTML = ''; // Clear existing rows
                let i = 0;
                persons.forEach(person => {

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${person.id}
                        <td>${person.person}
                        <td>${person.latest_date}</td>
                        <td>${person.recert_date}</td>
                    `;
                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error loading :', error);
            }
        }

        function loadPlans() {
            fetch('tablePlanServer.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'read' })
            })
            .then(res => res.json())
            .then(data => {
                let text = '';

            data.forEach(row => {
                text += `
                <div class="plan-data-container">
                    <div class="plan-data">
                        <div class="header-plan-data">
                            Plan No. ${row.id}
                        </div>
                        <div class="plan-section" id="information-plan-title">Product Information</div>
                        <div class="information-plan">
                            <div><label>Part No:&nbsp;</label> ${row.part_no}</div>
                            <div><label>Model:&nbsp;</label> ${row.model}</div>
                            <div><label>Line:&nbsp;</label> ${row.line}</div>
                            <div><label>Delivery Date:&nbsp;</label> ${row.del_date}</div>
                            <div><label>CT As Of:&nbsp;</label> ${row.ct_as_of}</div>
                            <div><label>Exp. Date:&nbsp;</label> ${row.exp_date}</div>
                            <div><label>Man Power:&nbsp;</label> ${row.man_power}</div>
                            <div><label>Prod Hours:&nbsp;</label> ${row.prod_hrs}</div>                            
                        </div>

                        <div class="plan-section" id="time-plan-title">Plan Output Per Hour</div>

                        <div class="time-plan">
                            ${(() => {
                                const plans = [
                                    row.plan_1, row.plan_2, row.plan_3, row.plan_4,
                                    row.plan_5, row.plan_6, row.plan_7, row.plan_8,
                                    row.plan_9, row.plan_10, row.plan_11, row.plan_12,
                                    row.plan_13, row.plan_14
                                ];
                                const times = [
                                    "6AM–7AM", "7AM–8AM", "8AM–9AM", "9AM–10AM",
                                    "10AM–11AM", "11AM–12PM", "12PM–1PM", "1PM–2PM",
                                    "2PM–3PM", "3PM–4PM", "4PM–5PM", "5PM–6PM",
                                    "6PM–7PM", "7PM–8PM"
                                ];

                                const half = Math.ceil(plans.length / 2);

                                // First column
                                const col1 = plans.slice(0, half).map((p, i) => `
                                    <div class="plan-item">
                                        <label class="time-label">${times[i]}:&nbsp;</label>
                                        <span class="plan-value">${p ?? '-'}</span>
                                    </div>
                                `).join('');

                                const col2 = plans.slice(half).map((p, i) => `
                                    <div class="plan-item">
                                        <label class="time-label">${times[i + half]}:&nbsp;</label>
                                        <span class="plan-value">${p ?? '-'}</span>
                                    </div>
                                `).join('');

                                return `
                                    <div class="column">${col1}</div>
                                    <div class="column">${col2}</div>
                                `;
                            })()}
                        </div>

                        <div id="plan-buttons">
                            <button class="editbtn-table" onclick="editPlan(
                                ${row.id},
                                '${row.part_no}',
                                '${row.model}', 
                                '${row.line}',
                                '${row.del_date}',
                                '${row.ct_as_of}',
                                '${row.exp_date}',
                                '${row.man_power}',
                                '${row.prod_hrs}',
                                '${row.plan_1}',
                                '${row.plan_2}',
                                '${row.plan_3}',
                                '${row.plan_4}',
                                '${row.plan_5}',
                                '${row.plan_6}',
                                '${row.plan_7}',
                                '${row.plan_8}',
                                '${row.plan_9}',
                                '${row.plan_10}',
                                '${row.plan_11}',
                                '${row.plan_12}',
                                '${row.plan_13}',
                                '${row.plan_14}'
                            )">Edit</button>

                            <button class="deletebtn-table" onclick="deletePlan(${row.id})">Delete</button>
                        </div>
                        
                    </div>                    
                </div>
                `;
            });

                document.getElementById('append-data-plan').innerHTML = text;
            })
            .catch(err => console.error('Error loading plans:', err));
        }

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('action', 'update'); // always update
            formData.append('planId', document.getElementById('planId').value);

            fetch('tablePlanServer.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(() => {
                    this.reset();
                    loadPlans(); // refresh the table
                    document.getElementById('editForm').style.display = "none";
                    document.getElementById('append-data-plan').style.display = "flex";
                });
        });

        function editPlan(id, part_no, model, line, del_date,
            ctasof, expdate, manpower, prodhrs, plan1, plan2,
            plan3, plan4, plan5, plan6, plan7, plan8, plan9, plan10,
            plan11, plan12, plan13, plan14
        ) {
            const deli = document.getElementById('delDate').value;
            console.log(deli)
            document.getElementById('editForm').style.display = "flex";
            document.getElementById('append-data-plan').style.display = "none";
            document.getElementById('planId').value = id;
            document.getElementById('partno').value = part_no;
            document.getElementById('modelnumber').value = model;
            document.getElementById('line-edit').value = line;
            document.getElementById('delDate').value = del_date;
            document.getElementById('ctasof').value = ctasof;
            document.getElementById('expdate').value = expdate;
            document.getElementById('manpower').value = manpower;
            document.getElementById('prodhrs').value = prodhrs;
            document.getElementById('plan1').value = plan1;
            document.getElementById('plan2').value = plan2;
            document.getElementById('plan3').value = plan3;
            document.getElementById('plan4').value = plan4;
            document.getElementById('plan5').value = plan5;
            document.getElementById('plan6').value = plan6;
            document.getElementById('plan7').value = plan7;
            document.getElementById('plan8').value = plan8;
            document.getElementById('plan9').value = plan9;
            document.getElementById('plan10').value = plan10;
            document.getElementById('plan11').value = plan11;
            document.getElementById('plan12').value = plan12;
            document.getElementById('plan13').value = plan13;
            document.getElementById('plan14').value = plan14;
        }

        function deletePlan(id) {
            if (!confirm('Delete this plan?')) return;
            fetch('tablePlanServer.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        action: 'delete',
                        id
                    })
                })
                .then(res => res.json())
                .then(() => loadPlans());
        }

        // Auto refresh every 5 seconds
        setInterval(loadPlans, 2000);

        // Initial load
        loadPlans();

        const checkboxData = [];

        function getCheckboxData() {
            const checkboxes = document.querySelectorAll('.checkbox-input input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkboxData.push(checkbox.checked ? 1 : 0);
            });

            return checkboxData;
        }

        function sendDataToServer(data) {
            fetch('updatePerson.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    console.log('Success:', result);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            for (let i = 0; i < checkboxData.length; i++) {
                console.log(checkboxData[i])
            }
        }

        function sendNumDelete(data) {
            fetch('DeleteNum.php', { // Change this to your PHP script filename
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message);
                    } else {
                        alert("Error: " + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong while deleting.');
                });
        }

        function submitUpdate() {
            const name = document.getElementById('name-update').value;
            const role = document.getElementById('role').value;
            const checkboxData = getCheckboxData();
            const lastCertDate = document.querySelector('.date-input input[type="date"]').value;
            const reCertDate = document.querySelectorAll('.date-input input[type="date"]')[1].value;

            const formData = {
                name_person: name,
                process_role: role,
                cert: checkboxData,
                recert_date: reCertDate,
                latest_date: lastCertDate
            };

            console.log('Checkbox data:', checkboxData);
            console.log('Form data:', formData);

            sendDataToServer(formData)


            alert('Form submitted! Check console for data.');

            document.getElementById('update-operator-div').style.display = "none";
            document.getElementById("operator-div").classList.remove("active");
        }

        function deleteOperator() {
            const num = document.getElementById('num-operator').value;

            const formData = {
                person_delete: num
            };
            sendNumDelete(formData)

            document.getElementById('DeleteContainer').style.display = "none";
            document.getElementById('delete-operator-div').classList.remove("active"); 
        }

        function edit() {
            document.getElementById("update-container").style.display = "block";
        }
           /*        function convertToPDF(base64Image) {

                    const { jsPDF } = window.jspdf;
                    const img = new Image();
                    img.src = `data:image/png;base64,${base64Image}`;
                    img.onload = function () {
                        const doc = new jsPDF({
                            orientation: 'landscape',
                            unit: 'px',
                            format: [img.width, img.height]
                        });
                        doc.addImage(img, 'PNG', 0, 0, img.width, img.height);
                        doc.save('production-data.pdf');
                    };
            }*/


        function convertToPDF(base64Image) {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF("landscape", "mm", "a4");

            const pageWidth = doc.internal.pageSize.getWidth();
            const pageHeight = doc.internal.pageSize.getHeight();

            const img = new Image();
            img.src = `data:image/png;base64,${base64Image}`;
            img.onload = function() {

                const imgWidth = pageWidth - 20
                const imgHeight = (img.height * imgWidth) / img.width;

                const x = (pageWidth - imgWidth) / 2;
                const y = (pageHeight - imgHeight) / 2;



                doc.addImage(img, 'PNG', x, y, imgWidth, imgHeight);
                doc.save('graphData_C4.pdf');
            };
        }

        function ShowUpdateForm() {
            document.getElementById('update-operator-div').style.display = "block"
            document.getElementById("operator-div").classList.add("active");           
        }

        function exitForm() {
            if (confirm('Are you sure you want to exit?')) {
                // You can hide the form, redirect, or close the modal
                document.querySelector('.update-operator-container').style.display = 'none';
                document.getElementById("operator-div").classList.remove("active");      
                document.querySelector('.upload-pic-container').style.display = 'none';
                document.getElementById("upload-operator-div").classList.remove("active");
              }

        }

        function ShowUploadForm() {
            document.getElementById('pic-container-div').style.display = "block"
            document.getElementById('upload-operator-div').classList.add("active");           
        }

        function ShowDeleteForm() {
            document.getElementById('DeleteContainer').style.display = "block";
            document.getElementById('delete-operator-div').classList.add("active");           
        }

        function exitDeleteForm() {
            document.getElementById('DeleteContainer').style.display = "none";
            document.getElementById('delete-operator-div').classList.remove("active");           
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            loadImages();
            loadPerson()
        })

    </script>
    
</body>

</html>