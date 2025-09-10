   async function fetchPDFs() {
        try {
            const response = await fetch('fetch_pdfs.php');
            const pdfs = await response.json();

            const tabContainer = document.getElementById('tab-container');
            const pdfViewer = document.getElementById('pdf-viewer');
	
            pdfs.forEach((pdf, index) => {
                // Create a button for each PDF
                const button = document.createElement('button');
                button.textContent = `PDF ${index + 1}`;
                button.className = 'tab-button';
                button.addEventListener('click', () => {
                    // Set iframe source to display the PDF
                    pdfViewer.src = `data:${pdf.mimeType};base64,${pdf.fileData}`;
                });

                tabContainer.appendChild(button);
            });

            // Display the first PDF by default
            if (pdfs.length > 0) {
                pdfViewer.src = `data:${pdfs[0].mimeType};base64,${pdfs[0].fileData}`;
            }

        } catch (error) {
            console.error('Error fetching PDFs:', error);
        }
    }

    // Fetch and display PDFs when the page loads
    window.onload = fetchPDFs;
