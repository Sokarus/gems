<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];
$stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
$stmt->execute([$tohello]);
$row = $stmt->fetch();
$herelogin = $row[0];

if (isset($_POST["save"])) {
    $date = date("Y-m-d H:i:s");
    $amethyst = 0 + $_POST["Am"];
    $sapphire = 0 + $_POST["Sa"];
    $emerald = 0 + $_POST["Em"];
    $ruby = 0 + $_POST["Ru"];
    $diamond = 0 + $_POST["Di"];
    $topaz = 0 + $_POST["To"];
    $stonesarr = [$amethyst, $sapphire, $emerald, $ruby, $diamond, $topaz];
    if ($stonesarr[0] > 0) {
        for ($i = 1; $i <= $stonesarr[0]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('amethyst', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
    if ($stonesarr[1] > 0) {
        for ($i = 1; $i <= $stonesarr[1]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('sapphire', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
    if ($stonesarr[2] > 0) {
        for ($i = 1; $i <= $stonesarr[2]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('emerald', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
    if ($stonesarr[3] > 0) {
        for ($i = 1; $i <= $stonesarr[3]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('ruby', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
    if ($stonesarr[4] > 0) {
        for ($i = 1; $i <= $stonesarr[4]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('diamond', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
    if ($stonesarr[5] > 0) {
        for ($i = 1; $i <= $stonesarr[5]; $i++) {
            $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd) VALUES ('topaz', ?, ?)");
            $addStones->execute([$tohello, $date]);
        }
    }
}
?>
<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssjewelry.css">

<div class="jumbotron">
    <div class="container">
        <div class="layer1">
            <p class="x1">Привет, <?php echo "$herelogin" ?> !</p>
        </div>
    </div>
</div>

<div class="jewelry">
    <form class="back3" method="POST">
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
        <button class="login100-form-btn" type="submit" name="save">
            Добавить камни
        </button>
    </form>
</div>

<?php include "footer.php"; ?>