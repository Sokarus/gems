<?php require 'dbconn.php';
require 'functionsphp.php';
session_start();
loginCheck();

$tohello = $_SESSION['login'];
$stmt = $pdo->prepare("SELECT name , login , datereg , dateaut FROM users where login=(?)");
$stmt->execute([$tohello]);
$row = $stmt->fetch();
$herename = $row[0];
$herelogin = $row[1];
$heredatereg = $row[2];
$heredateaut = $row[3];

try {
    if (isset($_POST['save1'])) {
        $name = $_POST['name'];
        if ($name == "") {
            throw new Exception('Введите имя!');
        }
        if (strlen($name) >= 30) {
            throw new Exception('Имя должно быть меньше 30 символов!');
        }
        if (strlen($name) <= 1) {
            throw new Exception('Имя должно быть больше 1 символа!');
        }
        if (preg_match('|^[-A-Za-z0-9_]*$|', $name)) {
            $changename = $pdo->prepare("UPDATE users SET name='$name' WHERE login=(?)");
            $changename->execute([$herelogin]);
            echo "<script>alert(\"Имя успешно изменено!\");</script>";
            header("Location: /gnomepage.php");
        } else {
            throw new Exception('На английском, пожалуйста!');
        }
    }
} catch (Exception $e) {
    echo 'Ошибка ввода имени: ',  $e->getMessage();
}

try {
    if (isset($_POST['save2'])) {
        $login = $_POST['login'];
        $stmt = $pdo->query("SELECT login FROM users where login='$login'");
        $row = $stmt->fetch();
        if ($row['login'] == $login) {
            throw new Exception('Логин занят!');
        }
        if ($login == "") {
            throw new Exception('Введите логин!');
        }
        if (strlen($login) >= 20) {
            throw new Exception('Логин должен быть меньше 20 символов!');
        }
        if (strlen($login) <= 2) {
            throw new Exception('Логин должен быть больше 2 символов!');
        }
        if (preg_match('|^[-A-Za-z0-9_]*$|', $login)) {
            $changelogin = $pdo->prepare("UPDATE users SET login=(?) WHERE login='$herelogin'");
            $changelogin->execute([$login]);
            $changeloginstones = $pdo->prepare("UPDATE userstones SET login=(?) WHERE login='$herelogin'");
            $changeloginstones->execute([$login]);
            echo "<script>alert(\"Логин успешно изменён!\");</script>";
            unset($_SESSION['login']);
            $_SESSION['login'] = $login;
            header("Location: /gnomepage.php");
        } else {
            throw new Exception('На английском, пожалуйста!');
        }
    }
} catch (Exception $e) {
    echo 'Ошибка ввода логина: ',  $e->getMessage();
}

try {
    if (isset($_POST['save3'])) {
        $password = ($_POST['password']);
        $passwordsha1 = sha1($_POST['password']);
        if ($password == "") {
            throw new Exception('Введите пароль!');
        }
        if (strlen($password) >= 20) {
            throw new Exception('Пароль должен быть меньше 20 символов!');
        }
        if (strlen($password) <= 3) {
            throw new Exception('Пароль должен быть больше 3 символов!');
        }
        if (preg_match('|^[-A-Za-z0-9_]*$|', $password)) {
            $changepassword = $pdo->prepare("UPDATE users SET password=(?) WHERE login='$herelogin'");
            $changepassword->execute([$passwordsha1]);
            echo "<script>alert(\"Пароль успешно изменён!\");</script>";
            header("Location: /gnomepage.php");
        } else {
            throw new Exception('На английском, пожалуйста!');
        }
    }
} catch (Exception $e) {
    echo 'Ошибка ввода пароля: ',  $e->getMessage();
}

?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssgnomepage.css">

<div class="jumbotron">
    <div class="container">
            <p class="x1">Страница <?php echo "$herelogin" ?>-а !</p>
            <p class="x2">Привет, <?php echo "$herelogin" ?> !</p>
</div>

<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваше имя:
        </span>
        <form class="login100-form" method="POST">
            <div class="wrap-input100 validate-input" data-validate="Введите имя!">
                <input class="input100" type="text" name="name" placeholder=<?php echo $herename; ?>>
                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
            </div>
            <button class="login100-form-btn" type="submit" name="save1">
                Изменить имя
            </button>
        </form>
    </div>
</div>


<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваш логин:
        </span>
        <form class="login100-form" method="POST">
            <div class="wrap-input100 validate-input" data-validate="Введите логин!">
                <input class="input100" type="text" name="login" placeholder=<?php echo $herelogin; ?>>
                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
            </div>
            <button class="login100-form-btn" type="submit" name="save2">
                Изменить логин
            </button>
        </form>
    </div>
</div>

<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваш пароль:
        </span>
        <form class="login100-form" method="POST">
            <div class="wrap-input100 validate-input" data-validate="Введите пароль!">
                <input class="input100" type="password" name="password" placeholder="*****">
                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
            </div>
            <button class="login100-form-btn" type="submit" name="save3">
                Изменить пароль
            </button>
        </form>
    </div>
</div>

<div class="container">
    <div class="limiter1">
        <span class="login104-form-title">
            Предпочтения:
        </span>
        <form class="back1" name="formstones" method="post">
            <p class="amethyst2">Аметист</p>
            <p class="sapphire2">Сапфир</p>
            <p class="emerald2">Изумруд</p>
            <p class="ruby2">Рубин</p>
            <p class="diamond2">Алмаз</p>
            <p class="topaz2">Топаз</p>
        </form>
    </div>

    <div class="limiter2">
        <a href="jewelry.php" class="button28">Добавить драгоценности</a>
    </div>
</div>
<div id="footer">
    <p class="x3">Дата регистрации: <?php echo $heredatereg ?>
        Дата последней авторизации: <?php echo $heredateaut ?></p>
</div>

<?php include "footer.php"; ?>