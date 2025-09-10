 fetch('../src/controller/server_lineleader.php')
        .then(response => response.json())
        .then(data => {
            // Dropdown IDs and corresponding selected data containers
            const dropdowns = [
                { dropdownId: 'dropdown-line-leader', imageId: 'selected-image-leader' }
            ];

            dropdowns.forEach(({ dropdownId, imageId, nameId }) => {
                const dropdown = document.getElementById(dropdownId);
                const optionsContainer = dropdown.querySelector('.dropdown-options-leader');
                const selectedImage = document.getElementById(imageId);
               
          

                // Populate dropdown options
                data.forEach(item => {
                    const option = document.createElement('div');
                    option.innerHTML = `<img src="data:image/jpeg;base64,${item.img_leader}"/> ${item.name_leader}`;
                    option.addEventListener('click', () => {
                        // Set selected value in the dropdown
                        dropdown.firstChild.nodeValue = item.name_leader;

                        // Display selected data
                        selectedImage.src =` data:image/jpeg;base64,${item.img_leader}`;
                        selectedImage.style.display = 'block';
                     

                        // Update certifications
                  

                        // Hide dropdown options
                        optionsContainer.style.display = 'none';
                    });
                    optionsContainer.appendChild(option);
                });

                // Toggle dropdown visibility
                dropdown.addEventListener('click', () => {
                    const isVisible = optionsContainer.style.display === 'block';
                    optionsContainer.style.display = isVisible ? 'none' : 'block';
                });

                // Hide options when clicking outside
                document.addEventListener('click', (event) => {
                    if (!dropdown.contains(event.target)) {
                        optionsContainer.style.display = 'none';
                    }
                });
            });

        })
        .catch(error => console.error('Error fetching data:', error));

