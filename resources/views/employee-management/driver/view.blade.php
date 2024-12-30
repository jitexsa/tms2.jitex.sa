<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Driver List</h5>
                    <a href="{{ baseUrl('employee/driver/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Driver Name</th>
                                <th>Company</th>
                                <th>Division</th>
                                <th>Mobile</th>
                                <th>License Number</th>
                                <th>NID</th>
                                <th>Iqama Expiry Date</th>
                                <th>Nationality</th>
                                <th>License Type</th>
                                <th>License Issue Date</th>
                                <th>License Expiry Date</th>
                                <th>Passport No</th>
                                <th>Passport Expiry</th>
                                <th>Join Date</th>
                                <th>Location Name</th>
                                <th>Vehicle</th>
                                <th>Subcontractor</th>
                                <th>Workspace</th>
                                <th>Port ID Number</th>
                                <th>Port ID End Date</th>
                                <th>Port Attachment</th>
                                <th>Iqama Image</th>
                                <th>License Image</th>
                                <th>Photograph</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                          @php
                          $trip = getValue('trips', 'trips.driver = ' . $value->id . ' AND trips.workspace_id  = ' . Auth::user()->workspace_id );
                          $user = getValue('users', 'driver_id = '. $value->id);
                          @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                              <div class="short-text" title="{{ $value->driver_name }}">
                              {{ $value->driver_name }}
                              </div>
                            </td>
                            <td>
                                <div class="short-text" title="{{ $value->company_name }}">
                                {{ $value->company_name }}
                                </div>
                            </td>
                            <td>
                                <div class="short-text" title="{{ $value->division_name }}">
                                {{ $value->division_name }}
                                </div>
                            </td>
                            <td>{{ $value->mobile }}</td>
                            <td>{{ $value->license_number }}</td>
                            <td>{{ $value->national_id }}</td>
                            <td>{{ dateFormat($value->iqama_expiry_date,'report') }}</td>
                            <td>{{ $value->nationality }}</td>
                            <td>{{ $value->license_type }}</td>
                            <td>{{ dateFormat($value->license_issue_date,'report') }}</td>
                            <td>{{ dateFormat($value->license_expiry_date,'report') }}</td>
                            <td>{{ $value->passport_no }}</td>
                            <td>{{ dateFormat($value->passport_expiry, 'report') }}</td>
                            <td>{{ dateFormat($value->join_date, 'report') }}</td>
                            <td><div class="short-text" title="{{ $value->location_name }}">
                                    {{ ($value->location_name)?$value->location_name:'' }}
                                </div>
                            </td>
                            <td>{{ $value->licence_plate_no }}</td>
                            <td>{{ $value->transporter_name }}</td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>{{ $value->port_id_number }}</td>
                            <td>{{ dateFormat($value->port_id_end_date,'report') }}</td>
                            <td>
                                @if(!empty($value->port_attachment))
                                    <div class="attachment">
                                        <a href="{{ baseURL($value->port_attachment) }}" target="_blank">
                                            <img src="{{ baseURL($value->port_attachment) }}" width="100">
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if(!empty($value->iqama_image))
                                    <div class="attachment">
                                        <a href="{{ baseURL($value->iqama_image) }}" target="_blank">
                                        <img src="{{ baseURL($value->iqama_image) }}" width="100">
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if(!empty($value->license_image))
                                    <div class="attachment">
                                        <a href="{{ baseURL($value->license_image) }}" target="_blank">
                                        <img src="{{ baseURL($value->license_image) }}" width="100">
                                        </a>
                                    </div>
                                    @endif
                            </td>
                            <td>
                                @if(!empty($value->picture)){ ?>
                                    <div class="attachment">
                                        <a href="{{ baseURL($value->picture) }}" target="_blank">
                                        <img src="{{ baseURL($value->picture) }}" width="100">
                                        </a>
                                    </div>
                                    @endif
                            </td>
                            <td>{{ listingStatus($value->status) }}</td>
                            <td>
                            <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                            @if(!empty($trip))
                                <button type="button" data-confirmation data-content="You cannot delete the selected driver because driver are linked <br/> to these waybills." data-id="{{ $value->id }}" data-type="driver" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                               @else
                               <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                               @endif
                               @if($user)
                                  <a href="#" data-copy data-link="{{ baseURL('login/'.$user->id)}}"
                                      class="btn btn-warning m-b-5" data-toggle="tooltip" data-placement="right"
                                      title="Copy Login Link">Copy
                                  </a>
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