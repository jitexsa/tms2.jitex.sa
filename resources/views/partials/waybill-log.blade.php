<table class="table display table-bordered table-striped table-hover" id="trip_status_list">
    <thead>
    <tr>
        <th>SL</th>
        <th>Trip Date</th>
        <th>Job #</th>
        <th>Waybill #</th>
        <th>Loading</th>
        <th>Delivery</th>
        <th>Vehicle</th>
        <th>Driver</th>
        <th>Mobile</th>
        <th>Loading Date</th>
        <th>Unloading Date</th>
        <th>Status</th>
        <th>Cargo Description</th>
        <th>Weight</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($waybill_log))
        @foreach($waybill_log as $i => $val)
            @php
             $trip_detail = ($val->trip_detail)? json_decode($val->trip_detail,true): array();
             $cargo_desc = $weight  = '';
             if($trip_detail){
                 $cargo_desc = implode(',',array_column($trip_detail,'cargo_desc'));
                 $weight = implode(',',array_column($trip_detail,'weight'));
             }
             @endphp
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $val->trip_date }}</td>
                <td>{{ $val->job_no }}</td>
                <td><a href="{{ baseURL('waybill/preview/'.$val->waybill_no) }}" target="_blank">{{ $val->waybill_no }}</a></td>
                <td>{{ $val->loading }}</td>
                <td>{{ $val->delivery }}</td>
                <td>{{ $val->licence_plate_no }}</td>
                <td>{{ $val->driver_name }}</td>
                <td>{{ $val->mobile }}</td>
                <td>{{ $val->loaded_date }}</td>
                <td>{{ $val->unloaded_date }}</td>
                <td>{{ $val->name }}</td>
                <td>{{ $cargo_desc }}</td>
                <td>{{ $weight }}</td>
            </tr>
        @endforeach
     @endif
    </tbody>
</table> <!-- /.table-responsive -->
<script>
    $('#trip_status_list').DataTable();
</script>
