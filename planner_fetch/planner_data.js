    
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
                        bar.style.transition = "width 3s ease, background 0.5s ease";
                        bar.style.width = targetWidth + "%";

                        // Change bar color
                        if (targetWidth >= 100) {
                            bar.style.background = "#2E7D32"; // green
                        } else {
                            bar.style.background = "#006ee4"; // blue
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
    setInterval(updateBars, 5000); // optional refresh every 5 seconds
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

