<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Purchase List</h5>
                    <a href="{{ baseUrl('cost/purchase/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Vendor Name</th>
                            <th>Invoice</th>
                            <th>QB Project</th>
                            <th>QB Invoice</th>
                            <th>Waybill #</th>
                            <th>Purchase Date</th>
                            <th>Total Amount</th>
                            <th>Workspace</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->vendor_name }}</td>
                            <td>{{ $value->invoice }}</td>
                            <td>{{ $value->qb_project }}</td>
                            <td>{{ $value->qb_invoice }}</td>
                            <td>{{ $value->waybill_no }}</td>
                            <td>{{ dateFormat($value->purchase_date,'report') }}</td>
                            <td>{{ $value->purchase_amount }}</td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>
                            <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                            <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            
                            @if(!empty($value->attachments))
                                    <div class="attachment">
                                        <a href="#" data-attachment data-id="<?php echo $rowdata->id; ?>">
                                            View Attachment
                                        </a>
                                    </div>
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