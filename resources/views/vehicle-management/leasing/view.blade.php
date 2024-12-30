<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Leasing List</h5>
                    <a href="{{ baseUrl('vehicle/leasing/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                                <th>SL</th>
                                <th>Vehicle</th>
                                <th>Company Name</th>
                                <th>Customer Name</th>
                                <th>Lease Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Workspace</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><div class="short-text" title="{{ $value->licence_plate_no }}">{{ $value->licence_plate_no }}</div></td>
                            <td><div class="short-text" title="{{ $value->company_name }}">{{ $value->company_name }}</div></td>
                            <td><div class="short-text" title="{{ $value->customer_name }}">{{ $value->customer_name }}</div></td>
                            <td>{{ ucfirst($value->lease_type) }}</td>
                            <td>{{ dateFormat($value->start_date,'shortdate') }}</td>
                            <td>{{ dateFormat($value->end_date,'shortdate') }}</td>
                            <td><div class="short-text" title="{{ $value->workspace_name }}">{{ $value->workspace_name }}</div></td>
                            <td>
                            <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                            <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                @if($value->attachments)
                                <a href="#" class="btn btn-xs btn-warning btn-sm mr-1" data-attachment data-id="{{ $value->id }}">
                                View Document
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