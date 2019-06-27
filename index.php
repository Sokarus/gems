<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssindex.css">

<div id="zatemnenie">
  <div id="okno"></div>
  <a href="#" class="close">X</a>
</div>

<div class="jumbotron">
  <div class="container">
    <p>Привет, путник!
      Регистрируйся скорее!</p><br>
  </div>
</div>

<div class="container-login101">
  <div class="wrap-login100">
    <span class="login100-form-title">
      Авторизация
    </span>

    <div class="wrap-input100 validate-input" data-validate="Введите логин!">
      <input class="input100" type="text" id="login" placeholder="Логин">
      <span class="focus-input100" data-placeholder="&#xe82a;"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Введите пароль!">
      <input class="input100" type="password" id="password" placeholder="Пароль">
      <span class="focus-input100" data-placeholder="&#xe80f;"></span>
    </div>
    <button class="login100-form-btn" type="submit" id="submit">
      Авторизация
    </button>

  </div>
  <a href="registration.php">Регистрация</a>
</div>


</div>
<?php include "footer.php"; ?>