<?php include "header.php"; ?>

<style>
    div {
        color: blue;
    }

    span {
        color: red;
    }
</style>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>


fds
<div>

    The values stored were
    <span></span>
    and
    <span></span>
</div>
<p class="amethyst"><input class="stone" name="amethyst" id="amethyst" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('amethyst', 'rangeAmethyst')"></span>Аметист</p>
<p class="sapphire"><input class="stone" name="sapphire" id="sapphire" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('sapphire', 'rangeSapphire')">Сапфир</p>
<p class="emerald"><input class="stone" name="emerald" id="emerald" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('emerald', 'rangeEmerald')">Изумруд</p>
<p class="ruby"><input class="stone" name="ruby" id="ruby" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('ruby', 'rangeRuby')">Рубин</p>
<p class="diamond"><input class="stone" name="diamond" id="diamond" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('diamond', 'rangeDiamond')">Алмаз</p>
<p class="topaz"><input class="stone" name="topaz" id="topaz" type="range" min="0" max="1" step="0.001" value="0.16" oninput="getValuetest('topaz', 'rangeTopaz')">Топаз</p>

<span class="intAmethyst" id="rangeAmethyst" value="0.16">0.16</span><br>
<span class="intSapphire" id="rangeSapphire" value="0.16">0.16</span><br>
<span class="intEmerald" id="rangeEmerald" value="0.16">0.16</span><br>
<span class="intRuby" id="rangeRuby" value="0.16">0.16</span><br>
<span class="intDiamond" id="rangeDiamond" value="0.16">0.16</span><br>
<span class="intTopaz" id="rangeTopaz" value="0.16">0.16</span><br>
<script>

    var previous_value = 0.16;

    function getValuetest(input, output) {
        var arrStones = $(".stone");
        var stonesLength = arrStones.length;
        for (i = 0; i < stonesLength; i++) { // удаляем из массива всех камней камень
            if (arrStones[i].id == input)   //           который крутим
            arrStones.splice(i, 1);
        }
        var in = document.getElementById(input);

        var out = document.getElementById(output);

        var step = +in.getAttribute("step") // 0.001

        // var number = Math.ceil((in.value) * 100) / 100;

        var stepgo = in.value - previous_value;

        var difference = stepgo / (arrStones.length - 1);

        pAm.innerHTML = Am.value;
        Sa.value = Sa.value - differenceAm;
        pSa.innerHTML = Sa.value;
        Em.value = Em.value - differenceAm;
        pEm.innerHTML = Em.value;
        Ru.value = Ru.value - differenceAm;
        pRu.innerHTML = Ru.value;
        Di.value = Di.value - differenceAm;
        pDi.innerHTML = Di.value;
        To.value = To.value - differenceAm;
        pTo.innerHTML = To.value;

        previous_valueAm = Am.value;
        previous_valueSa = Sa.value;
        previous_valueEm = Em.value;
        previous_valueRu = Ru.value;
        previous_valueDi = Di.value;
        previous_valueTo = To.value;
    }
</script>

<?php include "footer.php"; ?>