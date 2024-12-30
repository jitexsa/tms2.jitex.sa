
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
              <div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Email Setting</h5>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-12">
                        <x-input-label for="smtp_host" :value="__('SMTP Host')" />
                        <x-text-input wire:model="smtp_host" id="smtp_host" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('smtp_host')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <x-input-label for="smtp_port" :value="__('SMTP Port')" />
                        <x-text-input wire:model="smtp_port" id="smtp_port" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('smtp_port')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <x-input-label for="document_name" :value="__('SMTP Password')" />
                        <x-text-input wire:model="smtp_password" id="smtp_password" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('smtp_password')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <x-input-label for="protocol" :value="__('Protocol')" />
                        <x-text-input wire:model="protocol" id="protocol" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('protocol')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <x-input-label for="sender" :value="__('Sender')" />
                        <x-text-input wire:model="sender" id="sender" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('sender')" class="mt-2" />
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
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>