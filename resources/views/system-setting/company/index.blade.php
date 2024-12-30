
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('system-setting.company.create')
                  @else
                  @include('system-setting.company.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>