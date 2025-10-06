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
                                bar.style.background = "#FBC02D"; // yellow
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