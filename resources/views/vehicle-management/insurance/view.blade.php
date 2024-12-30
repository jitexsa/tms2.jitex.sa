<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Insurance List</h5>
                    <a href="{{ baseUrl('vehicle/insurance/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                                <th>Sr No</th>
                                <th>Company Name</th>
                                <th>Vehicle</th>
                                <th>Policy Number</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Recurring Period</th>
                                <th>Recurring Date</th>
                                <th>Policy Document</th>
                                <th>Workspace</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><div class="short-text" title="{{ $value->company_name }}">{{ $value->company_name }}</div></td>
                            <td><div class="short-text" title="{{ $value->licence_plate_no }}">{{ $value->licence_plate_no }}</div></td>
                            <td>{{ $value->policy_number }}</td>
                            <td><div class="short-text" title="{{ $value->start_date }}">{{ $value->start_date }}</div></td>
                            <td><div class="short-text" title="{{ $value->end_date }}">{{ $value->end_date }}</div></td>
                            <td>{{ $value->recurring_period }}</td>
                            <td>{{ $value->recurring_date }}</td>
                            <td>
                            @if($value->policy_document)  
                            <div class="short-text" title="View Document"><a href="{{ baseURL($value->policy_document) }}" target="_blank">View Document</a></div>
                            @endif
                          </td>
                            <td><div class="short-text" title="{{ $value->workspace_name }}">{{ $value->workspace_name }}</div></td>  
                            <td>
                            <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
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