            
        document.addEventListener("DOMContentLoaded", () => {
            const updateBars = () => {
                // Step 1: Fetch totalPlan and totalCount
                fetch("/planner_fetch/planner_data.php")
                    .then(response => response.text())
                    .then(value => {
                        const [totalPlan, totalCount] = value.split(" ").map(Number);

                        // Step 2: Fetch downtime count
                        const downtimeCountPromise = fetch("tablePlanServer.php?action=get_downtime_total")
                            .then(res => res.json())
                            .then(data => data.total_time || 0)
                            .catch(() => 0);

                        // Step 3: Fetch downtime duration and compute total time
                        const downtimeDurationPromise = fetch("tablePlanServer.php?action=get_downtime_duration")
                            .then(res => res.json())
                            .then(data => {
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
                            .catch(() => "00:00:00");

                        // Step 4: Fetch product model name
                        const modelNamePromise = fetch("/planner_fetch/planner_data.php", {
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
            setInterval(updateBars, 1000);
        });


        document.addEventListener("DOMContentLoaded", () => {
            const barEndpoints = {
                "c7": "http://10.0.0.102/planner_fetch/planner_data.php",
                "c9": "http://10.0.0.136/planner_fetch/planner_data.php",
                "c9one": "http://10.0.0.125/planner_fetch/planner_data.php",
                "c10": "http://10.0.0.164/planner_fetch/planner_data.php"
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
                        // Get total_time value from JSON (not .length)
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
                                    <div>Status: <span style="color:green;">Online</span></div>
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

        function loadOverviewPlan() {
            fetch('tablePlanServer.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'get_by_plan_id_value' })
            })
            .then(res => res.json())
            .then(row => {
                if (!row) return;

                // Save plan globally
                window.currentPlan = row;

                const text = `
                    <div class="DOM-graphs-title">Daily Production Details</div>
                    <div class="overview-plan-data-container">
                        <div class="overview-plan-data">
                            <div class="overview-header-plan-data">
                                Plan for ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}
                            </div>

                            <div class="overview-plan-section" id="overview-information-title">Product Information</div>
                            <div class="overview-information">
                                <div><label>Part No:<br></label> ${row.part_no}</div>
                                <div><label>Model:<br></label> ${row.model}</div>
                                <div><label>Line:<br></label> ${row.line}</div>
                                <div><label>Delivery Date:<br></label> ${row.del_date}</div>
                                <div><label>Cycle Time As Of:<br></label> ${row.ct_as_of}</div>
                                <div><label>Expiration Date:<br></label> ${row.exp_date}</div>
                                <div><label>Man Power:<br></label> ${row.man_power}</div>
                                <div><label>Prod Hours:<br></label> ${row.prod_hrs}</div>
                            </div>

                            <div class="overview-plan-section" id="overview-time-title">Plan Output Per Hour</div>
                            <div class="overview-time-plan">
                                ${generatePlanGrid(row)}
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
                row.plan_1, row.plan_2, row.plan_3, row.plan_4,
                row.plan_5, row.plan_6, row.plan_7, row.plan_8,
                row.plan_9, row.plan_10, row.plan_11, row.plan_12,
                row.plan_13, row.plan_14
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

            fetch('tablePlanServer.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'get_countPerHr' })
            })
            .then(res => res.json())
            .then(countData => {
                const plans = [
                    window.currentPlan.plan_1, window.currentPlan.plan_2, window.currentPlan.plan_3, window.currentPlan.plan_4,
                    window.currentPlan.plan_5, window.currentPlan.plan_6, window.currentPlan.plan_7, window.currentPlan.plan_8,
                    window.currentPlan.plan_9, window.currentPlan.plan_10, window.currentPlan.plan_11, window.currentPlan.plan_12,
                    window.currentPlan.plan_13, window.currentPlan.plan_14
                ];

                const maxVal = Math.max(
                    ...countData.map(v => parseInt(v) || 0),
                    ...plans.map(p => parseInt(p) || 0)
                ) || 1;

                const graphHeight = 150; // in vh
                const bars = document.querySelectorAll('#achieved-per-hr .achieved-bar');

                bars.forEach((bar, i) => {
                    const numericVal = parseInt(countData[i]) || 0;
                    const barHeight = (numericVal / maxVal) * graphHeight;
                    const color = numericVal >= (parseInt(plans[i]) || 0) ? "#28a745" : "#007bff";

                    bar.style.height = barHeight + 'px';
                    bar.style.backgroundColor = color;
                    bar.querySelector('.achieved-bar-value').textContent = numericVal;
                });
            })
            .catch(err => console.error('Error updating bar heights:', err));
        }

        function updateDowntimeBars() {
            fetch('tablePlanServer.php', {
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
            fetch('tablePlanServer.php', {
                method: 'POST',
                body: new URLSearchParams({ action: 'get_by_plan_id_value' })
            })
            .then(res => res.json())
            .then(row => {
                if (!row) return;

                window.currentPlan = row;

                // Update Product Info
                const infoHTML = `
                    <div><label>Part No:<br></label> ${row.part_no}</div>
                    <div><label>Model:<br></label> ${row.model}</div>
                    <div><label>Line:<br></label> ${row.line}</div>
                    <div><label>Delivery Date:<br></label> ${row.del_date}</div>
                    <div><label>Cycle Time As Of:<br></label> ${row.ct_as_of}</div>
                    <div><label>Expiration Date:<br></label> ${row.exp_date}</div>
                    <div><label>Man Power:<br></label> ${row.man_power}</div>
                    <div><label>Prod Hours:<br></label> ${row.prod_hrs}</div>
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