<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Edit</title>
</head>
<body>
    <h1>Post Edit</h1>
    <form action="/handlePostEdit?id=<?php echo $post['id']; ?>" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($post['title']) ? $post['title'] : ''; ?>"><br><br>
        <label for="content">Content:</label>
        <textarea name="content" cols="20" rows="3"><?php echo isset($post['content']) ? $post['content'] : '';?></textarea><br><br>
        <label for="Image">Image:</label>
        <input type="file" name="image"value="<?php echo isset($post['image']) ? $post['image'] : ''; ?>"><br><br>
        <label for="updated_at">Updated</label>
        <input type="text" name="updated_at" value="<?php echo isset($post['updated_at']) ? $post['updated_at'] : ''; ?>"><br><br>
        <button type="submit">Update Post</button><br>
        
        <a href="/profile">Back</a><br>
        <a href="/handleRead">Posts</a>
    </form>
</body>
</html>