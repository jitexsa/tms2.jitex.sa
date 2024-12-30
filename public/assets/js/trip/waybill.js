$(document).ready(function () {
    setTimeout(function () {
        $('.page-loader-wrapper').fadeOut();
    }, 50);
    if($('#signature_form').length > 0) {
        let sign = $('#signature_form').signaturePad({
            drawOnly: true,
            clear: '.clearButton',
            // executed whenever the user completes their drawing segment
            onDrawEnd: function () {
                $("#sign_img").val(sign.getSignatureImage())
            }
        });
    }

    jQuery(document).on('submit','[data-ajax-form]',function (e) {
        e.preventDefault();
        var form = jQuery(this);
        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            //async:false,
            success: function (result) {
                if(result.success){
                    $('p.success').html(result.message).show();
                    setTimeout(function (){
                        location.reload(true);
                    }, 2000)
                }
                if(result.error){
                    $('p.error').html(result.message).show();

                    setTimeout(function (){
                        $('p.error').html('').hide();
                    }, 2000)
                }

            },
            error: function (result){

            }
        });

    });
    $('#signature').on('hidden.bs.modal', function () {
        $("#first_name, #last_name, #email, #sign_img").val('');
        $(".clearButton").click();
    });

    $(document).on('click', '[data-attachment]', function () {
        $(".page-loader-wrapper").show();
        $.ajax({
            type: "POST",
            url: baseURL +'/trip/waybill/attachment',
            data: 'id=' + $(this).attr('data-id')+'&type='+$(this).attr('data-type'),
            success: function (result) {
                $("#attachment .modal-body").html(result);
                $("#attachment").modal('show');
                $(".page-loader-wrapper").hide();
            },
            error: function (result) {
                $(".page-loader-wrapper").hide();
            }
        });
    });
});