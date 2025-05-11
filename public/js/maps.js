
fetchData();
async function fetchData() {
    
    const url = "http://floonder-api.kakashispiritnews.my.id"
    try{
        const response = await fetch("http://floonder-api.kakashispiritnews.my.id/api/public/gis/flood-point?format=json");

        if(!response.ok) {
            throw new Error("Data Tidak Ditemukan")
        }

        const data = await response.json();
        console.log(data);

    }
    catch(error){
        console.error(error);
    }
}