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
    window.location.href = "http://10.0.0.189/DOM/files/DOMPlanner/planner.php";
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
    "10.0.0.189": "TUBE ASSEMBLY: C4 TUBE LINE",
    "10.0.0.102": "TUBE ASSEMBLY: C7 TUBE LINE",
    "10.0.0.136": "TUBE ASSEMBLY: C9 TUBE LINE",
    "10.0.0.125": "TUBE ASSEMBLY: C9-1 TUBE LINE",
    "10.0.0.164": "TUBE ASSEMBLY: C10 TUBE LINE",
    "localhost": "ADMINISTRATOR",
    "192.168.0.228": "TUBE ASSEMBLY: C4 PRODUCTION LINE"
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

function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

async function loadImages() {
    try {
        const response = await fetch('fetches/server_display.php');
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
        const response = await fetch('fetches/person_display_server.php');
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
    fetch('fetches/tablePlanServer.php', {
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
                    <div><label>Part No:&nbsp;</label> ${row.partnumber}</div>
                    <div><label>Model:&nbsp;</label> ${row.model}</div>
                    <div><label>Delivery Date:&nbsp;</label> ${row.deliverydate}</div>
                    <div><label>Balance:&nbsp;</label> ${row.balance}</div>
                    <div><label>Man Power:&nbsp;</label> ${row.manpower}</div>
                    <div><label>Production Hours:&nbsp;</label> ${row.prodhrs}</div>                            
                </div>

                <div class="plan-section" id="time-plan-title">Minutes Allotted Per Hour</div>

                <div class="time-plan">
                    ${(() => {
                        const plans = [
                            row.mins1, row.mins2, row.mins3, row.mins4,
                            row.mins5, row.mins6, row.mins7, row.mins8,
                            row.mins9, row.mins10, row.mins11, row.mins12,
                            row.mins13, row.mins14
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
                        '${row.partnumber}',
                        '${row.model}', 
                        '${row.deliverydate}',
                        '${row.manpower}',
                        '${row.prodhrs}',
                        '${row.mins1}',
                        '${row.mins2}',
                        '${row.mins3}',
                        '${row.mins4}',
                        '${row.mins5}',
                        '${row.mins6}',
                        '${row.mins7}',
                        '${row.mins8}',
                        '${row.mins9}',
                        '${row.mins10}',
                        '${row.mins11}',
                        '${row.mins12}',
                        '${row.mins13}',
                        '${row.mins14}'
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
    for (let [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }
    
    formData.append('action', 'update'); // always update
    formData.append('planId', document.getElementById('planId').value);

    fetch('fetches/tablePlanServer.php', {
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
            fetch('fetches/tablePlanServer.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => console.log(data));
});

function editPlan(id, partnumber, model, deliverydate, 
    manpower, prodhrs, mins1, mins2,
    mins3, mins4, mins5, mins6, mins7, mins8, mins9, mins10,
    mins11, mins12, mins13, mins14
) {
    const deli = document.getElementById('delDate').value;
    console.log(`Delivery Date: ${deli}`);
    document.getElementById('editForm').style.display = "flex";
    document.getElementById('append-data-plan').style.display = "none";
    document.getElementById('planId').value = id;
    document.getElementById('partno').value = partnumber;
    document.getElementById('modelnumber').value = model;
    document.getElementById('delDate').value = deliverydate;
    document.getElementById('manpower').value = manpower;
    document.getElementById('prodhrs').value = prodhrs;
    document.getElementById('plan1').value = mins1;
    document.getElementById('plan2').value = mins2;
    document.getElementById('plan3').value = mins3;
    document.getElementById('plan4').value = mins4;
    document.getElementById('plan5').value = mins5;
    document.getElementById('plan6').value = mins6;
    document.getElementById('plan7').value = mins7;
    document.getElementById('plan8').value = mins8;
    document.getElementById('plan9').value = mins9;
    document.getElementById('plan10').value = mins10;
    document.getElementById('plan11').value = mins11;
    document.getElementById('plan12').value = mins12;
    document.getElementById('plan13').value = mins13;
    document.getElementById('plan14').value = mins14;
}

function deletePlan(id) {
    if (!confirm('Delete this plan?')) return;
    fetch('fetches/tablePlanServer.php', {
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
setInterval(loadPlans, 5000);

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
    fetch('fetches/updatePerson.php', {
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

document.addEventListener("DOMContentLoaded", () => {
    const updateBars = () => {
        // Step 1: Fetch totalPlan and totalCount
        fetch("fetches/planner_data.php")
            .then(response => response.text())
            .then(value => {
                const [totalPlan, totalCount] = value.split(" ").map(Number);

                // Step 2: Fetch downtime count
                const downtimeCountPromise = fetch("fetches/tablePlanServer.php?action=get_downtime_total")
                    .then(res => res.json())
                    .then(data => {
                        return data.total_time || 0;
                    })
                    .catch(err => {
                        console.error("Error fetching downtime:", err);
                        return 0;
                    });


                // Step 3: Fetch downtime duration and compute total time
                const downtimeDurationPromise = fetch("fetches/tablePlanServer.php?action=get_downtime_duration")
                    .then(res => res.json())
                    .then(data => {
                        //console.log("Data received from server:", data); // <-- Add this to see the raw data

                        let totalSeconds = 0;

                        data.forEach(item => {
                            const parts = item.time_Elapse.split(":").map(Number);
                            // Handle HH:MM:SS or MM:SS formats
                            if (parts.length === 3) {
                                totalSeconds += parts[0] * 3600 + parts[1] * 60 + parts[2];
                            } else if (parts.length === 2) {
                                totalSeconds += parts[0] * 60 + parts[1];
                            }
                        });

                        const hours = Math.floor(totalSeconds / 3600);
                        const minutes = Math.floor((totalSeconds % 3600) / 60);
                        const seconds = totalSeconds % 60;
                        return `${hours.toString().padStart(2, "0")}:${minutes
                            .toString()
                            .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
                    })
                    .catch(err => {
                        console.error(err);
                        return "00:00:00";
                    });


                // Step 4: Fetch product model name
                const modelNamePromise = fetch("/DOM/files/DOMPlanner/fetches/planner_data.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ action: "get_plan_value" })
                })
                    .then(res => res.json())
                    .then(data => data.model || "--")
                    .catch(() => "--");

                // Step 5: After all data fetched
                Promise.all([downtimeCountPromise, downtimeDurationPromise, modelNamePromise]).then(
                    ([downtimeCount, downtimeDuration, modelName]) => {
                        const barContainers = document.querySelectorAll(".bar-container");

                        barContainers.forEach(container => {
                            const label = container.querySelector(".label");
                            const bar = container.querySelector(".bar");

                            if (label && label.textContent.trim() === "C4 Line:" && bar) {
                                const targetWidth = Math.round((totalCount / totalPlan) * 100);

                                // Update bar visuals
                                bar.setAttribute("data-width", targetWidth);
                                bar.textContent = totalCount;
                                bar.style.transition = "width 2s ease, background 2s ease";
                                bar.style.width = targetWidth + "%";

                                // Bar color
                                bar.style.background =
                                    targetWidth >= 100 ? "#3fb045ff" : "#3092fbff";

                                // Update info section
                                const info = container.parentElement.querySelector("#c4-info");
                                if (info) {
                                    info.innerHTML = `
                                        <div>Status: <strong style="color: green;">Online</strong></div>
                                        <div>Product Model: <strong>${modelName}</strong></div>
                                        <div>Quota per day: <strong>${totalPlan}</strong></div>
                                        <div>Completion Rate: <strong>${targetWidth}%</strong></div>
                                        <div>Downtime Count: <strong>${downtimeCount}</strong></div>
                                        <div>DT Duration: <strong>${downtimeDuration}</strong></div>
                                    `;
                                }
                            }
                        });
                    }
                );
            })
            .catch(err => console.error("Error fetching data:", err));
    };

    // Run initially and every second (you can increase to 5s if needed)
    updateBars();
    setInterval(updateBars, 5000);
});

/*  document.addEventListener("DOMContentLoaded", () => {
    const barEndpoints = {
        "c7": "http://10.0.0.102/fetches/planner_data.php",
        "c9": "http://10.0.0.136/fetches/planner_data.php",
        "c9one": "http://10.0.0.125/fetches/planner_data.php",
        "c10": "http://10.0.0.164/fetches/planner_data.php"
    };

    const barLabels = {
        "c7": "C7 Line:",
        "c9": "C9 Line:",
        "c9one": "C9-1 Line:",
        "c10": "C10 Line:"
    };

    const updateBar = async (key, url) => {
        const label = barLabels[key];
        const baseURL = url.replace("/planner_fetch/planner_data.php", ""); // derive base ip

        try {
            const response = await fetch(url);
            const value = await response.text();
            const [totalPlan, totalCount] = value.split(" ").map(Number);
            const targetWidth = Math.round((totalCount / totalPlan) * 100);

            // Fetch model name
            let modelName = "--";
            try {
                const modelResponse = await fetch(url, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ action: "get_plan_value" })
                });
                const modelData = await modelResponse.json();
                modelName = modelData.model || "--";
            } catch (err) {
                console.error(`Model fetch failed for ${label}:`, err);
            }

            // Fetch downtime data from same IP
            let downtimeCount = 0;
            let downtimeDuration = "00:00:00";

            try {
                // Downtime count
                const countResponse = await fetch(`${baseURL}/tablePlanServer.php?action=get_downtime_total`);
                const countData = await countResponse.json();
                downtimeCount = countData.total_time || 0;

                // Downtime duration
                const durationResponse = await fetch(`${baseURL}/tablePlanServer.php?action=get_downtime_duration`);
                const durationData = await durationResponse.json();

                let totalSeconds = 0;
                durationData.forEach(item => {
                    const parts = item.time_Elapse.split(":").map(Number);
                    if (parts.length === 3)
                        totalSeconds += parts[0] * 3600 + parts[1] * 60 + parts[2];
                    else if (parts.length === 2)
                        totalSeconds += parts[0] * 60 + parts[1];
                });

                const h = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");
                const m = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, "0");
                const s = String(totalSeconds % 60).padStart(2, "0");
                downtimeDuration = `${h}:${m}:${s}`;
            } catch (err) {
                console.error(`Downtime fetch failed for ${label}:`, err);
            }

            // Update DOM
            document.querySelectorAll(".bar-container").forEach(container => {
                const labelEl = container.querySelector(".label");
                const bar = container.querySelector(".bar");

                if (labelEl && labelEl.textContent.trim() === label && bar) {
                    bar.style.transition = "width 0.5s ease, background 0.5s ease";
                    bar.style.width = `${targetWidth}%`;
                    bar.textContent = totalCount;
                    bar.style.background = targetWidth >= 100 ? "#2E7D32" : "#006ee4";

                    const info = document.querySelector(`#${key}-info`);
                    if (info) {
                        info.innerHTML = `
                            <div>Status: <span style="color:green;"><strong>Online</strong></span></div>
                            <div>Product Model: <strong>${modelName}</strong></div>
                            <div>Quota per day: <strong>${totalPlan}</strong></div>
                            <div>Completion Rate: <strong>${targetWidth}%</strong></div>
                            <div>Downtime Count: <strong>${downtimeCount}</strong></div>
                            <div>DT Duration: <strong>${downtimeDuration}</strong></div>
                        `;
                    }
                }
            });
        } catch (err) {
            console.error(`Error updating ${label}:`, err);

            const info = document.querySelector(`#${key}-info`);
            if (info) {
                info.innerHTML = `
                    <div>Status: <strong style="color:red;">Offline</strong></div>
                    <div>Product Model: <strong>--</strong></div>
                    <div>Quota per day: <strong>--</strong></div>
                    <div>Completion Rate: <strong>--</strong></div>
                    <div>Downtime Count: <strong>--</strong></div>
                    <div>DT Duration: <strong>--</strong></div>
                `;
            }
        }
    };

    const updateBars = () => {
        for (const [key, url] of Object.entries(barEndpoints)) {
            updateBar(key, url);
        }
    };

    updateBars();
    setInterval(updateBars, 6000);
}); 
*/

function loadOverviewPlan() {
    fetch('fetches/tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'get_by_plan_id_value' })
    })
    .then(res => res.json())
    .then(async row => {
        if (!row) return;

        // SAVE PLAN DETAILS
        window.currentPlan = row;

        // 👉 NEW: Fetch plan_output 14 rows
        const planOutput = await fetch('fetches/tablePlanServer.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'fetchPlanOutput' })
        }).then(r => r.json());

        // 👉 Create a separate object for plan outputs
        window.currentPlanOutputs = {};
        if (Array.isArray(planOutput) && planOutput.length === 14) {
            for (let i = 0; i < 14; i++) {
                window.currentPlanOutputs[`mins${i + 1}`] = planOutput[i];
            }
        }

        const text = `
            <div class="DOM-graphs-title">Daily Production Details</div>
            <div class="overview-plan-data-container">
                <div class="overview-plan-data">
                    <div class="overview-header-plan-data">
                        Plan for ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
                    </div>

                    <div class="overview-plan-section" id="overview-information-title">Product Information</div>
                    <div class="overview-information">
                        <div><label>Part No:<br></label> ${row.partnumber}</div>
                        <div><label>Model:<br></label> ${row.model}</div>
                        <div><label>Delivery Date:<br></label> ${row.deliverydate}</div>
                        <div><label>Cycle Time:<br></label>${row.cycletime}</div>
                        <div><label>Cycle Time As Of:<br></label> ${row.cycletimeasof}</div>
                        <div><label>Expiration Date:<br></label> ${row.expirationdate}</div>
                        <div><label>Manpower:<br></label> ${row.manpower}</div>
                        <div><label>Prod Hours:<br></label> ${row.prodhrs}</div>
                    </div>

                    <div class="overview-plan-section" id="overview-time-title">Plan Output Per Hour</div>
                    <div class="overview-time-plan">
                        ${generatePlanGrid(window.currentPlanOutputs)}
                    </div>

                    <div id="achieved-per-hr">
                        <div class="achieved-bar-title">Actual Count Per Hour 
                        <select id="bar-graph-selection">
                            <option value="prodgraph" id="bar-select-1" class="bar-select">Production</option>
                            <option value="dtgraph"  id="bar-select-2" class="bar-select">Downtime</option>
                        </select>
                        </div>
                        <div class="achieved-bar-graph" id="production-bar-graph">
                            ${generateInitialBars()}
                        </div>
                        <div class="achieved-bar-graph" id="downtime-bar-graph" style="display:none;">
                            ${generateDowntimeBars()}
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('dom-overview-container').innerHTML = text;
    })
    .catch(err => console.error('Error loading plan details:', err));
}


function generatePlanGrid(row) {
    const plans = [
        row.mins1, row.mins2, row.mins3, row.mins4,
        row.mins5, row.mins6, row.mins7, row.mins8,
        row.mins9, row.mins10, row.mins11, row.mins12,
        row.mins13, row.mins14
    ];
    const times = [
        "6AM–7AM","7AM–8AM","8AM–9AM","9AM–10AM",
        "10AM–11AM","11AM–12PM","12PM–1PM","1PM–2PM",
        "2PM–3PM","3PM–4PM","4PM–5PM","5PM–6PM",
        "6PM–7PM","7PM–8PM"
    ];

    const formatValue = (val, time) => {
        if (val === 0 || val === "0" || val === null) {
            if (/(6AM|7AM|8AM|9AM|10AM|11AM|12PM|1PM|2PM|3PM|4PM|5PM|6PM)/.test(time) && !/6PM|7PM|8PM/.test(time)) return "BREAK";
            if (/6PM|7PM|8PM/.test(time)) return "N/A";
        }
        return val ?? "-";
    };

    const firstHalfTimes = times.slice(0, 7);
    const secondHalfTimes = times.slice(7);
    const firstHalfPlans = plans.slice(0, 7);
    const secondHalfPlans = plans.slice(7);

    return `
        <div class="overview-grid">
            ${firstHalfTimes.map(t => `<div class="time-cell">${t}</div>`).join('')}
            ${firstHalfPlans.map((p,i) => `<div class="value-cell">${formatValue(p, firstHalfTimes[i])}</div>`).join('')}
            ${secondHalfTimes.map(t => `<div class="time-cell" id="timecell2">${t}</div>`).join('')}
            ${secondHalfPlans.map((p,i) => `<div class="value-cell">${formatValue(p, secondHalfTimes[i])}</div>`).join('')}
        </div>
    `;
}

function generateInitialBars() {
    const times = ["6AM–7AM","7AM–8AM","8AM–9AM","9AM–10AM","10AM–11AM","11AM–12PM","12PM–1PM",
                "1PM–2PM","2PM–3PM","3PM–4PM","4PM–5PM","5PM–6PM","6PM–7PM","7PM–8PM"];
    return times.map(time => `
        <div class="achieved-bar-item">
            <div class="achieved-bar" style="height:0; transition: height 0.5s;">
                <span class="achieved-bar-value">0</span>
            </div>
            <div class="achieved-bar-label">${time}</div>
        </div>
    `).join('');
}

function generateDowntimeBars() {
    const times = [
        "6AM–7AM","7AM–8AM","8AM–9AM","9AM–10AM",
        "10AM–11AM","11AM–12PM","12PM–1PM",
        "1PM–2PM","2PM–3PM","3PM–4PM","4PM–5PM",
        "5PM–6PM","6PM–7PM","7PM–8PM"
    ];

    return times.map(time => `
        <div class="dt-bar-item">
            <div class="dt-bar" style="height:0; transition: height 0.5s; background-color:#dc3545;">
                <span class="dt-bar-value">0</span>
            </div>
            <div class="dt-bar-label">${time}</div>
        </div>
    `).join('');
}

function updateBarHeights() {
    if (!window.currentPlan) return;

    fetch('fetches/tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'get_countPerHr' })
    })
    .then(res => res.json())
    .then(countData => {
        const plans = [
            window.currentPlan.mins1,
            window.currentPlan.mins2,
            window.currentPlan.mins3,
            window.currentPlan.mins4,
            window.currentPlan.mins5,
            window.currentPlan.mins6,
            window.currentPlan.mins7,
            window.currentPlan.mins8,
            window.currentPlan.mins9,
            window.currentPlan.mins10,
            window.currentPlan.mins11,
            window.currentPlan.mins12,
            window.currentPlan.mins13,
            window.currentPlan.mins14
        ];

        const planMap = plans.map(p => parseInt(p) || 0);
        //console.log("Plans map:", planMap);

        // ⛔ Stop if all plans are 0
        if (planMap.every(v => v === 0)) {
            //console.log("All plan values are zero — terminating updateBarHeights().");
            return;
        }

        const maxVal = Math.max(
            ...countData.map(v => parseInt(v) || 0),
            ...plans.map(p => parseInt(p) || 0)
        ) || 1;

        const graphHeight = 150; // in vh
        const bars = document.querySelectorAll('#achieved-per-hr .achieved-bar');

        bars.forEach((bar, i) => {
            const numericVal = parseInt(countData[i]) || 0;
            const planVal = parseInt(plans[i]) || 0;
            const barHeight = (numericVal / maxVal) * graphHeight;
            const color = numericVal >= planVal ? "#28a745" : "#007bff";

            bar.style.height = barHeight + 'px';
            bar.style.backgroundColor = color;
            bar.querySelector('.achieved-bar-value').textContent = numericVal;

            // console.log(window.currentPlan);
            // console.log(`Bar ${i + 1}: numericVal = ${numericVal}, planVal = ${planVal}, barHeight (${barHeight.toFixed(2)})= (${numericVal}/${maxVal})*${graphHeight}`);
        });
    })
    .catch(err => console.error('Error updating bar heights:', err));
}

function updateDowntimeBars() {
    fetch('fetches/tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'get_downtime_data' })
    })
    .then(res => res.json())
    .then(downtimeData => {
        const bars = document.querySelectorAll('#downtime-bar-graph .dt-bar');
        const maxVal = Math.max(...downtimeData.map(v => v.time_num || 0), 1);
        const graphHeight = 150; // same as production

        bars.forEach((bar, i) => {
            const val = downtimeData[i]?.time_num || 0;
            const barHeight = (val / maxVal) * graphHeight;

            bar.style.height = barHeight + 'px';
            bar.querySelector('.dt-bar-value').textContent = val;
        });
    })
    .catch(err => console.error('Error updating downtime bars:', err));
}

function updateOverviewPlan() {
    fetch('fetches/tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'get_by_plan_id_value' })
    })
    .then(res => res.json())
    .then(async row => {
        if (!row) return;

        window.currentPlan = row;

        // 👉 NEW: Fetch plan_output 14 rows
        const planOutput = await fetch('fetches/tablePlanServer.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'fetchPlanOutput' })
        }).then(r => r.json());

        // 👉 Map the 14 values into mins1–mins14
        if (Array.isArray(planOutput) && planOutput.length === 14) {
            row.mins1  = planOutput[0];
            row.mins2  = planOutput[1];
            row.mins3  = planOutput[2];
            row.mins4  = planOutput[3];
            row.mins5  = planOutput[4];
            row.mins6  = planOutput[5];
            row.mins7  = planOutput[6];
            row.mins8  = planOutput[7];
            row.mins9  = planOutput[8];
            row.mins10 = planOutput[9];
            row.mins11 = planOutput[10];
            row.mins12 = planOutput[11];
            row.mins13 = planOutput[12];
            row.mins14 = planOutput[13];
        }

        // Update Product Info
        const infoHTML = `
            <div><label>Part No:<br></label> ${row.partnumber}</div>
            <div><label>Model:<br></label> ${row.model}</div>
            <div><label>Delivery Date:<br></label> ${row.deliverydate}</div>
            <div><label>Cycle Time:<br></label> ${row.cycletime}</div>
            <div><label>Cycle Time As Of:<br></label> ${row.cycletimeasof}</div>
            <div><label>Expiration Date:<br></label> ${row.expirationdate}</div>
            <div><label>Manpower:<br></label> ${row.manpower}</div>
            <div><label>Prod Hours:<br></label> ${row.prodhrs}</div>
        `;
        document.querySelector('.overview-information').innerHTML = infoHTML;

        // Update Plan per Hour Grid
        document.querySelector('.overview-time-plan').innerHTML = generatePlanGrid(row);
    })
    .catch(err => console.error('Error updating plan:', err));
}

document.addEventListener('change', function(e) {
    if (e.target.id === 'bar-graph-selection') {
        const selection = e.target.value;

        if (selection === 'prodgraph') {
            document.getElementById('production-bar-graph').style.display = 'flex';
            document.getElementById('downtime-bar-graph').style.display = 'none';
            updateBarHeights();
        } else if (selection === 'dtgraph') {
            document.getElementById('production-bar-graph').style.display = 'none';
            document.getElementById('downtime-bar-graph').style.display = 'flex';
            updateDowntimeBars();
        }
    }
});

loadOverviewPlan();

setInterval(updateBarHeights, 3000);  
setInterval(updateDowntimeBars, 3000);
setInterval(updateOverviewPlan, 5000); 

document.addEventListener("DOMContentLoaded", () => {
    const ctInput = document.getElementById('ct');
    const ctaoInput = document.getElementById('ctao');
    const expdateInput = document.getElementById('expdate');
    const editBtn = document.getElementById('edit-ct');
    const submitBtn = document.getElementById('submit-ct');
    const backBtn = document.getElementById('back-ct');

    let originalData = {}; // to store original values when editing

    // Inputs are readonly initially
    ctInput.readOnly = true;
    ctaoInput.readOnly = true;
    expdateInput.readOnly = true;

    // Submit and Back hidden initially
    submitBtn.style.display = 'none';
    backBtn.style.display = 'none';

    // Fetch CT data
    function loadCTData() {
        fetch('fetches/tablePlanServer.php?action=ctfetch')
            .then(res => res.json())
            .then(data => {
                ctInput.value = data.ctime || '';
                ctaoInput.value = data.ctao || '';
                expdateInput.value = data.ed || '';
                originalData = { ...data }; // store original values
            })
            .catch(err => console.error('Error fetching CT data:', err));
    }

    loadCTData();

    // Edit button click
    editBtn.addEventListener('click', () => {
        ctInput.readOnly = false;
        ctaoInput.readOnly = false;
        expdateInput.readOnly = false;

        editBtn.style.display = 'none';
        submitBtn.style.display = 'inline-block';
        backBtn.style.display = 'inline-block';
    });

    // Back button click
    backBtn.addEventListener('click', () => {
        // Restore original values
        ctInput.value = originalData.ctime || '';
        ctaoInput.value = originalData.ctao || '';
        expdateInput.value = originalData.ed || '';

        ctInput.readOnly = true;
        ctaoInput.readOnly = true;
        expdateInput.readOnly = true;

        submitBtn.style.display = 'none';
        backBtn.style.display = 'none';
        editBtn.style.display = 'inline-block';
    });

    // Submit button click
    submitBtn.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('action', 'ctupdate');
        formData.append('ctime', ctInput.value);
        formData.append('ctao', ctaoInput.value);
        formData.append('ed', expdateInput.value);

        fetch('fetches/tablePlanServer.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(resp => {
            if (resp.success) {
                alert('CT updated successfully!');
                ctInput.readOnly = true;
                ctaoInput.readOnly = true;
                expdateInput.readOnly = true;

                submitBtn.style.display = 'none';
                backBtn.style.display = 'none';
                editBtn.style.display = 'inline-block';
                location.reload();
                // Update originalData to latest values
                originalData = {
                    ctime: ctInput.value,
                    ctao: ctaoInput.value,
                    ed: expdateInput.value
                };
            } else {
                alert('Error: ' + (resp.error || 'Unknown'));
            }
        })
        .catch(err => console.error('Error updating CT:', err));
    });
});

document.addEventListener("DOMContentLoaded", () => {
    fetch('fetches/tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'updatePlanOutputLive' })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            //console.log(`PlanOutput updated on page load: Cycle Time ${res.cycletime}`);
        } else {
            console.error('Update failed:', resp.error);
        }
    })
    .catch(err => console.error('Fetch error:', err));
});


        