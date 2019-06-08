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
        $errorMessage = 'Ошибка удаления: '.$e->getMessage();
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

if (isset($_POST['save'])) {
    try {
        if ($hereMastergnomeCheck[0] == 'mastergnome') {
            $name = $_POST['name'];
            $login = $_POST['login'];
            $password = sha1($_POST['password']);
            $password2 = sha1($_POST['password2']);
            $answer = $_POST['answer'];
            if ($password !== $password2) {
                throw new Exception('Пароли не совпадают!');
            }
            if ($row['login'] == $login) {
                throw new Exception('Пользователь с таким логином уже существует!');
            }
            if ($answer) {
                $date = date("Y-m-d H:i:s");
                $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg, status) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$name, $login, $password, $answer, $date, 'Активен']);
            } else {
                throw new Exception('Пользователь не выбрал рассу!');
            }
            if ($answer == "elf") {
                $addlogin = $pdo->prepare('INSERT INTO userstones (login, amethyst, diamond, emerald, ruby, sapphire, topaz) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $addlogin->execute([$login, "0.16", "0.16", "0.16", "0.16", "0.16", "0.16"]);
                header("Location: /allusers.php");
            }
            if ($answer == "gnome") {
                header("Location: /allusers.php");
            }
            if ($answer == "mastergnome") {
                header("Location: /allusers.php");
            }
        } else {
            throw new Exception('Вам нельзя этого делать!');
        }
    } catch (Exception $e) {
        echo 'Ошибка регистрации: ',  $e->getMessage();
    }
}

include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/cssallusers.css">

<div class="jumbotron">
    <div class="container">
        <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
    </div>
</div>
<div class="inline">
    <div class="ui container">

        <div class="column">
            <div class="ui input focus">
                <input id="input1" type="text" placeholder="Найти...">
            </div>
        </div>

        <div class="container">
            <div class="limiter1">
                <table class="ui table" id="1">
                    <thead>
                        <tr>
                            <td>ЭЛЬФ</td>
                            <td>ИМЯ</td>
                            <td>Драгоценности</td>
                            <th>Камень1</th>
                            <th>Камень2</th>
                            <th>Камень3</th>
                            <td>Статус</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $getElf->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                            <tr>
                                <?php foreach ($row as $col_value) {

                                    ?>

                                    <td><a href="#zatemnenie" id="<?php echo ($col_value) ?>" onclick="getUserLogin('<?php echo ($col_value) ?>', 'elfLogin')"><?php echo ($col_value) ?></a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="ui container">

    <div class="column2">
        <div class="ui input focus">
            <input id="input2" type="text" placeholder="Найти...">
        </div>
    </div>

    <div class="limiter2">
        <table class="ui table" id="2">
            <thead>
                <td>ГНОМ</td>
                <td>ИМЯ</td>
                <td>Драгоценности</td>
                <td>Статус</td>
            </thead>
            <tbody>
                <?php while ($row = $getGnome->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <?php foreach ($row as $col_value) { ?>
                            <td><a href="#zatemneniegnome" id="<?php echo ($col_value) ?>" onclick="getUserLogin('<?php echo ($col_value) ?>', 'gnomeLogin')"><?php echo ($col_value) ?></a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="limiter3">
    <table class="sort">
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

<div id="zatemneniegnome">
    <div id="okno">
        <form method="POST">
            <input id="gnomeLogin" name="gnomeLogin" value="<?= $errorMessage ?>" readonly><br>
            <a href="#" class="close">Закрыть окно</a>
            <button class="login100-form-btn" type="submit" name="deleteGnome">
                Удалить
            </button>
            <button class="login100-form-btn" type="submit" name="gotoGnome">
                Перейти
            </button>
        </form>
    </div>
</div>

<div class="container">
    <div class="my-5 mx-auto text-center">
        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModal">Зарегистрировать пользователя</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contactForm" method="post">
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
                    <p class="x"><input type="radio" name="answer" value="elf">Эльф
                        <input type="radio" name="answer" value="gnome">Гном<input type="radio" name="answer" value="mastergnome">Мастер-гном<Br></p>
                    <button id="button" class="btn btn-success" name="save" type="submit">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>