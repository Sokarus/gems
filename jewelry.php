<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$sqlCheck = $pdo->prepare("SELECT race FROM users WHERE login='$tohello'");
$sqlCheck->execute([]);
$row = $sqlCheck->fetch();
if ($row[0] == "elf") {
    header("Location: /elfpage.php");
    die("Эльфу сюда нельзя!");
}

?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssjewelry.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close" id="closegn">X</a>
</div>

<input id="herelogin" value=<?php echo "$tohello" ?>>

<div class="jumbotron">
    <div class="container">
        <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
    </div>
</div>

<div class="jewelry">
    <div class="back3">
        <p class="amethyst2"><a class="button29" id="plusAm" onclick="plusStone('Am')">+</a><input class="amethyst4" type="number" id="Am" name="Am" value="0" readonly><a class="button29" id="minusAm" onclick="minusStone('Am')">-</a>Аметист</p>
        <br>
        <p class="sapphire2"><a class="button29" id="plusSa" onclick="plusStone('Sa')">+</a><input class="sapphire4" type="number" id="Sa" name="Sa" value="0" readonly><a class="button29" id="minusSa" onclick="minusStone('Sa')">-</a>Сапфир</p>
        <br>
        <p class="emerald2"><a class="button29" id="plusEm" onclick="plusStone('Em')">+</a><input class="emerald4" type="number" id="Em" name="Em" value="0" readonly><a class="button29" id="minusEm" onclick="minusStone('Em')">-</a>Изумруд</p>
        <br>
        <p class="ruby2"><a class="button29" id="plusRu" onclick="plusStone('Ru')">+</a><input class="ruby4" type="number" id="Ru" name="Ru" value="0" readonly><a class="button29" id="minusRu" onclick="minusStone('Ru')">-</a>Рубин</p>
        <br>
        <p class="diamond2"><a class="button29" id="plusDi" onclick="plusStone('Di')">+</a><input class="diamond4" type="number" id="Di" name="Di" value="0" readonly><a class="button29" id="minusDi" onclick="minusStone('Di')">-</a>Алмаз</p>
        <br>
        <p class="topaz2"><a class="button29" id="plusTo" onclick="plusStone('To')">+</a><input class="topaz4" type="number" id="To" name="To" value="0" readonly><a class="button29" id="minusTo" onclick="minusStone('To')">-</a>Топаз</p>
        <br>
        <button class="login100-form-btn" type="submit" id="pushstones" name="pushstones">
            Добавить камни
        </button>
    </div>
</div>

<?php include "footer.php"; ?>