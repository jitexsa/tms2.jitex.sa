<div id="add-request" class="modal fade bd-example-modal-md" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="title">Add Trip Requested By</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form action="{{baseURL('ajax/add-request')}}" method="post" id="request-by-form" class="row g-3 needs-validation custom-input">
                <div class="col-12">
                       <label for="requested_name">Name <i class="text-danger">*</i></label>
                      <input name="name" class="form-control" type="text" placeholder="" id="requested_name" value="" required>
                    </div>
                    <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success">Add</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</div>