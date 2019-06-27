<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$getinfo = $pdo->prepare("SELECT id, type, dateadd, gnome, elf FROM stonesinfo WHERE status='Активен' and condition!='Распределён' and condition!='Назначен'");
$getinfo->execute([]);

?>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssjewelrydistribution.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close" id="closerefr">X</a>
</div>

<div class="jumbotron">
    <div class="container">
        <div class="layer1">
            <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
        </div>
    </div>
</div>

<div class="ui table">
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

</div class='inline'>
<a href="allusers.php">Страница пользователей</a>
</div>

</div class='inline'>
<a href="settings.php">Настройки системы</a>
</div>

<div class="container">
    <button class="login100-form-btn" type="submit" id="distribute" name="distribute">
        Распределить
    </button>
    <button class="login100-form-btn" type="submit" id="distributeAccess" name="distributeAccess">
        Подтвердить
    </button>
</div>
<?php include "footer.php"; ?>