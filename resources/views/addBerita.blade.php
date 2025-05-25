<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Berita</title>
    <script type="module" src="{{ asset('js/addBerita.js') }}"></script></head>
<body>
<h1>Add New Berita</h1>

<form id="addBeritaForm">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea><br><br>

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" required><br><br>

    <button type="submit">Submit</button>
</form>

<script>
    const token = localStorage.getItem('token');
    if (!token) {
        // Redirect to home page if token is not present
        window.location.href = '/';
    }
</script>
</body>
</html>
