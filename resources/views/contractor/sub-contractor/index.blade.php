
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('contractor.sub-contractor.create')
                  @else
                  @include('contractor.sub-contractor.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>