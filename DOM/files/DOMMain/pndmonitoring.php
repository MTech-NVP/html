<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/ico" href="../../media/icons/nichivi-logo.ico">
    <title>DOM | Tube Assembly</title>
    <link rel="stylesheet" href="pnddesign.css">
</head>
<body>

    <nav>
        <div id="nav-title">
            <div id="company">
                <div>
                    <img width="35" src="../../media/icons/nichivi_logo_white.png" alt="logo">
                </div>
                <div id="company-name-container">
                    <div id="company-name">
                        NICHIVI PHILIPPINES CORPORATION
                    </div>                    
                </div>                
            </div>

            <div id="line-nav"></div>
            <div id="site-title">
                <div>
                    DOM - PRODUCTION OUTPUT AND DOWNTIME MONITORING
                </div>
                <div id="production_line_name">
                    Loading...
                </div> 
            </div>
        </div>
        <button id="menu-toggle">☰</button>
        <div id="nav-buttons">
            <button class="nav-btns">
                Dashboard
            </button>
            <button class="nav-btns">
                History Data
            </button>
            <button class="nav-btns">
                SWP
            </button>
            <button class="nav-btns">
                Video Tutorial
            </button>
        </div>
    </nav>
    <div id="dashboard-container">
        
        <div id="details">
            <div id="details-container">
                <div id="product-container">
                    <div id="product-picture">
                        <img id="pic" width="200" height="100"  src="../../media/img/ahh.png"> 
                    </div> 
                    <div id="product">
                        <div id="product-part">
                            <h4>Part Number:</h4> &nbsp; <h4>-</h4>
                        </div>
                        <div id="product-details">  
                            <span>Model:</span> <span>-</span>
                            <span>Delivery Date:</span> <span>-</span>
                            <span>Balance:</span> <span>-</span>
                            <span>Cycle Time:</span> <span>-</span>
                            <span>Manpower:</span> <span>-</span>
                            <span>Cycle Time as of:</span> <span>-</span>
                            <span>Production Hours:</span> <span>-</span>
                            <span>Expiration Date:</span> <span>-</span>
                        </div>
                    </div>
                    <div id="">

                    </div>
                </div>
            </div>
        </div>

        <div id="center-contents">
            <div id="production-table">
                <div id="table-data-container" class="data-container">
                    <table id="quota-data-table" class="data-table">
                        <tr>
                            <th colspan="4" class="actual-title">PLAN</th>
                            <th colspan="6" class="actual-title">ACTUAL</th>
                        </tr>

                        <tr>
                            <th class="actual-header">TIME</th>
                            <th class="actual-header">CYCLE TIME</th>
                            <th class="actual-header">MINUTES</th>
                            <th class="actual-header">PLAN OUTPUT <br><span>(Per hour)</span></th>
                            <th class="actual-header">ACTUAL <br> OUTPUT</th>
                            <th class="actual-header">PERCENTAGE</th>
                            <th class="actual-header">TOTAL</th>
                            <th class="actual-header">DOWNTIME <br>(MINS)</th>
                            <th class="actual-header">NG <br> QUANTITY</th>
                            <th class="actual-header">REMARKS</th>  
                        </tr>

                        </tr>
                            <tr>
                                <td>06:00 - 07:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>07:00 - 08:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>08:00 - 09:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>09:00 - 10:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>10:00 - 11:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>11:00 - 12:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>12:00 - 13:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>13:00 - 14:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>14:00 - 15:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>15:00 - 16:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>16:00 - 17:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>17:00 - 18:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>18:00 - 19:00</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>
                                    <div class="percent-bar-data" data-percent="0">
                                        0%
                                    </div>
                                </td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                            <td>19:00 - 20:00</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <div class="percent-bar-data" data-percent="0">
                                    0%
                                </div>
                            </td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>   
                    </table>
                </div>        
            </div>
            <div id="graph-table">
                <div id="graph-table-container">
                    <div id="graph-header">
                        PRODUCTION GRAPH
                    </div>
                    <div id="graph"></div>

                    <!-- ✅ Legend Section -->
                    <div id="graph-legend">
                        <div class="legend-item">
                            <span class="legend-color green"></span>
                            <span class="legend-text">Target Reached</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color red"></span>
                            <span class="legend-text">Incomplete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="bottom-contents">
            <div id="btm-container">
                <div id="downtime-graph-container">
                    <div id="downtime-graph-header" class="bottom-header">DOWNTIME GRAPH (Per Hour)</div>

                    <div id="downtime-graph">
                        <!-- Times 06:00 to 19:00 -->
                        <div class="bar2-row" data-time="06:00">
                            <div class="time-label">06:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="07:00">
                            <div class="time-label">07:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="08:00">
                            <div class="time-label">08:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="09:00">
                            <div class="time-label">09:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="10:00">
                            <div class="time-label">10:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="11:00">
                            <div class="time-label">11:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="12:00">
                            <div class="time-label">12:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>


                        <div class="bar2-row" data-time="13:00">
                            <div class="time-label">13:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="14:00">
                            <div class="time-label">14:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="15:00">
                            <div class="time-label">15:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="16:00">
                            <div class="time-label">16:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="17:00">
                            <div class="time-label">17:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="18:00">
                            <div class="time-label">18:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>

                        <div class="bar2-row" data-time="19:00">
                            <div class="time-label">19:00</div>
                            <div class="bar-container2"><div class="bar2"></div></div>
                        </div>
                    </div>
                </div>


                <div id="summary">
                    <div id="summary-container">
                        <div id="plan-summary">
                            <div id="planned-summary-container">
                                <div id="planned-summary-header" class="bottom-header2">
                                    PLANNED SUMMARY
                                </div>
                                <div id="planned-summary-body" class="summary-body">
                                    <span>PLAN PRODUCTION HOURS:</span>
                                    <span>99.99</span>
                                    <span>PLAN OUTPUT:</span>
                                    <span>999</span>
                                    <span>PLAN MANPOWER:</span>
                                    <span>9</span>
                                </div>
                            </div>
                        </div>
                        <div id="actual-summary">
                            <div id="actual-summary-container">
                                <div id="actual-summary-header" class="bottom-header2">
                                    ACTUAL SUMMARY
                                </div>
                                <div id="actual-summary-body" class="summary-body">
                                    <span>ACTUAL PRODUCTION HOURS:</span>
                                    <span>99.99</span>
                                    <span>ACTUAL OUTPUT:</span>
                                    <span>999</span>
                                    <span>ACTUAL MANPOWER:</span>
                                    <span>9</span>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div id="overview-container">
                        <span>BREAKTIME:</span> <span>-</span>
                        <span>TOTAL DOWNTIME:</span> <span>-</span>
                        <span>GOOD QUANTITY:</span> <span>-</span>
                        <span>TOTAL NG:</span> <span>-</span>
                    </div>

                </div>

                <div id="pie-graph">
                    <div id="dandt">
                        <span id="time">--:-- --</span>
                        <span id="date">-- --, ----</span>
                    </div>

                    <div id="pie-graphs">
                        <div class="pie-text">0%</div>
                    </div>                        


                    <button id="save-btn">Save Data</button>
                </div>
            </div>
        </div>
    </div>

<!--
    <div id="data_container">
        <div id="output_container">
            <table id="actual_output_table">
                <thead>
                    <tr>
                        <th colspan="11"> <span>PRODUCTION MONITORING</span> <button class="button-81" role="button" onclick="showDown()">Downtime</button></th>

                    </tr>
                    <tr>
                        <th colspan="5">PLAN</th>
                        <th colspan="3">ACTUAL <button onclick="showEditform()">EDIT</button> </th>
                        <th> <button onclick="show_ng_form()">ADD</button> </th>
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
                <tbody style="font-size:15px;">

                </tbody>
            </table>
        </div>  -->


        <!--<div id="downtime_container">
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
        </div> -->


    </div>
    
</body>

<script>

    ////////////////////////////////////////////////////////////////
    //mobile version
    const menuToggle = document.getElementById('menu-toggle');
    const navButtons = document.getElementById('nav-buttons');

    menuToggle.addEventListener('click', (event) => {
        event.stopPropagation(); 
        navButtons.classList.toggle('active');
    });

    document.addEventListener('click', (event) => {
        const isClickInsideMenu = navButtons.contains(event.target);
        const isClickOnToggle = menuToggle.contains(event.target);

        if (!isClickInsideMenu && !isClickOnToggle) {
        navButtons.classList.remove('active');
        }
    });

    const buttons = document.querySelectorAll('.nav-btns');
    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
        navButtons.classList.remove('active');
        });
    });
    
    //mobile version
    ////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////
    // LINE NAMES
    const dashboardNames = {
        "10.0.0.189": "TUBE ASSEMBLY: C4 TUBE LINE",
        "10.0.0.102": "TUBE ASSEMBLY: C7 TUBE LINE",
        "10.0.0.136": "TUBE ASSEMBLY: C9 TUBE LINE",
        "10.0.0.125": "TUBE ASSEMBLY: C9-1 TUBE LINE",
        "10.0.0.164": "TUBE ASSEMBLY: C10 TUBE LINE",
        "localhost": "ADMINISTRATOR",
        "192.168.0.228": "TUBE ASSEMBLY: C4 TUBE LINE"
    }

    const currentIP = window.location.hostname;

    const dashboardTitle = dashboardNames[currentIP] || "PRODUCTION LINE";
    
    document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector("#production_line_name");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });
    //LINE NAMES
    ////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////
    // PRODUCTION AND DOWNTIME GRAPH
    document.addEventListener("DOMContentLoaded", () => {
        /*** FIRST GRAPH (Vertical) ***/
        const container1 = document.getElementById("graph");
        const startHour = 6;

        // Initialize graph bars and labels
        function initializeGraph(length) {
            const labels = Array.from({ length }, (_, i) => {
                const start = startHour + i;
                const end = start + 1;
                const format = h => String(h).padStart(2, "0") + ":00";
                return `${format(start)}-${format(end)}`;
            });

            for (let i = 0; i < length; i++) {
                const wrap = document.createElement("div");
                wrap.classList.add("bar-wrap");

                const barContainer = document.createElement("div");
                barContainer.classList.add("bar-container");

                const bar = document.createElement("div");
                bar.classList.add("bar");
                bar.style.height = "0%";
                bar.style.transition = "height 0.8s ease";

                const val = document.createElement("div");
                val.classList.add("bar-value");
                val.textContent = "0";
                val.style.opacity = 0; // hidden initially
                val.style.transition = "opacity 0.5s ease";

                bar.appendChild(val);
                barContainer.appendChild(bar);

                const label = document.createElement("div");
                label.classList.add("bar-label");
                label.textContent = labels[i];

                wrap.appendChild(barContainer);
                wrap.appendChild(label);
                container1.appendChild(wrap);
            }
        }

        // Update bars with new data
        function updateGraph(data) {
            const bars = container1.querySelectorAll(".bar");
            const max = Math.max(...data, 1); // avoid division by 0

            bars.forEach((bar, i) => {
                const value = data[i] || 0;

                // If value is 0 → hide the whole bar-wrap (grandparent)
                const barWrap = bar.parentElement.parentElement;
                if (value === 0) {
                    barWrap.style.display = "none"; // hide entire bar-wrap
                } else {
                    barWrap.style.display = ""; // make visible
                    const height = (value / max * 100) + "%";

                    setTimeout(() => {
                        bar.style.height = height;

                        const val = bar.querySelector(".bar-value");
                        val.textContent = value;
                        val.style.opacity = 1; // show the number
                    }, i * 100);
                }
            });
        }

        // Fetch data from PHP and update chart

        ////////////////////////////////////////////////////////////////


        /*** 🔹 SECOND GRAPH (Horizontal Downtime) ***/
        const bars2 = document.querySelectorAll("#downtime-graph .bar2");

            // Helper: convert "HH:MM:SS" or "MM:SS" or "SS" to total seconds
        function timeToSeconds(timeStr) {
            const parts = timeStr.split(":").map(Number);
            if (parts.length === 3) return parts[0] * 3600 + parts[1] * 60 + parts[2];
            if (parts.length === 2) return parts[0] * 60 + parts[1];
            if (parts.length === 1) return parts[0];
            return 0;
        }

        // Update downtime graph
        function updateDowntimeGraph(data) {
            const bars2 = document.querySelectorAll("#downtime-graph .bar2");
            const data2 = data.map(row => timeToSeconds(row.dt_mins));

            // Find last non-zero value
            let lastNonZeroIndex = -1;
            data2.forEach((v, i) => { if (v > 0) lastNonZeroIndex = i; });

            // Collect only visible bars and count hidden bars
            let hiddenCount = 0;
            const visibleBars = [];
            bars2.forEach((bar, i) => {
                const barWrap = bar.parentElement.parentElement;
                if (i <= lastNonZeroIndex) {
                    barWrap.style.display = "";
                    visibleBars.push(barWrap);
                } else {
                    barWrap.style.display = "none";
                    hiddenCount++;
                }
            });

            // If no visible bars, hide grid and return
            const grid = document.getElementById("downtime-graph");
            if (visibleBars.length === 0) {
                grid.style.display = "none";
                return;
            } else {
                grid.style.display = "grid";
            }

            // ===== FIX: Dynamically set grid-template-rows based only on visible bars =====
            const numRows = Math.ceil(visibleBars.length / 2); // 2 columns
            grid.style.gridTemplateRows = `repeat(${numRows}, auto)`;

            const max2 = Math.max(...data2, 1);

            // Update each visible bar
            visibleBars.forEach((barWrap, i) => {
                const bar = barWrap.querySelector(".bar2");
                const value = data2[i] ?? 0;
                const widthPercent = (value / max2) * 100;
                bar.dataset.width = widthPercent + "%";

                // Format time text
                let timeText = "";
                if (value < 60) timeText = `${value}s`;
                else if (value < 3600) timeText = `${Math.floor(value / 60)}m ${value % 60}s`;
                else {
                    const hours = Math.floor(value / 3600);
                    const minutes = Math.floor((value % 3600) / 60);
                    const seconds = value % 60;
                    timeText = `${hours}h ${minutes}m ${seconds}s`;
                }

                bar.textContent = ""; // removes raw text
                let valSpan = bar.querySelector(".bar-value2");
                if (!valSpan) {
                    valSpan = document.createElement("span");
                    valSpan.className = "bar-value2";
                    bar.appendChild(valSpan);
                }
                valSpan.textContent = timeText;
                valSpan.style.opacity = 0;

                
                // Animate
                bar.style.width = "0";
                setTimeout(() => {
                    bar.style.transition = "width 0.8s ease";
                    bar.style.width = bar.dataset.width;
                    valSpan.style.transition = "opacity 0.5s ease";
                    valSpan.style.opacity = 1;
                }, i * 150);
            });

            console.log("Visible bars:", visibleBars.length, "Hidden bars:", hiddenCount, "Grid rows:", numRows);
        }
        
        // Fetch dt_mins data from PHP
        function fetchDowntimeData() {
            fetch('fetches1/domfetch.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'fetch' })
            })
            .then(res => res.json())
            .then(data => {
                if (!data || data.length === 0) return;

                const data2 = data.map(row => timeToSeconds(row.dt_mins));

                // Find index of last value > 0
                let lastNonZeroIndex = -1;
                data2.forEach((v, i) => { if (v > 0) lastNonZeroIndex = i; });

                const bars = document.querySelectorAll("#downtime-graph .bar2");

                // If all zero → hide all bars
                if (lastNonZeroIndex === -1) {
                    bars.forEach(bar => bar.parentElement.parentElement.style.display = "none");
                    return;
                }

                const max2 = Math.max(...data2, 1);

                bars.forEach((bar, i) => {
                    const value = data2[i] ?? 0;
                    const barWrap = bar.parentElement.parentElement;

                    // Hide bars after last non-zero value
                    if (i > lastNonZeroIndex) {
                        barWrap.style.display = "none";
                        return;
                    }

                    // Show this bar
                    barWrap.style.display = "";

                    const widthPercent = (value / max2) * 100;
                    bar.dataset.width = widthPercent + "%";

                    // Format as time text
                    let timeText = "";
                    if (value < 60) timeText = `${value}s`;
                    else if (value < 3600) timeText = `${Math.floor(value / 60)}m ${value % 60}s`;
                    else {
                        const hours = Math.floor(value / 3600);
                        const minutes = Math.floor((value % 3600) / 60);
                        const seconds = value % 60;
                        timeText = `${hours}h ${minutes}m ${seconds}s`;
                    }

                    bar.textContent = timeText;
                    bar.style.width = "0"; // reset animation start
                });

                // Animate bars
                setTimeout(() => {
                    bars.forEach((bar, i) => {
                        if (i <= lastNonZeroIndex) {
                            setTimeout(() => {
                                bar.style.transition = "width 0.8s ease";
                                bar.style.width = bar.dataset.width;
                            }, i * 150);
                        }
                    });
                }, 100);
                updateDowntimeGraph(data);
            })
            .catch(err => console.error("Failed to fetch downtime data:", err));
        }

        fetchDowntimeData();
        //setInterval(fetchDowntimeData, 1000);
        
        /////////////////////////////////////////////////////////////////////
        function fetchGraphData() {
            fetch('fetches1/domfetch.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'fetch' })
            })
            .then(res => res.json())
            .then(data => {
                if (!data || data.length === 0) return;

                // --- Actual Output Graph ---
                const actualOutputData = data.map(row => Number(row.actual_output) || 0);

                if (container1.children.length === 0) {
                    initializeGraph(actualOutputData.length);

                    // Initial animation after DOM is ready
                    setTimeout(() => updateGraph(actualOutputData), 100);
                } else {
                    updateGraph(actualOutputData);
                }

            })
            .catch(err => console.error(err));
        }


        fetchGraphData();
        setInterval(fetchGraphData, 1000);
    });
    ////////////////////////////////////////////////////////////////

    function updatePie(percent) {
        const pie = document.querySelector('#pie-graphs');
        const text = document.querySelector('.pie-text');
        pie.style.setProperty('--percent', percent);
        text.textContent = percent + '%';
    }

    // Smoothly animate percentage to target
    let percentage = 0;
    const targetPercentage = 96;

    function animatePie() {
        if (percentage < targetPercentage) {
            percentage++;
            updatePie(percentage);
            requestAnimationFrame(animatePie); // smooth animation
        }
    }
    animatePie();

    // Live time and date
    function updateTimeDate() {
        const timeEl = document.getElementById('time');
        const dateEl = document.getElementById('date');
        const now = new Date();

        const hours = now.getHours() % 12 || 12;
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = now.getHours() >= 12 ? 'PM' : 'AM';
        timeEl.textContent = `${hours}:${minutes} ${ampm}`;

        const options = { month: 'long', day: 'numeric', year: 'numeric' };
        dateEl.textContent = now.toLocaleDateString('en-US', options);
    }

    setInterval(updateTimeDate, 1000);
    updateTimeDate();

    function updateTable(){
        fetch('fetches1/domfetch.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'fetch' })
        })
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) return;

            const table = document.getElementById('quota-data-table');
            const rows = table.querySelectorAll('tr');

            // Find last row index in data that has any value
            
            let lastDataIndex = -1;
            for (let d = 0; d < data.length; d++) {
                const row = data[d];

                // Check row data EXCLUDING `ct`
                const isEmpty =
                    (!row.mins || row.mins == 0) &&
                    (!row.plan_output || row.plan_output == 0) &&
                    (!row.actual_output || row.actual_output == 0) &&
                    (!row.percentage || row.percentage == 0 || row.percentage === "0%") &&
                    (!row.total || row.total == 0) &&
                    (!row.dt_mins || row.dt_mins === "00:00:00") &&
                    (!row.ng_quantity || row.ng_quantity == 0) &&
                    (!row.remarks || row.remarks.trim() === "");


                if (!isEmpty) {
                    lastDataIndex = d; // last row that actually has data
                }
            }

            // Skip first 2 header rows
            for (let i = 2; i < rows.length; i++) {

                // table row index mapped to data
                const dataIndex = i - 2;

                // If this row is beyond the last row with data → hide it
                if (dataIndex > lastDataIndex) {
                    rows[i].style.display = "none";
                    continue;
                } else {
                    rows[i].style.display = ""; // make sure visible
                }

                const row = rows[i];
                const cells = row.querySelectorAll('td');
                const rowData = data[dataIndex] || {};

                // (your existing cell filling code continues here)

                cells[1].textContent = rowData.ct ?? '-';
                cells[2].textContent = rowData.mins ?? '-';
                cells[3].textContent = rowData.plan_output ?? '-';
                cells[4].textContent = rowData.actual_output ?? '-';

                const bar = cells[5].querySelector('.percent-bar-data');
                const percent = rowData.percentage ?? 0;

                bar.textContent = percent + '%';
                bar.style.setProperty('--percent', percent);

                if (percent == 100) {
                    bar.style.background = `linear-gradient(
                        to right,
                        green calc(${percent} * 1%),
                        transparent 0
                    )`;
                } else {
                    bar.style.background = `linear-gradient(
                        to right,
                        yellow calc(${percent} * 1%),
                        transparent 0
                    )`;
                }

                cells[6].textContent = rowData.total ?? '-';
                cells[7].textContent = rowData.dt_mins ?? '-';
                cells[8].textContent = rowData.ng_quantity ?? '-';
                cells[9].textContent = rowData.remarks ?? '-';
            }

        })
        .catch(err => console.error(err));   
    }
    updateTable();
    setInterval(updateTable, 1000);


</script>

</html>