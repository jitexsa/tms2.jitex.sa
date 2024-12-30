
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('vendor-management.type.create')
                  @else
                  @include('vendor-management.type.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>