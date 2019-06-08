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
  }
  if ($row[0] == "elf") {
    header("Location: /elfpage.php");
  }
  if ($row[0] == "gnome") {
    header("Location: /gnomepage.php");
  }
  if ($row[0] == "mastergnome") {
    header("Location: /alljewelry.php");
  }
} catch (Exception $e) {
  echo 'Ошибка авторизации: ',  $e->getMessage();
}


?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssindex.css">

<div class="jumbotron">
  <div class="container">
    <p>Привет, путник!
    Регистрируйся скорее!</p><br>
  </div>
</div>
</div>


<div class="container-login101">
  <div class="wrap-login100">
    <span class="login100-form-title">
      Авторизация
    </span>

    <form class="login101-form validate-form p-b-33 p-t-5" method="POST">

      <div class="wrap-input100 validate-input" data-validate="Введите логин!">
        <input class="input100" type="text" name="login" placeholder="Логин">
        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
      </div>

      <div class="wrap-input100 validate-input" data-validate="Введите пароль!">
        <input class="input100" type="password" name="password" placeholder="Пароль">
        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
      </div>

      <div class="container-login100-form-btn m-t-32">
        <button class="login100-form-btn" type="submit" name="save">
          Авторизоваться
        </button>

    </form>
  </div>
</div>
<a href="registration.php">Регистрация</a>
<?php include "footer.php"; ?>