<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$getinfo = $pdo->prepare("SELECT * FROM stonesinfo");
$getinfo->execute([]);

?>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssalljewelry.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close" id="closeall">X</a>
</div>

<input id="herelogin" value=<?php echo "$tohello" ?>>

<div class="jumbotron">
    <div class="container">
        <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
    </div>
</div>

<div class="ui container">

    <div class="column">
        <div class="ui input focus">
            <input id="input1" type="text" placeholder="Search...">
        </div>
    </div>
    <div class="scroll">
        <div class="column">
            <table class="ui table" id="1">
                <thead>
                    <th>ID</th>
                    <th>TYPE</th>
                    <th>DATEREG</th>
                    <th>DATEGIVE</th>
                    <th>DATEACC</th>
                    <th>GNOME</th>
                    <th>MGNOME</th>
                    <th>ALG OR MG</th>
                    <th>ELF</th>
                    <th>CONDITION</th>
                    <th>STATUS</th>
                    <th>УДАЛИТЬ</th>
                </thead>
                <tbody>
                    <?php while ($row = $getinfo->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <?php foreach ($row as $col_value) { ?>
                                <td><?php echo $col_value ?></td>
                            <?php } ?>
                            <td><button class="delete" id="deletestone" data-row-id="<?= $row['id'] ?>">Удалить</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div class='inline'>
  <a href="jewelrydistribution.php">Распределение камней</a>
</div>

<?php include "footer.php"; ?>