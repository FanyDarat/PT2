document.getElementById('addBeritaForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const url = 'http://floonder-api.kakashispiritnews.my.id/api/cms/news';
    const token = localStorage.getItem('token'); // Retrieve the token from local storage

    const data = {
        title: document.getElementById('title').value,
        content: document.getElementById('content').value,
        author: document.getElementById('author').value
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            alert('Berita added successfully!');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to add berita. Please try again.');
        });
});
