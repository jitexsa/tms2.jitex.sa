
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('vehicle-management.vehicle.create')
                  @else
                  @include('vehicle-management.vehicle.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>