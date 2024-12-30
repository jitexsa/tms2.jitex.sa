<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Subcontractor</h5>
                    <a href="{{ baseUrl('subcontractor/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Transporter Name</th>
                                <th>Onboarding Date</th>
                                <th>Email</th>
                                <th>Contact Person</th>
                                <th>Contact Number</th>
                                <th>CR Number</th>
                                <th>VAT No</th>
                                <th>Landline Number</th>
                                <th># of Vehicles</th>
                                <th>Location</th>
                                <th>Division</th>
                                <th>Company</th>
                                <th>Document Attachment</th>
                                <th>Website</th>
                                <th>Status</th>
                                <th>Workspace</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if(isset($rec) and !empty($rec))
                                @foreach($rec as $key => $value)
                                @php
                                $waybill = linkWithTrip($value->id);
                                @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->transporter_name }}</td>
                                <td>{{ dateFormat($value->onboarding_date,'shortdate') }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->contact_person }}</td>
                                <td>{{ $value->contact_no }}</td>
                                <td>{{ $value->cr_number }}</td>
                                <td>{{ $value->vat_no }}</td>
                                <td>{{ $value->landline_no }}</td>
                                <td>{{ $value->total_vehicle }}</td>
                                <td>{{ $value->location }}</td>
                                <td>{{ $value->division_name }}</td>
                                <td>{{ $value->company_name }}</td>
                                <td>
                                    @if($value->document_attachment)
                                        <div class="attachment">
                                            <img src="{{ baseURL($value->document_attachment) }}" width="100">
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $value->website }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->workspace_name }}</td>
                                <td>
                                <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                   @if(!empty($waybill))
                                       <a href="#" data-confirmation data-content="You cannot delete the selected subcontractor because subcontractor are linked <br /> to these waybills." data-id="{{ $value->id }}" data-type="contractor" class="btn btn-danger btn-sm mr-1">Delete</a>
                                   @else
                                   <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                   @endif
                                <a href="{{ baseURL('subcontractor/detail/'.$value->id) }}" class="btn btn-sm btn-primary mr-1" title="Add Detail">Detail</a>
                                   </td>
                            </tr>
                              @endforeach
                              @endif
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>