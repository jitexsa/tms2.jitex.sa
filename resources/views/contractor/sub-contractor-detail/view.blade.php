<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5> Contractor Details</h5>
                    <a href="{{ baseUrl('subcontractor/detail/add/'.$contractor_id) }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                         <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Fleet Type</th>
                            <th># of Vehicles</th>
                            <th>Location</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         @if(isset($rec) and !empty($rec))
                            @foreach($rec as $key => $val)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $val->type_name }}</td>
                                    <td>{{ $val->no_of_vehicles }}</td>
                                    <td>{{ $val->location }}</td>
                                    <td>{{ $val->remarks }}</td>
                                    <td>
                                    <button wire:click="edit({{$val->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                    <button wire:click="delete({{$val->id}}, {{$val->contractor_id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                  </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>