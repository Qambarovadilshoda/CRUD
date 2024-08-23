<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Salom <?php echo $_SESSION['user']['name'] ?></h1>
    <a href="/logout">Logout</a><br>
    <a href="/profile">Profile</a><br>
    <a href="/posts">Create post</a><br>
</body>

</html>
