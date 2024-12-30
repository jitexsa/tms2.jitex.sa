<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Fuel Type</h5>
                    <a href="{{ baseUrl('fuel/fuel-type/add') }}"  class="btn btn-primary btn-md">
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
                            <th>Workspace</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->type_name }}</td>
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