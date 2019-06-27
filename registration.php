<?php include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="css/cssreg.css">

<div id="zatemnenie">
  <div id="okno"></div>
  <a href="#" class="close">X</a>
</div>

<div class="container-login102">
  <div class="wrap-login101 p-t-1 p-b-20">
    <span class="login101-form-title">
      Регистрация
    </span>
    <div class="login100-form validate-form">
      <div class="wrap-input101 validate-input" data-validate="Введите имя!">
        <input class="input100" type="text" id="name" placeholder="Имя">
        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
      </div>
      <div class="wrap-input101 validate-input" data-validate="Введите логин!">
        <input class="input100" type="text" id="login" placeholder="Логин">
        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
      </div>
      <div class="wrap-input101 validate-input" data-validate="Введите пароль!">
        <input class="input100" type="password" id="password" placeholder="Пароль">
        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
      </div>
      <div class="wrap-input101 validate-input" data-validate="Повторите пароль!">
        <input class="input100" type="password" id="password2" placeholder="Повторите пароль">
        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
      </div>
      <form id="myForm">
        <p class="x"><input type="radio" id="elf" name="radio" value="elf">Эльф
          <input type="radio" id="gnome" name="radio" value="gnome">Гном<input type="radio" id="mastergnome" name="radio" value="mastergnome">Мастер-гном<Br></p>
      </form>
      <div class="container-login100-form-btn m-t-1">
        <button class="login100-form-btn" type="submit" id="registration">
          Зарегистрироваться
        </button>
      </div>
    </div>
  </div>
  <div class="container-login100-form-btn m-t-1">
    <button class="login100-form-btn" onClick='location.href="/autorization.php"'>Авторизация
    </button>
  </div>
</div>

<?php include "footer.php"; ?>