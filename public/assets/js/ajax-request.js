jQuery(document).ready(function (){
    "use strict";
    //from ajax request handler
    jQuery(document).on('submit','[data-ajax-form]',function (e) {
        e.preventDefault();
        ajaxRequest.form =  jQuery(this);
        ajaxRequest.ajaxURL = jQuery(this).attr('action');
        ajaxRequest.formData = new FormData(this);
        ajaxRequest.contentTypeJSON = false;
        ajaxRequest.ajax();
    });
});

let ajaxRequest = {
    form: jQuery(this),
    formData:[],
    ajaxURL: baseURL,
    contentTypeJSON: true,
    ajax: function (){
        jQuery.ajax({
            type: "POST",
            url: ajaxRequest.ajaxURL,
            data: ajaxRequest.formData,
            dataType: "json",
            contentType: (ajaxRequest.contentTypeJSON)?'application/json;charset=UTF-8':ajaxRequest.contentTypeJSON,
            cache: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': ajax_token
            },
            success: function (result) {
                if (result.warning) {
                    Toast.warning(result.warning);
                }
                else if (result.error) {
                    Toast.error(result.error);
                }
                else if (result.info) {
                    Toast.info(result.info);
                }
                else if (result.success) {
                    Toast.success(result.success);
                }
                if (result.fields) {
                    jQuery.each(result.fields, function (key, val){
                        Toast.error(val);
                    })
                }
                if (result.reset) {
                    if(typeof ajaxRequest.form[0] !== undefined) {
                        ajaxRequest.form[0].reset();
                    }
                }
                if (result.reload) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
                if (result.redirect) {
                    setTimeout(function () {
                        window.location.href = result.redirect;
                    }, 1000);
                }
            },
        });
    }
}
