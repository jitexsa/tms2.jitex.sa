"use strict";
let purchase = {
    getItem: function (id){
        if($("#category_id_"+id).val()) {
            $.ajax({
                url: baseURL  + "/ajax/get-item",
                data: JSON.stringify({cat_id: $("#category_id_" + id).val()}),
                dataType: "json",
                type: "POST",
                contentType: 'application/json;charset=UTF-8',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    let option = '<option value="">Select Item</option>';
                    $(data).each(function (k, v) {
                        option += '<option value="' + v.id + '" data-rate="' + v.item_price + '">' + v.item_name + '</option>';
                    });
                    $("#item_id_" + id).html(option);
                    $(`#row_${id}`).find(".basic-single").select2();
                }
            });
        }
    },
    getPrice: function(id) {
        let rate = $(`#item_id_${id} option:selected`).attr('data-rate');
        $(`#rate_${id}`).val(rate);
      },

    tripDetail: function (){
            let trip = $(`#trip_id option:selected`).attr('data-trip');
            let trip_data = JSON.parse(trip);
            let detail = `
                       <div class="row mt-4">
                             <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Job No</strong></label>
                                    <div class="text-right">${trip_data.job_no}</div>
                            </div>
                             <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Waybill #</strong></label>
                                    <div class="text-right">${trip_data.waybill_no}</div>
                            </div>
                            <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Trip Date</strong></label>
                                    <div class="text-right">${trip_data.trip_date}</div>
                            </div>
                             <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Plate No</strong></label>
                                    <div class="text-right">${trip_data.licence_plate_no}</div>
                            </div>
                             <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Driver</strong></label>
                                    <div class="text-right">${trip_data.driver_name}</div>
                            </div>
                             <div class="col-6 d-flex justify-content-between">
                                    <label><strong>Vehicle Type</strong></label>
                                    <div class="text-right">${trip_data.type_name}</div>
                            </div>
                             `;
                            if(trip_data.wessel){
                                detail +=`<div class="col-6 d-flex justify-content-between">
                                    <label><strong>Wessel</strong></label>
                                    <div class="text-right">${trip_data.wessel}</div>
                            </div>`;
                            }
                             if(trip_data.voyage){
                                 detail  +=`<div class="col-6 d-flex justify-content-between">
                                    <label><strong>Voyage</strong></label>
                                    <div class="text-right">${trip_data.voyage}</div>
                            </div>`;
                            }
                             if(trip_data.awb){
                                 detail += `<div class="col-6 d-flex justify-content-between">
                                    <label><strong>B/L AWB</strong></label>
                                    <div class="text-right">${trip_data.awb}</div>
                            </div>`;
                            }
                     detail +=`</div>`;
            $("[data-trip-detail]").html(detail);
      },
      //Calculate store Item
      calculateStore: function(sl) {
        var gr_tot = 0;
        var item_ctn_qty = $("#qty_" + sl).val();
        var vendor_rate = $("#rate_" + sl).val();
    
        var total_price = item_ctn_qty * vendor_rate;
        $("#total_price_" + sl).val(total_price.toFixed(2));
        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });
    
        $("#grandTotal").val(gr_tot.toFixed(2, 2));
    }
}