
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('employee-management.location.create')
                  @else
                  @include('employee-management.location.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>