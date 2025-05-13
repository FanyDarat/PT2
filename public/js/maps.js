async function fetchData(wilayah, year, month) {
    const url = "http://floonder-api.kakashispiritnews.my.id/api/public/gis/flood-point";
    try {
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error("Data Tidak Ditemukan");
        }

        const data = await response.json();
        console.log("All Data:", data);

        // Filter results based on the provided criteria
        const filteredResults = data.results.features.filter(feature => {
            const properties = feature.properties;
            return properties.wilayah === wilayah && properties.year === year && properties.month === month;
        });

        // Extract coordinates from filtered results
        const coordinates = filteredResults.map(feature => {
            const coords = feature.geometry.coordinates;
            return {
                longitude: coords[0],
                latitude: coords[1],
                desa: feature.properties.desa,
                kecamatan: feature.properties.kecamatan,
                risk_level: feature.properties.risk_level,
                risk_score: feature.properties.risk_score
            };
        });

    } catch (error) {
        console.error(error);
    }
}

// Example usage
fetchData("Bandung", 2025, "juni");
