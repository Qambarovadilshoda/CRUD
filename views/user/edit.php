<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
</head>
<body>
    <h1>Profile Edit</h1>
    <form action="/handleEdit" method="POST">
        <input type="text" name="name" value="<?php echo $_SESSION['user']['name'] ?>"><br><br>
        <input type="email" name="email" value="<?php echo $_SESSION['user']['email'] ?>"><br><br>
        <button type="submit">Edit</button>
    </form>
</body>
</html>