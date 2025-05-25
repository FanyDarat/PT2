const url = "http://floonder-api.kakashispiritnews.my.id/api/public/gis/kosan";

// Function to fetch Kosan data
async function fetchKosan() {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }

        const kosanData = await response.json();
        displayKosan(kosanData.results);
    } catch (error) {
        console.error('Error fetching Kosan data:', error);
        alert('Failed to load Kosan data.');
    }
}

// Function to display Kosan data
function displayKosan(kosanData) {
    const kosanGrid = document.getElementById('kosanGrid');
    kosanGrid.innerHTML = ''; // Clear existing content

    kosanData.forEach(kosan => {
        const kosanCard = document.createElement('div');
        kosanCard.className = 'kos-card';

        const kosanTitle = document.createElement('h2');
        kosanTitle.textContent = kosan.nama; // Display the name

        const kosanLocation = document.createElement('p');
        kosanLocation.className = 'lokasi';
        kosanLocation.textContent = kosan.alamat_lengkap; // Display the address

        const linkButton = document.createElement('a');
        linkButton.href = kosan.link_lengkap_properti; // Set the href to link_lengkap_properti
        linkButton.textContent = 'View Details'; // Button text
        linkButton.target = '_blank'; // Open in new tab
        linkButton.className = 'view-details'; // Add a class for styling if necessary

        // Append elements to card
        kosanCard.appendChild(kosanTitle);
        kosanCard.appendChild(kosanLocation);
        kosanCard.appendChild(linkButton); // Append link button
        kosanGrid.appendChild(kosanCard); // Append card to grid
    });
}

// Function to search Kosan by name
function searchKosan() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const kosanCards = document.querySelectorAll('.kos-card');

    kosanCards.forEach(card => {
        const title = card.querySelector('h2').textContent.toLowerCase();
        if (title.includes(input)) {
            card.style.display = ''; // Show card
        } else {
            card.style.display = 'none'; // Hide card
        }
    });
}

// Call the fetchKosan function on page load
fetchKosan();
