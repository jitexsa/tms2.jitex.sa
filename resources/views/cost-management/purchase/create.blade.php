<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Purchase</h5>
                    <a href="{{ baseUrl('cost/purchase') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">
                  <div class="col-12 mb-3">
                            <x-input-label :value="__('Vendor Name')" />
                            <select class="form-control" required wire:model="vendor_id" id="vendor_id">
                                        @php
                                        $get_vendor = getVendor();
                                        @endphp
                                        @foreach ($get_vendor as $v)
                                            <option value="{{ $v->id }}">
                                            {{ $v->vendor_name }}
                                            </option>
                                      @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vendor_id')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-3">
                            <x-input-label for="invoice" :value="__('Vendor Bill #')" />
                            <x-text-input wire:model="invoice" class="form-control" type="text" id="invoice"  required/>
                    </div>
                    <div class="col-12 mb-3">
                        <x-input-label for="qb_project" :value="__('QB Project #')" />
                        <x-text-input wire:model="qb_project" class="form-control" type="text" id="qb_project" />
                    </div>
                    <div class="col-12 mb-3">
                        <x-input-label :value="__('QB Invoice #')" />
                        <x-text-input wire:model="qb_invoice" class="form-control" type="text" id="qb_invoice" />
                    </div>
                    <div class="col-12 mb-3">
                        <x-input-label :value="__('Purchase Date')" />
                        <x-text-input wire:model="purchase_date" data-datepicker required class="form-control" type="text" id="purchase_date" />
                    </div>
                    <div class="col-12">
                        <x-input-label :value="__('Attachments')" />
                        <x-text-input wire:model="attachments[]" type="file" class="form-control" id="attachments" multiple />
                    </div>
                  </div>
                  <div class="col-6">
                  <div class="col-12">
                        <x-input-label :value="__('Waybill')" />
                        <select class="form-control" required wire:model="trip_id" id="trip_id" onchange="purchase.tripDetail()">
                                <option value="" selected="selected">Select Waybill</option>
                                @php
                                $trip_list = getTrip();
                                @endphp
                                @foreach ($trip_list as $val)
                                    @php
                                    unset($val->trip_detail);
                                    unset($val->sign_json);
                                    @endphp
                                    <option value="{{ $val->id }}"  data-trip='{{ json_encode($val) }}'>
                                      {{ $val->waybill_no }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('trip_id')" class="mt-2" />
                    </div>
                    <div data-trip-detail>
                        @if(isset($trip) and !empty($trip))
                        <div class="row">
                            <div class="col-6">
                                  <x-input-label :value="__('Job No')" />
                                  <div class="col-sm-7 text-right">{{ $trip->job_no }}</div>
                            </div>
                            <div class="col-6">
                                   <x-input-label :value="__('Waybill #')" />
                                   <div class="col-sm-7 text-right">{{ $trip->waybill_no }}</div>
                            </div>
                            <div class="col-6">
                                    <x-input-label :value="__('Trip Date')" />
                                    <div class="col-sm-7 text-right">{{ $trip->trip_date }}</div>
                            </div>
                            <div class="col-6">
                                    <x-input-label :value="__('Plate No')" />
                                    <div class="col-sm-7 text-right">{{ $trip->licence_plate_no }}</div>
                            </div>
                            <div class="col-6">
                                    <x-input-label :value="__('Driver')" />
                                    <div class="col-sm-7 text-right">{{ $trip->driver_name }}</div>
                            </div>
                            <div class="col-6">
                                    <x-input-label :value="__('Vehicle Type')" />
                                    <div class="col-sm-7 text-right">{{ $trip->type_name }}</div>
                            </div>
                             @if($trip->wessel)
                             <div class="col-6">
                                    <x-input-label :value="__('Wessel')" />
                                    <div class="col-sm-7 text-right">{{ $trip->wessel }}</div>
                            </div>
                            @endif                        
                            @if($trip->voyage)
                            <div class="col-6">
                                    <x-input-label :value="__('Voyage')" />
                                    <div class="col-sm-7 text-right">{{ $trip->voyage }}</div>
                            </div>
                            @endif 
                            @if($trip->awb)
                            <div class="col-6">
                                    <x-input-label :value="__('B/L AWB')" />
                                    <div class="col-sm-7 text-right">{{ $trip->awb }}</div>
                            </div>
                            @endif 
                        </div>
                        @endif 
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="20%">Category Name</th>
                                <th class="text-center" width="20%">Item Name</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Total Amount</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <tr class="delete">
                                        <td class="span3 supplier">
                                            <select class="form-control" wire:model="category_id" id="category_id_1"
                                                    required onchange="purchase.getItem(1);">
                                                <option value="" selected="selected">Category</option>
                                                @php
                                                $get_category = getCategory();
                                                @endphp
                                                @foreach ($get_category as $v)
                                                    <option value="{{ $v->id }}">
                                                    {{ $v->name }}
                                                    </option>
                                              @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                        </td>

                                        <td class="wt position-relative" >
                                            <select class="form-control" wire:model="item" id="item_id_1"
                                                    required onchange="purchase.getPrice(1);">
                                                <option value="" selected="selected">Item</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('item')" class="mt-2" />
                                        </td>

                                        <td class="text-right">
                                            <input type="number" required wire:model="quantity" id="qty_1"
                                                   class="form-control text-right" onkeyup="purchase.calculateStore(1);"
                                                   onchange="purchase.calculateStore(1);" placeholder="0.00" value="" tabindex="6" step="any">
                                                   <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                                </td>
                                        <td class="text-right">
                                            <input type="number" required wire:model="rate" onkeyup="purchase.calculateStore(1);"
                                                   onchange="purchase.calculateStore(1);" id="rate_1"
                                                   class="form-control text-right" placeholder="0.00"
                                                   value="" tabindex="7" step="any">
                                                   <x-input-error :messages="$errors->get('rate')" class="mt-2" />
                                        </td>
                                        <td class="test">
                                            <input class="form-control total_price text-right" type="text" wire:model="total_price"
                                                   id="total_price_1" value="" readonly="readonly">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger red text-right" type="button"
                                                    value="Delete" data-delete-row tabindex="8">Delete</button>
                                        </td>
                                    </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <input type="button" id="add_invoice_item" class="btn btn-success"
                                        name="add-invoice-item" data-row
                                        value="Add More item" tabindex="9">
                                </td>
                                <td class="text-right"><b>Grand Total</b></td>
                                <td class="text-right">
                                    <input type="text" id="grandTotal" class="text-right form-control"
                                        name="grand_total_price" value="" readonly="readonly">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                      <div class="col-12 text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            <!-- Container-fluid Ends-->
          </div>
          {{setJs(['purchase/index'])}}
          <script>
        let n = 1;
        $(document).on('click', '[data-row]', function (e){
        e.preventDefault();
        n++;
        let row = `<tr  class="delete" id="row_${n}">
                                <td class="span3 supplier">
                                    <select class="form-control basic-single"  wire:model="category_id" id="category_id_${n}"
                                            required onchange="purchase.getItem(${n});">
                                        <option value="" selected="selected">Category</option>
                                        <?php
                                             foreach ($category_list as $r) {?>
                                            <option value="<?php echo $r->id; ?>">
                                                <?php echo $r->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>

                                <td class="wt position-relative" >
                                    <select class="form-control basic-single"  wire:model="item" id="item_id_${n}"
                                            required onchange="purchase.getPrice(${n});">
                                        <option value="" selected="selected">Item</option>
                                    </select>
                                </td>

                                <td class="text-right">
                                    <input type="number" required  wire:model="quantity" id="qty_${n}"
                                        class="form-control text-right" onkeyup="purchase.calculateStore(${n});"
                                        onchange="purchase.calculateStore(${n});" placeholder="0.00" value="" tabindex="6" step="any">
                                </td>
                                <td class="text-right">
                                    <input type="number" required  wire:model="rate" onkeyup="purchase.calculateStore(${n});"
                                        onchange="purchase.calculateStore(${n});" id="rate_${n}"
                                        class="form-control text-right" placeholder="0.00"
                                        value="" tabindex="7" step="any">
                                </td>
                                <td class="test">
                                    <input class="form-control total_price text-right" type="text"  wire:model="total_price"
                                        id="total_price_${n}" value="0.00" readonly="readonly">
                                </td>
                                <td>
                                    <button class="btn btn-danger red text-right" type="button"
                                        value="Delete" data-delete-row tabindex="8">Delete</button>
                                </td>
                            </tr>`;
        $(".table tbody").append(row);
        });
        $(document).on('click', '[data-delete-row]', function (e){
            e.preventDefault();
            $(this).parents('tr.delete').remove();
            calculateStore(1);
        });
</script>