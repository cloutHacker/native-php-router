<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="<?= url('public/assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('public/assets/style.css') ?>">
</head>
<body>
    <div class="container col-lg-6 col-md-6 col-sm-8 col-xsm-10 card">
    <div class="fs-2 align-self-center text-success">Register to CodeSplash</div>
    <form method="post" action="register/user">
        <div class="form-group mb-2 py-3">
            <input type="text" class="form-control" placeholder="username" name="username">
        </div>
        <div class="form-group mb-2 py-3">
            <input type="text" class="form-control" placeholder="example@gmail.com" name="email">
        </div>
        <div class="form-group mb-2 py-3">
            <input type="text" class="form-control" placeholder="password" name="password">
        </div>
        <div class="form-group mb-2 py-3">
            <input type="text" class="form-control" placeholder="password confirmation" name="password_confirmation">
        </div>
        <button class="signup">Signup</button>
    </form>
    </div>
</body>
</html>