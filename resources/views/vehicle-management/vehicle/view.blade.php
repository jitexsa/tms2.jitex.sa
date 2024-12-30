<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Manage Vehicles</h5>
                    <a href="{{ baseUrl('vehicle/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                            <th>SL</th>
                                <th>GPS Vehicle ID</th>
                                <th>Display Name</th>
                                <th>Vehicle Type</th>
                                <th>Maker</th>
                                <th>Vehicle Model</th>
                                <th>License Plate No</th>
                                <th>Color</th>
                                <th>Model Year.</th>
                                <th>Driver</th>
                                <th>Location</th>
                                <th>Workspace</th>
                                <th>Service Start Date</th>
                                <th>ODO</th>
                                <th>Registration #</th>
                                <th>Registration Date</th>
                                <th>Registration Expiry Date</th>
                                <th>Chassis No.</th>
                                <th>Sequence No.</th>
                                <th>Last MVPI Date</th>
                                <th>Country of Origin</th>
                                <th>Division</th>
                                <th>Company</th>
                                <th>Subcontractor</th>
                                <th>MVPI Expiry Date</th>
                                <th>MVPI  Document</th>
                                <th>Insurance Start Date</th>
                                <th>Insurance End Date</th>
                                <th>Insurance Policy #</th>
                                <th>Insurance Document</th>
                                <th>Truck Image</th>
                                <th>Truck Sketch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                          @php
                          $trip = getValue('trips', 'trips.vehicle = ' . $value->id . ' AND trips.workspace_id  = ' . Auth::user()->workspace_id );
                          @endphp
                          <tr class="{{ ($value->gps_vehicle_id)?'synced':'' }}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->gps_vehicle_id }}</td>
                                <td>{{ $value->display_name }}</td>
                                <td><div class="short-text" title="{{ $value->type_name }}">{{ $value->type_name }}</div></td>
                                <td><div class="short-text" title="{{ $value->make_name }}">{{ $value->make_name }}</div></td>
                                <td><div class="short-text" title="{{ $value->model_name }}">{{ $value->model_name }}</div></td>
                                <td>{{ $value->licence_plate_no }}</td>
                                <td>{{ $value->vehicleColor }}</td>
                                <td>{{ $value->modelYear }}</td>
                                <td><div class="short-text" title="{{ $value->driver_name }}">{{ $value->driver_name }}</div></td>
                                <td><div class="short-text" title="{{ $value->location_name }}">{{ ($value->location)?$value->location_name:'' }}</div></td>
                                <td><div class="short-text" title="{{ $value->workspace_name }}">{{ $value->workspace_name }}</div></td>
                                <td>{{ ($value->serviceStartDate)?dateFormat($value->serviceStartDate, 'shortdate'):'' }}</td>
                                <td>{{ $value->odo }}</td>
                                <td>{{ $value->vehicleRegistration }}</td>
                                <td>{{ $value->registrationDate }}</td>
                                <td>{{ $value->registrationExpiryDate }}</td>
                                <td>{{ $value->chassisNo }}</td>
                                <td>{{ $value->sequenceNo }}</td>
                                <td>{{ $value->lastMvpiDate }}</td>
                                <td>{{ $value->countryOfOrigin }}</td>
                                <td>{{ $value->division_name }}</td>
                                <td>{{ $value->company_name }}</td>
                                <td>{{ $value->transporter_name }}</td>
                                <td>{{ $value->expiryDate }}</td>
                                <td>
                                @if($value->mvpi_document)
                                    <a href="{{ baseURL($value->mvpi_document) }}" target="_blank">View Document</a>
                                @endif
                                </td>
                                <td>{{ $value->insuranceStartDate }}</td>
                                <td>{{ $value->insuranceEndDate }}</td>
                                <td>{{ $value->insurancePolicyNo }}</td>
                                <td>
                                    @if($value->insurance_document)
                                        <a href="{{ baseURL($value->insurance_document) }}" target="_blank">View Document</a>
                                    @endif
                               </td>
                                <td>
                                    @if($value->truck_image)
                                        <a href="{{ baseURL($value->truck_image) }}" target="_blank">View Image</a>
                                    @endif
                                </td>
                                <td>
                                    @if($value->truck_sketch)
                                        <a href="{{ baseURL($value->truck_sketch) }}" target="_blank">View Sketch</a>
                                    @endif
                                </td>
                                <td> 
                                <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                    @if(!empty($trip))
                                        <button type="button" data-confirmation data-content="You cannot delete the selected vehicle because vehicle are linked <br /> to these waybills." data-id="{{ $value->id }}" data-type="vehicle" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    @else
                                    <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    @endif
                                    @if($value->vehicle_api_data)
                                    <button type="button" data-vehicle-detail-view data-id="{{ $value->id }}" class="btn btn-primary btn-sm">View</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                         @endif
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>