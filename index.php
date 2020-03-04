<?php
$con = new mysqli('localhost', 'root', '', 'small_login');
$errors = array(
    'name' => '',
    'email' => '',
    'password' => '',
    'cpassword' => ''

);
if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (empty($name)) {
        $errors['name'] = "Name require";
    } else {
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = "Username contain only space and letter";
        }
    }
    if (empty($email)) {
        $errors['email'] = "email require";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email Not valid format";
        }
    }
    if (empty($password)) {
        $errors['password'] = "password require";
    } else { }
    if (empty($cpassword)) {
        $errors['cpassword'] = "cpassword require";
    } else { }

    


    if ($password != $cpassword) {
        echo $errors['password']=   $errors['cpassword'] ="Password not match";
    }
    if(!array_filter($errors)){
        
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO user(name,email,password) VALUES('$name','$email','$hash')";
            $con->query($sql);
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        span {
            color: red;
        }

        input {
            margin: 10px;
            padding: 10px;
            width: 95%;
        }

        button {
            padding: 10px;
            width: 100%;
        }
    </style>
</head>

<body>
    <fieldset style="width: 600px;margin:auto;">
        <legend>Login</legend>
        <form action="" method="post">
            <span> <?php echo  $errors['name']; ?></span>
            <input type="text" name="name"><br>
            <span> <?php echo  $errors['email']; ?></span>
            <input type="email" name="email"><br>
            <span> <?php echo  $errors['password']; ?></span>
            <input type="password" name="password"><br>
            <span> <?php echo  $errors['cpassword']; ?></span>
            <input type="password" name="cpassword"><br>
            <button type="submit" name="login">Login</button>
        </form>
    </fieldset>
</body>

</html>