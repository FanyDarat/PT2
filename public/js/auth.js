document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Make the API request
    fetch('http://floonder-api.kakashispiritnews.my.id/api/auth/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            email: email,
            password: password,
        }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Login failed');
            }
            return response.json();
        })
        .then(data => {
          localStorage.setItem('token', data.data.access);
            window.location.href = '/admin'; // Change this to your desired route
        })
        .catch(error => {
            document.getElementById('error-message').innerText = error.message;
        });
});
