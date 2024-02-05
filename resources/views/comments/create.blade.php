<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
</head>
<body>
<h2>Add Comment</h2>

<form method="POST" action="{{ route('comments.store', ['post' => $post->id]) }}">
    @csrf

    <label for="body">Comment:</label>
    <textarea name="body" required></textarea>

    <button type="submit">Add Comment</button>
</form>
</body>
</html>
