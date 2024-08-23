<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>Posts</h1>
    <form action="/handleCreate" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title"><br><br>
        <label for="content">Content:</label>
        <textarea name="content" cols="15" rows="3"></textarea><br><br>
        <label for="Image">Image:</label>
        <input type="file" name="image"><br><br>
        <button type="submit">Create Post</button><br>
        <a href="/profile">Back</a><br>
        <a href="/handleRead">Posts</a><br>
        <a href="views/posts/find.php">Find Post</a>
    </form>
</body>
</html>