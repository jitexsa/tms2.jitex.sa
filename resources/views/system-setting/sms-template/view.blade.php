<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>SMS Template</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <table class="table" data-sms-template>
                    <thead>
                    <th>
                        Sr No
                    </th>
                    <th>
                        Template
                    </th>
                    <th>
                        Content
                    </th>
                    <th>
                        Action
                    </th>
                    </thead>
                    <tbody>
                      @if (!empty($rec))
                      @foreach ($rec as $key =>  $val)
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>
                                    {{TplList($val->template_id)}}
                                </td>
                                <td>
                                    {!! nl2br($val->description) !!}
                                </td>
                                <td>
                                <button wire:click="edit({{$val->id}})" class="btn btn-info btn-sm"><i class="fa-solid fa-pencil"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
                    </div>
                  </div>
                </div>