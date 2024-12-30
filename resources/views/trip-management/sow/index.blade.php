
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('trip-management.sow.create')
                  @else
                  @include('trip-management.sow.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>