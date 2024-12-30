<!-- footer start-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">{{date('Y')}} Copyright© <strong>JIT-Ex Transport Management System</strong>  </p>
            </div>
        </div>
    </div>
</footer>
{{ setJs(['bootstrap/bootstrap.bundle.min', 'icons/feather-icon/feather.min',
'icons/feather-icon/feather-icon', 'scrollbar/simplebar.min',  'select2/select2.min', 'config',
'sidebar-menu', 'slick/slick.min', 'slick/slick', 'header-slick', 'chart/apex-chart/apex-chart',
'chart/apex-chart/stock-prices', 'notify/bootstrap-notify.min',
'datatable/dataTables.min', 'datatable/dataTables.bootstrap4.min', 'datatable/dataTables.responsive.min',
'typeahead/handlebars', 'typeahead/typeahead.bundle',
 'typeahead/typeahead.custom', 'typeahead-search/handlebars', 'typeahead-search/typeahead-custom',
 'daterangepicker/moment.min', 'daterangepicker/daterangepicker',
 'flat-pickr/flatpickr', 'ulit', 'file-uploader', 'script']) }}
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{getenv('GOOGLE_API')}}&libraries=places&callback=initialize" defer></script>
<script>
 function initialize() {
                  let from = document.getElementById('location_map');
                  if(from){
                  let from_location = new google.maps.places.Autocomplete(from);
                  google.maps.event.addListener(from_location, 'place_changed', function () {
                      let place = from_location.getPlace();
                      $("#place_id").val(place.place_id)
                      Livewire.all()[4].$wire.$set('location_map', place['formatted_address'], false)
                  });
                }
              }
            document.addEventListener('livewire:init', () => {
                    Livewire.hook('request', ({ uri, options, payload, respond, succeed, fail }) => {
                    // Runs after commit payloads are compiled, but before a network request is sent...
                        respond(({ status, response }) => {
                            // Runs when the response is received...
                            // "response" is the raw HTTP response object
                            // before await response.text() is run...
                        })
                
                        succeed(({ status, json }) => {
                            // Runs when the response is received...
                            // "json" is the JSON response object...
                            setTimeout(function (){
                                if($("[data-select]").length) {
                                    $("[data-select]").select2();
                                }
                                if($("[data-datepicker]").length) {
                                    flatpickr("[data-datepicker]", {
                                        dateFormat: "d-m-Y",
                                    });
                                }
                                initialize()
                                $('#vehicle').find('option:selected').change();
                            }, 1000)
                        })
                
                        fail(({ status, content, preventDefault }) => {
                            // Runs when the response has an error status code...
                            // "preventDefault" allows you to disable Livewire's
                            // default error handling...
                            // "content" is the raw response content...
                            console.log(status)
                        })
                    })
                })
                window.addEventListener("load", (event) => {
                    google.maps.event.addDomListener(window, 'load', initialize);
                });
    </script>