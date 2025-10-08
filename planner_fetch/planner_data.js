    
    
    document.addEventListener("DOMContentLoaded", () => {
        const updateBars = () => {
            fetch("/planner_fetch/planner_data.php")
                .then(response => response.text())
                .then(value => {
                    // PHP returns "totalPlan totalCount"
                    const [totalPlan, totalCount] = value.split(" ").map(Number);

                    const bars = document.querySelectorAll(".bar");
                    bars.forEach(bar => {
                        // Check if previous element (the label) is C4
                        if (bar.previousElementSibling && bar.previousElementSibling.textContent.trim() === "C4") {
                            // Calculate percentage width
                            const targetWidth = Math.round((totalCount / totalPlan) * 100);

                            bar.setAttribute("data-width", totalPlan); // 100% = totalPlan
                            bar.textContent = totalCount; // display totalCount as text

                            // Animate smoothly
                            bar.style.transition = "width 0.5s ease, background 0.5s ease";
                            bar.style.width = targetWidth + "%";

                            // Color change based on percentage
                            if (targetWidth >= 100) {
                                bar.style.background = "#2E7D32"; // green
                            } else {
                                bar.style.background = "#006ee4"; // yellow
                            }
                        }
                    });
                });
    };

        // Initial update
        updateBars();

        // Update every 5 seconds (adjust as needed)
        setInterval(updateBars, 5000);
    });

    document.addEventListener("DOMContentLoaded", () => {
    // Map each label to its PHP endpoint
    const barEndpoints = {
        "C7": "http://10.0.0.102/planner_fetch/planner_data.php",
        "C9": "http://10.0.0.136/planner_fetch/planner_data.php",
        "C9-1": "http://10.0.0.125/planner_fetch/planner_data.php",
        "C10": "http://10.0.0.164/planner_fetch/planner_data.php"
    };

    const updateBar = (label, url) => {
        fetch(url)
                .then(response => response.text())
                .then(value => {
                    const [totalPlan, totalCount] = value.split(" ").map(Number);

                    const bars = document.querySelectorAll(".bar");
                    bars.forEach(bar => {
                        if (bar.previousElementSibling && bar.previousElementSibling.textContent.trim() === label) {
                            const targetWidth = Math.round((totalCount / totalPlan) * 100);

                            bar.setAttribute("data-width", totalPlan); // 100% = totalPlan
                            bar.textContent = totalCount; // show totalCount

                            // Animate smoothly
                            bar.style.transition = "width 0.5s ease, background 0.5s ease";
                            bar.style.width = targetWidth + "%";

                            // Color based on percentage
                            bar.style.background = targetWidth >= 100 ? "#2E7D32" : "#006ee4";
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
