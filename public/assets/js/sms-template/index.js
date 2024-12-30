"use strict";
$(document).ready(function () {
    $(document).on('change', '[data-shortcode]',function (e){
        let cursorPos = $('#description').prop('selectionStart');
        let v = $('#description').val();
        let textBefore = v.substring(0,  cursorPos );
        let textAfter  = v.substring( cursorPos, v.length );
        $('#description').val( textBefore + $(this).val() + textAfter );
        Livewire.all()[0].$wire.$set('description',  $('#description').val(), false)

    });
});