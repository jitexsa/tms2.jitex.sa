
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('customer.create')
                  @else
                  @include('customer.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>