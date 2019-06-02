<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$getStones = $pdo->query("SELECT SUM(amethyst), SUM(sapphire), SUM(emerald), SUM(ruby), SUM(diamond), SUM(topaz) FROM stones");
$hereStones = $getStones->fetch();
$allAmethyst = $hereStones[0];
$allSapphire = $hereStones[1];
$allEmerald = $hereStones[2];
$allRuby = $hereStones[3];
$allDiamond = $hereStones[4];
$allTopaz = $hereStones[5];

include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssalljewelry.css">

<div class="container">
    <span class="login106-form-title">
        Все драгоценности:
    </span>
    <div class="limiter1">
        <form class="back4" name="formstones" method="post">
            <p class="amethyst2">Аметист: <?php echo $allAmethyst ?></p>
            <p class="sapphire2">Сапфир: <?php echo $allSapphire ?></p>
            <p class="emerald2">Изумруд: <?php echo $allEmerald ?></p>
            <p class="ruby2">Рубин: <?php echo $allRuby ?></p>
            <p class="diamond2">Алмаз: <?php echo $allDiamond ?></p>
            <p class="topaz2">Топаз: <?php echo $allTopaz ?></p>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>