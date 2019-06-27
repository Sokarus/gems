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

$stmt1 = $pdo->prepare("SELECT COUNT(type), type FROM stonesinfo WHERE gnome=(?) GROUP BY type");
$stmt1->execute([$tohello]);

?>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssgnomepage.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close">X</a>
</div>

<input id="herelogin" value=<?php echo "$herelogin" ?>>

<div class="jumbotron">
    <div class="container">
        <p class="x1">Страница <?php echo "$herelogin" ?>-а !</p>
        <p class="x2">Привет, <?php echo "$herelogin" ?> !</p>
    </div>
</div>

<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваше имя:
        </span>
        <div class="login100-form">
            <div class="wrap-input100 validate-input" data-validate="Введите имя!">
                <input class="input100" type="text" id="namechange" name="namechange" placeholder=<?php echo $herename; ?>>
                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
            </div>
            <button class="login100-form-btn" type="submit" id="changenamegn" name="changename">
                Изменить имя
            </button>
        </div>
    </div>
</div>


<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваш логин:
        </span>
        <div class="login100-form">
            <div class="wrap-input100 validate-input" data-validate="Введите логин!">
                <input class="input100" type="text" id="loginchange" name="login" placeholder=<?php echo $herelogin; ?>>
                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
            </div>
            <button class="login100-form-btn" type="submit" id="changelogingn" name="changelogin">
                Изменить логин
            </button>
        </div>
    </div>
</div>

<div class="limiter">
    <div class="wrap-login100">
        <span class="login104-form-title">
            Ваш пароль:
        </span>
        <div class="login100-form">
            <div class="wrap-input100 validate-input" data-validate="Введите пароль!">
                <input class="input100" type="password" id="passwordchange" name="password" placeholder="*****">
                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
            </div>
            <button class="login100-form-btn" type="submit" id="changepasswordgn" name="changepassword">
                Изменить пароль
            </button>
        </div>
    </div>
</div>

</div class='inline'>
  <a href="allusers.php">Страница пользователей</a>
</div>

<div class="container">
    <div class="limiter2">
        <form class="back2" name="favoritestones">
            <table class="ui table" id="1">
                <thead>
                    <th>ID</th>
                    <th>TYPE</th>
                </thead>
                <tbody>
                    <?php while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row1 as $col_value) { ?>
                                <td><?php echo $col_value ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <div class="limiter1">
        <a href="jewelry.php" class="button28">Добавить драгоценности</a>
    </div>
</div>
<div id="footer">
    <p class="x3">Дата регистрации: <?php echo $heredatereg ?>
        Дата последней авторизации: <?php echo $heredateaut ?></p>
</div>

<?php include "footer.php"; ?>