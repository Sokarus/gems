<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();

$getElf = $pdo->prepare("SELECT login FROM users WHERE race='elf'");
$getElf->execute([]);

$getGnome = $pdo->prepare("SELECT login FROM users WHERE race='gnome'");
$getGnome->execute([]);

$getMastergnome = $pdo->prepare("SELECT login FROM users WHERE race='mastergnome'");
$getMastergnome->execute([]);

if (isset($_POST['deleteElf'])) {
    $hereLoginElf = $_POST['elfLogin'];
    $deleteElf = $pdo->prepare("DELETE FROM users WHERE login=(?)");
    $deleteElf->execute([$hereLoginElf]);
    header("Location: /allusers.php");
}

include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cssallusers.css">

<div class="container">
    <div class="limiter1">
        <div class="table">
            <table>
                <thead>
                    <th>ЭЛЬФ</th>
                </thead>
                <tbody>
                    <?php while ($row = $getElf->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row as $col_value) { ?>
                                <td><a href="#zatemnenie" id="<?php echo ($col_value) ?>" onclick="getUserLogin('<?php echo ($col_value) ?>', 'elfLogin')"><?php echo ($col_value) ?></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="limiter1">
        <div class="table">
            <table>
                <thead>
                    <th>ГНОМ</th>
                </thead>
                <tbody>
                    <?php while ($row = $getGnome->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row as $col_value) { ?>
                                <td><a href="#zatemnenie" id="<?php echo $col_value ?>" onclick="getUserLogin('<?php echo $col_value ?>', 'elfLogin')">
                                        <?php echo $col_value ?>
                                    </a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="limiter1">
        <div class="table">
            <table>
                <thead>
                    <th>МАСТЕР-ГНОМ</th>
                </thead>
                <tbody>
                    <?php while ($row = $getMastergnome->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row as $col_value) { ?>
                                <td><?php echo $col_value ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="zatemnenie">
    <div id="okno">
        <form method="POST">
            <input id="elfLogin" name="elfLogin" value="Удалён" readonly><br>
            <a href="#" class="close">Закрыть окно</a>
            <button class="login100-form-btn" type="submit" name="deleteElf">
                Удалить
            </button>
            <button class="login100-form-btn" type="submit" name="gotoElf">
                Перейти
            </button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>