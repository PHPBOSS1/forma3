<?php
session_start();
?>

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php

if(isset($_SESSION["session_username"])){
    header("Location: /intropage.php");
} else {}

if(isset($_POST["login"])){

    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);

    if(!empty($username) && !empty($password)) {

        $query =mysqli_query($con, "SELECT * FROM Users WHERE username = '".$username."' AND password='".$password."'");
        $numrows=mysqli_num_rows($query);

        if($numrows!=0){
            while($row=mysqli_fetch_assoc($query)){

                $dbusername=$row['username'];
                $dbpassword=$row['password'];
            }
            if($username == $dbusername && $password == $dbpassword) {

                $_SESSION['session_username']=$username;
                require('includes/redirect.php');
                exit();

            }
        } else {
            echo "Неверное имя пользователя или пароль!";
        }
    } else {
        $message = "Все поля обязательны для заполнения!";
    }
}
?>
<div class="container mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="" id="loginform" method="post"name="loginform">
            <p><label for="user_login">Имя пользователя<br>
                    <input class="input" id="username" name="username"size="20"
                           type="text" value=""></label></p>
            <p><label for="user_pass">Пароль<br>
                    <input class="input" id="password" name="password"size="20"
                           type="password" value=""></label></p>
            <p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
            <p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
        </form>
    </div>
