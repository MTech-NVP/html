// Fetch data from the server
fetch('../src/controller/fetch_persons.php')
    .then(response => response.json())
    .then(data => {
        const dropdowns = [
            {
                dropdownId: 'dropdown1',
                imageId: 'cert-img1',
                nameContainerId: 'person-cert-name1',
                statusPrefix: 'status-cert',
		selectedImageId: 'selected-image1'
            },
            {
                dropdownId: 'dropdown2',
                imageId: 'cert-img2',
                nameContainerId: 'person-cert-name2',
                statusPrefix: 'status-cert',
	   	selectedImageId: 'selected-image2'
            },
            {
                dropdownId: 'dropdown3',
                imageId: 'cert-img3',
                nameContainerId: 'person-cert-name3',
                statusPrefix: 'status-cert',
                selectedImageId: 'selected-image3'
            }


        ];

        dropdowns.forEach(({ dropdownId, imageId, nameContainerId, statusPrefix, selectedImageId },dropdownIndex) => {
            const dropdown = document.getElementById(dropdownId);
            const optionsContainer = dropdown.querySelector('.dropdown-options');
            const testImage = document.getElementById(imageId);
            const nameContainer = document.getElementById(nameContainerId);
            const selectedImage = document.getElementById(selectedImageId);
            // Populate dropdown options
            data.forEach(item => {
                const option = document.createElement('div');
                option.innerHTML = `<img src="data:image/jpeg;base64,${item.img_data}" /> ${item.name_person}`;
                option.addEventListener('click', () => {
                    // Set selected data
                    dropdown.firstChild.nodeValue = item.name_person;

                    // Display image
                    testImage.src = `data:image/jpeg;base64,${item.img_data}`;
                    testImage.style.display = 'block';
		    
                    selectedImage.src = `data:image/jpeg;base64,${item.img_data}`;
                    selectedImage.style.display = 'block';
		    selectedImage.style.objectFit='cover';
                    // Update name
                    nameContainer.textContent = `${item.name_person}`;

                    // Update certification status colors

                   item.cert.forEach((cert, index) => {
                        const statusElementId = `${statusPrefix}${index + 1}-div${dropdownIndex + 1}`;
                        const statusElement = document.getElementById(statusElementId);
			//console.log(statusElementId);
			//console.log(statusElement);

                        if (statusElement) {
                            statusElement.style.backgroundColor = cert === 1 ? 'green' : 'red';
                        }
                    }); 



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

