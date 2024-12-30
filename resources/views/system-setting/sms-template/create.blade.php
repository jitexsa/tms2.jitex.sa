<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>SMS Template</h5>
                    <a href="{{ baseUrl('setting/sms-template') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      
                  <div class="col-12">
                        <x-input-label for="sms_template" :value="__('SMS Template Shortcode')" />
                        <select class="form-control" data-shortcode id="sms_template">
                            <option value="">Select Shortcode</option>
                                @if(smsShortcode()){
                                @foreach(smsShortcode() as $key => $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                @endforeach
                                @endif
                        </select>                       
                      </div>
                  <div class="col-12">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea wire:model="description" class="form-control textarea" id="description" type="text" required /></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
