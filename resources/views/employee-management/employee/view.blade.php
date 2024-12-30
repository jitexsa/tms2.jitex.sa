<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Employee List</h5>
                    <a href="{{ baseUrl('employee/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>NID</th>
                                <th>Join Date</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Mobile</th>
                                <th>Location Name</th>
                                <th>Workspace</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><div class="short-text" title="{{ $value->emp_name }}">{{ $value->emp_name }}</div></td>
                            <td>{{ $value->emp_nid }}</td>
                            <td>{{ ($value->join_date)?dateFormat($value->join_date, 'shortdate'):'' }}</td>
                            <td><div class="short-text" title="{{ $value->department }}">{{ $value->department }}</div></td>
                            <td><div class="short-text" title="{{ $value->designation }}">{{ $value->designation }}</div></td>
                            <td>{{ $value->emp_phone }}</td>
                            <td><div class="short-text" title="{{ $value->location_name }}">{{ $value->location_name }}</div></td>
                            <td><div class="short-text" title="{{ $value->workspace_name }}">{{ $value->workspace_name }}</div></td>
                            <td>{{ listingStatus($value->isactive) }}</td>
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