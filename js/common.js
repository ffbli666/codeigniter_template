(function($) {
    $.alert = function (type, msg) {
        var type = type || "success";
        var msg = msg || "";
        var id = Math.floor((Math.random() * 1000000) + 1);;
        type = "alert-" + type;

        var alert_list = null;
        if ($("#alert_list").length > 0) {
            alert_list = $("#alert_list");
        }
        else {
            alert_list = $("<div id='alert_list'></div>");
            alert_list.addClass('dpd-alert-list');
            $('body').append(alert_list);
        }
        var alert = $("<div></div>");
        html  = "<div class='alert " + type + " alert-dismissible' role='alert'>";
        html += "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>";
        html += msg;
        html += "</div>";
        alert.addClass('dpd-alert');
        alert.append(html);

        alert_list.append(alert);

        setTimeout(function() {
            alert.remove();
        }, 2000);
    };
    $.postJson = function ( url, data, callback, type ) {
        type = type || 'json';
        if ( jQuery.isFunction( data ) ) {
            type = type || callback;
            callback = data;
            data = undefined;
        }

        return jQuery.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json; charset=utf-8',
            dataType: type,
            data: JSON.stringify(data),
            success: callback
        });
    };
})(jQuery)