
<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                @if($create)
                  @include('fuel.type.create')
                  @else
                  @include('fuel.type.view')
                @endif
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>