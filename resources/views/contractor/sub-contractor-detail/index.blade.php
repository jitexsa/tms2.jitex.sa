
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('contractor.sub-contractor-detail.create')
                  @else
                  @include('contractor.sub-contractor-detail.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>