<?php
$index = $_POST['index'];

if ($index == "index") {
    try {
        if (isset($_POST['login'])) {
            require '../dbconn.php';
            $login = $_POST['login'];
            $password = $_POST['password'];
            $stmt = $pdo->prepare("SELECT login , password FROM users where login=(?)");
            $stmt->execute([$login]);
            $row = $stmt->fetch();
        }
        if ($row['login'] !== $login || $row['password'] !== sha1($password)) {
            throw new Exception('Неверный логин или пароль!');
        } else {
            $date = date("Y-m-d H:i:s");
            session_start();
            $_SESSION['login'] = $row['login'];
            $adddate = $pdo->prepare("UPDATE users SET dateaut = (?) where login='$login'");
            $adddate->execute([$date]);
            $stmt = $pdo->prepare("SELECT race FROM users where login=(?)");
            $stmt->execute([$login]);
            $row = $stmt->fetch();
        }
        if ($row[0] == "elf") {
            echo $row[0];
        }
        if ($row[0] == "gnome") {
            echo $row[0];
        }
        if ($row[0] == "mastergnome") {
            echo $row[0];
        }
    } catch (Exception $e) {
        echo 'Ошибка авторизации: ',  $e->getMessage();
    }
}
if ($index == "registration") {
    require '../dbconn.php';
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $elf = $_POST['elf'];
    $gnome = $_POST['gnome'];
    $mastergnome = $_POST['mastergnome'];
    $stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
    $stmt->execute([$login]);
    $row = $stmt->fetch();
    $date = date("Y-m-d H:i:s");
    $number = 16;
    function addUser($name, $login, $password, $race, $date)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg, status) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$name, $login, sha1($password), $race, $date, 'Активен']);
    }
    try {
        if ($name == "") {
            throw new Exception('Введите имя!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $name)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($name) >= 20) {
            throw new Exception('Имя должно быть меньше 20 символов!');
        }
        if (strlen($name) < 1) {
            throw new Exception('Имя должно быть больше 1 символа!');
        }
        if ($login == "") {
            throw new Exception('Введите логин!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $login)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($login) >= 20) {
            throw new Exception('Логин должен быть меньше 20 символов!');
        }
        if (strlen($login) < 3) {
            throw new Exception('Логин должен быть больше 3 символов!');
        }
        if ($password == "") {
            throw new Exception('Введите пароль!');
        }
        if (strlen($password) >= 20) {
            throw new Exception('Пароль должен быть меньше 20 символов!');
        }
        if (strlen($password) <= 3) {
            throw new Exception('Пароль должен быть больше 3 символов!');
        }
        if (sha1($password) !== sha1($password2)) {
            throw new Exception('Пароли не совпадают!');
        }
        if ($row['login'] == $login) {
            throw new Exception('Пользователь с таким логином уже существует!');
        }
        if ($elf !== "elf" && $gnome !== "gnome" && $mastergnome !== "mastergnome") {
            throw new Exception('Пользователь не выбрал рассу!');
        }
        if ($elf == "elf") {
            addUser($name, $login, $password, $elf, $date);
            $addlogin = $pdo->prepare('INSERT INTO userstones (login, amethyst, diamond, emerald, ruby, sapphire, topaz) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $addlogin->execute([$login, $number, $number, $number, $number, $number, $number]);
            echo "elf";
        }
        if ($gnome == "gnome") {
            addUser($name, $login, $password, $gnome, $date);
            echo "gnome";
        }
        if ($mastergnome == "mastergnome") {
            addUser($name, $login, $password, $mastergnome, $date);
            echo "mastergnome";
        }
    } catch (Exception $e) {
        echo 'Ошибка регистрации: ',  $e->getMessage();
    }
}
if ($index == "registrationall") {
    require '../dbconn.php';
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $elf = $_POST['elf'];
    $gnome = $_POST['gnome'];
    $mastergnome = $_POST['mastergnome'];
    $stmt = $pdo->prepare("SELECT login FROM users where login=(?)");
    $stmt->execute([$login]);
    $row = $stmt->fetch();

    try {
        if ($name == "") {
            throw new Exception('Введите имя!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $name)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($name) >= 20) {
            throw new Exception('Имя должно быть меньше 20 символов!');
        }
        if (strlen($name) < 1) {
            throw new Exception('Имя должно быть больше 1 символа!');
        }
        if ($login == "") {
            throw new Exception('Введите логин!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $login)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($login) >= 20) {
            throw new Exception('Логин должен быть меньше 20 символов!');
        }
        if (strlen($login) < 3) {
            throw new Exception('Логин должен быть больше 3 символов!');
        }
        if ($password == "") {
            throw new Exception('Введите пароль!');
        }
        if (strlen($password) >= 20) {
            throw new Exception('Пароль должен быть меньше 20 символов!');
        }
        if (strlen($password) <= 3) {
            throw new Exception('Пароль должен быть больше 3 символов!');
        }
        if (sha1($password) !== sha1($password2)) {
            throw new Exception('Пароли не совпадают!');
        }
        if ($row['login'] == $login) {
            throw new Exception('Пользователь с таким логином уже существует!');
        }
        if ($elf !== "elf" && $gnome !== "gnome" && $mastergnome !== "mastergnome") {
            throw new Exception('Пользователь не выбрал рассу!');
        }
        if ($elf == "elf") {
            $date = date("Y-m-d H:i:s");
            $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg, status) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $login, sha1($password), $elf, $date, 'Активен']);
            $addlogin = $pdo->prepare('INSERT INTO userstones (login, amethyst, diamond, emerald, ruby, sapphire, topaz) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $addlogin->execute([$login, "0.16", "0.16", "0.16", "0.16", "0.16", "0.16"]);
            echo "elf";
        }
        if ($gnome == "gnome") {
            $date = date("Y-m-d H:i:s");
            $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg, status) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $login, sha1($password), $gnome, $date, 'Активен']);
            echo "gnome";
        }
        if ($mastergnome == "mastergnome") {
            $date = date("Y-m-d H:i:s");
            $stmt = $pdo->prepare('INSERT INTO users (name, login, password, race, datereg, status) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $login, sha1($password), $mastergnome, $date, 'Активен']);
            echo "mastergnome";
        }
    } catch (Exception $e) {
        echo 'Ошибка регистрации: ',  $e->getMessage();
    }
}

if ($index == "chname") {
    require '../dbconn.php';
    $name = $_POST['name'];
    $login = $_POST['login'];
    try {
        if ($name == "") {
            throw new Exception('Введите имя!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $name)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($name) >= 20) {
            throw new Exception('Имя должно быть меньше 20 символов!');
        }
        if (strlen($name) <= 1) {
            throw new Exception('Имя должно быть больше 1 символа!');
        } else {
            $changename = $pdo->prepare("UPDATE users SET name='$name' WHERE login=(?)");
            $changename->execute([$login]);
            echo "ok";
        }
    } catch (Exception $e) {
        echo 'Ошибка ввода имени: ',  $e->getMessage();
    }
}

if ($index == "chlogin") {
    require '../dbconn.php';
    session_start();
    $loginchange = $_POST['loginchange'];
    $login = $_POST['login'];
    $stmt = $pdo->prepare("SELECT login FROM users");
    $stmt->execute([]);
    $row = $stmt->fetchAll();
    try {
        if ($loginchange == "") {
            throw new Exception('Введите логин!');
        }
        for ($i = 0; $i < count($row); $i++) {
            if ($row[$i][0] == $loginchange) {
                throw new Exception('Логин занят!');
            }
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $loginchange)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($loginchange) >= 20) {
            throw new Exception('Логин должен быть меньше 20 символов!');
        }
        if (strlen($loginchange) <= 2) {
            throw new Exception('Логин должен быть больше 2 символов!');
        } else {
            $stmt = $pdo->prepare("UPDATE users SET login=(?) WHERE login='$login'");
            $stmt->execute([$loginchange]);
            $stmt2 = $pdo->prepare("UPDATE userstones SET login=(?) WHERE login='$login'");
            $stmt2->execute([$loginchange]);
            unset($_SESSION['login']);
            $_SESSION['login'] = $loginchange;
            echo "ok";
        }
    } catch (Exception $e) {
        echo 'Ошибка ввода логина: ',  $e->getMessage();
    }
}

if ($index == "chlogingn") {
    require '../dbconn.php';
    session_start();
    $loginchange = $_POST['loginchange'];
    $login = $_POST['login'];
    $stmt = $pdo->prepare("SELECT login FROM users");
    $stmt->execute([]);
    $row = $stmt->fetchAll();
    try {
        if ($loginchange == "") {
            throw new Exception('Введите логин!');
        }
        for ($i = 0; $i < count($row); $i++) {
            if ($row[$i][0] == $loginchange) {
                throw new Exception('Логин занят!');
            }
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $loginchange)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($loginchange) >= 20) {
            throw new Exception('Логин должен быть меньше 20 символов!');
        }
        if (strlen($loginchange) <= 2) {
            throw new Exception('Логин должен быть больше 2 символов!');
        } else {
            $stmt = $pdo->prepare("UPDATE users SET login=(?) WHERE login='$login'");
            $stmt->execute([$loginchange]);
            unset($_SESSION['login']);
            $_SESSION['login'] = $loginchange;
            echo "ok";
        }
    } catch (Exception $e) {
        echo 'Ошибка ввода логина: ',  $e->getMessage();
    }
}

if ($index == "chpassword") {
    require '../dbconn.php';
    $password = $_POST['password'];
    $login = $_POST['login'];
    $passwordsha1 = sha1($password);
    try {
        if ($password == "") {
            throw new Exception('Введите пароль!');
        }
        if (preg_match("/^[а-яА-Я]+$/iu", $password)) {
            throw new Exception('На английском пожалуйста!');
        }
        if (strlen($password) >= 20) {
            throw new Exception('Пароль должен быть меньше 20 символов!');
        }
        if (strlen($password) <= 3) {
            throw new Exception('Пароль должен быть больше 3 символов!');
        } else {
            $changepassword = $pdo->prepare("UPDATE users SET password=(?) WHERE login='$login'");
            $changepassword->execute([$passwordsha1]);
            echo "ok";
        }
    } catch (Exception $e) {
        echo 'Ошибка ввода пароля: ',  $e->getMessage();
    }
}

if ($index == "chstones") {
    require '../dbconn.php';
    $login = $_POST['login'];
    $amethyst = 0 + $_POST['amethyst'];
    $sapphire = 0 + $_POST['sapphire'];
    $emerald = 0 + $_POST['emerald'];
    $ruby = 0 + $_POST['ruby'];
    $diamond = 0 + $_POST['diamond'];
    $topaz = 0 + $_POST['topaz'];

    $stonesum = $amethyst + $sapphire + $emerald + $ruby + $diamond + $topaz;

    $amValue = round(($amethyst / $stonesum) * 100);
    $saValue = round(($sapphire / $stonesum) * 100);
    $emValue = round(($emerald / $stonesum) * 100);
    $ruValue = round(($ruby / $stonesum) * 100);
    $diValue = round(($diamond / $stonesum) * 100);
    $toValue = round(($topaz / $stonesum) * 100);

    $stoneArr = [
        $amethyst,
        $sapphire,
        $emerald,
        $ruby,
        $diamond,
        $topaz
    ];

    $gemTypes = [
        'amethyst',
        'sapphire',
        'emerald',
        'ruby',
        'diamond',
        'topaz'
    ];

    $gemNames = [
        "amethyst" => "Аметист",
        "sapphire" => "Сапфир",
        "emerald" => "Изумруд",
        "ruby" => "Рубин",
        "diamond" => "Алмаз",
        "topaz" => "Топаз"
    ];

    $gemOne = 1;
    $gemTwo = 1;
    $gemThree = 1;
    foreach ($gemTypes as $gemType) {
        $gemCount = +$_POST[$gemType];
        if ($gemCount >= $gemOne) {
            $gemOne = $gemCount;
            $gemOneAga = $gemNames[$gemType];
        }
    }

    foreach ($gemTypes as $gemType) {
        $gemCount = +$_POST[$gemType];
        if ($gemCount >= $gemTwo && $gemNames[$gemType] !== $gemOneAga) {
            $gemTwo = $gemCount;
            $gemTwoAga = $gemNames[$gemType];
        }
    }

    foreach ($gemTypes as $gemType) {
        $gemCount = +$_POST[$gemType];
        if ($gemCount >= $gemThree && $gemNames[$gemType] !== $gemTwoAga && $gemNames[$gemType] !== $gemOneAga) {
            $gemThree = $gemCount;
            $gemThreeAga = $gemNames[$gemType];
        }
    }

    if (!empty($gemOneAga)) {
        $favorit = $pdo->prepare("UPDATE users SET stone1 = '$gemOneAga' WHERE login='$login'");
        $favorit->execute([]);
    }

    if (!empty($gemTwoAga)) {
        $favorit = $pdo->prepare("UPDATE users SET stone2 = '$gemTwoAga' WHERE login='$login'");
        $favorit->execute([]);
    }
    if (!empty($gemThreeAga)) {
        $favorit = $pdo->prepare("UPDATE users SET stone3 = '$gemThreeAga' WHERE login='$login'");
        $favorit->execute([]);
    }

    $changeStones = $pdo->prepare("UPDATE userstones SET (amethyst, diamond, emerald, ruby, sapphire, topaz) = (?, ?, ?, ?, ?, ?) WHERE login='$login'");
    $changeStones->execute([$amValue, $diValue, $emValue, $ruValue, $saValue, $toValue]);
    echo "ok";
}

if ($index == "pushstones") {
    require '../dbconn.php';
    $login = $_POST['login'];

    function pushStones($stonerus, $stoneCount, $login)
    {
        global $pdo;
        $date = date("Y-m-d H:i:s");
        $addStones = $pdo->prepare("INSERT INTO stonesinfo (type, gnome, dateadd, condition, status) VALUES ('$stonerus', ?, ?, 'Свободен', 'Активен')");
        $stonesValue = $pdo->prepare("SELECT allstones FROM users where login=(?)");
        $stonesValue->execute([$login]);
        $tableValue = $stonesValue->fetch();
        $currentValue = +$tableValue[0];
        for ($i = 1; $i <= $stoneCount; $i++) {
            $currentValue = $currentValue + 1;
            $addStones->execute([$login, $date]);
        }
        $updateStonesValue = $pdo->prepare("UPDATE users SET allstones='$currentValue' where login=(?)");
        $updateStonesValue->execute([$login]);
    }

    $gemTypes = [
        'amethyst',
        'sapphire',
        'emerald',
        'ruby',
        'diamond',
        'topaz'
    ];

    $gemNames = [
        "amethyst" => "Аметист",
        "sapphire" => "Сапфир",
        "emerald" => "Изумруд",
        "ruby" => "Рубин",
        "diamond" => "Алмаз",
        "topaz" => "Топаз"
    ];

    foreach ($gemTypes as $gemType) {
        $gemCount = +$_POST[$gemType];
        if ($gemCount > 0) {
            pushStones($gemNames[$gemType], $gemCount, $login);
        }
    }
    echo "ok";
}

if ($index == "deletestone") {
    require '../dbconn.php';
    $idValue = +$_POST['idValue'];
    $deleteStones = $pdo->prepare("UPDATE stonesinfo SET status='Удалён' where id=(?)");
    $deleteStones->execute([$idValue]);
    echo 'ok';
}

if ($index == "deleteelf") {
    require '../dbconn.php';
    $login = $_POST['login'];
    $deleteElf = $pdo->prepare("UPDATE users SET status='Удалён' where login=(?)");
    $deleteElf->execute([$login]);
    echo 'ok';
}

if ($index == "deletegnome") {
    require '../dbconn.php';
    $login = $_POST['login'];
    $deleteGnome = $pdo->prepare("UPDATE users SET status='Удалён' where login=(?)");
    $deleteGnome->execute([$login]);
    echo 'ok';
}

if ($index == "access") {
    require '../dbconn.php';
    $fair = $_POST['fair'];
    $weekly = $_POST['weekly'];
    $prefer = $_POST['prefer'];

    $updateFair = $pdo->prepare("UPDATE users SET fair='$fair'");
    $updateFair->execute([]);
    $updateWeekly = $pdo->prepare("UPDATE users SET weekly='$weekly'");
    $updateWeekly->execute([]);
    $updatePrefer = $pdo->prepare("UPDATE users SET prefer='$prefer'");
    $updatePrefer->execute([]);

    echo 'ok';
}

if ($index == "distribute") {
    require '../dbconn.php';
    $getPrinciple = $pdo->prepare("SELECT login, allstones, fair, weekly, prefer FROM users where status !='Удалён' AND race='elf'");
    $getPrinciple->execute([]);
    $rowPrinciple = $getPrinciple->fetchAll();

    $getStonesCount = $pdo->prepare("SELECT COUNT(type) FROM stonesinfo where status!='Удалён' AND condition='Свободен'");
    $getStonesCount->execute([]);
    $rowStonesCount = $getStonesCount->fetch();
    $stonesCount = $rowStonesCount[0]; // Количество всех актиных не распределённых камней

    $getElfCount = $pdo->prepare("SELECT COUNT(login) FROM users where status!='Удалён' AND race='elf'");
    $getElfCount->execute([]);
    $rowElfCount = $getElfCount->fetch();
    $elfCount = $rowElfCount[0]; // Количество всех актиных эльфов

    $getElfLogin = $pdo->prepare("SELECT login FROM users where status!='Удалён' AND race='elf'");
    $getElfLogin->execute([]);
    $rowElfLogin = $getElfLogin->fetchAll(); // Логины всех актиных эльфов

    $getIdStone = $pdo->prepare("SELECT id FROM stonesinfo where status!='Удалён' AND condition='Свободен'");
    $getIdStone->execute([]);
    $rowIdStone = $getIdStone->fetchAll(); // Айди не удалённых свободных камней

    $countStoneForElf = $stonesCount / $elfCount; // количество камней для каждого эльфа
    $roundCountStoneForElf = ceil($countStoneForElf); // округлённое количество камней для каждого эльфа

    $arrLoginElf = [];
    for ($i = 0; $i < count($rowElfLogin); $i++) {
        for ($c = 0; $c < $roundCountStoneForElf; $c++) {
            array_push($arrLoginElf, $rowElfLogin[$i][0]);
        }
    }

    for ($i = 0; $i < count($arrLoginElf); $i++) {
        $addStone = $pdo->prepare("UPDATE stonesinfo SET elf=(?) where id=(?) and status='Активен' and condition='Свободен'");
        $addStone->execute([$arrLoginElf[$i], $rowIdStone[$i][0]]);
    }

    echo 'ok';
}

if ($index == "distributeAccess") {
    require '../dbconn.php';
    $date = date("Y-m-d H:i:s");
    $addDate = $pdo->prepare("UPDATE stonesinfo SET dategive=(?), condition='Назначен', algormg='alg' where status='Активен' and condition='Свободен'");
    $addDate->execute([$date]);
    echo 'ok';
}

if ($index == "acceptStone") {
    require '../dbconn.php';
    $id = $_POST['id'];
    $login = $_POST['login'];
    $date = date("Y-m-d H:i:s");
    $addDate = $pdo->prepare("UPDATE stonesinfo SET dateacc=(?), condition='Распределён' where elf=(?) and id=(?)");
    $addDate->execute([$date, $login, $id]);
    $stonesValue = $pdo->prepare("SELECT allstones FROM users where login=(?)");
    $stonesValue->execute([$login]);
    $tableValue = $stonesValue->fetch();
    $currentValue = +$tableValue[0];
    $currentValue = $currentValue + 1;
    $updateStonesValue = $pdo->prepare("UPDATE users SET allstones='$currentValue' where login=(?)");
    $updateStonesValue->execute([$login]);
    echo 'ok';
}
