    function updateTable() {
    let i = 0;
    var xhr = new XMLHttpRequest();
            xhr.open("GET", "historyServer.php", true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    var tableBody = document.querySelector("#dataTable tbody");
                    tableBody.innerHTML = "";  // Clear existing data           
                    data.forEach(function(row) {
                        var tr = document.createElement("tr");
                        i++; 
                        tr.innerHTML = `
                            <td style = "border:1px solid #3664FF;">${i}</td>
                            <td style = "border:1px solid #3664FF;" >${row.Partno}</td>
                            <td style = "border:1px solid #3664FF;" >${row.line_no}</td>
                            <td style = "border:1px solid #3664FF;">${row.total_output}</td>
                            <td style = "border:1px solid #3664FF;">${row.total_ng}</td>
                            <td style = "border:1px solid #3664FF;">${row.goodqty}</td>
                            <td style = "border:1px solid #3664FF;">${row.total_prod_hrs}</td>
                            <td style = "border:1px solid #3664FF;">${row.total_downtime}</td>
                            <td style = "border:1px solid #3664FF;">${row.actual_prod_hrs}</td>
                            <td style = "border:1px solid #3664FF;">${row.manpower}</td>
                            <td style = "border:1px solid #3664FF;">${row.breaktime}</td>
                            <td style = "border:1px solid #3664FF;">${row.achieve_per_day}</td>
                            <td style = "border:1px solid #3664FF;">${row.day_created}</td>
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


