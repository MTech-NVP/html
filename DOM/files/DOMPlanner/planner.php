<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOM | Planner</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/ico" href="../../media/icons/nichivi-logo.ico">
    <link rel="stylesheet" href="planner.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <!-- Cropper.js CSS -->
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

</head>


<body>

    <nav class="side-nav" id="side-nav-menu">
        <div class="title-dashboard" id="title-with-dom-number">
            <div>
                <img width="35" src="../../media/icons/nichivi_logo_white.png" alt="logo">
            </div>
            <div style="font-size: 0.9rem;">
                NICHIVI PHILIPPINES CORPORATION
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
                            <button onclick="showTablePlan()" class="active">List of Plans <i class='fas fa-file-upload'></i></button>
                            <button onclick="showPlandata()">Create Plan<i class='fas fa-file-upload'></i></button>
                            <button onclick="showPic()">Person-in-Charge List <i class='fas fa-file-upload'></i></button>
                            <button onclick="showSwp()">Upload SWP <i class='fas fa-file-upload'></i></button>
                            
                    </nav>
                </div>

                <div id="line2"></div>
                
                <div id="form-container">
                    <form action="fetches/formhandler.inc.php" method="post">
                        
                        <div class="section-header" id="section-header1">Product Information</div>
                        <div class="product-info" id="product-tab">
                            <label for="part_no">Part Number:</label>
                            <input type="text" id="part_no" name="partnumber" placeholder="Enter part number">

                            <label for="model">Model:</label>
                            <input type="text" id="model" name="model" placeholder="Enter model name">

                            <label for="del_date">Delivery Date:</label>
                            <input type="date" id="del_date" name="deliverydate">

                            <label for="balance">Balance:</label>
                            <input type="number" id="balance" name="balance" placeholder="Enter balance">

                            <label for="man_power">Manpower:</label>
                            <input type="number" id="man_power" name="man_power" placeholder="Enter manpower count">

                            <label for="prod_hrs">Production Hours:</label>
                            <input type="text" id="prod_hrs" name="prod_hrs" placeholder="Enter Production Hours">

                        </div>
                        <div id="plan-hr-container">
                            <div class="section-header">
                                Minutes Allotted Per Hour
                            </div>
                            <div class="plan-hr" id="plan-tab">
                                <input type="number" name="mins1" placeholder="6am-7am" />
                                <input type="number" name="mins2" placeholder="7am-8am" />
                                <input type="number" name="mins3" placeholder="8am-9am" />
                                <input type="number" name="mins4" placeholder="9am-10am" />
                                <input type="number" name="mins5" placeholder="10am-11am" />
                                <input type="number" name="mins6" placeholder="11am-12nn" />
                                <input type="number" name="mins7" placeholder="12nn-1pm" />
                                <input type="number" name="mins8" placeholder="1pm-2pm" />
                                <input type="number" name="mins9" placeholder="2pm-3pm" />
                                <input type="number" name="mins10" placeholder="3pm-4pm" />
                                <input type="number" name="mins11" placeholder="4pm-5pm" />
                                <input type="number" name="mins12" placeholder="5pm-6pm" />
                                <input type="number" name="mins13" placeholder="6pm-7pm" />
                                <input type="number" name="mins14" placeholder="7pm-8pm" /> 
                            </div>
                        </div>

                        <div class="submit-btn-container" id="submit-btn">
                            <button type="submit">Submit</button>
                        </div>                    

                    </form>

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
                        <form action="fetches/upload_file_swp.php" method="post" enctype="multipart/form-data">
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
                    <div id="append-data-persons">
                        <div id="line-leader-container">
                            <div id="ll-header">
                                List of Line Leaders
                            </div>
                            <table id="line-leader-person">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Position</th>                            
                                    </tr>                                
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        
                        <div class="table-person-container">
                            <div id="pic-header">
                                List of Production Staffs
                            </div>
                            <table id="table-person">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Designated Area</th>
                                        <th>Latest Certification Date</th>
                                        <th>Re-Certification Date</th>
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
                </div>

                <div id="plan-table-container">
                    <div class="section-header" id="section-header5" >Planned Quota Per Day
                        <span class="line-prod-number3" style="font-size: 0.7rem; font-family:Arial"></span>
                    </div>

                    <div id="ct-details">
                        <div id="ct-containers">
                            <div class="ct-container">
                                <label for="ct">Cycle Time:</label>
                                <input type="number" id="ct" name="cycletime" class="ct-input" placeholder="Cycle Time">
                            </div>
                            <div class="ct-container">
                                <label for="ctao">Cycle Time as of:</label>
                                <input type="date" id="ctao" name="ctao" class="ct-input" placeholder="Cycle Time as of">
                            </div>
                            <div class="ct-container">
                                <label for="expdate">Expiration Date:</label>
                                <input type="date" id="expdate" name="expdate" class="ct-input" placeholder="Expiration Date">
                            </div>                               
                        </div>
                        <div id="ct-buttons">
                            <button id="edit-ct" class="ct-btn">
                                Edit
                            </button>
                            <button id="submit-ct" class="ct-btn">
                                Submit
                            </button>
                            <button id="back-ct" class="ct-btn">
                                Back
                            </button>                            
                        </div>
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
                                        <input type="text" id="partno" name="partnumber" placeholder="Enter Part number">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="model">Model</label>
                                        <input type="text" id="modelnumber" name="model" placeholder="Enter Model">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="delDate">Delivery Date</label>
                                        <input type="date" id="delDate" name="deliverydate">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="manpower">Manpower</label>
                                        <input type="text" id="manpower" name="manpower" placeholder="Enter Number Manpower">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="prodhrs">Production Hours</label>
                                        <input type="text" id="prodhrs" name="prodhrs" placeholder="Enter Production Hours">
                                    </div>
                                </div>

                                <div class="table-plan-edit-form">
                                    <div class="edit-field-input">
                                        <label for="plan1">6am-7am</label>
                                        <input type="number" id="plan1" name="mins1" placeholder="6am-7am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan2">7am-8am</label>
                                        <input type="number" id="plan2" name="mins2" placeholder="7am-8am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan3">8am-9am</label>
                                        <input type="number" id="plan3" name="mins3" placeholder="8am-9am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan4">9am-10am</label>
                                        <input type="text" id="plan4" name="mins4" placeholder="9am-10am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan5">10am-11am</label>
                                        <input type="number" id="plan5" name="mins5" placeholder="10am-11am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan6">11am-12nn</label>
                                        <input type="number" id="plan6" name="mins6" placeholder="11am-12nn">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan7">12nn-1pm</label>
                                        <input type="number" id="plan7" name="mins7" placeholder="12nn-1pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan8">1pm-2pm</label>
                                        <input type="number" id="plan8" name="mins8" placeholder="1pm-2pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan9">2pm-3pm</label>
                                        <input type="text" id="plan9" name="mins9" placeholder="2pm-3pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan10">3pm-4pm</label>
                                        <input type="number" id="plan10" name="mins10" placeholder="3pm-4pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan11">4pm-5pm</label>
                                        <input type="number" id="plan11" name="mins11" placeholder="4pm-5pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan12">5pm-6pm</label>
                                        <input type="number" id="plan12" name="mins12" placeholder="5pm-6pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan13">6pm-7pm</label>
                                        <input type="number" id="plan13" name="mins13" placeholder="6pm-7pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="plan14">7pm-8pm</label>
                                        <input type="number" id="plan14" name="mins14" placeholder="7pm-8pm">
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
                <div id="fill-up">
                    <div id="header-update">
                        Update Details
                    </div>
                    <div id="choose-container" class="edit-persons-container">
                        <span>Choose which staff to edit.</span>
                        <button id="line-leader-edit-button" class="choose-container-buttons">Line Leaders</button>
                        <button id="prod-staff-edit-button" class="choose-container-buttons">Production Staffs</button>
                    </div>
                    <div id="line-leader-edit-container" class="edit-persons-container">
                        <button class="edit-back-btn" onclick="goBack()">← Back</button>
                        <div id="select-ll-form">
                            <select name="names-ll" id="names-ll">
                                <option value="Select">Select a Name</option>
                            </select>
                        </div>
                        <div id="ll-form">
                            <div>
                                <label for="first-name">First Name:</label>
                                <input id="first-name" type="text">
                            </div>
                            <div>
                                <label for="middle-name">Middle Name:</label>
                                <input id="middle-name" type="text">
                            </div>
                            <div>
                                <label for="last-name">Last Name:</label>
                                <input id="last-name" type="text">
                            </div>
                            <div>
                                <label for="title-ll">Position:</label>
                                <input id="title-ll" type="text">
                            </div>
                        </div>
                        <div id="pic-container-ll">
                            <div id="picture-display-ll">
                                Picture
                            </div>
                            <input id="picture-ll" type="file" accept="image/*">
                        </div>
                        <div id="submit-button-update-ll-container">
                            <button id="submit-button-update-ll">Submit Updates</button>
                        </div>
                    </div>
                    <div id="prod-staff-edit-container" class="edit-persons-container">
                        <button class="edit-back-btn" onclick="goBack()">← Back</button>
                        <div id="select-ps-form">
                            <select name="names-ps" id="names-ps">
                                <option value="SelectPS">Select a Name</option>
                            </select>
                        </div>
                        <div id="ps-form">
                            <div>
                                <label for="first-name-ps">First Name:</label>
                                <input id="first-name-ps" type="text">
                            </div>
                            <div>
                                <label for="middle-name-ps">Middle Name:</label>
                                <input id="middle-name-ps" type="text">
                            </div>
                            <div>
                                <label for="last-name-ps">Last Name:</label>
                                <input id="last-name-ps" type="text">
                            </div>
                            <div>
                                <label for="title-ps">Process:</label>
                                <input id="title-ps" type="text">
                            </div>
                            <div>
                                <label for="lcdate-ps">Last Certification Date:</label>
                                <input id="lcdate-ps" type="date">
                            </div>
                            <div>
                                <label for="rcdate-ps">Re-Certification Date:</label>
                                <input id="rcdate-ps" type="date">
                            </div>
                        </div>
                        <div id="pic-container-ps">
                            <div id="picture-display-ps">
                                Picture
                            </div>
                            <input id="picture-ps" type="file" accept="image*/">
                        </div>
                        <div id="submit-button-update-ps-container">
                            <button id="submit-button-update-ps">Submit Updates</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="crop-overlay">
            <div id="crop-container">
                <img id="crop-image" src="" alt="Crop Image">
                <div id="crop-buttons">
                    <button id="crop-confirm">Crop</button>
                    <button id="crop-cancel">Cancel</button>
                </div>
            </div>
        </div>

        <div class="operator-cover" id="upload-operator-div">
            <div class="upload-pic-container" id="pic-container-div">
                <button class="exit-btn" onclick="exitForm()">&times;</button>
                    <input type="file" id="input-image" accept="image/*">
                    <div id="crop-container" style="margin-top:15px; max-width:400px; max-height:400px;">
                        <img id="image-to-crop" style="max-width:100%; display:none;">
                    </div>
                    <button id="crop-btn">Crop & Save</button>
                    <div id="cropped-result" style="margin-top:15px;"></div>
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

    <script src="fetches/planner_data.js"></script>
    
</body>

</html>