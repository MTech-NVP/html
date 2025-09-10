function updateTableData() {
    let i = 0;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "downtime_table_server.php", true);
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            try {
                const data = JSON.parse(xhr.responseText);
                const tableBody = document.querySelector("#downtime_data_table tbody");
                tableBody.innerHTML = ""; // Clear existing data

                data.forEach(function (row) {
                    const tr = document.createElement("tr");
                    i++;
                    tr.innerHTML = `
                        <td>${row.time_occur}</td>
                        <td>${row.process}</td>
                        <td>${row.details}</td>
                        <td>${row.Act}</td>
                        <td>${row.time_Elapse}</td>
                        <td>${row.Pics}</td>
                        <td>${row.remark}</td>
                    </tr>`;
                    tableBody.appendChild(tr);
                });
            } catch (error) {
                console.error("Error parsing JSON data: ", error);
            }
        } else {
            console.error("Failed to fetch data: " + xhr.status);
        }
    };
    xhr.onerror = function () {
        console.error("Request error: An error occurred during the request.");
    };
    xhr.send();
}

// Set interval to update the table every second
setInterval(updateTableData, 1000);

// Initial data fetch when the page loads
window.onload = updateTableData;

