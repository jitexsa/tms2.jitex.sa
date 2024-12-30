<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Customer List</h5>
                    <a href="{{ baseUrl('customer/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Customer Name</th>
                            <th>CR Number</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Workspace</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Company</th>
                            <th>Division</th>
                            <th>SMS</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($rec))
                          @foreach ($rec as $key =>  $customer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->cr_number }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->workspace_name }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->country_name }}</td>
                            <td>{{ $customer->company_name }}</td>
                            <td>{{ $customer->division_name }}</td>
                            <td>{{ listingStatus($customer->is_sms) }}</td>
                            <td>{{ ($customer->is_active == 1)?'Active':'Deactivate' }}</td>
                            <td>
                               <button wire:click="edit({{$customer->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                               <button wire:click="delete({{$customer->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                         @endforeach
                         @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>