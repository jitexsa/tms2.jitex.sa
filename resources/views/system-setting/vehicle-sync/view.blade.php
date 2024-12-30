<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Sync</h5>
                    <a href="#"  class="btn btn-primary btn-md">
                                Sync 
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                            <th>Sr No</th>
                                <th>GPS Vehicle ID</th>
                                <th>License Plate No</th>
                                <th>Vehicle Display Name</th>
                                <th>Driver</th>
                                <th>Workspace</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($rec))
                            @foreach ($rec as $key => $val)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $val->gps_vehicle_id  }}</td>
                                <td>{{ $val->licence_plate_no  }}</td>
                                <td>{{ $val->display_name  }}</td>
                                <td>{{ $val->driver_name  }}</td>
                                <td>{{ $val->workspace_name  }}</td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>