<?php require 'dbconn.php';
$name = $_POST['name'];
$login = $_POST['login'];
$password = sha1($_POST['password']);
$password2 = sha1($_POST['password2']);
$answer = $_POST['answer'];
$stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
$stmt->execute([$login]);
$row = $stmt->fetch();

try {
  if (isset($_POST['save'])) {
    if ($password !== $password2) {
      throw new Exception('Пароли не совпадают!');
    }
    if ($row['login'] == $login) {
      throw new Exception('Пользователь с таким логином уже существует!');
    }
    if ($answer) {
      $date = date("Y-m-d H:i:s");
      $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg) VALUES (?, ?, ?, ?, ?)');
      $stmt->execute([$name, $login, $password, $answer, $date]);
    } else {
      throw new Exception('Пользователь не выбрал рассу!');
    }
    if ($answer == "elf") {
      $addlogin = $pdo->prepare('INSERT INTO userstones (login, amethyst, diamond, emerald, ruby, sapphire, topaz) VALUES (?, ?, ?, ?, ?, ?, ?)');
      $addlogin->execute([$login, "0.16", "0.16", "0.16" ,"0.16" ,"0.16" ,"0.16"]);
      header("Location: /autorization.php");
    }
    if ($answer == "gnome") {
      header("Location: /autorization.php");
    }
  }
} catch (Exception $e) {
  echo 'Ошибка регистрации: ',  $e->getMessage();
}
?>
<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="css/cssreg.css">

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