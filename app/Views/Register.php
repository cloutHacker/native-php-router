<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= url('public/assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('public/assets/style.css') ?>">
</head>
<body>
    <div class="container col-8 card splash-container">
        <div class="code-splash row justify-content-center">
        <div class="text-success splash-title">Register to our site.</div>
       <form method="POST">
         <input type="text" name="username" class="form-control mb-4" placeholder="Enter your name:"/>
         <span class="text-danger"></span>
         <input type="email" name="email" class="form-control mb-4" placeholder="Enter your email:"/>
         <span class="text-danger"></span>
         <input type="password" name="password" class="form-control mb-4" placeholder="Enter your password:"/>
         <span class="text-danger"></span>
         <input type="password"n ame="password_confirmation" class="form-control mb-4" placeholder="Confirm your password:"/>
         <span class="text-danger"></span>
         <div class="mb-4">Already have an account yet?<a href="<?= url('user/login') ?>">Login</a></div>
         <button class="btn-lg mb-3 col-12">Register</button>
       </form>
    </div>
</body>
</html>