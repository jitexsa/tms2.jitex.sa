<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Inspection List</h5>
                    <a href="{{ baseUrl('vehicle/inspection/add') }}"  class="btn btn-primary btn-md">
                                Add 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                        <tr>
                                <th>SL</th>
                                <th>Inspection Date</th>
                                <th>Vehicle</th>
                                <th>Registration #</th>
                                <th>Driver</th>
                                <th>ODO Reading</th>
                                <th>Workspace</th>
                                <th>Inspected By</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($rec))
                          @foreach ($rec as $key =>  $value)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ dateFormat($value->inspection_date, 'shortdate') }}</td>
                            <td>{{ $value->licence_plate_no }}</td>
                            <td>{{ $value->vehicleRegistration }}</td>
                            <td>{{ $value->driver_name }}</td>
                            <td>{{ $value->kms_in }}</td>
                            <td>{{ $value->workspace_name }}</td>
                            <td>{{ $value->inspected }}</td>
                            <td>{{ $value->firstname.' '.$value->lastname }}</td>
                            <td> 
                             <button wire:click="edit({{$value->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                             <button wire:click="delete({{$value->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                             <a href="javascript:void(0)" data-vehicle-inspection-view data-id="{{ $value->id }}" class="btn btn-primary btn-sm">View</a>
                             <a href="{{ baseURL('vehicle/inspection/pdf/'.$value->id) }}" class="btn btn-warning btn-sm" title="PDF Download">PDF</a>
                            </td>
                        </tr>
                        @endforeach
                         @endif
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <div id="vehicle_inspection_view" class="modal fade bd-example-modal-lg" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <strong class="title">Vehicle Inspection Detail</strong>
                                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close">>&times;</button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>
                <script>
                  $(document).on('click', '[data-vehicle-inspection-view]', function (e){
                        $.ajax({
                            type: "POST",
                            url: baseURL+'/ajax/inspection-detail',
                            data: 'id='+$(this).attr('data-id'),
                            data: JSON.stringify({id: $(this).attr('data-id')}),
                            dataType: "json",
                            contentType: 'application/json;charset=UTF-8',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (result) {
                                $("#vehicle_inspection_view .modal-body").html(result.html);
                                $("#vehicle_inspection_view").modal('show');
                            },
                            error: function (result){

                            }
                        });

                    });
                  </script>