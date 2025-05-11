// prediction.js - Vanilla JavaScript version for Laravel
class FloodPredictionMap {
    constructor(mapElementId) {
        this.map = null;
        this.predictionData = [];
        this.mapElementId = mapElementId;
        this.initMap();
    }

    initMap() {
        // Initialize map (adjust center/zoom as needed)
        this.map = L.map(this.mapElementId).setView([-6.9147, 107.6098], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(this.map);
    }

    async fetchPredictionData(city, month, year) {
        try {
            const params = new URLSearchParams();
            if (city) params.append("kota", city);
            if (month) params.append("month", month);
            if (year) params.append("year", year);
            params.append("limit", "10000");

            const response = await fetch(`/api/public/gis/flood-point?${params.toString()}`);
            
            if (!response.ok) throw new Error(`HTTP Error! Status: ${response.status}`);
            
            const data = await response.json();
            const predictionFeatures = data.results?.features || [];
            
            this.predictionData = predictionFeatures.filter(feature => 
                feature.type === "Feature" && 
                feature.geometry?.type === "Point" &&
                feature.geometry.coordinates
            );
            
            this.renderPredictions();
            
        } catch (error) {
            console.error("Error fetching prediction data:", error);
        }
    }

    renderPredictions() {
        // Clear existing layers
        this.clearPredictions();
        
        if (this.predictionData.length === 0) return;
        
        // Create feature collection
        const geojson = {
            type: "FeatureCollection",
            features: this.predictionData
        };
        
        // Add to map using Leaflet (not Mapbox GL JS)
        L.geoJSON(geojson, {
            pointToLayer: (feature, latlng) => {
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: this.getColorForRisk(feature.properties.risk_level),
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.7
                }).bindPopup(this.createPopupContent(feature));
            }
        }).addTo(this.map);
    }

    getColorForRisk(riskLevel) {
        const riskColors = {
            "Rendah": "#FFFF00",
            "Sedang": "#FFA500",
            "Rawan": "#FF4500",
            "Bahaya": "#FF0000",
            "Sangat Bahaya": "#8B0000"
        };
        return riskColors[riskLevel] || "#BBBBBB";
    }

    createPopupContent(feature) {
        return `
            <div>
                <h3>${feature.properties.risk_level || 'No Data'}</h3>
                <p>Lat: ${feature.geometry.coordinates[1].toFixed(6)}</p>
                <p>Lng: ${feature.geometry.coordinates[0].toFixed(6)}</p>
                ${feature.properties.description ? `<p>${feature.properties.description}</p>` : ''}
            </div>
        `;
    }

    clearPredictions() {
        // Remove all prediction layers
        this.map.eachLayer(layer => {
            if (layer instanceof L.GeoJSON) {
                this.map.removeLayer(layer);
            }
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const predictionMap = new FloodPredictionMap('map');
    
    // Example usage:
    // predictionMap.fetchPredictionData('Bandung', '6', '2023');
});