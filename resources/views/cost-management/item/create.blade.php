<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Item Registration</h5>
                    <a href="{{ baseUrl('cost/item') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-12">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select  class="form-control" wire:model="category_id" id="category_id" required>
                                <option value="" selected="selected">Select Category</option>
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
                      </div>   
                    <div class="col-12">
                        <x-input-label for="item_name" :value="__('Item Name')" />
                        <x-text-input wire:model="item_name" id="item_name" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <x-input-label for="item_price" :value="__('Item Price')" />
                        <x-text-input wire:model="item_price" id="item_price" class="form-control" type="text" />
                        <x-input-error :messages="$errors->get('item_price')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{($id)?'Update':'Save'}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>