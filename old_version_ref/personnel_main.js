fetch('fetch_persons.php')
    .then(response => response.json())
    .then(data => {
        // Dropdown IDs and corresponding selected data containers
        const dropdowns = [
            { dropdownId: 'dropdown1', imageId: 'cert-img1', nameId: 'person-cert-name1', certId: 'certification-status1', selectedImageId: 'selected-image1', statusContainerId: 'status-cert1', nameContainerId: 'name_person1' },
            { dropdownId: 'dropdown2', imageId: 'cert-img2', nameId: 'person-cert-name2', certId: 'certification-status2', selectedImageId: 'selected-image2', statusContainerId: 'status-cert2', nameContainerId: 'name_person2' },
            { dropdownId: 'dropdown3', imageId: 'cert-img3', nameId: 'person-cert-name3', certId: 'certification-status3', selectedImageId: 'selected-image3', statusContainerId: 'status-cert3', nameContainerId: 'name_person3' }
        ];

        dropdowns.forEach(({ dropdownId, imageId, nameId, certId, selectedImageId, statusContainerId, nameContainerId }) => {
            const dropdown = document.getElementById(dropdownId);
            const optionsContainer = dropdown.querySelector('.dropdown-options');
            const testImage = document.getElementById(imageId);
            const selectedImage = document.getElementById(selectedImageId);
            const selectedName = document.getElementById(nameId);
            const certificationStatus = document.getElementById(certId);
            const statusContainer = document.getElementById(statusContainerId);
            const nameContainer = document.getElementById(nameContainerId);

            // Populate dropdown options
            data.forEach(item => {
                const option = document.createElement('div');
                option.innerHTML = `<img src="data:image/jpeg;base64,${item.img_data}" /> ${item.name_person}`;
                option.addEventListener('click', () => {
                    // Set selected value in the dropdown
                    dropdown.firstChild.nodeValue = item.name_person;

                    // Display selected data in the corresponding image and data fields
                    selectedImage.src = `data:image/jpeg;base64,${item.img_data}`;
                    selectedImage.style.display = 'block';
                    testImage.src = selectedImage.src;  // Update the test image as well
                    testImage.style.display = 'block';  // Make it visible
                    selectedName.textContent = item.name_person;

                    // Update certifications
                    const certifications = item.cert; // Assuming array like [1, 0, 1]
                    const certCircles = certificationStatus.querySelectorAll('.certification');
                    certCircles.forEach((circle, index) => {
                        if (certifications[index] === 1) {
                            circle.classList.add('achieved'); // Green for achieved
                        } else {
                            circle.classList.remove('achieved'); // Red for not achieved
                        }
                    });

                    // Display name and certification status in the designated containers

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

        // Button to show certification status
        document.querySelectorAll('.show-status-button').forEach(button => {
            button.addEventListener('click', () => {
                const dropdownIndex = button.getAttribute('data-dropdown') - 1;
                const certContainerId = dropdowns[dropdownIndex].certId;
                const certContainer = document.getElementById(certContainerId);
                const statuses = [...certContainer.querySelectorAll('.certification')].map(circle =>
                    circle.classList.contains('achieved') ? 'Achieved' : 'Not Achieved'
                );
                alert(`Certification statuses: ${statuses.join(', ')}`);
            });
        });
    })
    .catch(error => console.error('Error fetching data:', error));

  

