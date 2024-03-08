<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3 align="center">Login</h3>
    <hr>
    <?php
    if (isset($_COOKIE['msg'])) {
        ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?= $_COOKIE['msg']; ?>
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
    <form action="?model=user&action=login" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter an username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter a password" name="password">
        </div>
        <div>
            <label for="rememberMe">Remember me</label>
            <input type="checkbox" id="rememberMe" checked name="rememberMe">
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
        <a href="index.php?model=user&action=signUp">Sign up</a>
    </form>
</div>
</body>
</html>