<?php
require 'db.php';
$data = $_POST;
if (isset($data['do_signup'])) {

    $errors = array();
    if (trim($data['login'] == "")) {
        $errors[] = "Введите логин";
    }
    if (trim($data['email'] == "")) {
        $errors[] = "Введите Email";
    }
    if ($data['password_2'] != $data['password']) {
        $errors[] = "Неверный пароль";
    }
    if (R::count('users', 'login=?', array($data['login'])) > 0) {
        $errors[] = 'Пользователь с таким логином уже существет';
    }
    if (R::count('users', 'email=?', array($data['email'])) > 0) {
        $errors[] = 'Пользователь с таким email уже существет';
    }
    if (empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password =  $data['password'];
        R::store($user);
        echo '<div style="color: green">' . 'Вы успешно зарегистрировались' . '</div><hr>';
        header('location: galery/rolkf/main.php');
    } else {
        echo '<div style="color: red">' . array_shift($errors) . '</div><hr>';
    }
}
?>
<style>
    * {
        background-color: wheat;
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        border-radius: 10px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    input {
        width: 300px;
        font-size: 13px;
        padding: 6px 0 4px 10px;
        border: 1px solid #cecece;
        background: #F6F6f6;
        border-radius: 8px;
    }

    .button9 {
        position: relative;
        display: inline-block;
        color: #777674;
        font-weight: bold;
        text-decoration: none;
        text-shadow: rgba(255, 255, 255, .5) 1px 1px, rgba(100, 100, 100, .3) 3px 7px 3px;
        user-select: none;
        padding: 1em 2em;
        outline: none;
        border-radius: 10px / 100%;
        background-image:
            linear-gradient(45deg, rgba(255, 255, 255, .0) 30%, rgba(255, 255, 255, .8), rgba(255, 255, 255, .0) 70%),
            linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0) 20%, rgba(255, 255, 255, 0) 90%, rgba(255, 255, 255, .3)),
            linear-gradient(to right, rgba(125, 125, 125, 1), rgba(255, 255, 255, .9) 45%, rgba(125, 125, 125, .5)),
            linear-gradient(to right, rgba(125, 125, 125, 1), rgba(255, 255, 255, .9) 45%, rgba(125, 125, 125, .5)),
            linear-gradient(to right, rgba(223, 190, 170, 1), rgba(255, 255, 255, .9) 45%, rgba(223, 190, 170, .5)),
            linear-gradient(to right, rgba(223, 190, 170, 1), rgba(255, 255, 255, .9) 45%, rgba(223, 190, 170, .5));
        background-repeat: no-repeat;
        background-size: 200% 100%, auto, 100% 2px, 100% 2px, 100% 1px, 100% 1px;
        background-position: 200% 0, 0 0, 0 0, 0 100%, 0 4px, 0 calc(100% - 4px);
        box-shadow: rgba(0, 0, 0, .5) 3px 10px 10px -10px;
    }

    .button9:hover {
        transition: .5s linear;
        background-position: -200% 0, 0 0, 0 0, 0 100%, 0 4px, 0 calc(100% - 4px);
    }

    .button9:active {
        top: 1px;
    }
</style>
<title>Регистрация</title>
<p>
    <button type="submit" onclick="location.href ='login.php'" class="button9">Авторизоваться</button>
</p>
<form action="signup.php" method="POST" style="text-align: center; margin-top:50px">
    <p><strong>Ваш логин</strong>
        <input type="text" name="login" value="<?php echo @$data['login'] ?>">
    </p>
    <p><strong>Ваш Email</strong>
        <input type="email" name="email" value="<?php echo @$data['email'] ?>">
    </p>
    <p><strong>Ваш пароль</strong>
        <input type="password" name="password" value="<?php echo @$data['password'] ?>">
    </p>
    <p><strong>Повторите пароль</strong>
        <input type="password" name="password_2" value="<?php echo @$data['password_2'] ?>">
    </p>
    <p>
        <button type="submit" name="do_signup" class="button">Зарегистрироваться</button>
    </p>
</form>