
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('trip-management.trip.create')
                  @else
                  @include('trip-management.trip.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>