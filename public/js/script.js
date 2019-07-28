/**
 * Created by yassineelmaaroufi on 27/07/2019.
 */
function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}

function request(callback) {

    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {


            callback(xhr.responseText);

        }
    };
    var action  = encodeURIComponent('new');

    xhr.open("GET", "http://localhost/MVC_project/index.php?action=message&value="+action, true);
    xhr.send(null);


}

function readData(sData) {
    if (sData.length > 0) {
        document.getElementById('cadre_chat').innerHTML = sData;
    }
    else {
        document.getElementById('cadre_chat').innerHTML = '<center><b>Pas de messages pour le moment.</b></center>';
    }
}

setInterval('request(readData)',500);
function request_status(callback) {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };



    xhr.open("GET", "http://localhost/MVC_project/index.php?action=status", true);
    xhr.send(null);
}

function readData_status(sData) {
    document.getElementById('membres_connectes').innerHTML = sData;
}
setInterval('request_status(readData_status)',700);

function post() {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            readData(xhr.responseText);

        }
    };
    var msg = encodeURIComponent(document.getElementById("message").value);

    xhr.open("GET", "http://localhost/MVC_project/index.php?action=post&msg="+msg, true);
    xhr.send(null);

    document.getElementById("message").value = '';
}

function set_status() {
    var xhr = getXMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            readData(xhr.responseText);

        }
    };
    var status = encodeURIComponent(document.getElementById("status").value);
    xhr.open("GET", "http://localhost/MVC_project/index.php?action=state&statechange=" + status, true);
    xhr.send(null);
}

function old_msg(callback) {
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            callback(xhr.responseText);
        }
    };
    var action  = encodeURIComponent('anc');
    xhr.open("GET", "http://localhost/MVC_project/index.php?action=message&value=" + action, true);
    xhr.send(null);
}
function echoMsg(sData) {

    if (sData.length > 0) {
        document.getElementById('modalbody').innerHTML += sData;
    }

}

