
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('employee-management.driver.create')
                  @else
                  @include('employee-management.driver.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>