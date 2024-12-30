"use strict";
(function($) {
    // Initialize
        jQuery('[name="lease_type"]').change(function (e){
                let start_date = jQuery('#start_date').val().split('-');
                let selected = jQuery('[name="lease_type"]:checked').val();
                if(selected !== 'custom'){
                    let month = '';
                   if(selected == 'monthly'){
                       month = 1;
                   }
                   else if(selected == 'quarterly'){
                       month = 3
                   } 
                   else{
                       month = 12 
                    }
                  let end_date = moment(start_date[2]+'-'+start_date[1]+'-'+start_date[0]).add(month, 'M').format('DD-MM-YYYY');
                jQuery("#end_date").val(end_date);
            }
        });

        $(document).on('change', '#company', function (){
            let vehicle = '<option value="" selected="selected">Please Select One</option>';
            if($(this).val()) {
                $.ajax({
                    url: baseURL + '/ajax/get-company-vehicle',
                    data: JSON.stringify({company_id: $(this).val()}),
                    dataType: "json",
                    type: "POST",
                    contentType: 'application/json;charset=UTF-8',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        $(data['vehicle']).each(function (index, val) {
                            vehicle += '<option value="' + val['id'] + '">' + val['licence_plate_no'] + '</option>';
                        });
                        $("#vehicle").html(vehicle);
                    },
                    error: function (result) {
                    }
                });
            }
        });

        $(document).on('click', '[data-attachment]', function () {
            $(".page-loader-wrapper").show();
            $.ajax({
                type: "POST",
                url: baseurl + 'vehiclemgt/Vehicle_leasing/get_attachment',
                data: 'id=' + $(this).attr('data-id'),
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
}(jQuery));
