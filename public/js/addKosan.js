// Function to handle the submission of new or updated Kosan data
async function submitKosanData(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get values from the form inputs
    const nama = document.getElementById('namaInput').value.trim();
    const alamat = document.getElementById('alamatInput').value.trim();
    const luas = parseFloat(document.getElementById('luasInput').value.trim());
    const latitude = parseFloat(document.getElementById('latitudeInput').value.trim());
    const longitude = parseFloat(document.getElementById('longitudeInput').value.trim());
    const link = document.getElementById('linkInput').value.trim();
    const kosanId = document.getElementById('kosanIdInput').value.trim(); // New input for ID

    // Validate input
    if (!nama || !alamat || isNaN(luas) || isNaN(latitude) || isNaN(longitude) || !link) {
        alert('Please fill in all fields correctly.');
        return;
    }

    // Create a new Kosan object
    const newKosan = {
        nama: nama,
        alamat_lengkap: alamat,
        luas_bangunan: luas,
        link_lengkap_properti: link,
        geometry: {
            type: "Point",
            coordinates: [longitude, latitude]
        }
    };

    // Add the new marker to the map
    addKosanMarker(newKosan);

    // Check if we are updating or creating a new Kosan
    if (kosanId) {
        await updateKosanData(kosanId, newKosan); // Call update function
    } else {
        await postKosanData(newKosan); // Call post function
    }

    // Reset the form
    document.getElementById('kosanForm').reset();
}

// Function to add a Kosan marker to the map
function addKosanMarker(kosan) {
    const { nama, alamat_lengkap, luas_bangunan, geometry, link_lengkap_properti } = kosan;
    const latitude = geometry.coordinates[1];
    const longitude = geometry.coordinates[0];

    // Create a marker for the new Kosan
    const marker = L.marker([latitude, longitude]).addTo(markersLayer);
    marker.bindPopup(`
        <strong>Nama:</strong> ${nama}<br />
        <strong>Alamat:</strong> ${alamat_lengkap}<br />
        <strong>Luas Bangunan:</strong> ${luas_bangunan} m²<br />
        <strong>Link:</strong> <a href="${link_lengkap_properti}" target="_blank">View Property</a>
    `);

    // Add click event to marker for editing
    marker.on('click', () => onMarkerClick(kosan));
}

// Function to post new Kosan data to the server
async function postKosanData(kosan) {
    const url = "http://floonder-api.kakashispiritnews.my.id/api/public/gis/kosan"; // Update with your API endpoint

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${localStorage.getItem('token')}`, // Include the JWT token
            },
            body: JSON.stringify(kosan),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Kosan data posted successfully:', data);
    } catch (error) {
        console.error('Error posting Kosan data:', error.message);
    }
}

// Function to update Kosan data on the server
async function updateKosanData(id, kosan) {
    const url = `http://floonder-api.kakashispiritnews.my.id/api/public/gis/kosan/${id}`; // Update with your API endpoint

    try {
        const response = await fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${localStorage.getItem('token')}`, // Include the JWT token
            },
            body: JSON.stringify(kosan),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Kosan data updated successfully:', data);
    } catch (error) {
        console.error('Error updating Kosan data:', error.message);
    }
}

async function fetchKosan() {
    const url = "http://floonder-api.kakashispiritnews.my.id";

    try {
        const response = await fetch(url + "/api/public/gis/kosan");
        const data = await response.json();

        // Process the results
        data.results.forEach(item => {
            const alamat = item.alamat_lengkap;
            const latitude = item.geometry.coordinates[1];
            const longitude = item.geometry.coordinates[0];
            const link = item.link_lengkap_properti;
            const luas = item.luas_bangunan;
            const nama = item.nama;
            const id = item.id; // Assuming the ID is available in the response

            // Create a normal marker for Kosan
            const marker = L.marker([latitude, longitude]).addTo(markersLayer);
            marker.bindPopup(`
                <strong>Nama:</strong> ${nama}<br />
                <strong>Alamat:</strong> ${alamat}<br />
                <strong>Luas Bangunan:</strong> ${luas} m²<br />
                <strong>Link:</strong> <a href="${link}" target="_blank">View Property</a>
            `);

            // Add click event to marker for editing
            marker.on('click', () => onMarkerClick(item));
        });
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Function to handle marker click event
function onMarkerClick(kosan) {
    const { nama, alamat_lengkap, luas_bangunan, geometry, link_lengkap_properti, id } = kosan;
    const latitude = geometry.coordinates[1];
    const longitude = geometry.coordinates[0];

    // Populate the form fields with the Kosan data
    document.getElementById('namaInput').value = nama;
    document.getElementById('alamatInput').value = alamat_lengkap;
    document.getElementById('luasInput').value = luas_bangunan;
    document.getElementById('latitudeInput').value = latitude;
    document.getElementById('longitudeInput').value = longitude;
    document.getElementById('linkInput').value = link_lengkap_properti;
    document.getElementById('kosanIdInput').value = id; // Set the ID for updating
}

// Function to handle map click event
function onMapClick(e) {
    // Get the latitude and longitude from the click event
    const latitude = e.latlng.lat;
    const longitude = e.latlng.lng;

    // Populate the form fields with the clicked coordinates
    document.getElementById('latitudeInput').value = latitude;
    document.getElementById('longitudeInput').value = longitude;
}

// Event listener for the form submission
document.getElementById('kosanForm').addEventListener('submit', submitKosanData);

// Add click event listener to the map
map.on('click', onMapClick);

fetchKosan();
