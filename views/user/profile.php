<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile user's</h1>
    <h3><?php echo "Name: " . $_SESSION['user']['name']; ?></h3>
    <h3><?php echo "Email: " . $_SESSION['user']['email']; ?></h3>
    <a href="/profile/edit">Edit</a><br>
    <a href="/posts">Create your post</a><br>    
</body>
</html>