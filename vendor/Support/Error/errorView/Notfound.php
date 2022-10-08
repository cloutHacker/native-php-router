<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    background: #fff;
    display: flex;
    justify-content: center;
}
.error {
    margin-top: 3vh;
    height: 40vh;
    width: 40vw;
    box-shadow: 0 0 5px rgba(0,0,0,0.4);
    border-radius: 3px;
    color: #6e5151;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 1.5vw;
    display: flex;
    justify-content: center;
    align-items: center;
}


    </style>
    <title><?= $title ?></title>
</head>
<body>
    <div class="error">
    <h2><?= $title ?></h2>
    </div>
</body>
</html>