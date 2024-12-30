<div id="add_driver" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="title">Add Driver</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form action="{{baseURL('ajax/add-driver')}}" method="post" id="driver-form" class="row g-3 needs-validation custom-input">
                <div class="col-6">   
                     <div class="col-12">
                        <label for="driver_name"  class="col-sm-5 col-form-label">Driver Name <i class="text-danger">*</i></label>
                            <input name="driver_name" required="" class="form-control" type="text"
                                   placeholder="Driver Name" id="driver_name">
                    </div>
                     <div class="col-12">
                        <label for="license_number"
                               class="col-sm-5 col-form-label">License Number <i class="text-danger">*</i> </label>
                            <input name="license_number" required class="form-control" type="text"
                                   placeholder="License Number" id="license_number">
                    </div>
                     <div class="col-12">
                        <label for="picture" class="col-sm-5 col-form-label">Photograph </label>
                            <input type="file" accept="image/*" name="picture" class="form-control">
                    </div>
                     <div class="col-12">
                        <label for="picture" class="col-sm-5 col-form-label">License Image </label>
                            <input type="file" accept="image/*" name="license_image" class="form-control">
                    </div>
                </div>
                <div class="col-6">   
                     <div class="col-12">
                        <label for="mobile" class="col-sm-5 col-form-label">Mobile <i class="text-danger">*</i></label>
                            <input name="mobile" required="" class="form-control" type="number"
                                   placeholder="Mobile" id="mobile">
                    </div>
                     <div class="col-12">
                        <label for="company" class="col-sm-5 col-form-label">Company <i class="text-danger">*</i> </label>
                            <select class="form-control" name="company" id="company" required>
                                <option value="" selected="selected">Company</option>
                                @php
                                $get_company = getCompany();
                                @endphp
                                @foreach ($get_company as $r)
                                    <option value="{{ $r->id }}">
                                        {{ $r->company_name }}</option>
                               @endforeach
                            </select>
                    </div>
                     <div class="col-12">
                        <label for="division" class="col-sm-5 col-form-label">Division <i class="text-danger">*</i> </label>
                            <select class="form-control" name="division" id="division" required>
                                <option value="" selected="selected">Division</option>
                                @php
                                $get_division = getDivision();
                                @endphp
                                @foreach ($get_division as $r)
                                    <option value="{{ $r->id }}">
                                        {{ $r->division_name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-12 text-right mt-2">
                    <label class="col-form-label"></label>
                        <button type="submit" class="btn btn-success w-md m-b-5">Add</button>
                    </div>
                </div>
                 </form>
            </div>
        </div>
    </div>
</div>