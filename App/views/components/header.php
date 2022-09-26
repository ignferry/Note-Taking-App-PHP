<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Taking App</title>
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div id="navbar-logo">NOTE</div>
        <div id="navbar-menu">
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <?php if(isset($_SESSION["userId"]) && $_SESSION["isAdmin"]) : ?>
                    <li><a href="/users">Users</a></li>
                <?php elseif(isset($_SESSION["userID"]) && $_SESSION["isAdmin"]) : ?>
                    <li><a href="/notes">Notes</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div id="navbar-account">
            <ul class="nav-links">
                <?php if(isset($_SESSION["userId"])) : ?>
                    <li><a href="/profile">Profile</a></li>
                    <form action="/logout" method="post">
                        <button type="submit">Logout</button>
                    </form>
                <?php else : ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</body>