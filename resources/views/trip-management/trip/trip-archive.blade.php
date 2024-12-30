
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
              <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Archive Trip</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Job No</th>
                                <th>Waybill</th>
                                <th>Client</th>
                                <th>POL</th>
                                <th>POD</th>
                                <th>Archive By</th>
                                <th>Status</th>
                                <th>Vehicle</th>
                                <th>Driver Name</th>
                                <th>Workspace</th>
                                <th>Driver Mobile</th>
                                <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                          @php
                          $log = getValue('logs', "log_type = 'waybill' and log_type_id =".$value->id ." and action = 'archive'");
                          if($log){
                          $log = json_decode($log->log_content);
                          $archive_by = getValue('users', 'id = '.$log->created_by);
                          }
                          @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->trip_date }}</td>
                            <td><div class="short-text" title="{{ $value->job_no }}"><a href="{{ baseURL('trip/waybill/preview/'.$value->waybill_no) }}" target="_blank">{{ $value->job_no }}</a></div></td>
                            <td><div class="short-text" title="{{ $value->waybill_no }}"><a href="{{ baseURL('trip/waybill/preview/'.$value->waybill_no) }}" target="_blank">{{ $value->waybill_no }}</a></div></td>
                            <td><div class="short-text" title="{{ $value->customer_name }}">{{ $value->customerName }}</div></td>
                            <td><div class="short-text" title="{{ $value->loading }}">{{ $value->loading }}</div></td>
                            <td><div class="short-text" title="{{ $value->delivery }}">{{ $value->delivery }}</div></td>
                            <td>{{ isset($archive_by)?$archive_by->firstname.' '.$archive_by->lastname:'' }}</td>
                            <td data-trip-status="{{ $value->id }}">{{ tripStatus($value->status) }}</td>
                            <td><div class="short-text" title="{{ $value->licence_plate_no }}">{{ $value->licence_plate_no }}</div></td>
                            <td><div class="short-text" title="{{ $value->driver_name }}">{{ $value->driver_name }}</div></td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>{{ $value->mobile }}</td>
                            <td>
                               <button wire:click="restore({{$value->id}})" class="btn btn-info btn-sm">Restore</button>
                               <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                         @endforeach
                         @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>