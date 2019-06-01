<?php if (!$_SESSION['login']) {
  require 'dbconn.php';
}
if (isset($_POST['save'])) {
  $login = $_POST['login'];
  $password = md5($_POST['password']); // sha алгоритм паролей
  $user = [$login, $password];
  $stmt = $pdo->prepare("SELECT login , password FROM users where login=(?)");
  $stmt->execute([$login]);
  $row = $stmt->fetch();
  if ($row['login'] == $login && $row['password'] == $password) {
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
  } else echo "<script>alert(\"Неверный логин или пароль!\");</script>";
}
?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="cssindex.css">

<div class="jumbotron">
  <div class="container">
    <h1 class="display-4">
      <p>Привет, путник!</p>
      <p>Регистрируйся скорее!</p><br>
  </div>
</div>
<hr>
</div>
<a href="registration.php">Регистрация</a></h1>

  <div class="container-login101">
    <div class="wrap-login100 p-t-1 p-b-86">
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
<?php include "footer.php"; ?>