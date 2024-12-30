
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('cost-management.item.create')
                  @else
                  @include('cost-management.item.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>