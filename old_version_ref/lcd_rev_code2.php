

<?php 
include_once("connection_db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production and Downtime Monitoring</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Global styles */
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body, html {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            margin: 0;
            padding:0;
           
        }

        /* Header styling */
        .header {
            background: linear-gradient(to right, #ffffff, #e6e6e6);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #d3d3d3;
            margin-top: 15px;
        }


        .logo {
            display: flex;
            align-items: center;
            padding: 5px 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .logo img {
            width: 50px;
            margin-right: 10px;
        }

        .logo span {
            font-size: 18px;
            font-weight: 600;
            color: #4a90e2;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .title {
            text-align: center;
            flex: 1;
            
        }

        .title h1 {
            font-size: 24px;
            font-weight: 700;
            color:  #4a90e2;
            margin: 0;
        }

        .title p {
            font-size: 16px;
            color: #666;
            margin: 0;
        }

        .status {
            display: flex;
            align-items: center;
            margin-right: 30px;
        }

        .status-text {
            margin-right: 8px;
            font-weight: 500;
        }

        .status-circle {
            width: 15px;
            height: 15px;
            background-color: green;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 10px rgba(144, 238, 144, 0.3);
            }
            50% {
                transform: scale(1.1);
                box-shadow: 0 0 20px rgba(144, 238, 144, 0.5);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 10px rgba(144, 238, 144, 0.3);
            }
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        .btn, .timer-btn >button {
            padding: 8px 15px;
            background-color: #3664FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            font-weight: 700;
            width: 100px;
            height: 50px;
            font-size: 13px;
        }
        

        .btn:hover {
            background-color: #357ab8;
            transform: scale(1.05);
        }

        /* Product details styling */
        .product-div {
            display: grid;
            grid-template-rows: 50% 50%;
border-top-left-radius: 11px;
            padding: 20px;
            gap: 15px;
        }

        .up_details, .downt_details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .details-container {
            display: flex;
            align-items: center;
            background: #ffffff;
            padding: 8px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .details-container span {
            font-weight: 700;
            color: #333;
            margin-right: 5px;
        }

        .details {
            font-size: 16px;
            color: #555;
        }
        /* Container for dropdown to ensure proper alignment */
        .dropdown-container {
            position: relative;
            display: inline-block;
            width: 398px; /* Set your desired width */
        }

        /* Dropdown styling */
        select {
            padding: 2px 6px;
            width: 100%;
            border: none;
            border-radius: 8px;
            background-color: #ffffff;
            color: #333;
            appearance: none; /* Removes the default browser dropdown arrow */
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            transition: background-color 0.3s, box-shadow 0.3s;
            outline: none; /* Remove the default focus outline */
            border: 2px solid black;
        }

        /* Custom arrow for the dropdown */
        .dropdown-container::after {
            content: '▾';
            font-size: 14px;
            color: #333;
            position: absolute;
            right: 16px; /* Position to align the arrow */
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none; /* Ensure the arrow does not interfere with clicking */
	        }

        /* Hover effect for the dropdown */
        select:hover {
            background-color: #f7f9fc; /* Light background on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* More pronounced shadow on hover */
        }

        /* Focused state for the dropdown */
        select:focus {
            background-color: #e6f0ff; /* Light blue shade for focus state */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow for focus */
            border: none;
        }

        #data_container {
            display: flex;
   	    flex-direction: row; /* Aligns children in a row */
            justify-content: space-between; /* Space between tables */
             gap: 20px; /* Space between tables */
	    margin: 20px; /* Margin around the container */
   	    background-color: #ffffff;
            width: 100%; /* Use relative width for responsiveness */
            max-width: 1500px; /* Max width to maintain layout */
            height: 580px;
            border-radius: 12px;
            border: 2px solid black;
    
        }

        #output_container, #downtime_container {
            flex: 1; /* Allows tables to grow equally */
            min-width: 300px; /* Minimum width for responsiveness */
            background-color: #ffffff; /* Background for better contrast */
            border-radius: 8px; /* Rounded corners for aesthetics */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            overflow-y: scroll;
	   
        }



        table {
            width: 100%; /* Ensures table takes the full width of the container */
            border-collapse: collapse; /* No space between borders */
        }
        #downtime_container th,td{
            padding: 4px;
            text-align: left; /* Aligns text to the left */
            border-bottom: 1px solid #ddd; /* Adds a bottom border to rows */
        }
        #downtime_container{
            display: none;
        }
        #output_container th, td {
            padding: 7px;
            text-align: left; /* Aligns text to the left */
            border-bottom: 1px solid #ddd; /* Adds a bottom border to rows */
        }

        th {
            background-color: #f7f9fc; /* Light background for headers */
            font-weight: 700; /* Bold headers */
            color: #333; /* Dark text for headers */
        }

        tbody tr:hover {
            background-color: #f1f1f1; /* Highlight row on hover */
        }
        .production_title, #downtime_title{
             color:#4a90e2;
             font-size: 18px;
        }
        .left-div{
            display:grid;
            grid-template-columns:75% 25%;
        }
        .main-content-container{
            display: flex;
            flex-direction: column;
            
        }
        .right-div{
	    margin-left:30px;
            display: flex;
            flex-direction: column;
         
        }
        .person-details{
            width: 450px; height: 220px;
            background-color: #ffffff;
            margin: 20px 20px 5px 20px;
            border-radius: 12px;
            border: 2px solid black;
	   
        }
        .persons-container{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap:5px;
            
        }
        .person{
            width: 130px; height: 130px;
            border: 1px solid black;
            margin: 10px 5px 5px 5px;
	    
            border-radius: 12px;
        }
        .name-person-container{
            display:flex;
            flex-direction: row;
            width: 400px; height: 40px;
            gap: 5px;
            margin-top: 2px;
            border-radius: 12px;
        }

        .name-person-container select{
            margin: 5px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
	    width:120px;
        }
        
  

	.person-incharge-title{
  	   display:flex;
	   flex-direction:row;
	   gap:7px;
	   background-color: #3664FF;
           color: white;
           justify-content:flex-start;
	   border-top-left-radius: 11px;
	   border-top-right-radius: 11px;


	}
/*
        .person-incharge-title{
            font-size: 20px; font-weight: 600;
            margin-top: 5px;
            
        }
        .person-incharge-title{
            background-color: #3664FF;
            color: white;
            text-align: center;
        }
*/
        .picture-product{
            display: flex;
            flex-direction: column;
            width: 200px;
            gap: 15px;
        
        }

       
                /* Product info container styling */
        .product-info {
            display: flex;
            background-color: #ffffff; /* White background for contrast */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            padding: 15px; /* Internal padding for spacing */
            gap: 10px; /* Space between image and text */
            width: 450px; /* Adjust the width for responsiveness */
            margin: 5px 20px 10px 20px; /* Center the container horizontally */
            flex-direction: row;
            border:2px solid black;
        }

        /* Styling the product image */
        .picture-product img {
            border-radius: 10px; /* Rounded corners for the image */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow around the image */
            display: flex;
            justify-content: center;
            margin-left: 10px;
            border:2px solid black;
        }

        /* Container for product details */
        .product-info-container {
            display: flex;
             /* Allows items to wrap if there's not enough space */
            gap: 8px; /* Space between detail items */
            flex-direction: column;
        
            
        }

        /* Dropdown styling */
        .product-info-container select {
            padding: 10px;
            border-radius: 8px;
            background-color: #f7f9fc;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            width: 100%;
            
            
        }

        .product-info-container select:focus {
            background-color: #e6f0ff; /* Highlight on focus */
            outline: none; /* Removes default outline */
        }

        /* Individual category styling */
        .category {
            display: flex;
            align-items: center;
            background-color: #f0f2f5; /* Light grey background for modern look */
            padding: 5px 7px;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Light shadow */
            font-weight: 900;
            font-size: 14px;
            color: #333;
            width: 185px;
            border:2px solid black;
        }

        /* Style the text inside each category */
        .category p {
            margin-left: 8px; /* Space between label and value */
            font-weight: 700; /* Make the value bold */
            color: #000;
        }
        .bottom-div{
            margin:0px 10px 20px 20px;
            display: flex;
	    flex-direction:row;
	    
        }
        .graph-container {
            background-color: #ffffff;
            height: 425px;
            width: auto;
            margin-right: 7px;
            border-radius: 12px;
            display: grid;
            grid-template-columns: 50% 50%;
            border: 2px solid black; 
	    width:1220px;
        }

        .downtime-timer{
            background-color: #ffffff;
            width: 450px;
            height: 420px;
            border-radius:12px;
            margin: 5px 0px 10px 15px; 
            border: 2px solid black;
            

        }
        .time-content{
            background-color: lightgray;
            color:black;
            width:300px; height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            font-size: 40px;
        }
        .timer-title{
            background-color: #3664FF; /* Blue background for the title */
            color: white;
            text-align: center;
            font-size: 18px; /* Slightly larger font for the title */
            padding: 10px 0; /* Padding for better spacing */
            font-weight: bold;
            border-top-right-radius:12px ;
            border-top-left-radius:12px ;
        }
            /* Summary container styling */
        .summary-container {
            background-color: #ffffff; /* White background for a clean look */
            width: 280px; 
            height: 427px; /* Allow height to adjust based on content */
            border-radius: 12px; /* Rounded corners for a modern feel */
            margin-left:4px;
	    margin-right:30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            overflow: hidden; /* Ensures content stays within rounded corners */
            border: 2px solid black;
        }

        /* Title styling */
        .title-summary {
            background-color: #3664FF; /* Blue background for the title */
            color: white;
            text-align: center;
            font-size: 18px; /* Slightly larger font for the title */
            padding: 10px 0; /* Padding for better spacing */
            font-weight: bold;
        }

        /* Data item styling */
        .sum-data {
            padding: 15px; /* Padding around data items for neat spacing */
        }

        .sum-cate {
            display: flex; /* Align label and value in a row */
            justify-content: space-between; /* Space items to the edges */
            align-items: center; /* Vertically center items */
            border-bottom: 1px solid #e0e0e0; /* Light grey border for separation */
            padding: 8px 0; /* Spacing between each row */
            font-size: 14px; /* Adjusted font size for readability */
            font-weight: 500;
            color: #333; /* Dark grey color for text */
        }

        .sum-cate:last-child {
            border-bottom: none; /* Remove border for the last item */
        }

        /* Value styling */
        .sum-cate p {
            margin: 0; /* Remove default margin for clean alignment */
            font-weight: 700; /* Bold font for values */
            color: #000; /* Black color for emphasis */
        }

        
        .savebtn{
                    padding: 2px 3px;
                    background-color: #3664FF;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s, transform 0.2s;
                    font-weight: 700;
                    width: 100px;
                    height: 30px;
                    font-size: 13px;
                    margin-left:30%; margin-top:5px;
                    
        }
        .savebtn>button{
            text-align: center;
        }
        .time-ss{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap:20px;
            margin-top: 100px;
        }
        #downtime_title, th[colspan="11"] {
            font-size: 18px;
            background-color: #3664FF;
            color: white;
	   
        }
  


        .production-graph{
        
            border-right: 1px solid darkgray;
        }
        .prod-title-graph{
            background-color: #3664FF;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            border-top-left-radius:12px ;
            
        }
        .down-title-graph{
            border-top-right-radius: 12px;
            background-color: #3664FF;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }
/* CSS */
.button-81 {
  background-color: #fff;
  border: 0 solid #e2e8f0;
  border-radius: 1.5rem;
  box-sizing: border-box;
  color: #0d172a;
  cursor: pointer;
  display: inline-block;
  font-family: "Basier circle",-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: 2.1rem;
  font-weight: 600;
  line-height: 1;
  padding: 1rem 1.6rem;
  text-align: center;
  text-decoration: none #0d172a solid;
  text-decoration-thickness: auto;
  transition: all .1s cubic-bezier(.4, 0, .2, 1);
  box-shadow: 0px 1px 2px rgba(166, 175, 195, 0.25);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  margin-left: 5px ;
}

.button-81:hover {
  background-color: #1e293b;
  color: #fff;
}

@media (min-width: 768px) {
  .button-81 {
    font-size: 1.125rem;
    padding: 1rem 2rem;
  }
}
.product-info-title{
	background-color:#3664FF;
	font-size:15px;
	padding:5px;
        color:white;
        border-radius:5px;
        font-weight:700;
    }
.con_timer,.ng-container{
  position:absolute;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 500px;
  height: 700px;
  padding: 0;
  display: none;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

}
  /* Form Container Styles */
  #con_time, .ng-container {
    max-width: 500px;
    margin: 20px auto;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }

  /* Title Styles */
  .title_form_downtime_timer h1 {
    font-family: 'Arial', sans-serif;
    color: #333;
    font-size: 1.5em;
    text-align: center;
    margin-bottom: 15px;
  }

  /* Label and Input Container */
  .form-top-margin,.ng-dis {
    display: flex;
    flex-direction: column;
    margin: 10px 0;
  }

  label {
    font-family: 'Arial', sans-serif;
    font-size: 0.9em;
    color: #555;
    margin-bottom: 5px;
  }

  .select_drop,
  input[type="text"],
  input[type="number"] {
    font-family: 'Arial', sans-serif;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border 0.3s ease;
    background-color: #fff;
  }

  .select_drop:focus,
  input[type="text"]:focus,
  input[type="number"]:focus {
    border: 1px solid #3664FF;
    outline: none;
    box-shadow: 0 0 5px rgba(54, 100, 255, 0.5);
  }

  /* Button Styles */
  .btn_sub_downtime button,.btn_ng button {
    width: 100%;
    padding: 12px;
    background-color: #3664FF;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-family: 'Arial', sans-serif;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn_sub_downtime button:hover {
    background-color: #2a50c9;
  }
  .btn_ng button:hover{
    background-color: #2a50c9;

  }

  /* Error Message Style */
  #error_msg {
    color: red;
    font-size: 0.8em;
    text-align: center;
    margin-top: 10px;
  }

 #stopBtn,#cancelBtn{
	display:none;
	}

/* General Container Styling */
.history_main_con {
    background-color: #f0f4f8; /* Light background for contrast */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
    display:none;
}

/* Header Styling */
.his-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #3664FF; /* Consistent brand color */
    border-radius: 10px 10px 0 0;
    color: white;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}
   
                
.his-header h1 {
    margin: 0;
    font-size: 1.5em;
}

/* Button Styling */
.back_button {
    background-color: #ffffff;
    color: #3664FF;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s, color 0.3s;
}

.back_button:hover {
    background-color: #3664FF;
    color: white;
}

/* Left and Right Sections */
.content_data {
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

/* Graph Section Styling */
.left_his {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.his_prod_graph, .his_down_graph {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width:600px;
   
}

.his_prod_graph h2, .his_down_graph h2 {
    margin: 0;
    color: #333;
    font-size: 1.2em;
}

/* Table Styling */
.right_his {
    flex: 2;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    overflow: scroll;
}

#dataTable {
    width: 100%;
    border-collapse: collapse;
}

#dataTable thead tr {
    background-color: #3664FF;
    color: #ffffff;
}

#dataTable th, #dataTable td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

#dataTable tbody tr:hover {
    background-color: #f1f1f1; /* Hover effect for rows */
}

/* Responsive Design */
@media (max-width: 600px) {
    .content_data {
        flex-direction: column;
    }

    .back_button {
        width: 100%;
        margin-bottom: 10px;
    }
}

        /* Center the video player, title, and buttons */
        #video-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
                        
        }

        /* Stylish and modern style for the video title */
        .video-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Modern style for the video player */
        #myVideo {
            width: 100%;
            max-width: 1000px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
	    height:800px;
        }

        /* Modern style for the buttons */
        .control-button {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
            margin: 5px;
        }

        /* Hover and active effects for the buttons */
        .control-button:hover {
            background: linear-gradient(135deg, #0056b3, #004494);
            box-shadow: 0 12px 20px rgba(0, 123, 255, 0.4);
            transform: translateY(-3px);
        }

        .control-button:active {
            transform: translateY(2px);
            box-shadow: 0 6px 10px rgba(0, 123, 255, 0.2);
        }
               /* Container for the PDF viewer */
        .pdf-container {
           width: 100%;
   	   height: 90vh;
    	   background: #ffffff;
           border-radius: 10px;
           box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
           overflow: hidden;
           display: flex;
           flex-direction: row;
           justify-content: space-between;
	   gap:20px;
           align-items: center;
           text-align: center; /* Center text inside */


        }

        /* Header for the PDF viewer */
        .pdf-header {
            width: 100%;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tab navigation styling */
        .tab-container {
            display: flex;
            justify-content: center;
            background: #e0e0e0;
            padding: 10px 0;
        }

        .tab-button {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: bold;
        }
        .tab-button-back{
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 10px 20px;
            margin-top:-540px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: bold;
            margin-bottom:15px;
	    font-size:16px;
	    
        }
        .tab-button:hover {
            background: linear-gradient(135deg, #0056b3, #004494);
        }

        .tab-button.active {
            background: #004494;
        }

        /* Styling for the embedded PDF viewer */
        .pdf-viewer {
            width: 100%;
            height: 100%;
            border: none;
            display: none; /* Hide all PDF viewers initially */
        }

        .pdf-viewer.active {
            display: block; /* Show only the active PDF */
        }
	#container-main-pdf{
	         margin: 0;
	         padding:50px;
                 width: 100%;
                 height: 100%;
                 font-family: Arial, sans-serif;
                 background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
                 display: flex;
      		 justify-content:space-between
		
                

	}
	 #container-main-pdf,#video-container{
		 
	  	  display:none;
	}

	.container-btn-add{
		display:flex;
		flex-direction:column;
		position:absolute;
		background-color: #fff;
   	        border-radius: 10px;
   	        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
		width:300px; height:250px;
		align-items:center;
		gap:10px;
	        top: 50%;
                left: 50%;
                 transform: translate(-50%, -50%);
		
		
	}
	.title-btn-add{
		background-color:#3664FF;
		height:50px;
		color:#fff;
		font-size: 20px;
		text-align:center;
		border-top-left-radius:10px;
		border-top-right-radius:10px;	
		width:100%;
		font-weight:900;
		display:flex;
		align-items:center;
		justify-content:center;

	}	
	.container-ng,.container-balance,.container-exit{
		padding:5px;
		width:250px;
		
	
	}
	
	.container-ng button, .container-balance button, .container-exit button{
		border:none;
		font-size:18px;
		background-color:#3664FF;
		font-size:1rem;
		width:100%;
		height:40px;
		color:#fff;
		border-radius:10px;
		font-weight:700;
		

		}
	#id-btn-add{
		display:none;

		}

      .balance-container-form{
		background-color:#fff;
		box-shadow:0px 3px 6px rgba(0,0,0,0.1);
		width:500px;
		height:500px;
		border-radius:10px;
		display:flex;
		flex-direction:column;
		align-items:center;
		position:absolute;
		gap:15px;	
		top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

	}



   	.input-container-bal, input[type="number"],.btn-container-balance button{
		width:80%;
		height:90%;
	}
	.title-balance{
		width:500px;
		height:60px;
	 }	
	.input-container-bal,.btn-container-balance{
		width:500px;
		height:60px;
		margin-top:15px;
		display:flex;
		align-items:center;
		justify-content:center;
	
	}
	.title-balance span{
		background-color:#3664FF;
		color:#fff;
		font-size:23px;
		display:flex; 
		justify-content:center;
		border-top-left-radius:10px;
		border-top-right-radius:10px;
		font-weight:900;
		height:50px;
		align-items:center;

	}

	.input-balance-bal, input[type="number"]{
		font-size:18px;
		text-align:center;
		
		
	}

	.btn-container-balance button{
		background-color:#3664FF;
		font-size:18px;
		font-weight:800;
		padding:5px;
		color:#fff;
		border:none;
		border-radius:10px;

	}

	.num-key-container{
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 5px;
            max-width: 300px;
            margin-top: 12px;	
	    justify-content:center;
	    align-items:center;
	    padding:20px;
	    margin-left:95px;
	    
	}

	.num-key{
	    padding:25px;
            text-align: center;
            background-color: #ccc;
            border: 1px solid #888;
            border-radius: 5px;
            cursor: pointer;
	}

	.balance-container-form{
	   display:none;
	 
	}

	.btn-person-details{
           margin-bottom:3px;
	   width:50px;
	   height:20px;
	   border:none;
 	   background-color:#fff;
	   color:blue;
	   border-radius:5px;
	   margin-top:3px;
	}


	.person1,.person2{
	  display:flex;
	  flex-direction:row;
	  gap:5px;
	  width:400px; height:195px;

	}
	.cert-pic-name{
	  display:flex;
	  flex-direction:column;
	  gap:2px;

	}
	.process-cert-container{
          display:flex;
	  flex-direction:column;
	  gap:2px;
	  margin-top:5px;
	}

	.process-cert{
	  display:flex;
	  flex-direction:column;
	  gap:2.5px;
          text-align: justify;
          text-justify: inter-word;

	 
	}
	.process-cert>span{
  	  text-align: justify;
  	  text-justify: inter-word;
	  font-weight:900;
	  background-color:#3664FF;
	  color:#fff;
	  padding-left:4px;
	}

	.process-cert>p{
          text-align: justify;
          text-justify: inter-word;
	  font-size:14px;

	}

	.cert-fill-container{
          display: grid;
          grid-template-columns: repeat(3,1fr);
         
	}

	.cert-details{
	  display:flex;
	  flex-direction:row;
	  gap:5px;
	  align-items:center;
	  font-size:12px;
	  margin-left:4px;
	}

	.process-container{
	  display:flex;
	  flex-direction:row;
	  gap:5px;
	}

	.status-cert{
	  border:1px solid black;
	  width:15px; height:15px;
	  border-radius:50%;

	}
        .custom-dropdown {
            width: 140px;
            border: 1px solid black;
            padding: 5px;
            position: relative;
            cursor: pointer;
            margin-bottom: 5px;
	    margin-top:3px;
	    border-radius:5px;
        }

        .dropdown-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            background: #fff;
            z-index: 1000;
            max-height: 150px;
            overflow-y: auto;
        }

        .dropdown-options div {
            display: flex;
            align-items: center;
            padding: 5px;
            cursor: pointer;
        }

        .dropdown-options div:hover {
            background: #f0f0f0;
        }

        .dropdown-options img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .selected-data {
            margin-top: 5px;
            display: flex;
	    flex-direction:column;
            align-items: center;
            gap: 4px;
        }
	.selected-data>span{
	   font-weight:800;
	   font-size:15px;
	}

        .selected-data img {
            width: 119px;
            height: 132px;
            border-radius: 10px;
	    border:1px solid black;
        }

        .certification-status {
            display: flex;
            gap: 5px;
        }

        .certification {
            border-radius: 50%;
            background: red;
	    border:1px solid black;
            width:15px; height:15px;
         
        }

        .certification.achieved {
            background: green;
        }

        .show-status-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
       
	}

	.persons-container{
	   display:flex;
	   flex-direction:row;
	   gap:3px;
	   margin-left:2px;
	}
	.person-icon-name,.cert-date{
	  display:flex;	
	  flex-direction:row;
	  margin-top:2px;
	  margin-left:3px;
	  align-items:center;
	  border-radius:15px;
	  font-size:12px;
	  height:20px;
          align-items: center;
          background-color: #f0f2f5; /* Light grey background for modern look */
          padding: 1px 2px;
          border-radius: 8px; /* Rounded corners */
          box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Light shadow */
          font-weight: 900;
          color: #333;
          border:1px solid black;
	  width:115px;
	}
	
	.line-leader-container{
	  display: flex;
	  flex-direction:column;
	  justify-content:center;
	  align-items:center;
	  width:400px; height:195px;
	}
	.custom-dropdown-leader{
           width: 240px;
           border: 1px solid black;
           padding: 2px;
	   text-align:center;
           position: relative;
           cursor: pointer;
           margin-top:2px;
           border-radius:5px;
           margin-bottom:1px;
	}
	.selected-data-leader{
	 display:flex;
	 flex-direction:column;
	 gap:4px;
	 align-items:center;
	}
	.dropdown-options-leader{
	    display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            background: #fff;
            z-index: 1000;
            max-height: 150px;
            overflow-y: auto;

	}
        .dropdown-options-leader div {
            display: flex;
            align-items: center;
            padding: 5px;
            cursor: pointer;
        }

        .dropdown-options-leader div:hover {
            background: #f0f0f0;
        }

        .dropdown-options-leader img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            border-radius: 50%;
        }
	.sub-pdf-container{
	  width:1000px;

	}

    </style>
</head>
<body>
<div id ="id-btn-add">
<div class ="container-btn-add">
   <div class ="title-btn-add">
	<span>Option Tab</span>
   </div>
   <div class ="container-ng">
       <button onclick ="showNG()">
	  Add NG
       </button>
   </div>
   <div class ="container-balance">
       <button onclick="show_balance()">
          C9 Line
       </button> 
   </div>

   <div class ="container-exit">
       <button onclick = "exit_container_btn()">
          Exit
       </button> 
   </div>
</div>
</div>
<div id = "balance-form-id">
  <div class ="balance-container-form" id ="bal-container">
      <form id = "balance-rem">
	 <div class = "title-balance">
	    <span>C9 Line Output</span>
         </dv>
	 <div class ="input-container-bal">
	    <input type="number" placeholder ="Enter C9 Line Output" id="input1"  onclick="setActiveInput('input1')"/>
	 </div>
         <div class ="btn-container-balance">
	    <button>Submit</button>
	 </div>
	 <div class ="num-key-container">
	      <div class = "num-key" onclick ="addToInput('1')">1</div>
	      <div class = "num-key" onclick ="addToInput('2')">2</div>
              <div class = "num-key" onclick ="addToInput('3')">3</div>
              <div class = "num-key" onclick ="addToInput('4')">4</div>
              <div class = "num-key" onclick ="addToInput('5')">5</div>
              <div class = "num-key" onclick ="addToInput('6')">6</div>
              <div class = "num-key" onclick ="addToInput('7')">7</div>
              <div class = "num-key" onclick ="addToInput('8')">8</div>
              <div class = "num-key" onclick ="addToInput('9')">9</div>
              <div class = "num-key" onclick ="addToInput('0')">0</div>
              <div class = "num-key" onclick ="deleteFromInput()"><i class='fas fa-arrow-left'></i></div> 
              <div class = "num-key" onclick ="clearInputs()">C</div> 		
	 </div>



      </form>
  </div>

</div>



 <div id ="container-main-pdf">
      <button onclick = "swpToMonitor()" class="tab-button-back"> Back to monitor</button>
    <div class="pdf-container">
      <div class = "sub-pdf-container">
	  <!-- Header with the title of the PDF viewer -->
        <div class="pdf-header">SWP Viewer1</div>
           <iframe src="fetch_pdf.php" width="100%" height="1000px"></iframe>

      </div>
      <div class = "sub-pdf-container" >
        <!-- Header with the title of the PDF viewer -->
        <div class="pdf-header">SWP Viewer2</div>
	   <iframe src="fetch_pdf.php" width="100%" height="1000px"></iframe>  
      </div>
         
            
    </div>
</div>    
   
        
   
      
    <div id="video-container">
        <div style="display:flex; justify-content:center; align-items:center; margin-top:15px;"> <button class="control-button" onclick = "videoToMonitor()">Back to monitor</button> </div>
        <!-- Dynamic video title with modern style -->
        <div class="video-title" id="videoTitle">Video Title 1</div>
         
        <!-- Video element -->
	<div style="display:flex; justify-content:center; align-items:center; height:700px; margin-top:70px;">
        <video id="myVideo" controls>
            <source src="path/to/your/video1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
	</div>

        <!-- Control buttons for the video -->
        <div style="display:flex; justify-content:center; align-items:center; margin-top:100px;">
            <button class="control-button" onclick="playVideo()">Play Video</button>
            <button class="control-button" onclick="nextVideo()">Next Video</button>
        </div>
    </div>


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


 <form id="downtime_data">
  <div id="con_time" class="con_timer">
 
    <div class="title_form_downtime_timer">
      <h1>Downtime Form</h1>
    </div>

    <div class="form-top-margin">
      <label>Time Occur:</label>
      <select name="time_occur" class="select_drop">
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
      <select id ="downtime_process" onchange="selectedProcess()" name="process" class="select_drop">
	<option>-</option>
          <?php
             $sql = "SELECT id,process_d FROM downtime_inputs";
             $resultset = mysqli_query($conn, $sql);
              while( $rows = mysqli_fetch_assoc($resultset) ) { 
             ?>
              <option value="<?php echo $rows["process_d"]; ?>"><?php echo $rows["process_d"]; ?></option>
             <?php } ?>
      </select>
    </div>

    <div class="form-top-margin">
      <label>Details:</label>
      <input type="text" id="details_form" name="detail" placeholder="Enter details"/>
      
    </div>

    <div class="form-top-margin">
      <label>Action:</label>
      <input id="action_form"  type="text"  name="action" placeholder= "Enter action"/>
    </div>

    <div class="form-top-margin">
      <label>Downtime:</label>
      <input id="timer_record" type="text" name="downtime" required placeholder="Downtime duration" />
    </div>

    <div class="form-top-margin">
      <label>PIC:</label>
      <select  name="pic" class="select_drop">
	<option>-</option>
        <option>Ronald.C</option>
        <option>Allan.A</option>
        <option>Antero.S</option>
        <option>Rodel</option>
        <option>Joy</option>
        <option>Samuel</option>
        <option>Connie</option>
        <option>Alma</option>
        <option>Vince</option>
        <option>Shan</option>
        <option>Marvin</option>
        <option>Jay</option>
        <option>Rolando</option>

      </select>
  

    </div>

    <div class="form-top-margin">
      <label>Remarks:</label>
       <select  name="remark" class="select_drop">
        <option>-</option>
        <option>OK</option>
        <option>For monitoring</option>
        <option>Not ok</option>


      </select>
 
    </div>

    <div class="btn_sub_downtime">
      <button type="submit" onclick="submit_Data_timer()">Submit Data</button>
    </div>
    <input style="display:none;" type="number" id="number_time" name="time_num">
  </div>
</form>
       

 <!--NG form -->     
       <form id = "ngform">

	   <div class="ng-container" id ="id_ng_container">
    <button onclick ="exit_ng_form()" style ="margin-left:90%;width:40px; height:40px; border-radius:50%; background-color:#3664FF;font-size:15px; padding:3px;border:none; color:white; "><i class="fa fa-times"></i></button> 
		<div style = "text-align:center">
		    <h2>NG FORM </h2>
		</div>
		
		<div class = "ng-dis">
		   <label>Time:<label>
		   <select  class = "select_drop" name = "time" id ="time_value" >
			<option value ="1" disabled>6am-7am</option>
			<option value ="2" disabled>7am-8am</option>
                        <option value ="3" disabled>8am-9am</option>
                        <option value ="4" disabled>9am-10am</option>
                        <option value ="5" disabled>10am-11am</option>
                        <option value ="6" disabled>11am-12nn</option>
			<option value ="7" disabled>12nn-1pm</option>
                        <option value ="8" disabled>1pm-2pm</option>
                        <option value ="9" disabled>2pm-3pm</option>
                        <option value ="10" disabled>3pm-4pm</option>
                        <option value ="11" disabled>4pm-5pm</option>
                        <option value ="12" disabled>5pm-6pm</option>
			<option value ="13" disabled>6pm-7pm</option>
			<option value ="14" disabled>7pm-8pm</option>
		   </select>
		</div>

		 <div class ="ng-dis">
                   <label>NG QTY:<label>
                   <select class = "select_drop" name = "ngqty"  id ="ng_qty">
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
			<option>-</option>
                        <option>slanted cut</option>
                        <option>short tube</option>
                        <option>long tube</option>
                        <option>No clamp</option>
                    </select>
                </div>
                <div class="ng-dis">
                    <label>NG TYPE:</label>
                    <select name="ngtype2" class="select_drop" id="ngtype_2">          
			<option>-</option>
                        <option>slanted cut</option>
                        <option>short tube</option>
                        <option>long tube</option>
                        <option>No clamp</option>
                    </select>
                </div>

                <div class="ng-dis">
                    <label>NG TYPE:</label>
                    <select name="ngtype3" class="select_drop" id="ngtype_3">
			<option>-</option>
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
<div id ="monitoring_data">
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <img src="nichivi_logo.jpg" alt="Company Logo">
            <span>NICHIVI PHILS., CORP.</span>
        </div>
        <div class="title">
            <h1>Production and Downtime Monitoring</h1>
            <p>生産および稼働停止の監視</p>
        </div>
        <div class="status">
            <span class="status-text">Line status:</span>
            <div class="status-circle" id ="status-id-circle"></div>
        </div>
        <div class="button-container">
            <button onclick = "history_table()"class="btn">History data</button>
            <button class="btn" onclick="swp()">SWP</button>
            <button class="btn" onclick="videos()">Guide video</button>
        </div>
    </div>
    <div class="main-content-container">
        <div class="left-div">
            
           <div id="data_container">
                <div id = "output_container">
                <table id ="actual_output_table">
                    <thead>
                    <tr>
                        <th colspan="11"> <span>PRODUCTION MONITORING</span> <button class="button-81" role="button" onclick ="showDown()">Downtime</button></th>
                        
                    </tr>
                    <tr>
                        <th colspan="5">PLAN</th>
                        <th colspan="3">ACTUAL</th>
                        <th> <button onclick ="show_ng_form()" style ="border:none; background-color:#3664FF; color:#fff; border-radius:5px; padding:5px; text-align:center;"> ADD</button> </th>
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
                    <tbody>
            
                    </tbody>
                </table>
            </div>
            <div id="downtime_container">
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
            </div>


            </div>
            <div class="right-div">

                <div class="person-details">
                    <div class="person-incharge-title">
                        <button style=" margin-top:3px;margin-left:5px;width:130px; height:20px; background-color:#fff;color:blue; font-size:14px; border:none;border-radius:5px;" onclick ="main_persons()">Person incharge</button>
			<button class = "btn-person-details" onclick = "displayOperator1()">P1</button>
			<button class = "btn-person-details" onclick = "displayOperator2()">P2</button>
                        <button class = "btn-person-details" onclick = "displayOperator3()">P3</button>
                        <button style="width:80px; margin-top:3px; height:20px; background-color:#fff; color:blue; font-size:14px; border:none; border-radius:5px;" onclick ="line_leader()">Line leader</button>
		
                    </div>
                    <div class="person-container" style ="display:none;"> 
                        <div class="person" id ="person_image">
			     <img id="displayedImage" src="" alt="Selected Image" style="display:none; width: 119px; height:128px; border-radius:10px;">
			</div>
                        <div class="person">
			     <img id="displayedImage2" src="" alt="Selected Image" style="display:none; width: 119px;height:128px; border-radius:10px;">
			</div>
                        <div class="person">
                             <img id="displayedImage3" src="" alt="Selected Image" style="display:none; width: 119px;height:128px; border-radius:10px;">
                        </div>

                    </div>
                    <div class="name-person-container" id ="name-person" style="display:none;">
                        <select name="" id="imageSelect">
                            <option value="">--Select--</option>
                        </select>
                        <select name="" id="imageSelect2">
                           <option value="">--Select--</option>
                        </select>
                        <select name="" id="imageSelect3">
                           <option value="">--Select--</option>
                        </select>
                    </div>


           <div id ="persons_img" class ="persons-container">
           <!-- Dropdown 1 -->
           <div class = "container-newdrop">
                 <div class="custom-dropdown" id="dropdown1">
                     --select--
                    <div class="dropdown-options"></div>
                </div>
                <div id="selected-data1" class="selected-data">
                  <img src="" alt="Selected Image" id="selected-image1" style="display: none; object-fit:cover; width: 119px; height:128px; ">
		  <span style= "text-align:center; font-weight:900;background-color: #3664FF; color:#fff; width:118px; border-radius:5px; margin-bottom:5px; font-size:15px;">Person 1</span>
                 </div>
           </div>


        <!-- Dropdown 2 -->
           <div class = "container-newdrop">
                 <div class="custom-dropdown" id="dropdown2">
                     --select--
                    <div class="dropdown-options"></div>
                </div>
                <div id="selected-data2" class="selected-data">
                  <img src="" alt="Selected Image" id="selected-image2" style="display: none; object-fit:cover; width: 119px; height:128px; ">
                  <span style= " text-align:center;  font-weight:900; background-color: #3664FF; color:#fff; width:118px; border-radius:5px; margin-bottom:5px; font-size:15px;"">Person 2</span>

                 </div>
           </div>

       

        <!-- Dropdown 3 -->
        	
           <div class = "container-newdrop">
                 <div class="custom-dropdown" id="dropdown3">
                     --select--
                    <div class="dropdown-options"></div>
                </div>
                <div id="selected-data3" class="selected-data">
 
                  <img src="" alt="Selected Image" id="selected-image3" style="display: none; object-fit:cover; width: 119px; height:128px;">
                  <span style= "text-align:center;  font-weight:900; background-color: #3664FF; color:#fff; width:118px; border-radius:5px; margin-bottom:5px; font-size:15px;"">Person 3</span>

                 </div>
 	   </div>
      
       </div>

		 <div class="person1" id ="operator1" style ="display:none;">
		     <div class ="cert-pic-name">
			<img id ="cert-img1" src ="" alt="" style="object-fit:cover; width: 119px;height:120px; margin-left:2px; margin-right:2px;margin-top:5px; border:1px solid black; border-radius:5px;">
			<div class = "person-icon-name">
			   <i class="material-icons" style= " font-size:10px;margin-left:2px; color: blue; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);">&#xe7fd;</i>
			   <p id = "person-cert-name1" style="margin-left:2px;font-weight:600;">
			</div>

                        <div class ="cert-date">
                            <i class='fas fa-hourglass-start' style =" font-size:10px;margin-left:4px; color: green; border:none;box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="curt-date-cert1" style="margin-left:2px;font-weight:600;">25-04-01</p>
                        </div>

                        <div class ="cert-date">
			    <i class='fas fa-hourglass-end'style ="font-size:10px;margin-left:4px; color: red; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="prev-date-cert1" style="margin-left:2px;font-weight:600;">24-10-01</>
			</div>

		     </div>
		    <div class ="process-cert-container">
		       <div class ="process-cert">
			<span>
		 	  Process:
			</span>
			<p>
			  Putting of pre-assembled tube/ Automatic insertion of L-joint/ Taping/ Installation of protector and inspection.
			</p>
		       </div>
                       <div style="font-weight:900;background-color:#3664FF; color:#fff; padding-left:4px;">Certification:</div>
		       <div class ="cert-fill-container">
                        <div class ="cert-details" id ="certification-status1">
			  <div id = "status-cert1-div1" class="certification"></div>
			  <span>Cutting</span>
                        </div>

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert2-div1"  class="certification"></div>
                          <span>Assembly</span>
			</div>	

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert3-div1" class ="certification"></div>
                          <span>Taping</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert4-div1" class="certification"></div>
                          <span>Installation pad</span>
			</div>
			
			<div class="cert-details"> 
			  <div id = "status-cert5-div1" class="certification"></div>
                          <span>Manual Seimitsu</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert6-div1" class="certification"></div>
                          <span>Retainer Putting</span>
			</div>
			
			<div class="cert-details">
                          <div id = "status-cert7-div1" class="certification"></div>
                          <span>Manual Valve check</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert8-div1" class="certification"></div>
                          <span>Final Inspection</span>
			</div>
		       </div>
		
		    </div>
		 </div>


<!-- person 2-->

		 <div class="person2" id ="operator2" style ="display:none;">
		     <div class ="cert-pic-name">
			<img id ="cert-img2" src ="" alt="" style="object-fit:cover; width: 119px;height:120px; margin-left:2px; margin-right:2px;margin-top:5px; border:1px solid black; border-radius:5px;">
			<div class = "person-icon-name">
			   <i class="material-icons" style= " font-size:10px;margin-left:2px; color: blue; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);">&#xe7fd;</i>
			   <p id = "person-cert-name2" style="margin-left:2px;font-weight:600;">
			</div>

                        <div class ="cert-date">
                            <i class='fas fa-hourglass-start' style =" font-size:10px;margin-left:4px; color: green; border:none;box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="curt-date-cert2" style="margin-left:2px;font-weight:600;">25-04-01</p>
                        </div>

                        <div class ="cert-date">
			    <i class='fas fa-hourglass-end'style ="font-size:10px;margin-left:4px; color: red; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="prev-date-cert2" style="margin-left:2px;font-weight:600;">24-10-01</>
			</div>

		     </div>

		    <div class ="process-cert-container">
		       <div class ="process-cert">
			<span>
		 	  Process:
			</span>
			<p>
			  Auto insertion of pre-assembly(L-joint & EPDM tube)/ Gromet & tube taping/ Clamp taping on PVC tube & feeder/ Clamp on PVC tube and Inspection
			</p>
		       </div>
                       <div style="font-weight:900;background-color:#3664FF; color:#fff; padding-left:4px;">Certification:</div>
		       <div class ="cert-fill-container">
                        <div class ="cert-details" id ="certification-status1">
			  <div id = "status-cert1-div2" class="certification"></div>
			  <span>Cutting</span>
                        </div>

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert2-div2"  class="certification"></div>
                          <span>Assembly</span>
			</div>	

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert3-div2" class ="certification"></div>
                          <span>Taping</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert4-div2" class="certification"></div>
                          <span>Installation pad</span>
			</div>
			
			<div class="cert-details"> 
			  <div id = "status-cert5-div2" class="certification"></div>
                          <span>Manual Seimitsu</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert6-div2" class="certification"></div>
                          <span>Retainer Putting</span>
			</div>
			
			<div class="cert-details">
                          <div id = "status-cert7-div2" class="certification"></div>
                          <span>Manual Valve check</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert8-div2" class="certification"></div>
                          <span>Final Inspection</span>
			</div>
		       </div>
		
		    </div>
		 </div>
<!-- person 3-->

		 <div class="person3" id ="operator3" style ="display:none;">
		     <div class ="cert-pic-name">
			<img id ="cert-img3" src ="" alt="" style="object-fit:cover; width: 119px;height:120px; margin-left:2px; margin-right:2px;margin-top:5px; border:1px solid black; border-radius:5px;">
			<div class = "person-icon-name">
			   <i class="material-icons" style= " font-size:10px;margin-left:2px; color: blue; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);">&#xe7fd;</i>
			   <p id = "person-cert-name3" style="margin-left:2px;font-weight:600;">
			</div>

                        <div class ="cert-date">
                            <i class='fas fa-hourglass-start' style =" font-size:10px;margin-left:4px; color: green; border:none;box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="curt-date-cert3" style="margin-left:2px;font-weight:600;">25-04-01</p>
                        </div>

                        <div class ="cert-date">
			    <i class='fas fa-hourglass-end'style ="font-size:10px;margin-left:4px; color: red; border:none; box-shadow:0px 3px 6px rgba(0,0,0,0.1);"></i>
			    <p id ="prev-date-cert3" style="margin-left:2px;font-weight:600;">24-10-01</>
			</div>

		     </div>

		    <div class ="process-cert-container">
		       <div class ="process-cert">
			<span>
		 	  Process:
			</span>
			<p>
			  Q.C Final inspection.
			</p>
		       </div>
                       <div style="font-weight:900;background-color:#3664FF; color:#fff; padding-left:4px;">Certification:</div>
		       <div class ="cert-fill-container">
                        <div class ="cert-details" id ="certification-status1">
			  <div id = "status-cert1-div3" class="certification"></div>
			  <span>Cutting</span>
                        </div>

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert2-div3"  class="certification"></div>
                          <span>Assembly</span>
			</div>	

			<div class ="cert-details" id ="certification-status1">
                          <div id = "status-cert3-div3" class ="certification"></div>
                          <span>Taping</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert4-div3" class="certification"></div>
                          <span>Installation pad</span>
			</div>
			
			<div class="cert-details"> 
			  <div id = "status-cert5-div3" class="certification"></div>
                          <span>Manual Seimitsu</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert6-div3" class="certification"></div>
                          <span>Retainer Putting</span>
			</div>
			
			<div class="cert-details">
                          <div id = "status-cert7-div3" class="certification"></div>
                          <span>Manual Valve check</span>
			</div>

			<div class="cert-details">
                          <div id = "status-cert8-div3" class="certification"></div>
                          <span>Final Inspection</span>
			</div>
		       </div>
		
		    </div>
		 </div>
	
<!-- line leader -->
	<div id ="line-leader"  class="line-leader-container" style ="display:none;">
	           <div class="custom-dropdown-leader" id="dropdown-line-leader">
                     --Select line leader--
                    <div class="dropdown-options-leader"></div>
                </div>
                <div id="selected-data-leader" class="selected-data-leader">
                  <img src="" alt="Selected Image" id="selected-image-leader" style=" object-fit:cover; width: 160px; height:120px; border:1px solid black; border-radius:5px; ">
		  <span style= "padding:5px 7px; text-align:center; font-weight:900;background-color: #3664FF; color:#fff; width:165px; border-radius:5px; margin-bottom:5px; font-size:15px;">Line leader incharge</span>
                 </div>

	</div>


              </div>
                <div class="product-info">
                    <div class="picture-product">
                        <img  height="275" width="190" src="prod-pic.jpg" alt="picture product">
                              <select id = "plan_data" onchange="send_plan()">
                                 <option  id = "partno" value="" selected="selected" >Select Part.No</option>
                                     <?php
                                        $sql = "SELECT id ,part_no,line, model, date_created FROM details_product";
                                        $resultset = mysqli_query($conn, $sql);
                                        while( $rows = mysqli_fetch_assoc($resultset) ) { 
                                        ?>
                                        <option value="<?php echo $rows["id"]; ?>"><?php echo $rows["id"].") ".$rows["part_no"]; ?></option>
                                        <?php } ?>
                              </select>

                    </div>

                    <div class="product-info-container">        
			<span class ="product-info-title">Product Info.</span>
                        <span  class="category">Line: <p id ="line"></p></span>
                        <span  class="category">Model:<p id ="model"></p></span>
                        <span  class="category">Balance:<p id ="balance"></p></span>
                        <span  class="category">Manpower: <p id ="manpower"></p></span>
                        <span  class="category">Date:<p id ="date"></p></span>
                        <span  class="category">Del.date: <p id ="del_date"></p></span>
                        <span  class="category">Ct.as.Of: <p id ="ct_as_of"></p></span>   
                        <span  class="category">Exp.date:<p id ="expdate"></p></span>
                    </div>

                </div>
           </div>

        </div>

            <div class="bottom-div">
                <div class="graph-container">
                    <div class="production-graph">
                        <div class ="prod-title-graph">
                          <span>Production graph</span>
                        </div>
                        <canvas id = "prodChart" width="400" height="270"></canvas>
                        
                    </div>
                    <div class="downtime-graph">
                        <div class="down-title-graph">
                            <span>Downtime graph</span>
                        </div>
                        <canvas id = "downChart" width="400" height="270"></canvas>
                    </div>
                </div> 
                <div class="summary-container">

                    <div class="title-summary">
                        <h3>Summary</h3>
                    </div>
                <div class="sum-data">
                    <span class="sum-cate">TOTAL OUTPUT:<p class="total_output" id = "total_output"></p></span>
                    <span class="sum-cate">TOTAL NG:<p class="total_ng" id ="total_NG"></p></span>
                    <span class="sum-cate">GOOD QTY:<p class="good_qty" id = "good_qty"></p></span>
                    <span class="sum-cate">TOTAL PROD.HRS:<p class="total_prod" id="totalProd_hr"></p></span>
                    <span class="sum-cate">TOTAL DOWNTIME:<p class="total_downtime" id="total_downtime_data"></p></span>
                    <span class="sum-cate">ACTUAL PROD.HRS:<p class="actual_prod" id ="actualProd_hr"></p></span>
                    <span class="sum-cate">ACTUAL MANPOWER:<p class="actual_manpower"id ="actual_manpower">2</p></span>
                    <span class="sum-cate">BREAKTIME:<p class="breaktime" id ="breaktime">1:40</p></span>
                    <span class="sum-cate">ACHIEVE DAY:<p class="achieveToday" id = "AchieveToday"></p></span>
                    <button class="savebtn" onclick="submitData()"> Save data </button>
                </div>
             </div>
                
                    <div class="downtime-timer">
                        <div class="timer-title">
                            <h3>Downtime timer</h3>
                        </div> 
                        <div class="time-ss">

                        <div class="time-content" id = "timer">
                            00:00:00
                        </div>
                        <div class="timer-btn">
                            <button id= "startBtn" onclick="startTimer()">Start</button>
                            <button id = "stopBtn" onclick="stopTimer()">Stop</button>
                            <button id ="cancelBtn" onclick="cancelTimer()">Cancel</button>

                        </div>
                        </div>
                    </div>

                      


                


            </div>
    </div>
</div>
    <script src="drop_data.js"></script>
    <script src="actual_out_table.js"></script>
    <script src="downtime_table_data.js"></script>
    <script src ="bar_chart.js "></script>
    <script src = "summary_part.js"></script>
    <script src = "timer_handler.js"></script>
    <script src="dowtime_data.js"></script>
    <script src="drop_downtime_form.js"></script>
    <script src ="ngsend.js"></script>  
    <script src="history.js"></script>     
    <script src="plan_data_output.js"></script>  
    <script src="operator_image.js"></script>  
    <script src="save_data.js"></script>      
    <script src = "personnel.js"></script>
    <script src = "line_leader.js"></script>
    <script src ="disable_timeng_option.js"></script>

    <script>
  // Get the canvas element
function send_plan(){
       var selectedValue = document.getElementById("plan_data").value;

       var xhr = new XMLHttpRequest();
           xhr.open("POST", "check_plan.php", true);
               xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function () {
                     if (xhr.readyState === 4 && xhr.status === 200) {
                                  
                        console.log("Response from server: " + xhr.responseText);
                    }
                };
            xhr.send("dropdownValue=" + encodeURIComponent(selectedValue));
     }

 
  function showProd(){
    document.getElementById('output_container').style.display ="block";
    document.getElementById('downtime_container').style.display="none";
  }
  function showDown(){
    document.getElementById('output_container').style.display ="none";
    document.getElementById('downtime_container').style.display="block";
  }
  function showBtnOption(){
    document.getElementById('id_ng_container').style.display = "block";	
    
  }
 function show_ng_form(){
   document.getElementById('id_ng_container').style.display = "block";

	}
 function exit_ng_form(){
    document.getElementById('id_ng_container').style.display ="none";
  }
 function history_table(){
    document.getElementById("container-main-pdf").style.display = "none";
    document.getElementById("video-container").style.display = "none";
    document.getElementById('main_history').style.display ="block";
    document.getElementById('monitoring_data').style.display ="none";

 }
function back(){
    document.getElementById("container-main-pdf").style.display = "none";
    document.getElementById("video-container").style.display = "none";
    document.getElementById('main_history').style.display ="none";
    document.getElementById('monitoring_data').style.display ="block"; 
}
function swp(){
   document.getElementById("container-main-pdf").style.display = "block";
   document.getElementById("video-container").style.display = "none";
   document.getElementById('main_history').style.display ="none";
   document.getElementById('monitoring_data').style.display ="none"; 
}
function swpToMonitor(){
   document.getElementById("container-main-pdf").style.display = "none";
   document.getElementById("video-container").style.display = "none";
   document.getElementById('main_history').style.display ="none";
   document.getElementById('monitoring_data').style.display ="block";

}
function videos(){
   document.getElementById("container-main-pdf").style.display = "none";
   document.getElementById("video-container").style.display = "block";
   document.getElementById('main_history').style.display ="none";
   document.getElementById('monitoring_data').style.display ="none";

}
function videoToMonitor(){
   document.getElementById("container-main-pdf").style.display = "none";
   document.getElementById("video-container").style.display = "none";
   document.getElementById('main_history').style.display ="none";
   document.getElementById('monitoring_data').style.display ="block";

}
function showNG(){
   document.getElementById('id_ng_container').style.display ="block";
}
function show_balance(){

   document.getElementById('bal-container').style.display ="block";

}

 function clockTick()    {
       currentTime = new Date();
       month = currentTime.getMonth() + 1;
       day = currentTime.getDate();
       year = currentTime.getFullYear();
      // alert("hi");
      document.getElementById('date').innerHTML=year + "-" +month + "-" + day;
    }
    
    setInterval(function(){clockTick();}, 1000);//setInterval(clockTick, 1000);
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
function clearInputs() {
    if (activeInputId) {
        const inputField = document.getElementById(activeInputId);
        inputField.value = "";
    }
}

function displayOperator1(){
	  document.getElementById('operator1').style.display="flex";
	  document.getElementById('operator1').style.flexDirection="row";
          document.getElementById('persons_img').style.display="none";
	  document.getElementById('operator2').style.display="none";
          document.getElementById('operator3').style.display="none";
          document.getElementById('line-leader').style.display="none";

	}
function main_persons(){
          document.getElementById('operator1').style.display="none";
          document.getElementById('operator2').style.display="none";
          document.getElementById('operator3').style.display="none";
          document.getElementById('line-leader').style.display="none";
          document.getElementById('persons_img').style.flexDirection="row";
          document.getElementById('persons_img').style.display="flex";
	}
function displayOperator2(){
          document.getElementById('operator2').style.display="flex";
          document.getElementById('operator2').style.flexDirection="row";
          document.getElementById('persons_img').style.display="none";
          document.getElementById('operator1').style.display="none";
          document.getElementById('operator3').style.display="none";
          document.getElementById('line-leader').style.display="none";


        }

function displayOperator3(){
          document.getElementById('operator3').style.display="flex";
          document.getElementById('operator3').style.flexDirection="row";
          document.getElementById('persons_img').style.display="none";
          document.getElementById('operator1').style.display="none";
          document.getElementById('operator2').style.display="none";
          document.getElementById('line-leader').style.display="none";

        }

function line_leader(){
          document.getElementById('operator3').style.display="none";
          document.getElementById('operator3').style.flexDirection="none";
          document.getElementById('persons_img').style.display="none";
          document.getElementById('operator1').style.display="none";
          document.getElementById('operator2').style.display="none";
          document.getElementById('line-leader').style.display="flex";
          document.getElementById('line-leader').style.flexDirection="column";
	}

</script>

<script>


           
</script>

</body>
</html>
