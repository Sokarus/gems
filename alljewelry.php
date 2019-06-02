<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$getinfo = $pdo->prepare("SELECT * FROM stonesinfo");
$getinfo->execute([]);

?>
<?php include "header.php"; ?>
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
        <th>DATEGIVE</th>
        <th>DATEACC</th>
        <th>GNOME</th>
        <th>MGNOME</th>
        <th>ALG OR MG</th>
        <th>ELF</th>
        <th>STATUS</th>
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

<?php include "footer.php"; ?>