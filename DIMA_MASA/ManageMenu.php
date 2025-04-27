<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <title>Manage Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffbe33;
            margin: 0;
            padding: 0;
            color: #1f1f1f;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #222831;
            color: #ffffff;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h1 {
            font-size: 24px;
            margin: 0 0 20px;
            color: #ffbe33;
        }
        .sidebar a {
            display: block;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 0;
            border-bottom: 1px solid #444;
        }
        .sidebar a:last-child {
            border-bottom: none;
        }
        .main {
            flex-grow: 1;
            padding: 20px;
        }
        .container h2 {
            color: #222831;
        }
        .form-group label {
            color: #222831;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h1>Pastalia</h1>
    <a href="users.html">Users</a>
    <a href="booking(backend).html">Book Tables</a>
    <a href="accepted.html">Accepted Bookings</a>
    <a href="rejected.html">Rejected Bookings</a>
    <a href="backmenu.html">Menu</a>
</div>
<div class="main">
    <div class="container">
        <h2>Manage Menu</h2>
        <form action="save_menu.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="Classic">Classic Pasta</option>
                    <option value="Seafood">Seafood Pasta</option>
                    <option value="vegan">Vegan Pasta</option>
                    <option value="Fettuccine">Fettuccine</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #222831; border-color: #ffbe33; color:white;">Save Menu</button>

        </form>
    </div>
</div>
</body>
</html>
