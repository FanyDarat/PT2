<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="navbar">
    <div class="logo">Admin Dashboard</div>
    <div class="right">
        <ul class="nav-links">
            <li><a href="{{ route('addKosan') }}">Add Kosan</a></li>
            <li><a href="{{ route('addBerita') }}">Add Berita</a></li>
            <li><a href="#" id="logoutLink">Logout</a></li> <!-- Logout link -->
        </ul>
    </div>
</nav>

<script>
    // Check if the user is authenticated
    const token = localStorage.getItem('token');
    if (!token) {
        // Redirect to home page if token is not present
        window.location.href = '/';
    }

    // Logout functionality
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        localStorage.removeItem('token'); // Remove the token from localStorage
        window.location.href = '/'; // Redirect to home page
    });
</script>

</body>
</html>
