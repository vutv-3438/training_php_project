<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3 align="center">Update the book</h3>
    <?php
    if (isset($_COOKIE['msg'])) {
        ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?php echo $_COOKIE['msg']; ?>
        </div>
        <?php
    }
    if (isset($_COOKIE['msg_fail'])) {
        ?>
        <div class="alert alert-danger">
            <strong>Danger!</strong> <?php echo $_COOKIE['msg_fail']; ?>
        </div>
        <?php
    }
    ?>
    <hr>
    <form action="?model=book&action=update" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">Code</label>
            <input type="text" class="form-control" id="id" placeholder="Code" name="id" value="<?= $data['id'] ?>"
                   readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a name" name="name"
                   value="<?= $data['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" placeholder="Enter an author" name="author"
                   value="<?= $data['author'] ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" placeholder="Enter a price" name="price"
                   value="<?= $data['price'] ?>" required min="1">
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>
</html>