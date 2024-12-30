// on ready function //
jQuery(document).ready(function() {
    jQuery(document).on("change", "[data-profile-image]", function (e){
        let ImageFile = e.target.files[0];
        let allowTypes = ['image/jpeg', 'image/jpg', 'image/png']; // Allowed Image types
        // Validation of Image Size... Max Image size is 2MB
        if(ImageFile.size > 2*1024*1024){
            Toast.warning('The file is too large. Maximum allowed file size is 2MB.')
            return false;
        }
        // Validation of Image Type... Allowed typese are JPG, PNG, GIF.
        if((allowTypes.indexOf(ImageFile.type) == -1)){
            Toast.warning('Invalid image format. Image format must be PNG, JPG, JPEG, or GIF.');
            return false;
        }
        // Insert Image for PlaceHolder...
        Util.fileUpload('[data-image-preview]', ImageFile);

        var data = new FormData();
        data.append('file', ImageFile);
        ajaxRequest.ajaxURL = baseURL + '/file/upload-photo';
        ajaxRequest.contentTypeJSON = false;
        ajaxRequest.formData = data;
        ajaxRequest.ajax();
    });
});
