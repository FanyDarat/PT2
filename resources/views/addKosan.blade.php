<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Kosan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px; /* Set the height of the map */
            width: 100%; /* Set the width of the map */
        }
    </style>
</head>
<body>

<h1>Add New Kosan</h1>

<form id="kosanForm">
    <label for="namaInput">Nama:</label>
    <input type="text" id="namaInput" required><br>

    <label for="alamatInput">Alamat:</label>
    <input type="text" id="alamatInput" required><br>

    <label for="luasInput">Luas Bangunan (m²):</label>
    <input type="number" id="luasInput" required><br>

    <input type="number" step="any" id="latitudeInput" required readonly hidden>

    <input type="number" step="any" id="longitudeInput" required readonly hidden>


    <label for="linkInput">Link Properti:</label>
    <input type="url" id="linkInput" required><br>

    <button type="submit">Add Kosan</button>
</form>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="module" src="{{ asset('js/addKosan.js') }}"></script>

<script>
    // Initialize the map
    const map = L.map('map').setView([-6.9039, 107.6177], 13); // Set initial view to Bandung

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Create a layer group for markers
    const markersLayer = L.layerGroup().addTo(map);
    let currentMarker = null; // Variable to hold the current marker

    // Function to handle map click event
    function onMapClick(e) {
        // Get the latitude and longitude from the click event
        const latitude = e.latlng.lat;
        const longitude = e.latlng.lng;

        // Populate the form fields with the clicked coordinates
        document.getElementById('latitudeInput').value = latitude;
        document.getElementById('longitudeInput').value = longitude;

        // Remove the existing marker if it exists
        if (currentMarker) {
            markersLayer.removeLayer(currentMarker);
        }

        // Add a new marker at the clicked location
        currentMarker = L.marker([latitude, longitude]).addTo(markersLayer);
    }

    // Add click event listener to the map
    map.on('click', onMapClick);
</script>

</body>
</html>
