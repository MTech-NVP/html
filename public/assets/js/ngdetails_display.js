    function ngtableDetails() {
    let i = 0;
    var xhr = new XMLHttpRequest();
            xhr.open("GET", "ngdetailsServer.php", true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    var tableBody = document.querySelector("#ng_data tbody");
                    tableBody.innerHTML = "";  // Clear existing data           
                    data.forEach(function(row) {
                        var tr = document.createElement("tr");
                        i++; 
                        tr.innerHTML = `
                            <td style = "border:1px solid #3664FF;">${i}</td>
                            <td style = "border:1px solid #3664FF;">${row.time_txt}</td>
                            <td style = "border:1px solid #3664FF;">${row.ngqtys}</td>
                            <td style = "border:1px solid #3664FF;">${row.ngtype1}</td>
                            <td style = "border:1px solid #3664FF;">${row.ngtype2}</td>
                            <td style = "border:1px solid #3664FF;">${row.ngtype3}</td>
         
                        `;
                        tableBody.appendChild(tr);
		        tableBody.style = 'background-color:white;'
                    });
                } else {
                    console.error("Failed to fetch data: " + xhr.status);
                }
            };
            xhr.send();
        }

        setInterval(ngtableDetails, 1000);

        // Initial data fetch when the page loads
        window.onload = ngtableDetails;
