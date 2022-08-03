/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function createXHR() {
    try {
        return new XMLHttpRequest();
    } catch (e) {
    }

    try {
        return new ActiveXObject("Msxml2.XMLHTTP.6.0");
    } catch (e) {
    }

    try {
        return new ActiveXObject("Msxml2.XMLHTTP.3.0");
    } catch (e) {
    }

    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    }

    try {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
    }

    return null;
}

function encodeValue(val) {

    var encodedVal;

    if (!encodeURIComponent) {
        encodedVal = escape(val);

        /* fix the omissions */
        encodedVal = encodedVal.replace(/@/g, "%40");
        encodedVal = encodedVal.replace(/\//g, "%2F");
        encodedVal = encodedVal.replace(/\+/g, "%2B");
    } else {

        encodedVal = encodeURIComponent(val);

        /* fix the omissions */
        encodedVal = encodedVal.replace(/~/g, "%7E");
        encodedVal = encodedVal.replace(/!/g, "%21");
        encodedVal = encodedVal.replace(/\(/g, "%28");
        encodedVal = encodedVal.replace(/\)/g, "%29");
        encodedVal = encodedVal.replace(/'/g, "%27");
    }

    /* clean up spaces and return */
    return encodedVal.replace(/\%20/g, "+");

}

function sendRequest(url, payload) {

    var xhr = createXHR();

    if (xhr) {
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            handleResponse(xhr);
        };
        xhr.send(payload);
    }
}

function handleResponse(xhr) {
    if (xhr.readyState == 4 && xhr.status == 200) {
        var responseOutput = document.getElementById("responseOutput");
        responseOutput.innerHTML = xhr.responseText;
    }
}

function showUser(id, email, password) {
    var url = "http://api.mansto.com/endpoints/users/create/";
    if (id <= 0) {
        var payload = "email=" + encodeValue(email) + "&password=" + encodeValue(password);
    } else {
        var payload = "id=" + encodeValue(id) + "&email=" + encodeValue(email) + "&password=" + encodeValue(password);
    }

    sendRequest(url, payload);
}

/*window.onload = function () {
 showUser(0, "eacassecasse@mansto.com", "@Pas1sword23");
 showUser(0, "admin@mansto.com", '2_xyzP@s$w0rd');
 };*/

function callback(response) {
    $(response).each(function () {
        $('#responseOutput').text($('#responseOutput').text() + JSON.stringify(this));
    });
}

(function ($) {
    $.ajax({
        type: "GET",
        url: "http://api.mansto.com/endpoints/users/list",
        data: null,
        dataType: "jsonp",
        success: callback
    });
})(jQuery);



