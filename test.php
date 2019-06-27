<?php include "header.php"; ?>

<style>
    div {
        color: blue;
    }

    body {
        background-color: black;
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

<p class="amethyst"><input class="stone" id="amethyst" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('amethyst', 'rangeAmethyst')">Аметист</p>
<p class="sapphire"><input class="stone" id="sapphire" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('sapphire', 'rangeSapphire')">Сапфир</p>
<p class="emerald"><input class="stone" id="emerald" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('emerald', 'rangeEmerald')">Изумруд</p>
<p class="ruby"><input class="stone" id="ruby" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('ruby', 'rangeRuby')">Рубин</p>
<p class="diamond"><input class="stone" id="diamond" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('diamond', 'rangeDiamond')">Алмаз</p>
<p class="topaz"><input class="stone" id="topaz" type="range" min="1" max="100" step="1" value="16" oninput="getValuetest('topaz', 'rangeTopaz')">Топаз</p>

<span class="intAmethyst" id="rangeAmethyst" value="16">16</span><br>
<span class="intSapphire" id="rangeSapphire" value="16">16</span><br>
<span class="intEmerald" id="rangeEmerald" value="16">16</span><br>
<span class="intRuby" id="rangeRuby" value="16">16</span><br>
<span class="intDiamond" id="rangeDiamond" value="16">16</span><br>
<span class="intTopaz" id="rangeTopaz" value="16">16</span><br>
<script>
    var previous_value = [16, 16, 16, 16, 16, 16];

    function getValuetest(input, output) {
        var arrStones = $(".stone");
        var arrStones2 = $("span[class^='int']");
        var inner = document.getElementById(input);
        var outer = document.getElementById(output);
        outer.innerHTML = inner.value;
        var coff = arrStones.length - 1;

        if (input == "amethyst") {
            var stepgo = inner.value - previous_value[0];
            var difference = stepgo / coff;
        }
        if (input == "sapphire") {
            var stepgo = inner.value - previous_value[1];
            var difference = stepgo / coff;
        }
        if (input == "emerald") {
            var stepgo = inner.value - previous_value[2];
            var difference = stepgo / coff;
        }
        if (input == "ruby") {
            var stepgo = inner.value - previous_value[3];
            var difference = stepgo / coff;
        }
        if (input == "diamond") {
            var stepgo = inner.value - previous_value[4];
            var difference = stepgo / coff;
        }
        if (input == "topaz") {
            var stepgo = inner.value - previous_value[5];
            var difference = stepgo / 5;
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "amethyst") {

                var innerAm = document.getElementById(arrStones[i].id);
                var outerAm = document.getElementById(arrStones2[i].id);
                innerAm.value = innerAm.value - difference;
                outerAm.innerHTML = innerAm.value;
                previous_value[0] = innerAm.value;
            }
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "sapphire") {

                var innerSa = document.getElementById(arrStones[i].id);
                var outerSa = document.getElementById(arrStones2[i].id);
                innerSa.value = innerSa.value - difference;
                outerSa.innerHTML = innerSa.value;
                previous_value[1] = innerSa.value;
            }
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "emerald") {

                var innerEm = document.getElementById(arrStones[i].id);
                var outerEm = document.getElementById(arrStones2[i].id);
                innerEm.value = innerEm.value - difference;
                outerEm.innerHTML = innerEm.value;
                previous_value[2] = innerEm.value;
            }
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "ruby") {

                var innerRu = document.getElementById(arrStones[i].id);
                var outerRu = document.getElementById(arrStones2[i].id);
                innerRu.value = innerRu.value - difference;
                outerRu.innerHTML = innerRu.value;
                previous_value[3] = innerRu.value;
            }
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "diamond") {

                var innerDi = document.getElementById(arrStones[i].id);
                var outerDi = document.getElementById(arrStones2[i].id);
                innerDi.value = innerDi.value - difference;
                outerDi.innerHTML = innerDi.value;
                previous_value[4] = innerDi.value;
            }
        }

        for (i = 0; i < arrStones.length; i++) {
            if (arrStones[i].id == "topaz") {

                var innerTo = document.getElementById(arrStones[i].id);
                var outerTo = document.getElementById(arrStones2[i].id);
                innerTo.value = innerTo.value - difference;
                outerTo.innerHTML = innerTo.value;
                previous_value[5] = innerTo.value;
            }
        }
    }

    // SELECT COUNT(type), type FROM stonesinfo WHERE gnome='TAYPOH' GROUP BY type;
</script>