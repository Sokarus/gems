<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$getinfo = $pdo->prepare("SELECT id, type, dateadd, gnome, elf FROM stonesinfo WHERE status='Активен'");
$getinfo->execute([]);

?>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssalljewelry.css">

<div class="jumbotron">
    <div class="container">
        <div class="layer1">
            <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
        </div>
    </div>
</div>

<div class="table">
<table>
    <thead>
        <th>ID</th>
        <th>TYPE</th>
        <th>DATEREG</th>
        <th>GNOME</th>
        <th>ELF</th>
    </thead>
    <tbody>
        <?php while ($row = $getinfo->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <?php foreach ($row as $col_value) { ?>
                    <td><?php echo $col_value ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<button class="login100-form-btn" type="submit" name="save3">
                Распределить
            </button>

<?php include "footer.php"; ?>