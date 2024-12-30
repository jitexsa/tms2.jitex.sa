<div id="add-shipping" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Add Shipping</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form action="{{baseURL('ajax/add-shipping')}}" method="post" data-shipping-form class="row g-3 needs-validation custom-input">
                <input type="hidden" name="transport" value="landtransport">
                <input type="hidden" name="shipment_type" value="FTL">
                    <div class="col-12">
                        <label class="col-form-label">Direction <i class="text-danger">*</i> &nbsp;</label>
                        <input name="direction" value="import" type="radio" id="import" required>
                        <label for="import" class="pr-2"> Import </label>
                        <input name="direction" value="export" type="radio" id="export" required>
                        <label for="export" class="pr-2"> Export </label>
                        <input name="direction" value="cts" type="radio" id="cts" required>
                        <label for="cts" class="pr-2"> CTS </label>
                        <input name="direction" value="domestic" type="radio" id="domestic" required>
                        <label for="domestic" class="pr-2"> Domestic </label>
                    </div>
                    <div class="col-12">
                        <label for="clientid" class="col-form-label">Customer <i class="text-danger">*</i></label>
                        <select class="form-control" name="clientid" id="clientid" data-select data-load-saleman required>
                            <option value="" selected="selected">Customer</option>
                            @php
                            $customer = getCustomerFromFreight();
                            @endphp
                            @foreach ($customer as $r)
                                <option value="{{ $r->userid }}">{{ $r->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="saleman" class="col-sm-2 col-form-label">Saleman</label>
                        <select class="form-control" name="assigned" id="saleman" data-select>
                            <option value="" selected="selected">Select Saleman</option>
                        </select>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
</div>
</div>