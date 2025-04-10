<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Electronic Library Management</title>
    <link rel="style.css" href="loginRegister.css">
</head>
<body>
    <header>
        <h1>Electronic Library Management</h1>
        <nav>
            <ul>
                <li><a href="librarian_dashboard.html">Home</a></li>
                <li><a href="search_books.html">Search Books</a></li>
                <li><a href="manage_users.html">Manage Users</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <input type="text" id="search" placeholder="Search for books...">
            <button type="button">Search</button>
        </section>
        <div id="book-list">
            <!-- Book list will be populated here -->
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Electronic Library. All rights reserved.</p>
    </footer>
</body>
</html>