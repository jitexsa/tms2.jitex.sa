<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vendor List</h5>
                    <a href="{{ baseUrl('vendor/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Vendor Type</th>
                            <th>Vendor Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>Branch Code</th>
                            <th>IBAN Number</th>
                            <th>CR Attachment</th>
                            <th>Vat Certificate</th>
                            <th>Workspace</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->vendor_type }}</td>
                            <td>{{ $value->vendor_Name }}</td>
                            <td>{{ $value->phone_number }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->bank_name }}</td>
                            <td>{{ $value->account_number }}</td>
                            <td>{{ $value->branch_code }}</td>
                            <td>{{ $value->iban_no }}</td>
                            <td>
                                @if(!empty($value->cr_attachment))
                                    <div class="attachment">
                                        <a href="{{baseUrl($value->cr_attachment)}}" target="_blank">
                                            View Attachment
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if(!empty($value->vat_certificate))
                                    <div class="attachment">
                                        <a href="{{baseUrl($value->vat_certificate)}}" target="_blank">
                                            View Attachment
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $value->workspace_name }}</td>
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