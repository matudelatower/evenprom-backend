
/* function to redirect a webpage to another using post method */

function redirect_by_post(purl, pparameters, in_new_tab) {
    pparameters = (typeof pparameters == 'undefined') ? {} : pparameters;
    in_new_tab = (typeof in_new_tab == 'undefined') ? true : in_new_tab;

    var form = document.createElement("form");
    $(form).attr("id", "reg-form").attr("name", "reg-form").attr("action", purl).attr("method", "post").attr("enctype", "multipart/form-data");
    if (in_new_tab) {
        $(form).attr("target", "_blank");
    }
    $.each(pparameters, function(key) {
        $(form).append('<input type="text" name="' + key + '" value="' + this + '" />');
    });
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);

    return false;
}


/*
 * 
 * Ajax: ejecuta una llamada asíncrona utilizando jquery
 * 
 * @param url
 * @param type post or get
 * @param dataType xml, json, script, or html
 * @param data json parameters to send on call
 * @param callbackFn función a ser ejecutada después de que la llamada asíncrona sea exitosa
 * 
 */
function ajax(url, type, dataType, jsonData, callbackFn) {

    var request = $.ajax({
        url: url,
        type: type,
        data: jsonData,
        dataType: dataType
    });

    request.done(callbackFn);

}


jQuery.fn.serializeJSON = function() {
    var json = {};
    jQuery.map(jQuery(this).serializeArray(), function(n, i) {
        var _ = n.name.indexOf('[');
        if (_ > -1) {
            var o = json;
            _name = n.name.replace(/\]/gi, '').split('[');
            for (var i = 0, len = _name.length; i < len; i++) {
                if (i == len - 1) {
                    if (o[_name[i]]) {
                        if (typeof o[_name[i]] == 'string') {
                            o[_name[i]] = [o[_name[i]]];
                        }
                        o[_name[i]].push(n.value);
                    }
                    else
                        o[_name[i]] = n.value || '';
                }
                else
                    o = o[_name[i]] = o[_name[i]] || {};
            }
        }
        else {
            if (json[n.name] !== undefined) {
                if (!json[n.name].push) {
                    json[n.name] = [json[n.name]];
                }
                json[n.name].push(n.value || '');
            }
            else
                json[n.name] = n.value || '';
        }
    });
    return json;
};

function resetForm (form) {

    form.find('input, textarea, input:not([type="submit"])').removeAttr('value');
    form.find('input, textarea, input:not([type="submit"])').val('');
    form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');

    form.find('select option').removeAttr('selected').find('option:first').attr('selected', 'selected');

}

function prevent(e) {
    if (e.preventDefault) {
        e.preventDefault();
    } else {
        e.returnValue = false;
    }
}

function bloquearPantalla(gif) {
    jQuery.blockUI({
        message: '<img src="' + gif + '"/>',
        css: {border: 'none', background: ''}
    });

}

function desbloquearPantalla() {

    jQuery.unblockUI()

}

function imagePreview(input, previewE) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            previewE.attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
