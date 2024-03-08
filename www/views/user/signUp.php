<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3 align="center">Register</h3>
    <hr>
    <?php
    if (isset($_COOKIE['msg'])) {
        ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $_COOKIE['msg']; ?>
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
    <form action="?model=user&action=signUp" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter an username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter a password" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Register</button>
        <a href="index.php?model=user&action=login">Login</a>
    </form>
</div>
</body>
</html>