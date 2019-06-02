function plusStone(elementId) {
    var element = document.getElementById(elementId);
    element.value = Number(element.value) + 1;
};

function minusStone(elementId) {
    var element = document.getElementById(elementId);
    if (Number(element.value) > 0) {
    element.value = Number(element.value) - 1; 
    }
};

function range(elementIn, elementOut) {
    var inner = document.getElementById(elementIn);
    var outer = document.getElementById(elementOut);
    outer.innerHTML = inner.value;
}

function getValue() {
    var pAm = document.getElementById('rangeAmethyst');
    var pSa = document.getElementById('rangeSapphire');
    var pEm = document.getElementById('rangeEmerald');
    var pRu = document.getElementById('rangeRuby');
    var pDi = document.getElementById('rangeDiamond');
    var pTo = document.getElementById('rangeTopaz');

    var Am = document.getElementById('amethyst');
    var Sa = document.getElementById('sapphire');
    var Em = document.getElementById('emerald');
    var Ru = document.getElementById('ruby');
    var Di = document.getElementById('diamond');
    var To = document.getElementById('topaz');

    pAm.innerHTML = Am.value;
    pSa.innerHTML = Sa.value;
    pEm.innerHTML = Em.value;
    pRu.innerHTML = Ru.value;
    pDi.innerHTML = Di.value;
    pTo.innerHTML = To.value;
    if (Number(Am.value) + Number(Sa.value) + Number(Em.value) + Number(Ru.value) + Number(Di.value) + Number(To.value) > 1) {
        if (Number(Am.value) > 0) {
            Am.value = Am.value - 0.16;
            pAm.innerHTML = Am.value;
        }
        if (Number(Sa.value) > 0) {
            Sa.value = Sa.value - 0.16;
            pSa.innerHTML = Sa.value;
        }
        if (Number(Em.value) > 0) {
            Em.value = Em.value - 0.16;
            pEm.innerHTML = Em.value;
        }
        if (Number(Ru.value) > 0) {
            Ru.value = Ru.value - 0.16;
            pRu.innerHTML = Ru.value;
        }
        if (Number(Di.value) > 0) {
            Di.value = Di.value - 0.16;
            pDi.innerHTML = Di.value;
        }
        if (Number(To.value) > 0) {
            To.value = To.value - 0.16;
            pTo.innerHTML = To.value;
            //в сумме всегда 1 , при убавлении везде расределялось поровну , что бы при открытии по дефолту значения были одинаковы.
        }
    }
    if (Number(Am.value) + Number(Sa.value) + Number(Em.value) + Number(Ru.value) + Number(Di.value) + Number(To.value) !== 1){

    }
}