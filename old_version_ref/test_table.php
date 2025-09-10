<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>

<style>
*{
  padding:0; margin:0;
  box-sizzing:border-box;
  font-family:sans-serif;

}

body{
 


}
table{
  width:100%;
  border:1px solid #3664FF;
  border-collapse: collapse;
}
th{
  border:1px solid #3664FF;
  
}
#downtime_title{
  font-size:22px;
  background-color:#3664FF;
  color:white;
}

#downtime_container{
  width:1000px;
  height:500px;
  display: none;


}


#btn_switch{
  display:grid;
  grid-template-colums:50% 50%;
  width:300px; height:100px;
  

}
#btn_switch>button{
   width: 150px;
   height: 60px;
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

#data_container{
  display:flex;
  flex-direction:rows;
  justify-content:space-between;


}

</style>




</head>
<body>



<div id = "btn_switch">
  <button>Output</button>
  <button onclick ="btnDowntime()" >Downtime</button>
 
</div>
<div id = "data_container">
<div id ="output_container">
 <table>
  <thead>
   <tr>
     <th colspan ="11">PRODUCTION</th>
   </tr>
   <tr>
     <th colspan="5">PLAN</th>
     <th colspan="3">ACTUAL</th>
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
 </table>
	
</div>




<div id ="downtime_container">
<table id = "downtime_datas">
  <thead>
   <tr>
     <th id = "downtime_title" colspan ="7">DOWNTIME MONITORING</th>
   </tr>
   <tr>
    <th id ="downtime_Element">TIME</th>
    <th id ="downtime_Element">PROCESSS</th>
    <th id ="downtime_Element">DETAILS</th>
    <th id ="downtime_Element">ACTION</th>
    <th id ="downtime_Element">DOWNTIME</th>
    <th id ="downtime_Element">PIC</th>
    <th id ="downtime_Element">REMARKS</th>
   </tr>
  </thead>
  <tbody>
  </tbody>
</table>
</div>

</div>
<script>
    function displayDowntime() {
    let i = 0;
    var xhr = new XMLHttpRequest();
            xhr.open("GET", "serve_downtime_dis.php", true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    var tableBody = document.querySelector("#downtime_datas tbody");
                    tableBody.innerHTML = "";  // Clear existing data           
                    data.forEach(function(row) {
                        var tr = document.createElement("tr");
                        i++; 
                        tr.innerHTML = `
                            <td style = "border:1px solid #3664FF;">${row.time_occur}</td>
                            <td style = "border:1px solid #3664FF;">${row.process}</td>
                            <td style = "border:1px solid #3664FF;">${row.details}</td>
                            <td style = "border:1px solid #3664FF;">${row.Act}</td>
                            <td style = "border:1px solid #3664FF;">${row.time_Elapse}</td>
                            <td style = "border:1px solid #3664FF;">${row.Pics}</td>
                            <td style = "border:1px solid #3664FF;">${row.remark}</td>

                        `;
                        tableBody.appendChild(tr);
                        tableBody.style = 'background-color:white; text-align:center;'
                    });
                } else {
                    console.error("Failed to fetch data: " + xhr.status);
                }
            };
            xhr.send();
        }

        setInterval(displayDowntime, 1000);

        // Initial data fetch when the page loads
        window.onload = displayDowntime;

function btnDowntime() {
    document.getElementById('downtime_container').style.display = "block";
    document.getElementById('output_container').style.display="none";	
}





</script>

</body>
</html>
