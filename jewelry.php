<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];
$stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
$stmt->execute([$tohello]);
$row = $stmt->fetch();
$herelogin = $row[0];
$getStones = $pdo->query("SELECT amethyst, sapphire, emerald, ruby, diamond, topaz FROM stones");
$hereStones = $getStones->fetch();
$hereAmethyst = $hereStones[0];
$hereSapphire = $hereStones[1];
$hereEmerald = $hereStones[2];
$hereRuby = $hereStones[3];
$hereDiamond = $hereStones[4];
$hereTopaz = $hereStones[5];

if (isset($_POST["save"])) {
    $amethyst = $_POST["Am"] + $hereAmethyst;
    $sapphire = $_POST["Sa"] + $hereSapphire;
    $emerald = $_POST["Em"] + $hereEmerald;
    $ruby = $_POST["Ru"] + $hereRuby;
    $diamond = $_POST["Di"] + $hereDiamond;
    $topaz = $_POST["To"] + $hereTopaz;
    $addStones = $pdo->prepare("UPDATE stones SET (amethyst, sapphire, emerald, ruby, diamond, topaz) = (?, ?, ?, ?, ?, ?)");
    $addStones->execute([$amethyst, $sapphire, $emerald, $ruby, $diamond, $topaz]);
}
?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="cssjewelry.css">

<div>
    <div class="layer1">
        <p class="x1">Привет, <?php echo "$herelogin" ?> !</p>
    </div>
</div>

<div class="layer7">
    <form class="back3" method="POST">
        <p class="amethyst2"><a class="button29" id="plusAm" onclick="plusStone('Am')">+</a><a class="button27" id="minusAm" onclick="minusStone('Am')">-</a>Аметист</p>
        <p class="amethyst3" id="Am" name="Am">0</p><br>
        <p class="sapphire2"><a class="button29" id="plusSa" onclick="plusStone('Sa')">+</a><a class="button27" id="minusSa" onclick="minusStone('Sa')">-</a>Сапфир</p>
        <p class="sapphire3" id="Sa" name="Sa">0</p><br>
        <p class="emerald2"><a class="button29" id="plusEm" onclick="plusStone('Em')">+</a><a class="button27" id="minusEm" onclick="minusStone('Em')">-</a>Изумруд</p>
        <p class="emerald3" id="Em" name="Em">0</p><br>
        <p class="ruby2"><a class="button29" id="plusRu" onclick="plusStone('Ru')">+</a><a class="button27" id="minusRu" onclick="minusStone('Ru')">-</a>Рубин</p>
        <p class="ruby3" id="Ru" name="Ru">0</p><br>
        <p class="diamond2"><a class="button29" id="plusDi" onclick="plusStone('Di')">+</a><a class="button27" id="minusDi" onclick="minusStone('Di')">-</a>Алмаз</p>
        <p class="diamond3" id="Di" name="Di">0</p><br>
        <p class="topaz2"><a class="button29" id="plusTo" onclick="plusStone('To')">+</a><a class="button27" id="minusTo" onclick="minusStone('To')">-</a>Топаз</p>
        <p class="topaz3" id="To" name="To">0</p><br>
        <button class="login100-form-btn" type="submit" name="save">
            Добавить камни
        </button>
    </form>
</div>
<?php include "footer.php"; ?>