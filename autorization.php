<?php
include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssreg.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close">X</a>
</div>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-10 p-b-50">
            <span class="login102-form-title p-b-20">
                Авторизация
            </span>
            <div class="login100-form validate-form">
                <div class="wrap-input101 validate-input" data-validate="Введите логин!">
                    <input class="input100" type="text" id="login" placeholder="Логин">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input101 validate-input" data-validate="Введите пароль!">
                    <input class="input100" type="password" id="password" placeholder="Пароль">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-1">
                    <button class="login100-form-btn" type="submit" id="submit">
                        Авторизоваться
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>