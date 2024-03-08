<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add new book</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3 align="center">Add a new book</h3>
    <?php
    if (isset($_COOKIE['msg'])) {
        ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?= $_COOKIE['msg']; ?>
        </div>
        <?php
    }
    if (isset($_COOKIE['msg_fail'])) {
        ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?= $_COOKIE['msg_fail']; ?>
        </div>
        <?php
    }
    ?>
    <hr>
    <form action="?model=book&action=add" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">Title</label>
            <input type="text" class="form-control" id="id" placeholder="Enter a title" name="name" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" placeholder="Enter an author" name="author" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter a price" name="price" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button type="submit" class="btn btn-primary" name="submit">Create new book</button>
    </form>
</div>
</body>
</html>