<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="scss/profile.css">
    <title>Profile</title>
</head>
<body>
    <?php include "./php_static_elements/nav.php"?>

    <div class="container info-wrapper">
        <div class="no-profile-image"></div>
        <div class="bio">
            <h2>Username</h2>
            <p>Status</p>
            <a href="edit.php">Edit</a>
        </div>
    </div>

    <div class="container bloglist">
        <h1>User's bloglist</h1>
        <div class="blog-item">
            <div class="blog-text">
                <div class="blog-text-text">
                    <h2>Title</h2>
                    <p>“Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                    sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.”</p>
                    <input type="submit" name="delete" value="Delete">
                </div>
                <div class="blog-posted">
                    <small>Posted on (date)</small>
                </div>
            </div>
            <div class="blog-image-wrapper">
                <div class="no-blog-image"></div>
            </div>
        </div>
    </div>
</body>
</html>