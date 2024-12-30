<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Fuel</h5>
                    <a href="{{ baseUrl('fuel/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Vehicle</th>
                                <th>Refueled Date</th>
                                <th>Current ODO Meter</th>
                                <th>Invoice Reference</th>
                                <th>State/Province</th>
                                <th>Vendor</th>
                                <th>Fuel Type</th>
                                <th>Qty</th>
                                <th>Cost</th>
                                <th>Note</th>
                                <th>Workspace</th>
                                <th>Slip</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @if (!empty($rec))
                              @foreach ($rec as $key =>  $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->licence_plate_no }}</td>
                                <td>{{ dateFormat($value->refueling_date,'shortdate') }}</td>
                                <td>{{ $value->start_meter }}</td>
                                <td>{{ $value->reference }}</td>
                                <td>{{ $value->state }}</td>
                                <td>{{ $value->vendor_name }}</td>
                                <td>{{ $value->type_name }}</td>
                                <td>{{ $value->qty }}</td>
                                <td>{{ $value->cost }}</td>
                                <td>{{ $value->note }}</td>
                                <td>{{ $value->workspace_name }}</td>
                                <td>
                                    @if(!empty($value->slip))
                                        <div class="attachment">
                                            <a href="{{$value->slip}}" target="_blank">
                                                View Slip
                                            </a>
                                        </div>
                                    @endif
                                    </td>
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