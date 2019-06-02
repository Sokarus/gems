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
$stmtstones = $pdo->prepare("SELECT amethyst , diamond , emerald , ruby , sapphire , topaz FROM userstones where login=(?)");
$stmtstones->execute([$tohello]);
$rowstones = $stmtstones->fetch();
$hereAmethyst = $rowstones[0];
$hereDiamond = $rowstones[1];
$hereEmerald = $rowstones[2];
$hereRuby = $rowstones[3];
$hereSapphire = $rowstones[4];
$hereTopaz = $rowstones[5];

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
            header("Location: /elfpage.php");
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
            header("Location: /elfpage.php");
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
            header("Location: /elfpage.php");
        } else {
            throw new Exception('На английском, пожалуйста!');
        }
    }
} catch (Exception $e) {
    echo 'Ошибка ввода пароля: ',  $e->getMessage();
}

if (isset($_POST['saveStones'])) {
    $amethyst = 0 + $_POST['amethyst'];
    $diamond = 0 + $_POST['diamond'];
    $emerald = 0 + $_POST['emerald'];
    $ruby = 0 + $_POST['ruby'];
    $sapphire = 0 + $_POST['sapphire'];
    $topaz = 0 + $_POST['topaz'];
    $changeStones = $pdo->prepare("UPDATE userstones SET (amethyst, diamond, emerald, ruby, sapphire, topaz) = (?, ?, ?, ?, ?, ?) WHERE login='$herelogin'");
    $changeStones->execute([$amethyst, $diamond, $emerald, $ruby, $sapphire, $topaz]);
    header("Location: /elfpage.php");
}
?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/csselfpage.css">

<div class="jumbotron">
    <div class="container">
        <div class="layer1">
            <p class="x1">Привет, <?php echo "$herelogin" ?> !</p>
        </div>
    </div>
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
            <p class="amethyst"><input name="amethyst" id="amethyst" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()"></span>Аметист</p>
            <p class="sapphire"><input name="sapphire" id="sapphire" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()">Сапфир</p>
            <p class="emerald"><input name="emerald" id="emerald" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()">Изумруд</p>
            <p class="ruby"><input name="ruby" id="ruby" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()">Рубин</p>
            <p class="diamond"><input name="diamond" id="diamond" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()">Алмаз</p>
            <p class="topaz"><input name="topaz" id="topaz" type="range" min="0" max="1" step="0.16" value="0.16" oninput="getValue()">Топаз</p>
            <button class="login100-form-btn" type="submit" name="saveStones">
                Выбрать камни
            </button>
        </form>
    </div>
    <div class="limiter2">
        <div class="intStones">
            <span class="intAmethyst" id="rangeAmethyst" value="0.16">0.16</span><br>
            <span class="intSapphire" id="rangeSapphire" value="0.16">0.16</span><br>
            <span class="intEmerald" id="rangeEmerald" value="0.16">0.16</span><br>
            <span class="intRuby" id="rangeRuby" value="0.16">0.16</span><br>
            <span class="intDiamond" id="rangeDiamond" value="0.16">0.16</span><br>
            <span class="intTopaz" id="rangeTopaz" value="0.16">0.16</span><br>
        </div>
    </div>


    <div class="limiter2">
        <form class="back2" name="favoritestones">
            <p class="amethyst1"><?php if ($hereAmethyst == NULL) {
                                        echo "Пусто";
                                    } else {
                                        echo (Аметист . " " . $hereAmethyst);
                                    } ?></p>
            <p class="sapphire1"><?php if ($hereSapphire == NULL) {
                                        echo "Пусто";
                                    } else {
                                        echo (Сапфир . " " . $hereSapphire);
                                    } ?></p>
            <p class="emerald1"><?php if ($hereEmerald == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Изумруд . " " . $hereEmerald);
                                } ?></p>
            <p class="ruby1"><?php if ($hereRuby == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Рубин . " " . $hereRuby);
                                } ?></p>
            <p class="diamond1"><?php if ($hereDiamond == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Алмаз . " " . $hereDiamond);
                                } ?></p>
            <p class="topaz1"><?php if ($hereTopaz == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Топаз . " " . $hereTopaz);
                                } ?></p>
        </form>
    </div>


    <div class="limiter2">
    <span class="login104-form-title">
            Полученные:
        </span>
        <form class="back1" name="getstones">
            <p class="amethyst"><input type="checkbox" name="Аметист" value="Аметист">Аметист</p>
            <p class="sapphire"><input type="checkbox" name="Сапфир" value="Сапфир">Сапфир</p>
            <p class="emerald"><input type="checkbox" name="Изумруд" value="Изумруд">Изумруд</p>
            <p class="ruby"><input type="checkbox" name="Рубин" value="Рубин">Рубин</p>
            <p class="diamond"><input type="checkbox" name="Алмаз" value="Алмаз">Алмаз</p>
            <p class="topaz"><input type="checkbox" name="Топаз" value="Топаз">Топаз</p>
        </form>
    </div>

    <div class="limiter2">
    <span class="login104-form-title">
            Принять:
        </span>
        <form class="back1" name="givemestones">
            <p class="amethyst"><input type="checkbox" name="Аметист" value="Аметист">Аметист</p>
            <p class="sapphire"><input type="checkbox" name="Сапфир" value="Сапфир">Сапфир</p>
            <p class="emerald"><input type="checkbox" name="Изумруд" value="Изумруд">Изумруд</p>
            <p class="ruby"><input type="checkbox" name="Рубин" value="Рубин">Рубин</p>
            <p class="diamond"><input type="checkbox" name="Алмаз" value="Алмаз">Алмаз</p>
            <p class="topaz"><input type="checkbox" name="Топаз" value="Топаз">Топаз</p>
    </div>
</div>
<div id="footer">
    <p class="x2">Дата регистрации: <?php echo $heredatereg ?>
        Дата последней авторизации: <?php echo $heredateaut ?></p>
</div>
<?php include "footer.php"; ?>