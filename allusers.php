<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

$getElf = $pdo->prepare("SELECT login, name, allstones, stone1, stone2, stone3, status FROM users WHERE race='elf'");
$getElf->execute([]);

$getGnome = $pdo->prepare("SELECT login, name, allstones, status FROM users WHERE race='gnome'");
$getGnome->execute([]);

$getMastergnome = $pdo->prepare("SELECT login FROM users WHERE race='mastergnome'");
$getMastergnome->execute([]);

$mastergnomeCheck = $pdo->prepare("SELECT race FROM users WHERE login=(?)");
$mastergnomeCheck->execute([$tohello]);
$hereMastergnomeCheck = $mastergnomeCheck->fetch();

// удаление юзеров делаются в одной функиции
if (isset($_POST['deleteElf'])) {
    try {
        if ($hereMastergnomeCheck[0] == 'mastergnome') {
            $hereLoginElf = $_POST['elfLogin'];
            $deleteElf = $pdo->prepare("DELETE FROM users WHERE login=(?)");
            $deleteElf->execute([$hereLoginElf]);
            $deleteElf = $pdo->prepare("DELETE FROM userstones WHERE login=(?)"); //не удалять а обновлять
            $deleteElf->execute([$hereLoginElf]);
            header("Location: /allusers.php");
        } else {
            throw new Exception('Вам нельзя этого делать!');
        }
    } catch (Exception $e) {
        echo 'Ошибка удаления: ',  $e->getMessage(); // нужно запихать эту ошибку в input value
    }
}
// комбинировать фильтры инпуты и списки 
$errorMessage = null;

if (isset($_POST['deleteGnome'])) {
    try {
        if ($hereMastergnomeCheck[0] == 'mastergnome') {
            $hereLoginGnome = $_POST['gnomeLogin'];
            $deleteGnome = $pdo->prepare("DELETE FROM users WHERE login=(?)");
            $deleteGnome->execute([$hereLoginGnome]);
            header("Location: /allusers.php");
        } else {
            throw new Exception('Вам нельзя этого делать!');
        }
    } catch (Exception $e) {
        $errorMessage = 'Ошибка удаления: ' . $e->getMessage();
    }
}


if (isset($_POST['gotoElf'])) {
    $hereLoginElf = $_POST['elfLogin'];
    header("Location: /elfpage.php");
}

if (isset($_POST['gotoGnome'])) {
    $hereLoginGnome = $_POST['gnomeLogin'];
    header("Location: /gnomepage.php");
}

include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssallusers.css">

<div id="zatemnenie">
    <div id="okno"></div>
    <a href="#" class="close" id="closeallusers">X</a>
</div>

<div class="jumbotron">
    <div class="container">
        <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
    </div>
</div>

<div class="limiter1">

    <div class="ui input focus">
        <input id="input1" type="text" placeholder="Найти...">
    </div>
    <div class="scroll">
        <table class="ui table" id="1">
            <thead>
                <tr>
                    <td>ЭЛЬФ</td>
                    <td>ИМЯ</td>
                    <td>Драг</td>
                    <th>Кам1</th>
                    <th>Кам2</th>
                    <th>Кам3</th>
                    <td>Статус</td>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $getElf->fetch(PDO::FETCH_ASSOC)) {

                    ?>
                    <tr>
                        <?php foreach ($row as $col_value) {

                            ?>

                            <td><?php echo ($col_value) ?></td>
                        <?php } ?>
                        <td><button class="delete" id="deleteelf" data-row-id="<?= $row['login'] ?>">Удалить</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>





<div class="limiter2">

    <div class="ui input focus">
        <input id="input2" type="text" placeholder="Найти...">
    </div>
    <div class="scroll">
        <table class="ui table" id="2">
            <thead>
                <td>ГНОМ</td>
                <td>ИМЯ</td>
                <td>Драг</td>
                <td>Статус</td>
                <th>Удалить</th>
            </thead>
            <tbody>
                <?php while ($row = $getGnome->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <?php foreach ($row as $col_value) { ?>
                            <td><?php echo ($col_value) ?></td>
                        <?php } ?>
                        <td><button class="delete" id="deletegnome" data-row-id="<?= $row['login'] ?>">Удалить</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="limiter3">
    <table class="ui table">
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

<!-- аякс запросы  -->


<div class="container">
    <div class="my-5 mx-auto text-center">
        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModal">Зарегистрировать пользователя</button>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
                <button type="button" class="closex" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contactForm">
                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input id="name" class="form-control" name="name" required type="text" placeholder="Великий">
                    </div>
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input id="login" class="form-control" name="login" required type="text" placeholder="Завоеватель">
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль:</label>
                        <input id="password" class="form-control" name="password" required type="password" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label for="password2">Повторите пароль:</label>
                        <input id="password2" class="form-control" name="password2" required type="password" placeholder="*****">
                    </div>
                    <form id="myForm">
                        <p class="x"><input type="radio" id="elf" name="radio" value="elf">Эльф
                            <input type="radio" id="gnome" name="radio" value="gnome">Гном<input type="radio" id="mastergnome" name="radio" value="mastergnome">Мастер-гном<Br></p>
                    </form>
                    <button class="btn btn-success" id="registrationall" name="registration" type="submit">Добавить</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div class='inline'>
  <a href="jewelrydistribution.php">Распределение камней</a>
</div>

<?php include "footer.php"; ?>