<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Trip Status List</h5>
                    <a href="{{ baseUrl('trip/status/add') }}"  class="btn btn-primary btn-md">
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
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>
                               <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                               @if($value->is_default == 2)
                               <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                               @endif
                               @if($value->is_disable == 0)
                               <button wire:click="disable({{$value->id}})" class="btn btn-danger btn-sm"  title="Disable"><i class="fa fa-ban"></i></button>
                            @else
                                <button wire:click="enable({{$value->id}})" class="btn btn-warning btn-sm"  title="Enable"><i class="fa fa-check"></i></button>
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