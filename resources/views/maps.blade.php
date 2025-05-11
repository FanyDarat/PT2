<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Flood Points Map</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }
        #map {
            width: 100%;
            height: 100vh;
            background-color: lightblue;
        }
        .leaflet-popup-content {
            min-width: 200px;
        }
        .risk-low {
            color: green;
        }
        .risk-medium {
            color: orange;
        }
        .risk-high {
            color: red;
        }
        .filter-container {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
</head>

<body>
    <div id='map'></div>
    <div class="filter-container">
        <form id="filterForm">
            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="kota" value="{{ $filters['city'] ?? '' }}">
            </div>
            <div>
                <label for="month">Month:</label>
                <input type="text" id="month" name="month" value="{{ $filters['month'] ?? '' }}">
            </div>
            <div>
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" value="{{ $filters['year'] ?? '' }}">
            </div>
            <button type="submit">Apply Filters</button>
        </form>
    </div>

    <script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
    <script>
        let map, markers = [];
        const initialMarkers = @json($initialMarkers);

        /* ----------------------------- Initialize Map ----------------------------- */
        function initMap() {
            // Set initial center to first marker or default location
            const initialCenter = initialMarkers.length > 0 
                ? [initialMarkers[0].position.lat, initialMarkers[0].position.lng]
                : [-7.7925927, 110.3658812];

            map = L.map('map', {
                center: initialCenter,
                zoom: 12
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            initMarkers();
        }

        /* --------------------------- Initialize Markers --------------------------- */
        function initMarkers() {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Add new markers
            initialMarkers.forEach((data, index) => {
                const marker = generateMarker(data, index);
                marker.addTo(map).bindPopup(createPopupContent(data));
                markers.push(marker);
            });

            // Fit map to markers if there are any
            if (initialMarkers.length > 0) {
                const markerGroup = new L.featureGroup(markers);
                map.fitBounds(markerGroup.getBounds().pad(0.1));
            }
        }

        function generateMarker(data, index) {
            // Customize marker color based on risk level
            const markerColor = getRiskColor(data.properties.risk_level);
            
            return L.circleMarker([data.position.lat, data.position.lng], {
                radius: 8,
                fillColor: markerColor,
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8,
                draggable: false
            }).on('click', () => markerClicked(data));
        }

        function getRiskColor(riskLevel) {
            switch(riskLevel.toLowerCase()) {
                case 'rendah':
                case 'low':
                    return 'green';
                case 'sedang':
                case 'medium':
                    return 'orange';
                case 'rawan':
                case 'high':
                    return 'red';
                default:
                    return 'blue';
            }
        }

        function createPopupContent(data) {
            const props = data.properties;
            return `
                <div>
                    <h3>${props.desa}, ${props.kecamatan}</h3>
                    <p><strong>Wilayah:</strong> ${props.wilayah}</p>
                    <p><strong>Provinsi:</strong> ${props.provinsi}</p>
                    <p><strong>Period:</strong> ${props.month} ${props.year}</p>
                    <p><strong>Risk Level:</strong> 
                        <span class="risk-${props.risk_level.toLowerCase()}">${props.risk_level} (${props.risk_score})</span>
                    </p>
                    <p><strong>Elevation:</strong> ${props.flood_elev.toFixed(2)}m</p>
                    <p><strong>Distance to River:</strong> ${props.dist_to_river.toFixed(2)}m</p>
                </div>
            `;
        }

        /* ------------------------ Handle Marker Click Event ----------------------- */
        function markerClicked(data) {
            console.log('Marker clicked:', data);
        }

        /* ------------------------- Handle Form Submission ------------------------- */
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData).toString();
            window.location.href = window.location.pathname + '?' + params;
        });

        // Initialize the map
        initMap();
    </script>
</body>
</html>