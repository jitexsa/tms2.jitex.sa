<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Route List</h5>
                    <a href="{{ baseUrl('vehicle/route/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Location</th>
                            <th>Map Location</th>
                            <th>Workspace</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> 
                          @if(!empty($rec))
                          @foreach ($rec as $key =>  $value)
                          @php
                          $loading = getValue('trips', 'trips.loading_at = ' . $value->id . ' OR trips.delivery_at  = ' . $value->id );
                          @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->location }}</td>
                            <td><a href="{{ $value->location_map }}" target="_blank">View Map</a></td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>
                               <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                               @if($loading)
                               <a href="#" data-confirmation data-content="You cannot delete the selected Route because the are linked <br /> to these waybills." data-id="{{$value->id}}" data-type="route" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';
                               @else
                               <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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