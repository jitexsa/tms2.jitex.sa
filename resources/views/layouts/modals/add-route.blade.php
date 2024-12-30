<div id="route" class="modal fade bd-example-modal-lg route" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="title">Add Route</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form action="{{baseURL('ajax/add-route')}}" method="post" id="route-form" class="row g-3 needs-validation custom-input" novalidate="">
                <input type="hidden" name="place_id" id="place_id">
                <input type="hidden" name="location_type" id="location_type" value="1">
                <div class="col-6">
                        <label for="location" class="col-sm-5 col-form-label">Location <i class="text-danger">*</i></label>
                        <input name="location" required="" class="form-control" type="text"
                                   placeholder="Location" id="location">
                </div>
                <div class="col-6">
                        <label for="location_map" class="col-sm-5 col-form-label">Map Location</label>
                        <input name="location_map" class="form-control" type="text"
                                   placeholder="Map Location" id="location_map">
                </div>
                
                <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success" data-save>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>