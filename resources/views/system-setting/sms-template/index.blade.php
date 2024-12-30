
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('system-setting.sms-template.create')
                  @else
                  @include('system-setting.sms-template.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
          {{ setJs(['sms-template/index']) }}