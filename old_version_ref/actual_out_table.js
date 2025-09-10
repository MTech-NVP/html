function updateTableOutput() {
    let i = 0;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "output_table_server.php", true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                const data = JSON.parse(xhr.responseText);
                const tableBody = document.querySelector("#actual_output_table tbody");
                tableBody.innerHTML = ""; // Clear existing data

                data.forEach(function (row) {
                    const tr = document.createElement("tr");
                    i++;

                    tr.innerHTML = `
                        <td>${row.time_prod}</td>
                        <td>${row.cycle_time}</td>
                        <td>${row.min}</td>
                        <td>${row.plan_out_hr}</td>
                        <td>${row.total_out_hr}</td>
                        <td>${row.countPerHr}</td>
                        <td>${row.countTol}</td>
                        <td class="data_achieved">${row.achieved}%</td> <!-- Added a class for easier targeting -->
                        <td>${row.NG_count}</td>
                    `;
                    tableBody.appendChild(tr);
                });

                // Change text color based on "achieved" value
              /*  const achievedCells = document.querySelectorAll(".data_achieved");
                achievedCells.forEach(function (cell) {
                    const achievedValue = parseFloat(cell.textContent.replace('%', ''));
                    if (achievedValue < 100) {
                        cell.style.backgroundColor = "#FF0000"; // Set red if less than 100
                        cell.style.color = "black";
                    } else {
                        cell.style.backgroundColor = "#43A047"; // Set green if 100 or more
                        cell.style.color = "black";
                    } */
                        const achievedCells = document.querySelectorAll(".data_achieved");
                        achievedCells.forEach(function (cell) {
                            const achievedValue = parseFloat(cell.textContent.replace('%', ''));
                        
                            // Create bar container and fill
                            const container = document.createElement("div");
                            container.className = "progress-container";
                        
                            const fill = document.createElement("div");
                            fill.className = "progress-fill";
                            fill.style.width = achievedValue + "%";
                        
                            // Color transitions from red to green
                            const red = achievedValue < 50 ? 255 : Math.round(255 - (achievedValue - 50) * 5.1);
                            const green = achievedValue > 50 ? 255 : Math.round(achievedValue * 5.1);
                            fill.style.backgroundColor = `rgb(${red}, ${green}, 100)`;
                        
                            fill.textContent = achievedValue + "%";
                        
                            container.appendChild(fill);
                            cell.textContent = "";           // Clear original cell text
                            cell.appendChild(container); 
                    
                });

            } catch (error) {
                console.error("Error parsing JSON data: ", error);
            }
        } else {
            console.error("Failed to fetch data: " + xhr.status);
        }
    };
    xhr.error = function () {
        console.error("Request error: An error occurred during the request.");
    };
    xhr.send();
}

// Set interval to update the table every second
setInterval(updateTableOutput, 1000);

// Initial data fetch when the page loads
window.onload = updateTableOutput;


