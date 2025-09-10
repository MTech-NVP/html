<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <title>Production Plan form</title>
    <style>
        
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    font-family: Arial, sans-serif;
    /*background: linear-gradient(135deg, #1E90FF, #4682B4);*/
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.content{
    width: 760px;
    height: 550px;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
}   
form{
   
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    
   
}
form>.details_on_products{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 100px;
    

}


form>.plan-time-hr{
    display: grid;
    grid-template-rows: 200px 200px auto;
    

}

.btn-submit{
    position: absolute;
    margin-top: 430px;
    margin-left: 290px;
    
}
input, textarea {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    transition: border-color 0.3s;
    margin-left: 10px;
}
input:focus, textarea:focus {
    border-color: #007BFF;
    outline: none;
}
button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007BFF;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}
.morning {
    margin-top: 30px;
    text-align:left;
    margin-left: 10px;
    
}

label{
    font-size: 16px;
    color:#333;
    padding:10px;
    text-decoration-line: underline;
}
table{
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
}
table, th, td {
      border: 1px solid #ddd;
    }
table th{
    border: 1px solid #333;
    background-color:  #3664FF;
    border-collapse: collapse;
    color: white;
    border-color: white;
    height: 30px;
    width: 50px;
    border-radius: 3px;
}
th, td {
      padding: 10px;
      text-align: center;
    }
h1{
    background-color: #3664FF;
    color:white;
    text-align: center;
}
.production-weekly-title{
    display: flex;
    align-items: center;
    width: 100%;
    height: 70px;
    color:#333;
    padding-left: 10px;
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
img {
    max-width: 80%;
    height: auto;
}
td{
      font-size: 15px;
      font-weight: 700;
    }
.big-border{
    display: grid;
    grid-template-columns: 50% 50%;
}
.production_pdf_container{
    overflow-y: scroll; 
    height: 530px;
    border: 1px solid #ccc;
    

}
    </style>
</head>
<body>
    <div class="big-border">
        <div class="content">
            <h1>Production Plan Form</h1>
            <form action="formhandler.inc.php" method = "post">
                <div class="details_on_products">
                    <label style="padding-bottom:4px; padding-top:4px;padding-left:13px;";>Pro.Info</label>
                    <input type="text" name = "part_no" placeholder="Part no.">
                    <input type="text" name = "model" placeholder="Model">
                    <input type="text" name = "line" placeholder="Line">
                    <input type="text" name = "del_date" placeholder="del_date">
                    <input type="text" name = "balance" placeholder="balance">
                    <input type="text" name = "man_power" placeholder="Man Power">
                    <input type="text" name = "ct_as_of" placeholder="Ct_as_of">
                    <input type="text" name = "exp_date" placeholder="Exp.date">
                </div>
                <div class="plan-time-hr">
                    <div class="morning">
                    <label style="position: absolute; margin-top:-40px;" >Morning plan production time</label>
                    <input type="number" name = "plan1" placeholder="6am-7am">
                    <input type="number" name = "plan2" placeholder="7am-8am">
                    <input type="number" name = "plan3" placeholder="8am-9am">
                    <input type="number" name = "plan4" placeholder="9am-10am">
                    <input type="number" name = "plan5" placeholder="10am-11am">
                    <input type="number" name = "plan6" placeholder="11am-12am">
                    
                    </div>
                    <label style="position: absolute; margin-top:155px; margin-left:8px;"  >Afternoon plan production time</label>
                    <div class="pm">
                    
                    <input type="number" name = "plan7" placeholder="12am-1pm">
                    <input type="number" name = "plan8" placeholder="1pm-2pm">
                    <input type="number" name = "plan9" placeholder="2pm-3pm">
                    <input type="number" name = "plan10" placeholder="3pm-4pm">
                    <input type="number" name = "plan11" placeholder="4pm-5pm">
                    <input type="number" name = "plan12" placeholder="5pm-6pm">
                    <input type="number" name = "plan13" placeholder="6pm-7pm">
                    <input type="number" name = "plan14" placeholder="7pm-8pm">
                    <input type="number" name = "plan15" placeholder="8pm-9pm">
                    <input type="number" name = "plan16" placeholder="9pm-10pm">
                    <input type="number" name = "plan17" placeholder="10pm-11pm">
                    
                    </div>

                </div>
                    
                <div class="btn-submit">
                    <button> Submit Plan data</button>
                </div>
               


            </form>
        </div>

        <div class="production_pdf_container" style="margin-top: 20px;">
            <div style="position:fixed; width:820px;">
                 <h1>Production record</h1>
            </div>

                <table id="imagesTable" style="margin-top: 30px;">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Production data</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Rows will be added here dynamically -->
                    </tbody>
                </table>
        </div>
    </div>

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
            <td><img src="data:image/png;base64,${image.image_data}" alt="Captured Image"/></td>
            <td><button onclick="convertToPDF('${image.image_data}')">Download data</button></td>
          `;
          tableBody.appendChild(row);
        });
      } catch (error) {
        console.error('Error loading images:', error);
      }
    }

    function convertToPDF(base64Image) {
      const { jsPDF } = window.jspdf;
      const img = new Image();
      img.src = `data:image/png;base64,${base64Image}`;
      img.onload = function() {
        const doc = new jsPDF({
          orientation: 'landscape',
          unit: 'px',
          format: [img.width, img.height]
        });
        doc.addImage(img, 'PNG', 0, 0, img.width, img.height);
        doc.save('production-data.pdf');
      };
    }

    document.addEventListener('DOMContentLoaded', loadImages);
  </script>  
</body>
</html>
