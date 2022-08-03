/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function callback(response) {
    $(response).each(function () {
        console.log(this);
    });
}

(function ($) {
    $('.needs-validation').on('submit', function (ev) {
        ev.preventDefault();
        var username = $('#input-email').val().trim();
        var password = $('#input-password').val().trim();

        var url = window.location.href;
        var a = url.indexOf("?");
        var b = url.substring(a);
        var c = url.replace(b, "");
        url = c;

        $.ajax({
            type: "GET",
            url: "http://api.mansto.com/endpoints/users/list",
            data: null,
            dataType: "jsonp",
            success: callback
        });

    });

})(jQuery);






