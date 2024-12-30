"use strict";
let img = 'img#truck_sketch';
let image_selected_areas = [];
$(document).ready(function() {
    $(document).on('change',"#vehicle" ,function (e){
        let route = $('#vehicle').find('option:selected');
        jQuery("#reg_no").val(route.attr('data-vehicle_registration'));
        jQuery("#driver_name").val(route.attr('data-driver-name'));
        if(route.attr('data-vehicle-image')) {
            jQuery("#vehicle_inspection_section").show();
            jQuery("#inspection_image_sketch").val(baseurl + '/' + route.attr('data-vehicle-image'))
            if(jQuery("#vehicle_inspection_image").attr('src') == '') {
                jQuery("#vehicle_inspection_image").attr('src', (baseurl + '/' + route.attr('data-vehicle-image')));
            }
        }
        else{
            jQuery("#vehicle_inspection_section").hide();
        }
    });

    $('#reset').click(function() {
        $(img).selectAreas('reset');
        image_selected_areas = [];
    });

    $(document).on('click', "#vehicle_inspection_image", function (e){
            $("#vehicle_inspection_view").modal('show');
            $("#vehicle_inspection_view #truck_sketch").attr('src', jQuery("#inspection_image_sketch").val());
    });

    $("#vehicle_inspection_view").on('shown.bs.modal', function() {
            $(img).selectAreas({
                minSize: [10, 10],
                onChanged: area,
                width: '100%',
                areas: [],
                allowDelete: true
            })
    });
    $(document).on('click', "#done", function (e){
        output(JSON.stringify(image_selected_areas));
        domtoimage
            .toPng(document.querySelector('.inspection-parent'))
            .then(function (dataUrl) {
                $("textarea[name='vehicle_inspection_image']").val(dataUrl)
                $("#vehicle_inspection_image").attr('src',dataUrl)
            })
            .catch(function (error) {
                console.error("oops, something went wrong!", error);
            });
        setTimeout(function (){
            $("#vehicle_inspection_view").modal('hide');
        }, 1000)

    });

});

function areaToString(area) {
    return {x : area.x, y : area.y, width : area.width, height : area.height}
}

function output(text) {
    $('#output').val(text);
}

// Log the quantity of selections
function area(event, id, areas) {
    let area = $(img).selectAreas('areas');
    displayAreas(area);
};

// Display areas coordinates in a div
function displayAreas(areas) {
    $.each(areas, function(id, area) {
        image_selected_areas.push(areaToString(area));
    });
};

