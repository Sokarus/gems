<?php if (!$_SESSION['login']) {
    require 'dbconn.php';
}

try {
    if (isset($_POST['save'])) {
        $login = $_POST['login'];
        $password = sha1($_POST['password']);
        $user = [$login, $password];
        $stmt = $pdo->prepare("SELECT login , password FROM users where login=(?)");
        $stmt->execute([$login]);
        $row = $stmt->fetch();
    }
    if ($row['login'] !== $login || $row['password'] !== $password) {
        throw new Exception('Неверный логин или пароль!');
    } else {
        $date = date("Y-m-d H:i:s");
        session_start();
        $_SESSION['login'] = $row['login'];
        $adddate = $pdo->prepare("UPDATE users SET dateaut = (?) where login='$login'");
        $adddate->execute([$date]);
        $stmt = $pdo->prepare("SELECT race FROM users where login=(?)");
        $stmt->execute([$login]);
        $row = $stmt->fetch();
        if ($row[0] == "elf") {
            header("Location: /elfpage.php");
        }
        if ($row[0] == "gnome") {
            header("Location: /gnomepage.php");
        }
    }
} catch (Exception $e) {
    echo 'Ошибка авторизации: ', $e->getMessage();
}

include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssreg.css">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-10 p-b-50">
            <span class="login102-form-title p-b-20">
                Авторизация
            </span>

            <form class="login100-form validate-form" method="POST">

                <div class="wrap-input101 validate-input" data-validate="Введите логин!">
                    <input class="input100" type="text" name="login" placeholder="Логин">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input101 validate-input" data-validate="Введите пароль!">
                    <input class="input100" type="password" name="password" placeholder="Пароль">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-1">
                    <button class="login100-form-btn" type="submit" name="save">
                        Авторизоваться
                    </button>

            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>