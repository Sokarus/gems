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

if (isset($_POST['save1'])) {
    $name = $_POST['name'];
    if ($name !== "") {
        if (strlen($name) < 30) {
            if (strlen($name) > 1) {
                if (preg_match('|^[-A-Za-z0-9_]*$|', $name)) {
                    $changename = $pdo->query("UPDATE users SET name='$name' WHERE login='$herelogin'");
                    echo "<script>alert(\"Имя успешно изменено!\");</script>";
                    header("Location: /gnomepage.php");
                } else {
                    echo "<script>alert(\"На английском, пожалуйста\");</script>";
                }
            } else {
                echo "<script>alert(\"Имя должно быть больше 1 символа!\");</script>";
            }
        } else {
            echo "<script>alert(\"Имя должно быть меньше 30 символов!\");</script>";
        }
    } else {
        echo "<script>alert(\"Введите имя!\");</script>";
    }
}

if (isset($_POST['save2'])) {
    $login = $_POST['login'];
    $stmt = $pdo->query("SELECT login FROM users where login='$login'");
    $row = $stmt->fetch();
    if ($row['login'] !== $login) {
        if ($login !== "") {
            if (strlen($login) < 20) {
                if (strlen($login) > 2) {
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
                        echo "<script>alert(\"На английском, пожалуйста\");</script>";
                    }
                } else {
                    echo "<script>alert(\"Логин должен быть больше 2 символов!\");</script>";
                }
            } else {
                echo "<script>alert(\"Логин должен быть меньше 20 символов!\");</script>";
            }
        } else {
            echo "<script>alert(\"Введите логин!\");</script>";
        }
    } else {
        echo "<script>alert(\"Логин занят!\");</script>";
    }
}

if (isset($_POST['save3'])) {
    $password = ($_POST['password']);
    $passwordmd5 = md5($_POST['password']);
    if ($password !== "") {
        if (strlen($password) < 20) {
            if (strlen($password) > 3) {
                if (preg_match('|^[-A-Za-z0-9_]*$|', $password)) {
                    $changepassword = $pdo->prepare("UPDATE users SET password=(?) WHERE login='$herelogin'");
                    $changepassword->execute([$passwordmd5]);
                    echo "<script>alert(\"Пароль успешно изменён!\");</script>";
                    header("Location: /gnomepage.php");
                } else {
                    echo "<script>alert(\"На английском, пожалуйста\");</script>";
                }
            } else {
                echo "<script>alert(\"Пароль должен быть больше 3 символов!\");</script>";
            }
        } else {
            echo "<script>alert(\"Пароль должен быть меньше 20 символов!\");</script>";
        }
    } else {
        echo "<script>alert(\"Введите пароль!\");</script>";
    }
}

?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="cssgnomepage.css">

<div>
    <div class="layer1">
        <p class="x1">Привет, <?php echo "$herelogin" ?> !</p>
    </div>
</div>



<div class="limiter block1">
    <div class="wrap-login100 p-t-1 p-b-10">
        <span class="login104-form-title p-b-1">
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


<div class="limiter1 block2">
    <div class="wrap-login100 p-t-1 p-b-10">
        <span class="login104-form-title p-b-1">
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

<div class="limiter block3">
    <div class="wrap-login100 p-t-1 p-b-10">
        <span class="login104-form-title p-b-1">
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

<div class="layer6">
    <p class="x4">Драгоценности:</p><br>
    <form class="back1" name="formstones" method="post">
        <p class="amethyst2">Аметист</p>
        <p class="sapphire2">Сапфир</p>
        <p class="emerald2">Изумруд</p>
        <p class="ruby2">Рубин</p>
        <p class="diamond2">Алмаз</p>
        <p class="topaz2">Топаз</p>
    </form>
</div>

<a href="jewelry.php" class="button28">Добавить драгоценности</a>

<div id="footer">
    <p class="x2">Дата регистрации: <?php echo $heredatereg ?>
        Дата последней авторизации: <?php echo $heredateaut ?></p>
</div>

<?php include "footer.php"; ?>