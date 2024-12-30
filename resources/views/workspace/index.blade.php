
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('workspace.create')
                  @else
                  @include('workspace.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>