let inquiry = {
    routeRow: 1,
    routeType: '',
    inquiryOption: function (){
        jQuery(".inquiry-form-validation").html('');
        jQuery(".inquiry-form-option").animate({"right":"66px", 'opacity' : 1}, 100);
        jQuery(".inquiry-sidebar .bg-primary").fadeOut(200, function (){
            jQuery(".inquiry-sidebar .bg-danger").fadeIn(200);
        });
    },
    backInquiryOption: function (){
        jQuery(".inquiry-form-option").animate({"right":"-400px", 'opacity' :0}, 100);
        jQuery(".inquiry-sidebar .bg-danger").fadeOut(200, function (){
            jQuery("[data-transport-mode], [data-shipment-type],[data-preview], .inquiry-sidebar .bg-success").hide();
            jQuery(".inquiry-sidebar .bg-primary, [data-direction]").show();
        });
    },
    editInquiryOption: function (){
        jQuery(".inquiry-sidebar .bg-danger").fadeOut(200, function (){
            jQuery("[data-transport-mode], [data-shipment-type],[data-preview], .inquiry-sidebar .bg-success").hide();
            jQuery(".inquiry-sidebar .bg-danger, [data-direction]").show();
            jQuery(".inquiry-form-option").animate({"right":"66px", 'opacity' : 1}, 100);
        });
    },
   direction: function (e){
           if(jQuery(e).is(":checked")){
               jQuery("[data-direction] li").removeClass('checked');
               jQuery(e).closest('li').addClass('checked');
               jQuery("[data-direction]").slideUp(200, function (){
                   jQuery("[data-transport-mode]").show( 200);
               });
           }
   },
    transport: function (e){
        if(jQuery(e).is(":checked")){
            jQuery("[data-transport-mode] li").removeClass('checked');
            jQuery(e).closest('li').addClass('checked');
            jQuery("[data-transport-mode]").slideUp(200, function (){
                jQuery("[data-shipment-type] li").hide();
                jQuery("[data-shipment-type]").show( 200, function (){
                    jQuery(`[data-transport-id="${jQuery(e).val()}"]`).show( 200);
                });
            });
        }
    },
    shipment: function (e){
            if(jQuery(e).is(":checked")){
                jQuery("[data-shipment-type] li").removeClass('checked');
                jQuery(e).closest('li').addClass('checked');
                jQuery("[data-shipment-type]").slideUp(300, function (){
                    jQuery("[data-preview] ul").html('')
                    jQuery(".inquiry-form-option li.checked").map(function (e, i){
                        let selected_option = jQuery(i).find('.form-check-label')[0].outerHTML;
                        jQuery("[data-preview] ul").append('<li class="w-full p-2 p-relative checked">'+selected_option+'</li>');
                    });
                    jQuery("[data-preview]").show(200)
                    jQuery(".inquiry-sidebar .bg-danger").fadeOut(200, function (){
                        jQuery(".inquiry-sidebar .bg-success").fadeIn(200);
                    });
                });
            }
    },
    /**
     * clone route
     */
    cloneRoute: function (e){
        jQuery("[data-route-parent]").append(jQuery(e).parents('[data-row]')[0].outerHTML)
        jQuery("[data-route-parent] [data-row]:last").attr('data-row',jQuery("[data-route-parent] [data-row]").length-1);
        jQuery("[data-route-parent] [data-row]:last .remove-route").removeClass('hide')
        jQuery("[data-route-parent] [data-row]:last .location").html('')
    },
    /**
     * remove route
     * @param e
     */
    removeRoute: function (e){
        let row  = jQuery(e).parents('[data-row]');
        row.remove();
        storage.delete('route', row.attr('data-row'))
    },
    /**
     * route setting modal show
     */
    showRouteModal: function (e, type, option){
        this.routeRow = jQuery(e).parents('[data-row]').data('row');
        this.routeType = type;
        if(option == 'port'){
            jQuery(".port").removeClass('hide');
            jQuery(".address").addClass('hide');
        }
        else{
            jQuery(".port").addClass('hide');
            jQuery(".address").removeClass('hide');
        }
        jQuery(".customizer-header h5 span").text(type)
        jQuery("[data-route-setting-modal]").addClass('open')
        jQuery(".pod, .same_delivery_address").addClass('hide')
        jQuery('[for="final_address"]').text('Pickup Address')
        if(type == 'pod'){
            jQuery(".pod").removeClass('hide')
            jQuery('[for="final_address"]').text('Delivery Address')
        }
        this.editRoute()
    },
    /**
     * route setting modal close
     */
    closeRouteModal: function (e){
        this.resetRoute();
        jQuery("[data-route-setting-modal]").removeClass('open')
    },
    /**
     * location dropdown in route setting
     */
    selectLocation: function (e){
        jQuery("#final_address").val(jQuery(e).find(':selected').attr('data-address'))
    },
    /**
     * save pod and pol route
     */
    saveRoute: function (e){
        let route = []
        let data = {
            'port': jQuery('#port').val(),
            'location': jQuery('#location').val(),
            'port_name': jQuery("#port option:selected" ).text(),
            'location_name': jQuery("#location option:selected" ).text(),
            'address': jQuery("#final_address").val()
        };
       route = storage.get('route');
        if(typeof route != "undefined" && route[this.routeRow]){
            route[this.routeRow][this.routeType] = data;
        }
        else{
            route[this.routeRow] = {[this.routeType]: data};
        }
        if(this.routeType == 'pol') {
            jQuery("[data-row=" + this.routeRow + "] [data-pol]").text(jQuery("#port option:selected").text())
        }
        else{
            jQuery("[data-row=" + this.routeRow + "] [data-pod]").text(jQuery("#port option:selected").text())
            route[this.routeRow][this.routeType]['same_delivery_address'] = jQuery("#same_delivery_address").is(':checked');
            let delivery_address = jQuery("#final_address").val();
            if(!jQuery("#same_delivery_address").is(':checked')){
                delivery_address = jQuery("#delivery_address").val();
            }
            route[this.routeRow][this.routeType]['delivery_address'] = delivery_address
        }
        jQuery("#routing").val(JSON.stringify(route));
        storage.set('route', route)
        this.closeRouteModal();
        this.loadRoute();
    },
    /**
     * edit route information
     */
    editRoute: function (){
        let route = storage.get('route');
        if(typeof route != "undefined" && route[this.routeRow]){
            let data = route[this.routeRow][this.routeType];
            jQuery("#port").val(data['port']);
            jQuery("#location").val(data['location']);
            jQuery("#final_address").val(data['address']);
            let same_address = (typeof data['same_delivery_address'] != "undefined" && data['same_delivery_address'] == 1)?true:false;
            jQuery("#same_delivery_address").prop("checked", same_address);
            if(!same_address){
                jQuery(".same_delivery_address").removeClass('hide')
            }
            jQuery("#delivery_address").val(data['delivery_address']);
        }
    },
    /**
     * reset route form fields
     */
    resetRoute: function (){
        jQuery("#port, #location, #final_address, #delivery_address").val('');
    },
    /**
     * load route from local storage
     */
    loadRoute: function (){
        jQuery("#routing").val(JSON.stringify(storage.get('route')));
        Livewire.all()[0].$wire.$set('routing', JSON.stringify(storage.get('route')), false)
        jQuery.ajax({
            type: "POST",
            url: baseURL+'/ajax/load-route',
            data:  JSON.stringify({route:storage.get('route')}),
            dataType : "json",
            contentType: 'application/json;charset=UTF-8',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
               if(result){
                  jQuery("[data-route-parent]").html(result.html);
               }
            },
        });
    },
    sameAddress: function (e){
        if(!e.checked){
            jQuery(".same_delivery_address").removeClass('hide')
        }
        else{
            jQuery(".same_delivery_address").addClass('hide')
        }
    },
    inputChange: function (e){
        jQuery(e).removeAttr('data-error')
    }
};

jQuery(document).ready(function (){
    "use strict";
    inquiry.loadRoute();
    jQuery("#route_information-tab").on('click', function (e){
        inquiry.loadRoute();
    });

    jQuery("#customer_name").on('change', function (e){
        if(jQuery(this).val()){
            let attr = JSON.parse(jQuery(this).find(':selected').attr('data-attribute'))
            jQuery("#branch").val(attr['branch']).trigger('change')
            jQuery("#business_area").val(attr['business_area']).trigger('change')
        }
    });
});
