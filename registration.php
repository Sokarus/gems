<?php require 'dbconn.php';
if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $login = $_POST['login'];
  $password = md5($_POST['password']);
  $password2 = md5($_POST['password2']);
  $answer = $_POST['answer'];
  $stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
  $stmt->execute([$login]);
  $row = $stmt->fetch();
  if ($password == $password2) { // по порядку 
    if ($row['login'] !== $login) {
      if ($answer) {
        $date = date("Y-m-d H:i:s");
        $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $login, $password, $answer, $date]);
        if ($answer == "elf") {
          $addlogin = $pdo->prepare('INSERT INTO userstones (login) VALUES (?)');
          $addlogin->execute([$login]);
        }
        header("Location: /autorization.php");
      } else {
        echo "<script>alert(\"Пользователь не выбрал рассу!\");</script>";
      }
    } else {
      echo "<script>alert(\"Пользователь с таким логином уже существует!\");</script>";
    }
  } else {
    echo "<script>alert(\"Пароли не совпадают!\");</script>";
  }
}
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="cssreg.css">

<div>
  <div class="container-login102">
    <div class="wrap-login101 p-t-1 p-b-20">
      <span class="login101-form-title">
        Регистрация
      </span>

      <form class="login100-form validate-form" method="POST">

        <div class="wrap-input101 validate-input" data-validate="Введите имя!">
          <input class="input100" type="text" name="name" placeholder="Имя">
          <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>

        <div class="wrap-input101 validate-input" data-validate="Введите логин!">
          <input class="input100" type="text" name="login" placeholder="Логин">
          <span class="focus-input100" data-placeholder="&#xe82a;"></span>
        </div>

        <div class="wrap-input101 validate-input" data-validate="Введите пароль!">
          <input class="input100" type="password" name="password" placeholder="Пароль">
          <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>

        <div class="wrap-input101 validate-input" data-validate="Повторите пароль!">
          <input class="input100" type="password" name="password2" placeholder="Повторите пароль">
          <span class="focus-input100" data-placeholder="&#xe80f;"></span>
        </div>

        <p class="x"><input type="radio" name="answer" value="elf">Эльф
          <input type="radio" name="answer" value="gnome">Гном<Br></p>

        <div class="container-login100-form-btn m-t-1">
          <button class="login100-form-btn" type="submit" name="save">
            Зарегистрироваться
          </button>

      </form>
    </div>
  </div>
  <div class="container-login100-form-btn m-t-1">
    <button class="login100-form-btn" onClick='location.href="/autorization.php"'>Авторизация
    </button>
  </div>
</div>

<?php include "footer.php"; ?>