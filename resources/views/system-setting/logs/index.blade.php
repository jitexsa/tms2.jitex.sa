<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>System Logs</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table dataTable class="dt-responsive">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Type</th>
                                <th>Action</th>
                                <th>Log</th>
                                <th>Workspace</th>
                            </tr>
                        </thead>
                        <tbody> 
                        @if(!empty($rec))
						   @foreach($rec as $key => $val)
                           @php
                                $log_content = json_decode($val->log_content);
                           @endphp
                           @if(isset($log_content->created_by))
                               @php
                                $user = getValue('users', 'id = '.$log_content->created_by);
                                $log_content->created_by = $user->firstname . ' ' . $user->lastname;
                               @endphp
                           @endif
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ logType($val->log_type) }}</td>
                                <td>{{ ucwords($val->action) }}</td>
                                <td><code>{{ json_encode($log_content) }}</code></td>
                                <td>{{ $val->workspace_name }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>