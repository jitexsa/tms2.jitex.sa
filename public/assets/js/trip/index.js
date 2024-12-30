"use strict";
$(document).ready(function() {
    $(document).on('change',"#vehicle" ,function (e){
        let vehicle = $('#vehicle').find('option:selected');
        jQuery("#truck_type").val(vehicle.attr('data-vehicle_type'));
        jQuery("#driver_name").val(vehicle.attr('data-driver-name'));
        jQuery("#license_no").val(vehicle.attr('data-license-no'));
        jQuery("#driver_mobile").val(vehicle.attr('data-mobile'));
        jQuery("#driver").val(vehicle.attr('data-driver-id'));
        Livewire.all()[4].$wire.$set('driver', vehicle.attr('data-driver-id'), false)
    });

    let n = 0;
    $(document).on('click', '[data-add-row]', function (e){
        e.preventDefault();
        n++;
      let row = `<div class="row pt-3 delete">
                        <div class="col-sm-3">
                            <input wire:model="marks_no" class="form-control" type="text" placeholder="" id="row_${n}">
                        </div>
                        <div class="col-sm-3">
                            <input wire:model="cargo_desc" class="form-control" type="text" placeholder="">
                        </div>
                        <div class="col-sm-1">
                            <input wire:model="qty" class="form-control" type="text" placeholder="">
                        </div>
                        <div class="col-sm-1">
                            <input wire:model="weight" class="form-control" type="text" placeholder="">
                        </div>
                        <div class="col-sm-3">
                            <input wire:model="remarks" class="form-control" type="text" placeholder="">
                        </div>
                        <div class="col-md-1">
                            <a href="#" data-delete-row><img src="${baseurl}assets/img/minus.png"></a>
                        </div>
                    </div>`;
        $("[data-set]").append(row);
        $(`#row_${n}`).focus();
    });

    $(document).on('click', '[data-delete-row]', function (e){
        e.preventDefault();
        $(this).parents('div.delete').remove();
    })

    $(document).on('click', '#trip_loading', function (e){
        e.preventDefault();
        $('#location_type').val(1);
    })

    $(document).on('click', '#trip_delivery', function (e){
        e.preventDefault();
        $('#location_type').val(2);
    })

    //route form ajax request handler
    jQuery(document).on('submit','#route-form',function (e) {
        e.preventDefault();
        let form = jQuery('#route-form');
        let location = $('[name=location]').val();
        let location_type = $('#location_type').val();
        if(location){
        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(document.getElementById("route-form")),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                if(result.successfully) {
                    $(".message").html('<div class="alert alert-success alert-dismissible" role="alert">' + result.message + '</div>');
                }
                if(result.error){
                    $(".message").html('<div class="alert alert-danger alert-dismissible" role="alert">' + result.message + '</div>');
                }
                let load_location_type  = '.loading-route';
                let loading  = 'loading_at';
                if(location_type == 2){
                    load_location_type  = '.delivery-route';
                    loading  = 'delivery_at';
                }
                $(load_location_type).html(result.html);
                $('.modal').modal('hide');
                document.getElementById("route-form").reset();
                $('.modal').on('hidden.bs.modal', function () {
                    $("#"+loading+" option").filter(function() {
                        return $.trim($(this).text()).toLowerCase() == $.trim(location).toLowerCase();
                    }).prop("selected", true);
                    setTimeout(() => {
                        $("[data-select]").select2().change()
                    }, 2000);
                });
            },
            error: function (result){
            }
        });
        }
    });

        //request by form ajax request handler
        jQuery(document).on('submit','#request-by-form',function (e) {
        e.preventDefault();
        let form = jQuery(this);
        let requested_name = $('#requested_name').val();
            jQuery.ajax({
                type: "POST",
                url: form.attr('action'),
                data: new FormData(document.getElementById("request-by-form")),
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    if(result.successfully) {
                        $(".message").html('<div class="alert alert-success alert-dismissible" role="alert">' + result.message + '</div>');
                    }
                    if(result.error){
                        $(".message").html('<div class="alert alert-danger alert-dismissible" role="alert">' + result.message + '</div>');
                    }
                    $('.load-requested').html(result.html);
                    $('.modal').modal('hide');
                    document.getElementById("request-by-form").reset();
                    $('.modal').modal('hide');
                    $('.modal').on('hidden.bs.modal', function () {
                        $("#request_by option").filter(function() {
                            return $.trim($(this).text()).toLowerCase() == $.trim(requested_name).toLowerCase();
                        }).prop("selected", true);
                        setTimeout(() => {
                            $("[data-select]").select2().change()
                        }, 2000);
                    });
                },
                error: function (result){
                }
            });
        });


        $(".modal").on('hide.bs.modal', function() {
            $(".message").html('');
        });
       
        $("#add_driver").on('show.bs.modal', function() {
            $("#add-vehicle").modal('hide');
        });
        $("#add_driver").on('hide.bs.modal', function() {
            $("#add-vehicle").modal('show');
        });

    $(document).on('change', '[data-load-saleman]', function (e){
            jQuery.ajax({
                type: "POST",
                url: baseURL+'/ajax/get-saleman',
                data: 'customer='+$(this).val(),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    let opt = '<option value="" selected="selected">Select Saleman</option>';
                    if (result !== 'null') {
                        let r = JSON.parse(result);
                        opt += `<option value='${r.staffid}'>${r.firstname} ${r.lastname}</option>`;
                    }
                    $("#saleman").html(opt);
                },
                error: function (result) {
                }
            });
        });

    jQuery(document).on('submit','[data-shipping-form]',function (e) {
        e.preventDefault();
        let form = jQuery(this);
        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                if(result.successfully) {
                    $(".message").html('<div class="alert alert-success alert-dismissible" role="alert">' + result.message + '</div>');
                }
                $('.load-shipping').html(result.html);
                $('.modal').modal('hide');
                document.querySelector("[data-shipping-form]").reset();
                $('.modal').on('hidden.bs.modal', function () {
                    $("#job_no option").filter(function() {
                        return $.trim($(this).text()).toLowerCase() == $.trim(result.job_no).toLowerCase();
                    }).prop("selected", true);
                    setTimeout(() => {
                        $("[data-select]").select2().change()
                    }, 2000);
                });
            },
            error: function (result){
            }
        });
    });

    jQuery(document).on('submit','#vehicle-form',function (e) {
        e.preventDefault();
        let form = jQuery(this);
        $("#licence_plate_no").val($("#plate_no").val()+' '+$("#plate_alphabet").val());
        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                if(result.successfully) {
                    $(".message").html('<div class="alert alert-success alert-dismissible" role="alert">' + result.message + '</div>');
                    $('.load-vehicle').html(result.html);
                    $('.modal').modal('hide');
                    document.querySelector("#vehicle-form").reset();
                    $('.modal').on('hidden.bs.modal', function () {
                        $("#vehicle option").filter(function() {
                            return $.trim($(this).text()).toLowerCase() == $.trim(result.plate_no).toLowerCase();
                        }).prop("selected", true);
                        setTimeout(() => {
                            $("[data-select]").select2().change()
                        }, 2000);
                    });
                }
                if(result.error){
                    let error_list = '<ul>';
                    for(let m of result.error){
                        error_list += '<li>'+m+'</li>';
                    }
                    error_list += '</ul>';
                    $(".message").html('<div class="alert alert-danger alert-dismissible" role="alert">' +error_list+ '</div>');

                }
               
            },
            error: function (result){
            }
        });
    });

    jQuery(document).on('submit','#driver-form',function (e) {
        e.preventDefault();
        let form = jQuery(this);
        jQuery.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                if(result.successfully) {
                    $(".message").html('<div class="alert alert-success alert-dismissible" role="alert">' + result.message + '</div>');
                    $('.load-driver').html(result.html);
                    $('.modal').modal('hide');
                    document.querySelector("#driver-form").reset();
                    $('.modal').on('hidden.bs.modal', function () {
                        $("#driver_id option").filter(function() {
                            return $.trim($(this).text()).toLowerCase() == $.trim(result.driver).toLowerCase();
                        }).prop("selected", true);
                        setTimeout(() => {
                            $("[data-select]").select2().change()
                        }, 2000);
                    });
                }
                if(result.error){
                    let error_list = '<ul>';
                    for(let m of result.error){
                        error_list += '<li>'+m+'</li>';
                    }
                    error_list += '</ul>';
                    $(".message").html('<div class="alert alert-danger alert-dismissible" role="alert">' +error_list+ '</div>');

                }
                
            },
            error: function (result){
            }
        });
    });

    $(document).on('change', '[data-labor]', function (e){
        if($(this).val()) {
            $($(this).parents('.row')[0]).find('#labor_qty').attr('required', true);
        }
        else{
            $($(this).parents('.row')[0]).find('#labor_qty').val('').attr('required', false);
        }
    });

    $(document).on('click', '[data-open-vehicle-modal]', function (e){
        e.preventDefault();
        let vehicle = $('#vehicle').val();
            jQuery.ajax({
                type: "POST",
                url: baseURL+'/ajax/load-vehicle',
                data: 'vehicle_id='+vehicle,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $(".vehicle-modal").html(result);
                    $("#add-vehicle").modal('show');
                    setTimeout(() => {
                        $("[data-select]").select2().change()
                        flatpickr("[data-datepicker]", {
                            dateFormat: "d-m-Y"
                        })
                    }, 2000);
                },
                error: function (result) {
                }
            });
    });

});
