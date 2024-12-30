@if(isset($vehicle_info))
    @foreach($vehicle_info as $key => $val)
        <div class="chart-legend-item">
            <div class="chart-legend-color kelly-green"></div>
            <p>
                <a href="javascript:void(0)"  class="f-12 text-success" data-load-map data-gps-id="{{ $key }}">{{ $val['plate_no'] }}</a>
            </p>
        </div>
@endforeach
@endif