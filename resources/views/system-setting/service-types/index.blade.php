
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('system-setting.service-types.create')
                  @else
                  @include('system-setting.service-types.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>