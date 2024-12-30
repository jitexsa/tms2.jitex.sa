
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('employee-management.position.create')
                  @else
                  @include('employee-management.position.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>