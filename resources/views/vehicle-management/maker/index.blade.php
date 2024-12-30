
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('vehicle-management.maker.create')
                  @else
                  @include('vehicle-management.maker.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>