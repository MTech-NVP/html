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
    
/*fullscreen, just open to use
    const fullscreenButton = document.getElementById('fullscreen-button');
    const fullscreenIcon = document.getElementById('fullscreen-icon');

    fullscreenButton.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen();
        } else {
            document.exitFullscreen();
        }
    }); 

    // Listen for fullscreen changes
document.addEventListener('fullscreenchange', () => {
    if (document.fullscreenElement) {
        fullscreenIcon.classList.add('fullscreen');
    } else {
        fullscreenIcon.classList.remove('fullscreen');
    }
});

asd*/

//LINE NAMES
////////////////////////////////////////////////////////////////

// 1️⃣ Fetch and display plan output
fetch('fetches1/domfetch.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=fetchPlanOutput'
})
.then(res => res.json())
.then(data => {
    // Display the data
    document.querySelector('#product-part h4:nth-child(2)').textContent = data.partnumber;
    const spans = document.querySelectorAll('#product-details span');
    spans[1].textContent = data.model;
    spans[3].textContent = data.deliverydate;
    spans[5].textContent = data.balance;
    spans[7].textContent = data.cycletime;
    spans[9].textContent = data.manpower;
    spans[11].textContent = data.cycletimeasof;
    spans[13].textContent = data.prodhrs;
    spans[15].textContent = data.expirationdate;

    // 2️⃣ After displaying, call the new action to update the summary table
    return fetch('fetches1/domfetch.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=updateSummary' // <-- this is your new PHP action
    });
})
.then(res => res.json())
.then(resp => {
    console.log('Summary table updated:', resp);
})
.catch(err => {
    console.error('Error:', err);
});


////////////////////////////////////////////////////////////////
// PRODUCTION AND DOWNTIME GRAPH
document.addEventListener("DOMContentLoaded", () => {
    /*** FIRST GRAPH (Vertical) ***/
    const container1 = document.getElementById("graph");
    const startHour = 6;

    // Initialize graph bars and labels
    function initializeGraph(length) {
        const format = h => String(h).padStart(2, "0") + ":00";
        const labels = Array.from({ length }, (_, i) => {
            const start = startHour + i;
            const end = start + 1;
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
    function updateGraph(data, planData) {
        const bars = container1.querySelectorAll(".bar");
        const max = Math.max(...data, 1); // avoid division by 0
        const minVisible = 1; // height for zero bars

        // Find the last index that has either actual_output or plan_output > 0
        let lastNonZeroIndex = -1;
        data.forEach((v, i) => {
            if (v > 0 || (planData[i] || 0) > 0) lastNonZeroIndex = i;
        });

        bars.forEach((bar, i) => {
            const actual = data[i] || 0;
            const plan = planData[i] || 0;
            const barWrap = bar.parentElement.parentElement;

            if (i > lastNonZeroIndex) {
                // hide bars after the last non-zero
                barWrap.style.display = "none";
            } else {
                barWrap.style.display = ""; // visible

                const height = actual === 0 ? minVisible + "%" : (actual / max * 100) + "%";

                // Determine color: green if actual === plan, else default color
                const color = actual === plan && actual !== 0 ? "#4caf50" : "red";
                bar.style.backgroundColor = color;

                setTimeout(() => {
                    bar.style.height = height;

                    const val = bar.querySelector(".bar-value");
                    val.textContent = actual;
                    val.style.opacity = actual === 0 ? 0 : 1;
                }, i * 100);
            }
        });
    }

    ////////////////////////////////////////////////////////////////

    /*** 🔹 SECOND GRAPH (Horizontal Downtime) ***/
    let firstLoad = true;

    // Helper: convert "HH:MM:SS" or "MM:SS" or "SS" to seconds
    function timeToSeconds(timeStr) {
        const parts = timeStr.split(":").map(Number);
        if (parts.length === 3) return parts[0] * 3600 + parts[1] * 60 + parts[2];
        if (parts.length === 2) return parts[0] * 60 + parts[1];
        if (parts.length === 1) return parts[0];
        return 0;
    }

        // =========================================
        // NEW FUNCTION – INITIAL GRAPH ANIMATION
        // =========================================
    function initializeDowntimeAnimation(data) {
        const bars2 = document.querySelectorAll("#downtime-graph .bar2");
        const data2 = data.map(row => timeToSeconds(row.dt_mins));
        const max2 = Math.max(...data2, 1);

        const grid = document.getElementById("downtime-graph");

        // ===== Compute visible rows (same as update) =====
        let lastNonZeroIndex = -1;
        data2.forEach((v, i) => { if (v > 0) lastNonZeroIndex = i; });

        const visibleBars = [];

        bars2.forEach((bar, i) => {
            const wrap = bar.parentElement.parentElement;

            if (i <= lastNonZeroIndex) {
                wrap.style.display = "";
                visibleBars.push(wrap);
            } else {
                wrap.style.display = "none";
            }
        });

        // If nothing visible

        // Initialize grid sizing
        grid.style.display = "grid";
        const numRows = Math.ceil(visibleBars.length / 2);
        grid.style.gridTemplateRows = `repeat(${numRows}, auto)`;

        // ===== Animate bars =====
        const baseDelay = 300;
        bars2.forEach((bar, i) => {
            const value = data2[i] ?? 0;
            const widthPercent = (value / max2) * 100;
            bar.dataset.width = widthPercent + "%";

            // Build text
            let timeText = "";
            if (value < 60) timeText = `${value}s`;
            else if (value < 3600) timeText = `${Math.floor(value / 60)}m ${value % 60}s`;
            else {
                const h = Math.floor(value / 3600);
                const m = Math.floor((value % 3600) / 60);
                const s = value % 60;
                timeText = `${h}h ${m}m ${s}s`;
            }

            // Apply into span
            bar.textContent = "";
            let valSpan = bar.querySelector(".bar-value2");
            if (!valSpan) {
                valSpan = document.createElement("span");
                valSpan.className = "bar-value2";
                bar.appendChild(valSpan);
            }
            valSpan.textContent = timeText;
            valSpan.style.opacity = 0;

            // Reset to start
            bar.style.width = "0";

            // Animate staggered
            setTimeout(() => {
                bar.style.transition = "width 1.2s ease";
                bar.style.width = bar.dataset.width;
                valSpan.style.transition = "opacity 0.8s ease";
                valSpan.style.opacity = 1;
            }, baseDelay + i * 150);

        });
    }

    // =========================================
    // UPDATE FUNCTION – ONLY WIDTH/DISPLAY/GRID
    // =========================================
    function updateDowntimeGraph(data) {
        const bars2 = document.querySelectorAll("#downtime-graph .bar2");
        const data2 = data.map(row => timeToSeconds(row.dt_mins));

        const grid = document.getElementById("downtime-graph");
        const noDowntime = document.getElementById("no-downtime");

        // Find last non-zero value
        let lastNonZeroIndex = -1;
        data2.forEach((v, i) => { if (v > 0) lastNonZeroIndex = i; });

        const visibleBars = [];
        let hiddenCount = 0;

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

        // ===== Show "no downtime" if nothing visible =====
        if (visibleBars.length === 0) {
            grid.style.display = "none";
            noDowntime.style.display = "flex";
            //console.log("No downtime to display. Grid hidden.");
            return;
        } else {
            grid.style.display = "grid";
            noDowntime.style.display = "none";
        }

        // ===== Adjust grid rows dynamically =====
        const numRows = Math.ceil(visibleBars.length / 2);
        grid.style.gridTemplateRows = `repeat(${numRows}, auto)`;

        console.log(
            "Visible bars:", visibleBars.length,
            "Hidden bars:", hiddenCount,
            "Grid rows:", numRows
        );

        // ===== Update bar widths and time text =====
        const max2 = Math.max(...data2, 1);
        visibleBars.forEach((barWrap, i) => {
            const bar = barWrap.querySelector(".bar2");
            const value = data2[i] ?? 0;

            const widthPercent = (value / max2) * 100;
            bar.dataset.width = widthPercent + "%";
            bar.style.width = bar.dataset.width;

            // ===== Update time text =====
            let timeText = "";
            if (value < 60) timeText = `${value}s`;
            else if (value < 3600) timeText = `${Math.floor(value / 60)}m ${value % 60}s`;
            else {
                const hours = Math.floor(value / 3600);
                const minutes = Math.floor((value % 3600) / 60);
                const seconds = value % 60;
                timeText = `${hours}h ${minutes}m ${seconds}s`;
            }

            let valSpan = bar.querySelector(".bar-value2");
            if (!valSpan) {
                valSpan = document.createElement("span");
                valSpan.className = "bar-value2";
                bar.appendChild(valSpan);
            }
            valSpan.textContent = timeText;
        });
    }
    // =========================================
    // AJAX – FETCH AND UPDATE LOGIC
    // =========================================
    function fetchDowntimeData() {
        fetch('fetches1/domfetch.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'fetch' })
        })
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) return;

            if (firstLoad) {
                firstLoad = false;

                // Call pre-setup which updates output durations first
                preDowntimeSetup().then(() => {
                    // Once done, run the original animation
                    initializeDowntimeAnimation(data);
                });
            } else {
                preDowntimeSetup();
                updateDowntimeGraph(data); // Live updates
            }
        })
        .catch(err => console.error("Failed to fetch downtime data:", err));
    }

    // New function that calls update_output_durations action
    function preDowntimeSetup() {
        return fetch('fetches1/domfetch.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'update_output_durations' })
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                //console.log("Updated OutputTable data:", result.data);
            } else {
                console.error("Failed to update OutputTable:", result.error);
            }
        })
        .catch(err => console.error("Error in preDowntimeSetup:", err));
    }

    fetchDowntimeData();
    setInterval(fetchDowntimeData, 3000);

    /////////////////////////////////////////////////////////////////////

    function fetchGraphData() {
        fetch('fetches1/domfetch.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'fetch' })
        })
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) return;

            const actualOutputData = data.map(row => Number(row.actual_output) || 0);
            const planOutputData = data.map(row => Number(row.plan_output) || 0);

            if (container1.children.length === 0) {
                initializeGraph(actualOutputData.length);
                setTimeout(() => updateGraph(actualOutputData, planOutputData), 100);
            } else {
                updateGraph(actualOutputData, planOutputData);
            }
        })
        .catch(err => console.error(err));
    }

    fetchGraphData();
    setInterval(fetchGraphData, 3000);
});

////////////////////////////////////////////////////////////////
let percentage = 0; // current displayed percentage

function updatePie(percent) {
    const pie = document.querySelector('#pie-graphs');
    const text = document.querySelector('.pie-text');

    const color = percent >= 100 ? '#4caf50' : '#ffeb3b';
    pie.style.setProperty('--color', color);
    pie.style.setProperty('--percent', percent);
    text.textContent = percent + '%';
}

function animatePie(targetPercentage) {
    if (percentage < targetPercentage) {
        percentage++;
        updatePie(percentage);
        requestAnimationFrame(() => animatePie(targetPercentage));
    } else if (percentage > targetPercentage) {
        // optional: animate down if needed
        percentage--;
        updatePie(percentage);
        requestAnimationFrame(() => animatePie(targetPercentage));
    }
}

function updatePieChart() {
    fetch('fetches1/domfetch.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'fetchTotals' })
    })
    .then(res => res.json())
    .then(data => {
        if (!data || data.percentage === undefined) return;

        animatePie(data.percentage);
    })
    .catch(err => console.error(err));
}

updatePieChart();
setInterval(updatePieChart,3000);

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

function updateTable() {
    fetch('fetches1/domfetch.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'fetch' })
    })
    .then(res => res.json())
    .then(data => {
        if (!data || data.length === 0) return;

        const table = document.getElementById('quota-data-table');
        const rows = table.querySelectorAll('tr');

        // --- Compute last active row index ---
        let lastDataIndex = -1;
        for (let d = 0; d < data.length; d++) {
            const row = data[d];
            const hasPlanOutput = row.plan_output && Number(row.plan_output) > 0;
            if (hasPlanOutput) lastDataIndex = d;
        }
        const activeRows = lastDataIndex + 1; // total number of active rows

        let cumulativeTotal = 0;
        const hourStart = 6; // first row = 6AM

        for (let i = 2; i < rows.length; i++) { // skip 2 header rows
            const dataIndex = i - 2;

            if (dataIndex > lastDataIndex) {
                rows[i].style.display = "none";
                const cells = rows[i].querySelectorAll('td');
                cells[6].textContent = 0; // cumulative total
                cells[9].textContent = "";
                continue;
            } else {
                rows[i].style.display = "";
            }

            const row = rows[i];
            const cells = row.querySelectorAll('td');
            const rowData = data[dataIndex] || {};

            const planOutput = Number(rowData.plan_output) || 0;
            const actualOutput = Number(rowData.actual_output) || 0;

            // --- Determine remark ---
            const rowHourStart = hourStart + dataIndex;
            const rowHourEnd = rowHourStart + 1;
            const now = new Date();
            const rowEndTime = new Date();
            rowEndTime.setHours(rowHourEnd, 0, 0, 0);

            let remarkText = "";
            if (planOutput === 0) {
                remarkText = "BREAK";
            } else if (now >= rowEndTime) {
                if (actualOutput > planOutput) remarkText = "EXCEEDED";
                else if (actualOutput === planOutput) remarkText = "COMPLETED";
                else remarkText = "INCOMPLETE";
            } else {
                remarkText = "ONGOING";
            }
            cells[9].textContent = remarkText;

            // --- Fill other cells ---
            cells[1].textContent = rowData.ct ?? '-';
            cells[2].textContent = rowData.mins ?? '-';
            cells[3].textContent = rowData.plan_output ?? '-';
            cells[4].textContent = rowData.actual_output ?? '-';

            const percent = planOutput > 0 ? Math.round((actualOutput / planOutput) * 100) : 0;
            const bar = cells[5].querySelector('.percent-bar-data');
            if (bar) {
                bar.textContent = percent + '%';
                bar.style.setProperty('--percent', percent);
                if (percent > 100) bar.style.background = `linear-gradient(to right, red ${percent}%, transparent 0)`;
                else if (percent === 100) bar.style.background = `linear-gradient(to right, #58ff58 ${percent}%, transparent 0)`;
                else bar.style.background = `linear-gradient(to right, yellow ${percent}%, transparent 0)`;
            }

            cumulativeTotal += actualOutput;
            cells[6].textContent = cumulativeTotal;
            if (rowData.id) {
                sendPercentToDB(rowData.id, percent);
                sendTotalToDB(rowData.id, cumulativeTotal);
                sendRemarksToDB(rowData.id, remarkText);
            }
            // --- Downtime ---
            const dtId = rowData.id;
            if (dtId) {
                fetch('fetches1/domfetch.php', {
                    method: 'POST',
                    body: new URLSearchParams({ action: 'get_downtime_count', dt_id: dtId })
                })
                .then(res => res.json())
                .then(downtimeData => {
                    const count = downtimeData.count ?? 0;
                    cells[7].textContent = count + ' | ' + (rowData.dt_mins ?? '-');
                })
                .catch(err => console.error(err));
            } else {
                cells[7].textContent = '0 | ' + (rowData.dt_mins ?? '-');
            }

            cells[8].textContent = rowData.ng_quantity ?? '-';
        }

        // --- Call updateOverview after table update ---
        updateOverview(activeRows);
        updateTimelyOutputs(activeRows);
        if (!editing) {
            fetchOutputs(activeRows);
        }
    })
    .catch(err => console.error(err));
}

updateTable();
setInterval(updateTable, 3000);


function loadPlanSummary() {
    fetch("fetches1/domfetch.php", {
        method: "POST",
        body: new URLSearchParams({ action: "fetchPlanSummary" })
    })
    .then(res => res.json())
    .then(data => {

        document.querySelector("#planned-summary-body").innerHTML = `
            <span>PLAN PRODUCTION HOURS:</span>
            <span>${data.prodhrs}</span>
            <span>PLAN OUTPUT:</span>
            <span>${data.total_plan_output}</span>
            <span>PLAN MANPOWER:</span>
            <span>${data.manpower}</span>
        `;
    })
    .catch(err => console.error(err));
}

loadPlanSummary();

function loadActualSummary() {
    fetch("fetches1/domfetch.php", {
        method: "POST",
        body: new URLSearchParams({ action: "fetchActualSummary" })
    })
    .then(res => res.json())
    .then(data => {

        document.querySelector("#actual-summary-body").innerHTML = `
            <span>ACTUAL PRODUCTION HOURS:</span>
            <span>${data.actual_prodhrs}</span>
            <span>ACTUAL OUTPUT:</span>
            <span>${data.total_actual_output}</span>
            <span>ACTUAL MANPOWER:</span>
            <span>${data.actual_manpower}</span>
        `;
    })
    .catch(err => console.error(err));
}

loadActualSummary();
setInterval(loadActualSummary,3000);

fetch("fetches1/domfetch.php", {
    method: "POST",
    body: new URLSearchParams({ action: "copyPlanMinutesToOutputTable" })
})
.then(res => res.json());
//.then(d => console.log(d));

function sendPercentToDB(rowId, percent) {

    fetch('fetches1/domfetch.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ id: rowId, percentage: percent })
    })
    .then(res => res.text())
        //.then(resp => console.log(resp))
        .catch(err => console.error(err));
}

function sendTotalToDB(id, total){
    fetch('fetches1/domfetch.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'updateTotal', id, total })
    })
    .catch(err => console.error(err));
}

function sendRemarksToDB(id, remarks) {
    fetch('fetches1/domfetch.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'updateRemarksRow',
            id: id,
            remarks: remarks
        })
    });
}

function updateOverview(activeRows) {
    if (activeRows === undefined || activeRows <= 0) return;

    fetch('fetches1/domfetch.php', {
        method: 'POST',
        body: new URLSearchParams({ 
            action: 'totalng',
            activeRows: activeRows
        })
    })
    .then(res => res.json())
    .then(data => {
        //console.log("SUMMARY DATA:", data); // ✅ DEBUG

        if (!data) return;

        const overview = document.getElementById('overview-container');
        const spans = overview.querySelectorAll("span");

        spans[1].textContent = data.breaktime      || "-"; // ✅ BREAKTIME
        spans[3].textContent = data.totaldowntime || "-"; // ✅ TOTAL DOWNTIME (FIXED)
        spans[5].textContent = data.good_qty      || "-"; // ✅ GOOD QTY (FIXED)
        spans[7].textContent = data.total_ng      || "-"; // ✅ TOTAL NG
    })
    .catch(err => console.error(err));
}



loadProdStaff();

function loadProdStaff() {
    const container = document.getElementById("prod-staff");
    container.innerHTML = ""; // clear previous staff

    // 1️⃣ Fetch staff JSON (names, title, id)
    fetch("fetches1/domfetch.php?action=fetchProdStaff")
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                container.innerHTML = "<p>No staff available</p>";
                return;
            }

            data.forEach(staff => {
                // Combine first + middle name
                const fullFirstName = staff.fn + (staff.mn ? " " + staff.mn : "");

                // Create staff HTML
                const staffDiv = document.createElement("div");
                staffDiv.className = "person-details";

                // Picture box
                const pictureBox = document.createElement("div");
                pictureBox.className = "picture-box";

                const img = document.createElement("img");
                // Set the src to the separate PHP action for raw image
                img.src = `fetches1/domfetch.php?action=fetchProdStaffPicture&id=${staff.id}`;
                img.width = 72;
                img.height = 72;
                img.alt = "wala?";

                pictureBox.appendChild(img);

                // Infos
                const infos = document.createElement("div");
                infos.className = "infos";

                const nameDiv = document.createElement("div");
                nameDiv.className = "name";
                nameDiv.innerHTML = `<span>${staff.ln}</span><span>${fullFirstName}</span>`;

                const titleDiv = document.createElement("div");
                titleDiv.className = "person-title";
                titleDiv.textContent = staff.title;

                infos.appendChild(nameDiv);
                infos.appendChild(titleDiv);

                // Append to staffDiv
                staffDiv.appendChild(pictureBox);
                staffDiv.appendChild(infos);

                // Append staffDiv to container
                container.appendChild(staffDiv);
            });
        })
        .catch(err => console.error("Error loading staff:", err));
}

LineLeader();

function LineLeader(){
    fetch("fetches1/domfetch.php?action=fetchLineLeader")
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.warn(data.error);
                return;
            }

            // Combine first + middle name
            const fullFirstName = data.fn + (data.mn ? " " + data.mn : "");
            document.getElementById("ll-fn").textContent = fullFirstName;
            document.getElementById("ll-ln").textContent = data.ln;
            document.getElementById("ll-title").textContent = data.title;
        })
        .catch(err => console.error("Error fetching line leader:", err));

    // Fetch picture separately
    document.getElementById("ll-picture").src = "fetches1/domfetch.php?action=fetchLineLeaderPicture";
}

const editBtn = document.getElementById("edit-btn");
const settingsOverlay = document.getElementById("settings-overlay");

// Open modal
editBtn.addEventListener("click", () => {
    settingsOverlay.classList.add("active");
});


const buttonsset = document.querySelectorAll('.btns-form button');

buttonsset.forEach(btn => {
    btn.addEventListener('click', () => {
        buttonsset.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});

function resetDataHandlingSections() {
    const sections = document.querySelectorAll('.data-handlers');
    const selectionView = document.getElementById('data-handling-selection');

    // Hide all sections
    sections.forEach(section => section.style.display = 'none');
    // Show selection view
    selectionView.style.display = 'block';
}

function showDataHandling() {
    resetDataHandlingSections(); // reset first
    document.getElementById('data-handling-container').style.display = 'block';
    document.getElementById('generalization-container').style.display = 'none';
}

function showGeneralization() {
    resetDataHandlingSections(); // reset first
    document.getElementById('data-handling-container').style.display = 'none';
    document.getElementById('generalization-container').style.display = 'block';
}

const buttonsedit = document.querySelectorAll('.edits');
const sections = document.querySelectorAll('.data-handlers');
const selectionView = document.getElementById('data-handling-selection');

// Show sections
buttonsedit.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        selectionView.style.display = 'none'; // hide selection
        sections.forEach(section => section.style.display = 'none'); // hide all
        sections[index].style.display = 'block'; // show clicked
    });
});

// Back buttons inside sections
const backBtns = document.querySelectorAll('.back-btn');
backBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        sections.forEach(section => section.style.display = 'none'); // hide all sections
        selectionView.style.display = 'block'; // show button selection
    });
});


//////////////////////////    EDIT OUTPUT DAILY /////////////////////////////
function updateTimelyOutputs(activeRows) {
    const outputs = document.querySelectorAll('#timely-outputs .outputs');

    outputs.forEach((div, index) => {
        if (index < activeRows) {
            div.style.display = "flex";   // show only needed
        } else {
            div.style.display = "none";    // hide the rest

            // Optional: clear hidden inputs
            const input = div.querySelector('input');
            if (input) input.value = "";
        }
    });
}

let activeInput = null;

// Track last focused input
document.querySelectorAll('#timely-outputs input').forEach(input => {
    input.addEventListener('focus', () => {
        activeInput = input;
    });
});

const keys = document.querySelectorAll('#keypad .key');

keys.forEach(key => {
    key.addEventListener('click', () => {
        if (!activeInput) return; // no input selected

        const keyVal = key.textContent;

        if (keyVal === '←') {
            activeInput.value = activeInput.value.slice(0, -1);
        } 
        else if (keyVal === 'C') {
            activeInput.value = '';
        } 
        else {
            activeInput.value += keyVal;
        }

        activeInput.focus();
    });
});

let editing = false;

// --- FETCH OUTPUTS ---
function fetchOutputs(activeRows) {
    if (editing) return; // do not overwrite while editing

    fetch('fetches1/domfetch.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=fetch_outputs&activeRows=${activeRows}`
    })
    .then(res => res.json())
    .then(data => {
        data.forEach((row, index) => {
            const inputId = index + 6; // now starts from 1
            const input = document.getElementById(inputId);
            if (input) input.value = row.actual_output;
        });
    })
    .catch(err => console.error('Fetch Error:', err));
}

// --- EDIT / CONFIRM / CANCEL ---
document.addEventListener('DOMContentLoaded', () => {
    const editBtn = document.getElementById('edit-output');
    const confirmBtn = document.getElementById('confirm-output');
    const cancelBtn = document.getElementById('cancel-output');
    const inputs = document.querySelectorAll('#timely-outputs input');

    // Initial state
    confirmBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
    inputs.forEach(input => input.readOnly = true);

    // --- EDIT BUTTON ---
    editBtn.addEventListener('click', () => {
        editing = true;
        editBtn.style.display = 'none';
        confirmBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
        inputs.forEach(input => input.readOnly = false);
        inputs[0].focus();
    });

    // --- CANCEL BUTTON ---
    cancelBtn.addEventListener('click', () => {
        editing = false;
        editBtn.style.display = 'inline-block';
        confirmBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        inputs.forEach(input => input.readOnly = true);

        const activeRows = inputs.length;
        fetchOutputs(activeRows);
    });

    // --- CONFIRM BUTTON ---
    confirmBtn.addEventListener('click', () => {
        // --- Ask user for confirmation ---
        const proceed = confirm("Are you sure you want to save the changes?");
        if (!proceed) return; // stop if user cancels

        const data = {};
        inputs.forEach((input, index) => {
            const inputId = index + 1; // start from 1
            data[inputId] = input.value;
        });

        console.log('Data to send:', data); // inspect before sending

        fetch('fetches1/domfetch.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=update_outputs&data=${encodeURIComponent(JSON.stringify(data))}`
        })
        .then(res => res.json())
        .then(resp => {
            console.log('Server response:', resp); // inspect response
            if (resp.success) {
                alert('Data saved successfully!');
                editing = false;
                editBtn.style.display = 'inline-block';
                confirmBtn.style.display = 'none';
                cancelBtn.style.display = 'none';
                inputs.forEach(input => input.readOnly = true);
            } else {
                alert('Error saving data.');
            }
        })
        .catch(err => console.error('Save Error:', err));
    });
});
/////////////////////////////////////////////////////////////////////////



// Close modal
function closeSettings() {
    settingsOverlay.classList.remove("active");

    // Reset sections and selection view
    resetDataHandlingSections();
    // Hide both main containers
}








