
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('trip-management.additional-requirements.create')
                  @else
                  @include('trip-management.additional-requirements.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>