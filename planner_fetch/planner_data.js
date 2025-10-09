    
document.addEventListener("DOMContentLoaded", () => {
    const updateBars = () => {
        fetch("/planner_fetch/planner_data.php")
            .then(response => response.text())
            .then(value => {
                // PHP returns "totalPlan totalCount"
                const [totalPlan, totalCount] = value.split(" ").map(Number);

                // Loop through all .bar-container elements
                const barContainers = document.querySelectorAll(".bar-container");

                barContainers.forEach(container => {
                    const label = container.querySelector(".label");
                    const bar = container.querySelector(".bar");

                    // Check if this container is for C4
                    if (label && label.textContent.trim() === "C4 Line:" && bar) {
                        const targetWidth = Math.round((totalCount / totalPlan) * 100);

                        // Update bar visual
                        bar.setAttribute("data-width", targetWidth);
                        bar.textContent = totalCount;
                        bar.style.transition = "width 2s ease, background 2s ease";
                        bar.style.width = targetWidth + "%";

                        // Change bar color
                        if (targetWidth >= 100) {
                            bar.style.background = "#3fb045ff"; // green
                        } else {
                            bar.style.background = "#3092fbff"; // blue
                        }

                        // Update info section inside the same parent container
                        const info = container.parentElement.querySelector("#c4-info");
                        if (info) {
                            info.innerHTML = `
                                <div>Product Model: YDB</div>
                                <div>Quota per day: <strong>${totalPlan}</strong></div>
                                <div>Percentage: <strong>${targetWidth}%</strong></div>
                            `;
                        }
                    }
                });
            })
            .catch(err => console.error("Error fetching data:", err));
    };

    // Run once on load, and every few seconds after if needed
    updateBars();
    loadOverviewPlan();
    setInterval(updateBars, 1000); // optional refresh every 5 seconds
});

document.addEventListener("DOMContentLoaded", () => {
    // Map each label to its PHP endpoint
    const barEndpoints = {
        "C7 Line:": "http://10.0.0.102/planner_fetch/planner_data.php",
        "C9 Line:": "http://10.0.0.136/planner_fetch/planner_data.php",
        "C9-1 Line:" : "http://10.0.0.125/planner_fetch/planner_data.php",
        "C10 Line:": "http://10.0.0.164/planner_fetch/planner_data.php"
    };

    const updateBar = (label, url) => {
        fetch(url)
            .then(response => response.text())
            .then(value => {
                const [totalPlan, totalCount] = value.split(" ").map(Number);

                // Find the correct bar container by label
                const containers = document.querySelectorAll(".bar-container");
                containers.forEach(container => {
                    const labelElement = container.querySelector(".label");
                    const bar = container.querySelector(".bar");

                    if (labelElement && labelElement.textContent.trim() === label && bar) {
                        const targetWidth = Math.round((totalCount / totalPlan) * 100);

                        // Set data attributes and text
                        bar.setAttribute("data-width", totalPlan);
                        bar.textContent = totalCount;

                        // Animate smoothly
                        bar.style.transition = "width 0.5s ease, background 0.5s ease";
                        bar.style.width = targetWidth + "%";

                        // Change color based on percentage
                        bar.style.background = targetWidth >= 100 ? "#2E7D32" : "#006ee4";

                        // Update info section dynamically (e.g., #c7-info)
                        const info = document.querySelector(`#${label.toLowerCase().replace("-", "")}-info`);
                        if (info) {
                            info.innerHTML = `
                                <div>Product Model: </div>
                                <div>Quota per day: <strong>${totalPlan}</strong></div>
                                <div>Percentage: <strong>${targetWidth}%</strong></div>
                            `;
                        }
                    }
                });
            })
            .catch(err => console.error(`Error fetching ${label}:`, err));
    };

    const updateBars = () => {
        for (const [label, url] of Object.entries(barEndpoints)) {
            updateBar(label, url);
        }
    };

    // Initial update
    updateBars();

    // Update every 5 seconds
    setInterval(updateBars, 5000);
});


function loadOverviewPlan() {
    fetch('tablePlanServer.php', {
        method: 'POST',
        body: new URLSearchParams({ action: 'read' })
    })
    .then(res => res.json())
    .then(data => {
        if (!data || data.length === 0) return;

        const row = data[0]; // show only first plan
        let text = `
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
                        <div><label>CT As Of:<br></label> ${row.ct_as_of}</div>
                        <div><label>Expected Date:<br></label> ${row.exp_date}</div>
                        <div><label>Man Power:<br></label> ${row.man_power}</div>
                        <div><label>Prod Hours:<br></label> ${row.prod_hrs}</div>                            
                    </div>

                    <div class="overview-plan-section" id="overview-time-title">Plan Output Per Hour</div>

                    <div class="overview-time-plan">
                    ${(() => {
                        const plans = [
                            row.plan_1, row.plan_2, row.plan_3, row.plan_4,
                            row.plan_5, row.plan_6, row.plan_7, row.plan_8,
                            row.plan_9, row.plan_10, row.plan_11, row.plan_12,
                            row.plan_13, row.plan_14
                        ];
                        const times = [
                            "6AM–7AM", "7AM–8AM", "8AM–9AM", "9AM–10AM",
                            "10AM–11AM", "11AM–12PM", "12PM–1PM", "1PM–2PM",
                            "2PM–3PM", "3PM–4PM", "4PM–5PM", "5PM–6PM",
                            "6PM–7PM", "7PM–8PM"
                        ];

                        // Function to handle value replacement
                        const formatValue = (val, time) => {
                            if (val === 0 || val === "0" || val === null) {
                                // Day shift → show BREAK
                                if (/(6AM|7AM|8AM|9AM|10AM|11AM|12PM|1PM|2PM|3PM|4PM|5PM|6PM)/.test(time) && !/6PM|7PM|8PM/.test(time)) {
                                    return "BREAK";
                                }
                                // Night shift → show N/A
                                if (/6PM|7PM|8PM/.test(time)) {
                                    return "N/A";
                                }
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
                                ${firstHalfPlans.map((p, i) => `<div class="value-cell">${formatValue(p, firstHalfTimes[i])}</div>`).join('')}
                                ${secondHalfTimes.map(t => `<div class="time-cell" id="timecell2">${t}</div>`).join('')}
                                ${secondHalfPlans.map((p, i) => `<div class="value-cell">${formatValue(p, secondHalfTimes[i])}</div>`).join('')}
                            </div>
                        `;
                    })()}
                    </div>

                </div>
            </div>
        `;
// <div id="achieved-per-hr">Loading actual count...</div>

        // 👇 Display inside #dom-overview-container
        document.getElementById('dom-overview-container').innerHTML = text;

        // ✅ Fetch countPerHr values and display them
        fetch('tablePlanServer.php', {
            method: 'POST',
            body: new URLSearchParams({ action: 'get_countPerHr' })
        })

        .then(res => res.json())
        .then(countData => {
            const times = [
                "6AM–7AM", "7AM–8AM", "8AM–9AM", "9AM–10AM",
                "10AM–11AM", "11AM–12PM", "12PM–1PM", "1PM–2PM",
                "2PM–3PM", "3PM–4PM", "4PM–5PM", "5PM–6PM",
                "6PM–7PM", "7PM–8PM"
            ];

            const achievedHTML = countData.map((val, i) => `
                <div class="overview-plan-item">
                    <label class="overview-time-label">${times[i] || '-'}:&nbsp;</label>
                    <span class="overview-plan-value">${val ?? '-'}</span>
                </div>
            `).join('');

            document.getElementById('achieved-per-hr').innerHTML = `
                <div class="overview-plan-section" id="overview-time-title">Actual Count Per Hour</div>
                <div class="overview-time-plan">${achievedHTML}</div>
            `;
        })
        .catch(err => {
            document.getElementById('achieved-per-hr').innerHTML = "Failed to load actual count.";
            console.error('Error loading countPerHr:', err);
        });
    })
    .catch(err => console.error('Error loading overview plan:', err));
}



