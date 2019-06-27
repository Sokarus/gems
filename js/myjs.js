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

function getUserLogin(elementIn, elementOut) {
    var inner = document.getElementById(elementIn);
    var outer = document.getElementById(elementOut);
    outer.value = inner.innerHTML;
}

var img_dir = "/js/i/"; // папка с картинками
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




//                       AJAX
// index.php
$('button#submit').on('click', function () {
    var login = $('input#login').val();
    var password = $('input#password').val();
    var index = "index";
    $.ajax({
        url: 'js/userinfo.php',
        data: { login: login, password: password, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg == "elf") {
            location.href = "/elfpage.php";
        }
        if (msg == "gnome") {
            location.href = "/gnomepage.php";
        }
        if (msg == "mastergnome") {
            location.href = "/alljewelry.php";
        }
        if (msg !== "elf" && msg !== "gnome" && msg !== "mastergnome") {
            $('div#okno').text("Ошибка авторизации: " + msg);
            location.href = "#zatemnenie";
        }
    })
});

// allusers.php 
$('button#registrationall').on('click', function () {
    var name = $('input#name').val();
    var login = $('input#login').val();
    var password = $('input#password').val();
    var password2 = $('input#password2').val();
    var elf = $('input#elf:checked', '#myForm').val(); // тут либо elf либо undefined
    var gnome = $('input#gnome:checked', '#myForm').val();
    var mastergnome = $('input#mastergnome:checked', '#myForm').val();
    var index = "registrationall";
    $.ajax({
        url: 'js/userinfo.php',
        data: { name: name, login: login, password: password, password2: password2, elf: elf, gnome: gnome, mastergnome: mastergnome, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg == "elf" || msg == "gnome" || msg == "mastergnome") {
            location.href = "/allusers.php";
        }
        if (msg !== "elf" && msg !== "gnome" && msg !== "mastergnome") {
            $('div#okno').text("Ошибка авторизации: " + msg);
            location.href = "#zatemnenie";
        }
    })
});

// registration.php 
$('button#registration').on('click', function () {
    var name = $('input#name').val();
    var login = $('input#login').val();
    var password = $('input#password').val();
    var password2 = $('input#password2').val();
    var elf = $('input#elf:checked', '#myForm').val(); // тут либо elf либо undefined
    var gnome = $('input#gnome:checked', '#myForm').val();
    var mastergnome = $('input#mastergnome:checked', '#myForm').val();
    var index = "registration";
    $.ajax({
        url: 'js/userinfo.php',
        data: { name: name, login: login, password: password, password2: password2, elf: elf, gnome: gnome, mastergnome: mastergnome, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg == "elf" || msg == "gnome" || msg == "mastergnome") {
            location.href = "/autorization.php";
        }
        if (msg !== "elf" && msg !== "gnome" && msg !== "mastergnome") {
            $('div#okno').text("Ошибка авторизации: " + msg);
            location.href = "#zatemnenie";
        }
    })
});

// elfpage.php -----> name
$('button#changename').on('click', function () {
    var name = $('input#namechange').val();
    var login = $('input#herelogin').val();
    var index = "chname";
    $.ajax({
        url: 'js/userinfo.php',
        data: { name: name, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/elfpage.php";
        }
    })
});

// elfpage.php -----> login
$('button#changelogin').on('click', function () {
    var loginchange = $('input#loginchange').val();
    var login = $('input#herelogin').val();
    var index = "chlogin";
    $.ajax({
        url: 'js/userinfo.php',
        data: { loginchange: loginchange, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/elfpage.php";
        }
    })
});

// elfpage.php -----> password
$('button#changepassword').on('click', function () {
    var password = $('input#passwordchange').val();
    var login = $('input#herelogin').val();
    var index = "chpassword";
    $.ajax({
        url: 'js/userinfo.php',
        data: { password: password, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/elfpage.php";
        }
    })
});

// elfpage.php -----> stonesmove
function getValuetest(input, output) {
    var inner = document.getElementById(input);
    var outer = document.getElementById(output);
    outer.innerHTML = inner.value;
}

// elfpage.php -----> stones
$('button#saveStones').on('click', function () {
    var login = $('input#herelogin').val();
    var index = "chstones";
    var amethyst = $('input#amethyst').val();
    var sapphire = $('input#sapphire').val();
    var emerald = $('input#emerald').val();
    var ruby = $('input#ruby').val();
    var diamond = $('input#diamond').val();
    var topaz = $('input#topaz').val();
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            login: login,
            index: index,
            amethyst: amethyst,
            sapphire: sapphire,
            emerald: emerald,
            ruby: ruby,
            diamond: diamond,
            topaz: topaz
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            location.href = "/elfpage.php";
        } else {
            alert(msg);
        }
    })
});

// gnomepage.php -----> name
$('button#changenamegn').on('click', function () {
    var name = $('input#namechange').val();
    var login = $('input#herelogin').val();
    var index = "chname";
    $.ajax({
        url: 'js/userinfo.php',
        data: { name: name, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/gnomepage.php";
        }
    })
});

// gnomepage.php -----> login
$('button#changelogingn').on('click', function () {
    var loginchange = $('input#loginchange').val();
    var login = $('input#herelogin').val();
    var index = "chlogingn";
    $.ajax({
        url: 'js/userinfo.php',
        data: { loginchange: loginchange, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/gnomepage.php";
        }
    })
});

// gnomepage.php -----> password
$('button#changepasswordgn').on('click', function () {
    var password = $('input#passwordchange').val();
    var login = $('input#herelogin').val();
    var index = "chpassword";
    $.ajax({
        url: 'js/userinfo.php',
        data: { password: password, login: login, index: index },
        type: 'post'
    }).done(function (msg) {
        if (msg !== "ok") {
            $('div#okno').text(msg);
            location.href = "#zatemnenie";
        } else {
            location.href = "/gnomepage.php";
        }
    })
});

// jewelry.php -----> addstones
$('button#pushstones').on('click', function () {
    var login = $('input#herelogin').val();
    var index = "pushstones";
    var amethyst = $('input#Am').val();
    var sapphire = $('input#Sa').val();
    var emerald = $('input#Em').val();
    var ruby = $('input#Ru').val();
    var diamond = $('input#Di').val();
    var topaz = $('input#To').val();
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            login: login,
            index: index,
            amethyst: amethyst,
            sapphire: sapphire,
            emerald: emerald,
            ruby: ruby,
            diamond: diamond,
            topaz: topaz
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Камни успено добавлены!");
            location.href = "#zatemnenie";
        } else {
            alert(msg);
        }
    })
});

// jewelry.php -----> ok
$('a#closegn').on('click', function () {
    location.href = "/gnomepage.php";
});

// alljewelry.php -----> delete
$('.delete#deletestone').on('click', function (e) {
    var idValue = e.target.getAttribute("data-row-id");
    var index = "deletestone";
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
            idValue: idValue
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Камень удалён!");
            location.href = "#zatemnenie";
        }
    })
});

// allusers.php -----> deleteelf
$('.delete#deleteelf').on('click', function (e) {
    var login = e.target.getAttribute("data-row-id");
    var index = "deleteelf";
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
            login: login
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Эльф удалён!");
            location.href = "#zatemnenie";
        }
    })
});

// allusers.php -----> deletegnome
$('.delete#deletegnome').on('click', function (e) {
    var login = e.target.getAttribute("data-row-id");
    var index = "deletegnome";
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
            login: login
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Гном удалён!");
            location.href = "#zatemnenie";
        }
    })
});

// alljewelry.php -----> ok
$('a#closeall').on('click', function () {
    location.href = "/alljewelry.php";
});

// alljewelry.php -----> ok
$('a#closeallusers').on('click', function () {
    location.href = "/allusers.php";
});

// jewelrydistribution.php -----> ok
$('a#closerefr').on('click', function () {
    location.href = "/jewelrydistribution.php";
});

// settings.php -----> access
$('button#access').on('click', function () {
    var index = "access";
    var fair = $('input#fair').val();
    var weekly = $('input#weekly').val();
    var prefer = $('input#prefer').val();
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
            fair: fair,
            weekly: weekly,
            prefer: prefer
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            location.href = "/settings.php";
        }
    })
});

// jewelrydistribution.php -----> distribute
$('button#distribute').on('click', function () {
    var index = "distribute";
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            location.href = "/jewelrydistribution.php";
        } else {
            alert(msg);
        }
    })
});

// jewelrydistribution.php -----> distributeAccess
$('button#distributeAccess').on('click', function () {
    var index = "distributeAccess";
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            index: index,
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Камни распределены!");
            location.href = "#zatemnenie";
        }
    })
});

// elfpage.php -----> acceptStone
$('.getStone#getStone').on('click', function (e) {
    var id = e.target.getAttribute("data-row-id");
    var index = "acceptStone";
    var login = $('input#herelogin').val();
    $.ajax({
        url: 'js/userinfo.php',
        data: {
            id: id,
            index: index,
            login: login
        },
        type: 'post'
    }).done(function (msg) {
        if (msg == "ok") {
            $('div#okno').text("Камень получен!");
            location.href = "/elfpage.php";
        } else {alert(msg);}
    })
});
//$('.ui.table tr').on('click', function (e) {
  //  alert(e.target.parentElement.getAttribute("data-row-id"));
    // $(e.target.parentElement).remove();