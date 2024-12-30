
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('trip-management.requested-by.create')
                  @else
                  @include('trip-management.requested-by.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>