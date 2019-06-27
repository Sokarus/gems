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

$getStonesAccess = $pdo->prepare("SELECT id, type FROM stonesinfo WHERE elf=(?) and condition='Назначен' and status='Активен'");
$getStonesAccess->execute([$tohello]);

$gemNames = [
    "Аметист",
    "Сапфир",
    "Изумруд",
    "Рубин",
    "Алмаз",
    "Топаз"
];

$arrGems = [];

for ($i = 0; $i < count($gemNames); $i++) {
    $getElfStones = $pdo->prepare("SELECT COUNT(type) FROM stonesinfo WHERE elf=(?) and condition='Распределён' and status='Активен' and type=(?)");
    $getElfStones->execute([$tohello, $gemNames[$i]]);
    $rowCount = $getElfStones->fetch();
    array_push($arrGems, $rowCount[0]);
}


?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/csselfpage.css">

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
            <button class="login100-form-btn" type="submit" id="changename" name="changename">
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
            <button class="login100-form-btn" type="submit" id="changelogin" name="changelogin">
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
            <button class="login100-form-btn" type="submit" id="changepassword" name="changepassword">
                Изменить пароль
            </button>
        </div>
    </div>
</div>

</div class='inline'>
  <a href="allusers.php">Страница пользователей</a>
</div>

<div class="container">
    <div class="limiter1">
        <span class="login104-form-title">
            Поменять предпочтения:
        </span>
        <div class="back1">
            <p class="amethyst"><input class="stone" id="amethyst" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('amethyst', 'rangeAmethyst')">Аметист</p>
            <p class="sapphire"><input class="stone" id="sapphire" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('sapphire', 'rangeSapphire')">Сапфир</p>
            <p class="emerald"><input class="stone" id="emerald" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('emerald', 'rangeEmerald')">Изумруд</p>
            <p class="ruby"><input class="stone" id="ruby" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('ruby', 'rangeRuby')">Рубин</p>
            <p class="diamond"><input class="stone" id="diamond" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('diamond', 'rangeDiamond')">Алмаз</p>
            <p class="topaz"><input class="stone" id="topaz" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('topaz', 'rangeTopaz')">Топаз</p>
            <button class="login100-form-btn" type="submit" id="saveStones">
                Выбрать камни
            </button>
        </div>
    </div>
    <div class="limiter2">
        <div class="intStones">
            <span class="intAmethyst" id="rangeAmethyst" value="16">16</span><br>
            <span class="intSapphire" id="rangeSapphire" value="16">16</span><br>
            <span class="intEmerald" id="rangeEmerald" value="16">16</span><br>
            <span class="intRuby" id="rangeRuby" value="16">16</span><br>
            <span class="intDiamond" id="rangeDiamond" value="16">16</span><br>
            <span class="intTopaz" id="rangeTopaz" value="16">16</span><br>
        </div>
    </div>

    <div class="limiter2">
        <span class="login104-form-title">
            Предпочтения:
        </span>
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
        <form class="back2" name="favoritestones">
            <p class="amethyst1"><?php if ($arrGems[0] == NULL) {
                                        echo "Пусто";
                                    } else {
                                        echo (Аметист . " " . $arrGems[0]);
                                    } ?></p>
            <p class="sapphire1"><?php if ($arrGems[1] == NULL) {
                                        echo "Пусто";
                                    } else {
                                        echo (Сапфир . " " . $arrGems[1]);
                                    } ?></p>
            <p class="emerald1"><?php if ($arrGems[2] == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Изумруд . " " . $arrGems[2]);
                                } ?></p>
            <p class="ruby1"><?php if ($arrGems[3] == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Рубин . " " . $arrGems[3]);
                                } ?></p>
            <p class="diamond1"><?php if ($arrGems[4] == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Алмаз . " " . $arrGems[4]);
                                } ?></p>
            <p class="topaz1"><?php if ($arrGems[5] == NULL) {
                                    echo "Пусто";
                                } else {
                                    echo (Топаз . " " . $arrGems[5]);
                                } ?></p>
        </form>
    </div>

    <div class="limiter2">
        <span class="login104-form-title">
            Назначенные:
        </span>
        <form class="back4" name="favoritestones">
            <table class="ui table" id="1">
                <thead>
                    <th>ID</th>
                    <th>TYPE</th>
                    <th>Получить</th>
                </thead>
                <tbody>
                    <?php while ($row1 = $getStonesAccess->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row1 as $col_value) { ?>
                                <td><?php echo $col_value ?></td>
                            <?php } ?>
                            <td><button class="getStone" id="getStone" data-row-id="<?= $row1['id'] ?>">Получить</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div id="footer">
    <p class="x3">Дата регистрации: <?php echo $heredatereg ?>
        Дата последней авторизации: <?php echo $heredateaut ?></p>
</div>
<?php include "footer.php"; ?>