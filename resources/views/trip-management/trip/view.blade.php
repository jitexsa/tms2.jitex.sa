<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Trip List</h5>
                    <a href="{{ baseUrl('trip/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                        <th>SL</th>
                                <th><input type="checkbox" name="all_download_file"></th>
                                <th>Date</th>
                                <th>Job No</th>
                                <th>Waybill</th>
                                <th>Client</th>
                                <th>POL</th>
                                <th>POD</th>
                                <th>Status</th>
                                <th>Vehicle</th>
                                <th>Driver Name</th>
                                <th>Workspace</th>
                                <th>Scope Of Work</th>
                                <th>Request Date</th>
                                <th>Contact Person</th>
                                <th>Telephone</th>
                                <th>Vehicle Type</th>
                                <th>L/C No</th>
                                <th>Division</th>
                                <th>Company</th>
                                <th>Subcontractor</th>
                                <th>Driver Mobile</th>
                                <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @if(isset($rec))
                            @foreach($rec as $key => $v)
                            @php
                                $cost = getValue('purchases',  'trip_id ='. $v->id);
                                $sms_log = getValue('logs', "log_type = 'sms' and log_type_id =".$v->id);
                                $status_log = getValue('logs', "log_type = 'waybill' and log_type_id =".$v->id." and action = 'change status'");
                            @endphp
                        <tr data-row="{{  $v->id }}">
                            <td>{{  $key+1 }}</td>
                            <td><input type="checkbox" name="download_file" value="{{  $v->id }}"></td>
                            <td>{{  $v->trip_date }}</td>
                            <td><div class="short-text" title="{{  $v->job_no }}"><a href="{{  baseURL('trip/waybill/preview/'.$v->waybill_no) }}" target="_blank">{{  $v->job_no }}</a></div></td>
                            <td><div class="short-text" title="{{  $v->waybill_no }}"><a href="{{  baseURL('trip/waybill/preview/'.$v->waybill_no) }}" target="_blank">{{  $v->waybill_no }}</a></div></td>
                            <td><div class="short-text" title="{{  $v->customer_name }}">{{  $v->customer_name }}</div></td>
                            <td><div class="short-text" title="{{  $v->loading }}">{{  $v->loading }}</div></td>
                            <td><div class="short-text" title="{{  $v->delivery }}">{{  $v->delivery }}</div></td>
                            <td data-trip-status="{{  $v->id }}">{{  tripStatus($v->status) }}</td>
                            <td><div class="short-text" title="{{  $v->licence_plate_no }}">{{  $v->licence_plate_no }}</div></td>
                            <td><div class="short-text" title="{{  $v->driver_name }}">{{  $v->driver_name }}</div></td>
                            <td>{{  $v->workspace_name }}</td>
                            <td>{{  $v->scope_name }}</td>
                            <td>{{  $v->request_date }}</td>
                            <td>{{  $v->contact_person }}</td>
                            <td>{{  $v->telephone }}</td>
                            <td>{{  $v->type_name }}</td>
                            <td>{{  $v->license_number }}</td>
                            <td>{{  $v->division_name }}</td>
                            <td>{{  $v->company_name }}</td>
                            <td>{{  $v->transporter_name }}</td>
                            <td>{{  $v->mobile }}</td>
                            <td>
                            <button wire:click="edit({{$v->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                            @if(!empty($cost))
                                  <button type="button" data-confirmation data-content="You cannot delete the selected waybill because the have cost for this waybill." data-id="{{ $v->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                               @else
                                  <button wire:click="delete({{$v->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                               @endif
                               @if($sms_log)
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Waybill SMS Log" data-sms-log data-id="{{  $v->id }}">SMS Log</a>
                               @endif
                               @if($status_log)
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Trip Status Log" data-trip-status-log data-id="{{  $v->id }}">Trip Log</a>
                               @endif
                               <a href="javascript:void(0)"  class="btn btn-danger btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Clone Trip" data-clone data-id="{{  $v->id }}">Clone</a>
                               @if(!empty($cost))
                               <a href="javascript:void(0)" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Generate Waybill Cost"  data-cost-detail data-id="{{  $cost->id }}">Cost Detail</a>
                               @else
                               <a href="{{  baseURL('cost/purchase/add') }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Generate Waybill Cost">Waybill Cost</a>
                               @endif
                               <div class="dropdown">
                                    <button class="btn btn-xs btn-warning btn-sm dropdown-toggle status-toggle" type="button" id="update_status" title="Change Status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-bookmark-alt"></i>
                                    </button>
                                    <div class="dropdown-menu trip_status" aria-labelledby="update_status">
                                        @php
                                        $trip_status = tripStatus();
                                        @endphp
                                        @foreach ($trip_status as $key => $s)
                                            <a href="javascript:void(0)" data-update-status data-trip-id="{{  $v->id }}" data-status-id="{{  $s->id }}" class="dropdown-item">{{  $s->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
