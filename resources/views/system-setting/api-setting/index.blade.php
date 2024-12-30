<div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>API Documentation</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive custom-scrollbar table-striped">
                    <div class="card-body api-setting">
                        <div>
                        <h5>Introduction</h5>
                        <p>
                            The business purpose that this API carries out. The organization can get waybill data for other platforms from the TMS.
                        </p>
                        </div>
                        <div class="item">
                            <details>
                                <summary>Basic API Information</summary>
                                <div class="api-info"><div class="host">API Base URL <code>{{baseURL()}}/api/waybill</code></div><div class="readonly">This is a read-only API</div></div>
                            </details>
                        </div>
                        <div class="item">
                            <details>
                                <summary>API Authentication</summary>
                            <div class="desc">
                                <p>
                                    API authentication is the process of verifying the identity of the user or application making the request, while API authorization is the process of verifying that the authenticated user or application has permission to access the requested resources.
                                </p>
                            </div>
                            <h6>API Request</h6>
                            <div class="desc">
                                <p>
                                    API will work with <code>POST</code> method.
                                </p>
                                <h5>Required Parameters</h5>
                                <ul>
                                    <li>
                                        Headers of the request/response<br />
                                        Specify the authorization process.
                                    </li>
                                    <li>
                                        Example:<br />
                                        Content-Type: application/json<br />
                                        Authorization: Bearer <6c3624c5-e736-4ead-988a-a94d58c62b09> Required
                                    </li>
                                    <li>
                                        Date should be in the mentioned format.<br />
                                        form : (d-m-Y)<br />
                                        to: (d-m-Y)
                                    </li>
                                </ul>
                                <h5>Request Body</h5>
                                <div class="request">
                                    <code>
                                      {{nl2br( "{
                            'workspace': 'JIT-Ex',
                            'from': '01-04-2024',
                            'to': '30-04-2024',
                            'waybill': '217397')
                            }");
                                    }}
                                    </code>
                                </div>
                                <h5>Response</h5>
                                <div class="request">
                                    <code>
                                       {{ nl2br( '{
                                        “record”: array(),
                                        "count": 0
                                        }
                                    ');
                                    }}
                                    </code>
                                </div>
                            </div>
                            </details>
                        </div>
                        <div class="item">
                            <details>
                                <summary>Postman Request Sample Code</summary>
                                <code>
                                    <div class="request">
                                {{ nl2br( '$curl = curl_init();

                                    curl_setopt_array($curl, array(
                                    CURLOPT_URL => "'.baseURL().'",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "POST",
                                    CURLOPT_POSTFIELDS => array("workspace" => "JIT-Ex","from" => "01-04-2024","to" => "30-04-2024","waybill" => "217397"),
                                    CURLOPT_HTTPHEADER => array(
                                    "Authorization: Bearer 6c3624c5-e736-4ead-988a-a94d58c62b09",
                                    ),
                                    ));
                                    $response = curl_exec($curl);
                                    curl_close($curl);
                                    echo $response;
                                    ');
                                }}
                                    </div>
                                </code>
                            </details>
                        </div>
                        <div class="item">
                            <details>
                                <summary>Response Codes</summary>
                                <div class="table-responsive custom-scrollbar table-striped">
                                <table  style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        Response code
                                    </th>
                                    <th>
                                        Message
                                    </th>
                                    <th>
                                        Meaning
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>200 - OK</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>400 - Bad Request</td>
                                    <td>Mismatched argument!</td>
                                    <td>Example will send this if any details are missing or there is a mismatch with our records.</td>
                                </tr>
                                <tr>
                                    <td>401 - Authentication error</td>
                                    <td>Authentication error</td>
                                    <td>E.g. missing or invalid token.</td>
                                </tr>
                                <tr>
                                    <td>403 - Forbidden</td>
                                    <td>Method error</td>
                                    <td>E.g.  Supported methods: POST.</td>
                                </tr>
                                <tr>
                                    <td>404 - Not Found</td>
                                    <td></td>
                                    <td>Record not found.</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            </details>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>