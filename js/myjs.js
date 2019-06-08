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


function getValue(outer, inner) {
    //data() jquery мне нужно
    // var arrStones = $(".stone"); 
    // var step = + stoneIn.getAttribute("step")
    var stoneOut = document.getElementById(outer);
    var stoneIn = document.getElementById(inner).value;
    // jQuery.data("step", stoneIn);
    // var difference = step / (arrStones.length - 1);
    stoneOut.innerHTML = Math.ceil((stoneIn) * 100) / 100;
    //в сумме всегда 1 , при убавлении везде расределялось поровну , что бы при открытии по дефолту значения были одинаковы.
}





function getUserLogin(elementIn, elementOut) {
    var inner = document.getElementById(elementIn);
    var outer = document.getElementById(elementOut);
    outer.value = inner.innerHTML;
}

var img_dir = "/i/"; // папка с картинками
var sort_case_sensitive = false; // вид сортировки (регистрозависимый или нет)

// ф-ция, определяющая алгоритм сортировки
function _sort(a, b) {
    var a = a[0];
    var b = b[0];
    var _a = (a + '').replace(/,/, '.');
    var _b = (b + '').replace(/,/, '.');
    if (parseFloat(_a) && parseFloat(_b)) return sort_numbers(parseFloat(_a), parseFloat(_b));
    else if (!sort_case_sensitive) return sort_insensitive(a, b);
    else return sort_sensitive(a, b);
}

// ф-ция сортировки чисел
function sort_numbers(a, b) {
    return a - b;
}

// ф-ция регистронезависимой сортировки
function sort_insensitive(a, b) {
    var anew = a.toLowerCase();
    var bnew = b.toLowerCase();
    if (anew < bnew) return -1;
    if (anew > bnew) return 1;
    return 0;
}

// ф-ция регистрозависимой сортировки
function sort_sensitive(a, b) {
    if (a < b) return -1;
    if (a > b) return 1;
    return 0;
}

// вспомогательная ф-ция, выдирающая из дочерних узлов весь текст
function getConcatenedTextContent(node) {
    var _result = "";
    if (node == null) {
        return _result;
    }
    var childrens = node.childNodes;
    var i = 0;
    while (i < childrens.length) {
        var child = childrens.item(i);
        switch (child.nodeType) {
            case 1: // ELEMENT_NODE
            case 5: // ENTITY_REFERENCE_NODE
                _result += getConcatenedTextContent(child);
                break;
            case 3: // TEXT_NODE
            case 2: // ATTRIBUTE_NODE
            case 4: // CDATA_SECTION_NODE
                _result += child.nodeValue;
                break;
            case 6: // ENTITY_NODE
            case 7: // PROCESSING_INSTRUCTION_NODE
            case 8: // COMMENT_NODE
            case 9: // DOCUMENT_NODE
            case 10: // DOCUMENT_TYPE_NODE
            case 11: // DOCUMENT_FRAGMENT_NODE
            case 12: // NOTATION_NODE
                // skip
                break;
        }
        i++;
    }
    return _result;
}

// суть скрипта
function sort(e) {
    var el = window.event ? window.event.srcElement : e.currentTarget;
    while (el.tagName.toLowerCase() != "td") el = el.parentNode;
    var a = new Array();
    var name = el.lastChild.nodeValue;
    var dad = el.parentNode;
    var table = dad.parentNode.parentNode;
    var up = table.up;
    var node, arrow, curcol;
    for (var i = 0; (node = dad.getElementsByTagName("td").item(i)); i++) {
        if (node.lastChild.nodeValue == name) {
            curcol = i;
            if (node.className == "curcol") {
                arrow = node.firstChild;
                table.up = Number(!up);
            } else {
                node.className = "curcol";
                arrow = node.insertBefore(document.createElement("img"), node.firstChild);
                table.up = 0;
            }
            arrow.src = img_dir + table.up + ".gif";
            arrow.alt = "";
        } else {
            if (node.className == "curcol") {
                node.className = "";
                if (node.firstChild) node.removeChild(node.firstChild);
            }
        }
    }
    var tbody = table.getElementsByTagName("tbody").item(0);
    for (var i = 0; (node = tbody.getElementsByTagName("tr").item(i)); i++) {
        a[i] = new Array();
        a[i][0] = getConcatenedTextContent(node.getElementsByTagName("td").item(curcol));
        a[i][1] = getConcatenedTextContent(node.getElementsByTagName("td").item(1));
        a[i][2] = getConcatenedTextContent(node.getElementsByTagName("td").item(0));
        a[i][3] = node;
    }
    a.sort(_sort);
    if (table.up) a.reverse();
    for (var i = 0; i < a.length; i++) {
        tbody.appendChild(a[i][3]);
    }
}

// ф-ция инициализации всего процесса аджакс запросы
function init(e) {
    if (!document.getElementsByTagName) return;

    for (var j = 0; (thead = document.getElementsByTagName("thead").item(j)); j++) {
        var node;
        for (var i = 0; (node = thead.getElementsByTagName("td").item(i)); i++) {
            if (node.addEventListener) node.addEventListener("click", sort, false);
            else if (node.attachEvent) node.attachEvent("onclick", sort);
            node.title = "Нажмите на заголовок, чтобы отсортировать колонку";
        }
        thead.parentNode.up = 0;

        if (typeof (initial_sort_id) != "undefined") {
            td_for_event = thead.getElementsByTagName("td").item(initial_sort_id);
            if (document.createEvent) {
                var evt = document.createEvent("MouseEvents");
                evt.initMouseEvent("click", false, false, window, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, td_for_event);
                td_for_event.dispatchEvent(evt);
            } else if (td_for_event.fireEvent) td_for_event.fireEvent("onclick");
            if (typeof (initial_sort_up) != "undefined" && initial_sort_up) {
                if (td_for_event.dispatchEvent) td_for_event.dispatchEvent(evt);
                else if (td_for_event.fireEvent) td_for_event.fireEvent("onclick");
            }
        }
    }
}

// запускаем ф-цию init() при возникновении события load
var root = window.addEventListener || window.attachEvent ? window : document.addEventListener ? document : null;
if (root) {
    if (root.addEventListener) root.addEventListener("load", init, false);
    else if (root.attachEvent) root.attachEvent("onload", init);
}

// filter   'table'   'input'
$("#input1").jSearch({
    selector: $("#1"),
    child: 'tr > td',
    minValLength: 0,
    Before: function () {
        $('table tr').data('find', '');
    },
    Found: function (elem, event) {
        $(elem).parent().data('find', 'true');
        $(elem).parent().show();
    },
    NotFound: function (elem, event) {
        if (!$(elem).parent().data('find'))
            $(elem).parent().hide();
    },
    After: function (t) {
        if (!t.val().length) $('table tr').show();
    }
});

$("#input2").jSearch({
    selector: $("#2"),
    child: 'tr > td',
    minValLength: 0,
    Before: function () {
        $('table tr').data('find', '');
    },
    Found: function (elem, event) {
        $(elem).parent().data('find', 'true');
        $(elem).parent().show();
    },
    NotFound: function (elem, event) {
        if (!$(elem).parent().data('find'))
            $(elem).parent().hide();
    },
    After: function (t) {
        if (!t.val().length) $('table tr').show();
    }
});



function getValuezzz() {
    var quantityStones = $(".stone").length; // тут количество всех камней

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

    var difference =

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
}