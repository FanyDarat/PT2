const map = L.map('map').setView([-6.9176, 107.6191], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        document.getElementById('searchButton').addEventListener('click', async () => {
            const wilayah = document.getElementById('wilayahInput').value.trim();
            const year = parseInt(document.getElementById('yearInput').value);
            const month = document.getElementById('monthInput').value;

            if (!wilayah || !year || !month) {
                alert('Please enter all search criteria (wilayah, year, and month).');
                return;
            }

            try {
                const data = await fetchFloodData(wilayah, year, month);
                updateMapMarkers(data);
            } catch (error) {
                console.error('Error fetching flood data:', error);
                alert('Failed to fetch flood data.');
            }
        });

        async function fetchFloodData(wilayah, year, month) {
            const url = "http://floonder-api.kakashispiritnews.my.id/api/public/gis/flood-point?limit=10000";
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('Data Tidak Ditemukan');
            }
            const json = await response.json();

            const filtered = json.results.features.filter(feature => {
                const props = feature.properties;
                return props.wilayah === wilayah && props.year === year && props.month === month;
            });

            return filtered.map(feature => ({
                latitude: feature.geometry.coordinates[1],
                longitude: feature.geometry.coordinates[0],
                desa: feature.properties.desa,
                kecamatan: feature.properties.kecamatan,
                risk_level: feature.properties.risk_level,
                risk_score: feature.properties.risk_score
            }));
        }

        let markersLayer = L.layerGroup().addTo(map);

        function riskLevelColor(level) {
            switch(level) {
                case 'Rendah': return 'green';
                case 'Sedang': return 'yellow';
                case 'Rawan': return 'orange';
                case 'Bahaya': return 'red';
                case 'Sangat Bahaya': return '#8B0000'; // dark red
                case 'Sangat Rendah': return '#66ff00';
                default: return 'gray';
            }
        }

        function updateMapMarkers(data) {
            markersLayer.clearLayers();

            if (data.length === 0) {
                alert('No data found for the specified criteria.');
                return;
            }

            data.forEach(point => {
                const circle = L.circleMarker([point.latitude, point.longitude], {
                    radius: 8,
                    fillColor: riskLevelColor(point.risk_level),
                    color: '#333',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(markersLayer);

                circle.bindPopup(`
                    <strong>Desa:</strong> ${point.desa}<br />
                    <strong>Kecamatan:</strong> ${point.kecamatan}<br />
                    <strong>Risk Level:</strong> ${point.risk_level}<br />
                    <strong>Risk Score:</strong> ${point.risk_score}
                `);
            });

            const group = new L.featureGroup(markersLayer.getLayers());
            map.fitBounds(group.getBounds().pad(0.2));
        }