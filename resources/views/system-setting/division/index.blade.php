
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('system-setting.division.create')
                  @else
                  @include('system-setting.division.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>