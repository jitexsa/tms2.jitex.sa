<x-app-layout>
    <div class="py-12">
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-5">
            <div class="row">
              <div class="col-12 od-xl-1"> 
                <div class="row"> 
                 @if($workspace_data->vehicle_block == 1)
                  <div class="col s-xxl-3 box-col-4">
                    <div class="card social-widget widget-hover">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2">
                            <span class="f-w-600">Vehicles</span>
                          </div>
                        </div>
                        <div class="social-content">
                          <ul>
                            <li class="f-12">On Trip Management</li>
                            <li class="f-12">On Maintenance</li>
                            <li class="f-12">Available</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($workspace_data->trip_block == 1)
                  <div class="col s-xxl-3 box-col-4">
                    <div class="card social-widget widget-hover">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2">
                            <span class="f-w-600">Todays Trip Management</span>
                          </div>
                        </div>
                        <div class="social-content">
                        <ul>
                            <li class="f-12">Trip Management</li>
                            <li class="f-12">Maintenance Trip Management</li>
                            <li class="f-12">Fuel Trip Management</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($workspace_data->remainder == 1)
                  <div class="col s-xxl-3 box-col-4">
                    <div class="card social-widget widget-hover">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2">
                            <span class="f-w-600">Reminder</span>
                          </div>
                        </div>
                        <div class="social-content">
                        <ul>
                            <li class="f-12">Legal Doc Soon Expire</li>
                            <li class="f-12">Legal Doc Expired</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @if($workspace_data->trip_status_block == 1)
                  <div class="col s-xxl-3 box-col-4">
                    <div class="card social-widget widget-hover">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center gap-2">
                            <span class="f-w-600">Trip Status Report</span>
                          </div>
                        </div>
                        <div class="d-flex flex-column social-content">
                            @if(isset($status_list))
                                @foreach($status_list as $vl)
                            <a href="#" class="col-12 d-flex justify-content-between f-12 {{ ($vl->total_waybill_status == 0)?'text-gray':'text-success' }}" data-show-waybill-list data-status-id="{{ $vl->id }}" data-name="{{  $vl->name }}">
                                    <span>{{ $vl->name }}</span>
                                    <span>
                                      <strong>{{  $vl->total_waybill_status }}</strong>
                                    </span>
                            </a>
                            @endforeach
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
              @if($workspace_data->vehicle_map_tracking == 1)
              <div class="col s-xxl-3 box-col-4">
                <div class="card follower-wrap">
                  <div class="card-header card-no-border pb-2">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                      <div class="show_trip_vehicle">
                          <select name="show_trip_vehicle" class="form-control">
                              <option value="yes">Track Only Trip Vehicles</option>
                              <option value="no" selected>Track All Vehicles</option>
                          </select>
                      </div>
                      <div>
                        <a href="java:script(0)" class="btn btn-success btn-sm" data-refresh>Refresh Tracking </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0 papernote-wrap">
                    <div class="row">
                      <div class="col-md-12">
                      <input type="Search" id="search" class="form-control" placeholder="Search By Vehicle Number / Name">
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="chart-legend scrollbar mt-4" data-vehicle>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col s-xxl-9  box-col-8">
                <div class="card heading-space"> 
                  <div class="vehicle-type">
                      <select class="form-control" name="vehicle_type" id="vehicle_type" data-select>
                          <option value="" selected="selected">Select Vehicle Type</option>
                          @php
                          $get_vehicle_type  = getVehicleType();
                          @endphp
                          @foreach ($get_vehicle_type as $type)
                              <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div id='map'></div>
                </div>
              </div>
              @endif
            </div>
          </div>
    </div>

    <script>
    @php
    if($workspace_data->vehicle_map_tracking == 1){
    @endphp
    let tracking_list = '{{ (isset($_SESSION['tracking_list']) and $_SESSION['tracking_list'])?$_SESSION['tracking_list']:'' }}'
        let lat = 23.8859;
        let lng = 45.0792;
        let data = '';
        @php } @endphp
    $(document).ready(function() {
        $(window).on('load', function (){
            loadTrackingVehicle();
        })
        @php
        if($workspace_data->vehicle_map_tracking == 1){
          @endphp
        $(document).on('keyup', '#search', function(e) {
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(),
            count = 0;
            // Loop through the comment list
            $('.chart-legend-item p').each(function() {
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).parent('.chart-legend-item').hide();  // MY CHANGE
                // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).parent('.chart-legend-item').show(); // MY CHANGE
                count++;
            }
            });
        });
        $(document).on('click', '[data-load-map]', function (e){
            e.preventDefault();
            let id =  $(this).attr('data-gps-id');
            let locations = JSON.parse(tracking_list)[id];
            lat = +locations['lat'];
            lng = +locations['lng']
            initMap(15);
        });
        $(document).on('click', '[data-refresh]', function (e){
            $(".page-loader-wrapper").show();
            e.preventDefault();
            loadTrackingVehicle();
        });
        $(document).on('change', '[name="show_trip_vehicle"]', function (e){
            $(".page-loader-wrapper").show();
            e.preventDefault();
            loadTrackingVehicle();
        });
        $(document).on('change', '[name="vehicle_type"]', function (e){
            $(".page-loader-wrapper").show();
            e.preventDefault();
            loadTrackingVehicle();
        });
        @php } @endphp
        $(document).on('click', '[data-show-waybill-list]', function(e){
            $(".page-loader-wrapper").show();
            e.preventDefault();
            let status = $(this).attr('data-status-id');
            let name = $(this).attr('data-name');
            $.ajax({
                type: "POST",
                url: baseURL + '/dashboard/waybill-list',
                data: 'status='+status,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (result) {
                    $("#waybill_list_by_status .title").html(name+ ' Waybill List')
                    $("#waybill_list_by_status .modal-body").html(result);
                    $("#waybill_list_by_status").modal('show');
                    $(".page-loader-wrapper").hide();
                },
                error: function (result) {
                    $(".page-loader-wrapper").hide();
                }
            });
        })
    });
    @php
    if($workspace_data->vehicle_map_tracking == 1){
    @endphp
    function initMap(zoom = 4) {
        const myLatLng = { lat: lat, lng:  lng};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: zoom,
            center: myLatLng,
            mapTypeControl: false,
        });
        if(tracking_list) {
            let marker, count;
            let locations = JSON.parse(tracking_list);
            for (count = 0; count < locations.length; count++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count]['lat'], locations[count]['lng']),
                    icon: '<?php echo base_url('assets/img/iconmaps.png?v='.VERSION) ?>',
                    map: map,
                });
                google.maps.event.addListener(marker, 'click', (function (marker, count) {
                    return function () {
                        $(".vehicle_number").text(locations[count]['plate_no'])
                        $(".driver_name").text(locations[count]['driver_name'])
                        $(".driver_mobile").text(locations[count]['driver_mobile'])
                        $(".vehicle_type").text(locations[count]['type'])
                        $(".speed").text(locations[count]['speed'])
                        $(".direction").text(locations[count]['direction'])
                        $(".location_coord").text(locations[count]['lat']+', '+locations[count]['lng'])
                        $(".date").text(locations[count]['created_at'])
                        $('#vehicle_tracking_view').modal('show');
                        $(".mode").html('');
                        $("#clock_display").hide();
                        if(locations[count]['show_clock'] == 1){
                            showTime(locations[count]['mode_date']);
                            $(".mode").html(locations[count]['mode']);
                            $("#clock_display").show();
                        }
                    }
                })(marker, count));
            }
        }
}
    window.initMap = initMap;
    @php } @endphp

    function loadTrackingVehicle(){
        let show_trip_vehicle = $('[name="show_trip_vehicle"]').val();
        $.ajax({
            type: "POST",
            url: baseURL + '/dashboard/vehicle-sync-with-google-map',
            data: 'refresh=1&show_trip_vehicle='+show_trip_vehicle+'&vehicle_type='+$('[name="vehicle_type"]').val(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
                let rec = JSON.parse(result);
                $("[data-vehicle]").html(rec.vehicle);
                tracking_list = rec.tracking_list;
                initMap();
                $(".page-loader-wrapper").hide();
            },
            error: function (result) {
                $(".page-loader-wrapper").hide();
            }
        });
    }
</script>
@if($workspace_data->vehicle_map_tracking == 1)
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{getenv('GOOGLE_API')}}&libraries=places&callback=initMap" defer></script>
<div id="vehicle_tracking_view" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="title">Vehicle Tracking Detail</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label class="form-label"><i class="fa fa-truck-moving"></i> <strong>Vehicle Name:</strong> </label>
                            <span class="vehicle_number"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="far fa-paper-plane"></i> <strong>Vehicle Type:</strong> </label>
                            <span class="vehicle_type"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="fa fa-user"></i> <strong>Driver Name:</strong> </label>
                            <span class="driver_name"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="fa fa-phone"></i> <strong>Driver Mobile:</strong> </label>
                            <span class="driver_mobile"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label class="form-label"><i class="fa fa-clock"></i> <strong>Date:</strong> </label>
                            <span class="date"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="fas fa-map-marker"></i> <strong>Coordinate:</strong> </label>
                            <span class="location_coord"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="fas fa-directions"></i> <strong>Direction:</strong> </label>
                            <span class="direction"></span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="fas fa-tachometer-alt"></i> <strong>Speed:</strong> </label>
                            <span class="speed"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif 
@if($workspace_data->trip_status_block == 1)
<div id="waybill_list_by_status" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 1320px;">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="title"></strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endif

<script>
    function showTime(mode_date){
        let current_time = new Date().getTime();
        let mode = new Date(mode_date).getTime();
        let diff = current_time-mode;
        let h = Math.floor(diff / 1000 / 60 / 60);
        let m = Math.floor(diff / 1000 / 60) % 60;
        let s = Math.floor(diff / 1000) % 60;
        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;
        let time = h + ":" + m + ":" + s ;
        document.getElementById("clock_display").innerText = time;
    }
</script>
</x-app-layout>
