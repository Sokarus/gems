<?php require 'dbconn.php';
require 'functionsphp.php';

session_start();
loginCheck();

$tohello = $_SESSION['login'];

?>
<?php include "header.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/csssettings.css">

<div class="jumbotron">
    <div class="container">
        <p class="x1">Привет, <?php echo "$tohello" ?> !</p>
    </div>
</div>

<div class="container">
    <div class="my-5 mx-auto text-center">
        <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModal">Изменить принцип расределения</button>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Выберите предпочтение:</h5><Br>
                <button type="button" class="closex" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="x">Справедливое: все эльфы должны получить равное количество драгоценностей.</p><Br>
            <p class="x">Еженедельное: каждый эльф должен получить хотя бы одну драгоценность.</p><Br>
            <p class="x">Предпочтения: расределение камней должно соответствовать пожеланиям эльфа по типу камня.</p><Br>
            <div id="contactForm">
                <form id="myForm">
                    <div class="form-group">
                        <div class="modal-header">
                            <p class="x">
                                <input class="stone" id="fair" type="range" min="1" max="100" step="1" value="1" oninput="getValuetest('fair', 'fairValue')">Справедливое
                                <input class="stone" id="weekly" type="range" min="1" max="100" step="1" value="1" oninput="getValuetest('weekly', 'weeklyValue')">Еженедельное
                                <input class="stone" id="prefer" type="range" min="1" max="100" step="1" value="1" oninput="getValuetest('prefer', 'preferValue')">Предпочтения<br>

                                <span id="fairValue" value="1">1</span><br>
                                <span id="weeklyValue" value="1">1</span><br>
                                <span id="preferValue" value="1">1</span><br>
                            </p>
                        </div>
                    </div>
                    <button class="btn btn-success" id="access" name="access" type="submit">Подтвердить</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div class='inline'>
  <a href="jewelrydistribution.php">Распределение камней</a>
</div>


<?php include "footer.php"; ?>