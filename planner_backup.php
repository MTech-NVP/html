<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


</head>
<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body,
    html {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #e0eafc, #cfdef3);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container-data {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        width: 1400px;
        height: 90vh;
        display: flex;
        overflow: hidden;
    }

    .side-nav {
        width: 200px;
        background-color: #f7f9fc;
        padding: 20px;
        border-right: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .side-nav button {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        color: #555;
        background-color: #f7f9fc;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .side-nav button:hover {
        background-color: #e0eafc;
    }

    .data-side {
        /*
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        */
        display: flex;
        flex-direction: column;
        gap:30px;
        padding: 20px;
        overflow-y: auto;
        width: 90%;
    }

    .title-dashboard {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-weight: 900;
        color: #007bff;
        align-items: center;
    }

    .title-dashboard span {
        font-size: 20px;
    }

    .graph-data-container {
        background-color: #f7f9fc;
        border-radius: 15px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 550px;

    }

    .graph-header {
        font-size: 1.8rem;
        font-weight: 500;
        color: #555;
        margin-bottom: 15px;
        text-align: center;
    }

    .dropdown-container {
        margin-bottom: 15px;
    }

    .dropdown {
        padding: 8px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ddd;
        width: 200px;
    }

    .download-production-data {
        background-color: #f7f9fc;
        border-radius: 10px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
        padding: 10px;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;

    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f7f9fc;
        font-weight: 500;
        color: #555;
    }

    td {
        color: #555;
    }

    .download-btn {
        color: #007bff;
        cursor: pointer;
        text-decoration: underline;
    }

    .download-btn:hover {
        color: #0056b3;
    }

    /* Professional Form Styling */
    #form-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 40px;
        width: 800px;
        max-width: 800px;
        margin: auto;
        display: flex;
        flex-direction: column;
        gap: 25px;
        font-family: 'Roboto', sans-serif;
        border: 1px solid black;
    }

    .section-header {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2b2b2b;
        margin-bottom: 15px;
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }

    .product-info,
    .plan-hr {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .product-info label {
        color: #333;
        font-weight: 600;
        font-size: 0.85rem;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"] {
        padding: 10px 15px;
        font-size: 0.9rem;
        color: #333;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background-color: #f8f9fa;
        transition: border-color 0.2s;
    }

    input[type="text"]:focus,
    input[type="date"]:focus,
    input[type="number"]:focus {
        border-color: #007bff;
        outline: none;
        background-color: #fff;
    }

    .plan-hr input {
        padding: 10px;
        font-size: 0.85rem;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        text-align: center;
        background-color: #f8f9fa;
        color: #333;
    }

    .submit-btn-container {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .submit-btn-container button {
        padding: 12px 25px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;

    }

    .submit-btn-container button:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 10px rgba(0, 91, 187, 0.2);
    }

    .btns-form-container {
        height: 60px;
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .btns-form button {
        padding: 12px 25px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        margin-bottom: 10px;
    }

    #input-data {

        border-radius: 15px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        height: 1100px;

    }

    .upload-swp-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 400px;
        margin: 20px auto;
    }

    .upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        justify-content: center;
    }

    .upload-label {
        display: inline-block;
        padding: 12px 20px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #007bff;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
        text-align: center;
    }

    .upload-label:hover {
        background-color: #0056b3;
    }

    .file-input {
        display: none;
        /* Hide the default file input */
    }

    .upload-label i {
        margin-right: 8px;
    }

    .submit-button {
        padding: 10px 20px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #28a745;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }

    .submit-button:hover {
        background-color: #218838;
    }

    #form-pic-container,
    #form-swp-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        background-color: #f8f9fa;
        width: 800px;
        max-width: 800px;
        display: none;
    }

    #editForm {
        display: none;
        flex-direction: column;
        padding: 40px;
        background-color: #f8f9fa;
        width: 800px;
        max-width: 800px;
        gap: 10px;

    }

    .upload-pic-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 150px;

    }

    .upload-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .upload-label {
        display: inline-block;
        padding: 12px 20px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #007bff;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
        text-align: center;
    }

    .upload-label:hover {
        background-color: #0056b3;
    }

    .upload-label i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    .file-input {
        display: none;
        /* Hide the default file input */
    }

    .text-input {
        width: 100%;
        padding: 10px 15px;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }

    .text-input:focus {
        border-color: #80bdff;
        outline: none;
    }

    .submit-button {
        padding: 10px 20px;
        font-size: 1rem;
        color: #ffffff;
        background-color: #28a745;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: 600;
        width: 100%;
    }

    .submit-button:hover {
        background-color: #218838;
    }

    #input-data {
        display: none;

    }

    .cert-input {
        min-width: 400px;
        padding: 4px 5px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 10px;

    }

    .input-checkbox {
        padding: 10px;

    }

    .input-checkbox span {
        margin-left: 0.4rem;
    }

    .upload-label-pic {
        border-bottom: 1px solid blue;
        box-shadow: #555;
    }

    .update-container,
    .DeleteContainer {
        position: absolute;
        top: 50%;
        left: 70%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        min-width: 400px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        display: none;
    }


    .exit-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ff4757;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .exit-btn:hover {
        background: #ff3742;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group input,
    .input-delete input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .checkbox-container {
        margin-bottom: 20px;
    }

    .checkbox-input {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .checkbox-input input {
        margin-right: 10px;
    }

    .date-input {
        margin-bottom: 15px;
    }

    .date-input label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .date-input input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .submit-update-btn {
        text-align: center;
        margin-top: 20px;
    }

    .submit-update-btn button,
    .delete-btn-submit button {
        background: #2ed573;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .delete-btn-submit {
        margin-top: 5px;
        display: flex;
        justify-content: center;
    }

    .submit-update-btn button:hover {
        background: #26d467;
    }

    .updateBtn button {
        padding: 12px 25px;
        background-color: blue;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
    }

    .deleteBtn button {
        padding: 12px 25px;
        background-color: red;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-container {
        display: flex;
        flex-direction: row;
        gap: 10px;
        margin-top: 10px;
        justify-content: flex-end;
    }

    .upper-table-operator {
        display: flex;
        flex-direction: column;
        margin-top: 20px;

    }

    .title-delete-form {
        margin-bottom: 5px;
    }
    #plan-table-container{
        display: none;
    }
    #plan-table-container table {
        width: 200%;
        border-collapse: collapse;
        padding: 10px;
    }

    #plan-table-container table thead th {
        padding: 7px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        width: 100px;
        min-height: 800px;
        font-size: 12.5px;

    }

    .header-table-data {
        display: flex;
        flex-direction: row;
        gap: 25px;
        padding: 10px 15px;
        align-items: center;
    }

    .editbtn-table,
    .deletebtn-table {
        padding: 5px 3px;
        border: none;
        cursor: pointer;
        color: #cfdef3;
        font-size: 15px;
        border-radius: 7px;
        width: 100px;
        height: 40px;
    }

    .editbtn-table {
        background-color: #0056b3;
        margin-bottom: 3px;
    }

    .deletebtn-table {
        background-color: crimson;
    }

    .editbtn-table:hover {
        background-color: darkblue;
    }

    .deletebtn-table:hover {
        background-color: darkred;
    }

    .info-prod-edit {
        display: flex;
        flex-direction: column;
        gap: 10px;

    }

    .edit-field-input {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 10px;
    }

    .table-plan-edit-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    select {
        padding: 10px 15px;
        font-size: 17px;
        border-radius: 5px;
        border: none;

    }

    .edit-field-input select {
        background-color: #0056b3;
    }

    .edit-field-input select option {
        background-color: #ffffff;
    }

    .header-edit-form span {
        font-weight: 700;
        font-size: 21px;
        border-left: 4px solid #007bff;
        padding-left: 10px;
        margin-bottom: 30px;
    }

    select option {
        background-color: white;
        color: black;
    }

    .SubmitEditForm {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .SubmitEditForm button {
        padding: 15px;
        font-size: 20px;
        background-color: rgb(24, 105, 192);
        border: none;
        border-radius: 10px;
        color: white;
    }

    .SubmitEditForm button:hover {
        background-color: darkblue;
    }
    #tableData td, #tableData th{
         border-right: 1px solid #ddd;
         text-align: center;
    }
</style>

<body>
    <div class="update-container" id="update-container">
        <button class="exit-btn" onclick="exitForm()">&times;</button>
        <div>
            <h1>
                Update Operator Cert
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

    <div class="DeleteContainer" id="DeleteContainer">
        <div class="title-delete-form">
            <h2>Delete Form</h2> <button class="exit-btn" onclick="exitDeleteForm()">&times;</button>
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
    <div class="container-data">
        <div class="side-nav">
            <button>Dashboard</button>
            <button>Data Entry</button>
            <button>C4 DOM</button>
            <button>C9-1 DOM</button>
            <button>C9 DOM</button>
            <button>C7 DOM</button>
        </div>
        <div class="data-side">
            <div id="dashboard">
                <div class="title-dashboard">
                    <span>Dashboard C4</span>
                    <div style="display: flex; flex-direction:row; gap:4px; align-items:center;">

                        <img width="35" height="25" src="nichivi_logo.jpg" alt="logo">
                        <span style="font-size: 16px;">NICHIVI PHILS., CORP.</span>
                    </div>
                </div>
                <div class="graph-data-container">
                    <div class="graph-header">Production vs. Downtime</div>
                    <div class="dropdown-container">
                        <select class="dropdown" id="data-selector" onchange="updateChartData()">
                            <option value="monthly">Monthly Data</option>
                            <option value="yearly">Yearly Data</option>
                        </select>
                    </div>
                    <canvas id="graph-data" width="800" height="400"></canvas>
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

            <div id="input-data">
                <div class="title-dashboard">
                    <span>Data Entry </span>
                    <div style="display: flex; flex-direction:row; gap:4px; align-items:center;">
                        <img width="35" height="25" src="nichivi_logo.jpg" alt="logo">
                        <span style="font-size: 16px;">NICHIVI PHILS., CORP.</span>
                    </div>
                </div>
                <div class="btns-form-container">
                    <div class="btns-form">
                        <button onclick="showPlandata()" style='font-size:15px'>Upload Plan/Hr <i class='fas fa-file-upload'></i></button>
                    </div>
                    <div class="btns-form">
                        <button onclick="showSwp()" style='font-size:15px'>Upload SWP <i class='fas fa-file-upload'></i></button>
                    </div>
                    <div class="btns-form">
                        <button onclick="showPic()" style='font-size:15px'>Upload PIC <i class='fas fa-file-upload'></i></button>
                    </div>
                    <div class="btns-form">
                        <button onclick="showTablePlan()" style='font-size:15px;'>Table Plan <i class='fas fa-file-upload'></i></button>
                    </div>
                </div>
                <div id="form-container">
                    <form action="formhandler.inc.php" method="post">
                        <div class="section-header">Product Information</div>
                        <div class="product-info">
                            <label>Plan ID.</label>
                            <input type="text" name="id" placeholder="Enter plan ID">
                            <label>Part no.</label>
                            <input type="text" name="part_no" placeholder="Enter part number">
                            <label>Model</label>
                            <input type="text" name="model" placeholder="Enter model name">
                            <label>Line</label>
                            <input type="text" name="line" placeholder="Enter line name">
                            <label>Delivery Date</label>
                            <input type="date" name="del_date">
                            <label>Balance</label>
                            <input type="number" name="balance" placeholder="Enter balance">
                            <label>Manpower</label>
                            <input type="number" name="man_power" placeholder="Enter manpower count">
                            <label>Ct. as of</label>
                            <input type="date" name="ct_as_of">
                            <label>Exp. Date</label>
                            <input type="date" name="exp_date">
                            <label>Production Hours</label>
                            <input type="text" name="prod_hrs" placeholder="Enter Production Hours">
                        </div>

                        <div class="section-header">Production Hours</div>
                        <div class="plan-hr">
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

                        <div class="submit-btn-container">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>

                <div id="form-swp-container">
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
                                <input type="submit" value="Upload File" class="submit-button">
                            </div>
                        </form>

                    </div>
                </div>

                <div id="form-pic-container">
                    <div class="upload-pic-container">
                        <form action="inserSigna.php" method="POST" enctype="multipart/form-data">
                            <div class="upload-section">
                                <label for="upload-file" class="upload-label-pic">
                                    Upload PIC Picture
                                </label>
                                <input type="file" name="picture" required>
                                <input type="text" name="ope-pic" placeholder="Enter Operator Name" required>
                                <input type="submit" value="Upload" class="submit-button">
                            </div>

                        </form>
                    </div>

                    <div class="table-person-container">
                        <div class="upper-table-operator">
                            <div>
                                <h2>List of Operator</h2>
                            </div>
                            <div class="btn-container">
                                <div class="updateBtn">
                                    <button onclick="ShowUpdateForm()">
                                        Update
                                    </button>
                                </div>
                                <div class="deleteBtn">
                                    <button onclick="ShowDeleteForm()">
                                        Delete
                                    </button>
                                </div>
                            </div>

                        </div>
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

                </div>

                <!--Table-->
                <div id="plan-table-container">
                    <div class="header-table-data">
                        <h2>Table Plan</h2>
                    </div>
                    <div>
                        <table id="tableData">
                            <thead>
                                <tr>
                                    <th>Plan No.</th>
                                    <th>Part No.</th>
                                    <th>Model</th>
                                    <th>Line</th>
                                    <th>Del.Date</th>
                                    <th>Ct.As.Of</th>
                                    <th>Exp.Date</th>
                                    <th>Manpower</th>
                                    <th>Prod.Hours</th>
                                    <th>6am-7am</th>
                                    <th>7am-8am</th>
                                    <th>8am-9am</th>
                                    <th>9am-10am</th>
                                    <th>10am-11am</th>
                                    <th>11am-12nn</th>
                                    <th>12nn-1pm</th>
                                    <th>1pm-2pm</th>
                                    <th>2pm-3pm</th>
                                    <th>3pm-4pm</th>
                                    <th>4pm-5pm</th>
                                    <th>5pm-6pm</th>
                                    <th>6pm-7pm</th>
                                    <th>7pm-8pm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-data-plan"></tbody>
                        </table>
                        <form id="editForm">
                            <div class="info-prod-edit">
                                <div class="header-edit-form">
                                    <span>Edit Table Form</span>
                                </div>
                                <div class="edit-field-input">
                                    <label for="">Plan number</label>
                                    <input type="text" id="planId" placeholder="Enter Plan number" readonly>

                                    <div class="edit-field-input">
                                        <label for="">Part Number</label>
                                        <input type="text" id="partno" name ="part_no" placeholder="Enter Part number">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Model</label>
                                        <input type="text" id="model" name="model"  placeholder="Enter Model">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Line</label>
                                        <input type="text" id="line" name="line"  placeholder="Enter Line">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Delivery Date</label>
                                        <input  type="text" id="delDate" name="delDate">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Manpower</label>
                                        <input type="text" id="manpower" name="manpower" placeholder="Enter Number Manpower">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">CT.AS.OF</label>
                                        <input type="text" id="ctasof" name="ctasof">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Exp.Date</label>
                                        <input type="text" id="expdate" name="expdate">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">Production Hours</label>
                                        <input type="text" id="prodhrs" name="prodhrs" placeholder="Enter Production Hours">
                                    </div>
                                </div>

                                <div class="table-plan-edit-form">
                                    <div class="edit-field-input">
                                        <label for="">6am-7am</label>
                                        <input type="number" id="plan1" name="plan1" placeholder="6am-7am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">7am-8am</label>
                                        <input type="number" id="plan2" name="plan2" placeholder="7am-8am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">8am-9am</label>
                                        <input type="number" id="plan3" name="plan3" placeholder="8am-9am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">9am-10am</label>
                                        <input type="text" id="plan4" name="plan4" placeholder="9am-10am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">10am-11am</label>
                                        <input type="number" id="plan5" name="plan5" placeholder="10am-11am">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">11am-12nn</label>
                                        <input type="number" id="plan6" name="plan6" placeholder="11am-12nn">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">12nn-1pm</label>
                                        <input type="number" id="plan7" name="plan7" placeholder="12nn-1pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">1pm-2pm</label>
                                        <input type="number" id="plan8" name="plan8" placeholder="1pm-2pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">2pm-3pm</label>
                                        <input type="text" id="plan9" name="plan9" placeholder="2pm-3pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">3pm-4pm</label>
                                        <input type="number" id="plan10" name="plan10" placeholder="3pm-4pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">4pm-5pm</label>
                                        <input type="number" id="plan11" name="plan11" placeholder="4pm-5pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">5pm-6pm</label>
                                        <input type="number" id="plan12" name="plan12" placeholder="5pm-6pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">6pm-7pm</label>
                                        <input type="number" id="plan13" name="plan13" placeholder="6pm-7pm">
                                    </div>
                                    <div class="edit-field-input">
                                        <label for="">7pm-8pm</label>
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

    </div>
    </div>

    <script>
        const ctx = document.getElementById('graph-data').getContext('2d');

        let chartData = {
            monthly: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                        label: 'Production',
                        data: [120, 150, 100, 180, 130],
                        backgroundColor: 'green'
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
        document.querySelector('.side-nav button:nth-child(1)').addEventListener('click', function() {
            document.getElementById('dashboard').style.display = 'block';
            document.getElementById('input-data').style.display = 'none';
        });

        document.querySelector('.side-nav button:nth-child(2)').addEventListener('click', function() {
            document.getElementById('dashboard').style.display = 'none';
            document.getElementById('input-data').style.display = 'block';
        });

        document.querySelector('.side-nav button:nth-child(3)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.199/planner.php";
        });
        document.querySelector('.side-nav button:nth-child(4)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.125/planner.php";
        });
        document.querySelector('.side-nav button:nth-child(5)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.136/planner.php";
        });
        document.querySelector('.side-nav button:nth-child(6)').addEventListener('click', function() {
            window.location.href = "http://10.0.0.193/planner.php";
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
        }
    </script>
    <script>
        async function loadImages() {
            try {
                const response = await fetch('server_display.php');
                const images = await response.json();

                const tableBody = document.querySelector('#imagesTable tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                images.forEach(image => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${image.date}</td>
                        <td><img  style ="width:100px; height:30px;"src="data:image/png;base64,${image.image_data}" alt="Captured Image"/></td>
                        <td><button  style= " padding: 12px 25px; background-color: #007bff; color: #ffffff; border: none; border-radius: 6px; font-size: 0.8rem; font-weight: 700; cursor: pointer;"onclick="convertToPDF('${image.image_data}')">Download Data</button></td>
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
                    body: new URLSearchParams({
                        action: 'read'
                    })
                })
                .then(res => res.json())
                .then(data => {
                    let rows = '';
                    data.forEach(row => {
                        rows += `<tr>
                <td>${row.id}</td>
                <td>${row.part_no}</td>
                <td>${row.model}</td>
                <td>${row.line}</td>
                <td>${row.del_date}</td>
                <td>${row.ct_as_of}</td>
                <td>${row.exp_date}</td>
                <td>${row.man_power}</td>
                <td>${row.prod_hrs}</td>
                <td>${row.plan_1}</td>
                <td>${row.plan_2}</td>
                <td>${row.plan_3}</td>
                <td>${row.plan_4}</td>
                <td>${row.plan_5}</td>
                <td>${row.plan_6}</td>
                <td>${row.plan_7}</td>
                <td>${row.plan_8}</td>
                <td>${row.plan_9}</td>
                <td>${row.plan_10}</td>
                <td>${row.plan_11}</td>
                <td>${row.plan_12}</td>
                <td>${row.plan_13}</td>
                <td>${row.plan_14}</td>
                <td>
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
                   '${row.plan_14}',)">Edit</button>

                   
                    <button class="deletebtn-table" onclick="deletePlan(${row.id})">Delete</button>
                </td>
            </tr>`;
                    });
                    document.getElementById('table-data-plan').innerHTML = rows;
                });
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
            document.getElementById('planId').value = id;
            document.getElementById('partno').value = part_no;
            document.getElementById('model').value = model;
            document.getElementById('line').value = line;
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

            document.getElementById('update-container').style.display = "none";
        }

        function deleteOperator() {
            const num = document.getElementById('num-operator').value;

            const formData = {
                person_delete: num
            };
            sendNumDelete(formData)

            document.getElementById('DeleteContainer').style.display = "none";
        }

        function edit() {
            document.getElementById("update-container").style.display = "block";
        }

        function exitForm() {
            if (confirm('Are you sure you want to exit?')) {
                // You can hide the form, redirect, or close the modal
                document.querySelector('.update-container').style.display = 'none';
            }

        }

        function exitDeleteForm() {

            document.getElementById('DeleteContainer').style.display = "none";
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
            document.getElementById('update-container').style.display = "block"

        }

        function ShowDeleteForm() {

            document.getElementById('DeleteContainer').style.display = "block";
        }
        document.addEventListener('DOMContentLoaded', (event) => {

            loadImages();
            loadPerson()


        })
    </script>
</body>

</html>