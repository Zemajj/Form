<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>
<body bgcolor="#6495ed">

    <form action="register.php" method="post">
        <input type="text" placeholder="login" name="login" required>
        <input type="password" placeholder="password" name="pass" required>
        <input type="password" placeholder="repeat password" name="repeatpass" required>
        <input type="text" placeholder="email" name="email" required>
        <button type="submit">Register</button>
    </form>

    <form action="login.php" method="post">
        <input type="text" placeholder="login" name="login" required>
        <input type="password" placeholder="password" name="pass" required>
        <button type="submit">Authorization</button>
    </form>



</body>
</html>