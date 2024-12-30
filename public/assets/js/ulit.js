var Util = {
    copyLink: function (){
        var $temp = jQuery("<INPUT>");
        jQuery("body").append($temp);
        $temp.val(jQuery.trim(jQuery("[data-copy-link]").attr("data-link"))).focus().select();
        document.execCommand("copy");
        $temp.remove();
        Toast.success('Link Copied.');
    },
    inputNumberAllow: function (){
        jQuery('[data-number]').on('keydown keyup', function(e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            if (!(key == 8 ||//Backspace
                key == 9 ||//Tab
                key == 37 ||//Setas
                key == 38 ||//Setas
                key == 39 ||//Setas
                key == 40 || //Setas
                key == 46 || // delete
                key == 190 || //comma
                key == 65 || key == 67 || key == 86 || key == 88 || //ctrl+a,x,c,v
                key == 13 || // enter
                key >= 48 && key <= 57 || key >= 96 && key <= 105)) { // keyboard right side number pad
                e.preventDefault();
                return false;
            }
            var text = $(this).val();
            $(this).val(text.replace(/[^0-9.]/g,''));
        });
    },
    fileUpload: function (selector, file){
        var fr = new FileReader();
        fr.readAsDataURL(file);
        fr.addEventListener('load', function (e) {
            jQuery(selector).attr("src", fr.result);
        });
    },
}
