<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Location</h5>
                    <a href="{{ baseUrl('employee/location') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-12">
                        <x-input-label for="location_name" :value="__('Location Name')" />
                        <x-text-input wire:model="location_name" id="location_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
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
          
          <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{getenv('GOOGLE_API')}}&libraries=places&callback=initialize"></script>
                <script>
                function initialize() {
                    let from = document.getElementById('location_name');
                    let autocomplete = new google.maps.places.Autocomplete(from);
                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                            let place = autocomplete.getPlace();
                            Livewire.all()[0].$wire.$set('location_name', place['formatted_address'], false)
                  });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>