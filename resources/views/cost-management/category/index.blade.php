
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('cost-management.category.create')
                  @else
                  @include('cost-management.category.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>