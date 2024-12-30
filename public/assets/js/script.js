/*! -----------------------------------------------------------------------------------

    Template Name: Cuba Admin
    Template URI: http://admin.pixelstrap.com/cuba/theme
    Description: This is Admin theme
    Author: Pixelstrap
    Author URI: https://themeforest.net/user/pixelstrap

-----------------------------------------------------------------------------------

        01. password show hide
        02. Background Image js
        03. sidebar filter
        04. Language js
        05. Translate js

 --------------------------------------------------------------------------------- */

(function ($) {
  "use strict";
  $(document).on("click", function (e) {
    var outside_space = $(".outside");
    if (!outside_space.is(e.target) && outside_space.has(e.target).length === 0) {
      $(".menu-to-be-close").removeClass("d-block");
      $(".menu-to-be-close").css("display", "none");
    }
  });

  // $(".prooduct-details-box .close").on("click", function (e) {
  //   var tets = $(this).parent().parent().parent().parent().addClass("d-none");
  //   console.log(tets);
  // });

  if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
    $(".sidebar-list").hover(
      function () {
        $(this).addClass("hoverd");
      },
      function () {
        $(this).removeClass("hoverd");
      }
    );
    $(window).on("scroll", function () {
      if ($(this).scrollTop() < 600) {
        $(".sidebar-list").removeClass("hoverd");
      }
    });
  }

  /*=====================
      02. Background Image js
      ==========================*/
  $(".bg-center").parent().addClass("b-center");
  $(".bg-img-cover").parent().addClass("bg-size");
  $(".bg-img-cover").each(function () {
    var el = $(this),
      src = el.attr("src"),
      parent = el.parent();
    parent.css({
      "background-image": "url(" + src + ")",
      "background-size": "cover",
      "background-position": "center",
      display: "block",
    });
    el.hide();
  });

  $(".mega-menu-container").css("display", "none");
  $(".header-search").click(function () {
    $(".search-full").addClass("open");
  });
  $(".close-search").click(function () {
    $(".search-full").removeClass("open");
    $("body").removeClass("offcanvas");
  });
  $(".mobile-toggle").click(function () {
    $(".nav-menus").toggleClass("open");
  });
  $(".mobile-toggle-left").click(function () {
    $(".left-header").toggleClass("open");
  });
  $(".bookmark-search").click(function () {
    $(".form-control-search").toggleClass("open");
  });
  $(".filter-toggle").click(function () {
    $(".product-sidebar").toggleClass("open");
  });
  $(".toggle-data").click(function () {
    $(".product-wrapper").toggleClass("sidebaron");
  });
  $(".form-control-search input").keyup(function (e) {
    if (e.target.value) {
      $(".page-wrapper").addClass("offcanvas-bookmark");
    } else {
      $(".page-wrapper").removeClass("offcanvas-bookmark");
    }
  });
  $(".search-full input").keyup(function (e) {
    if (e.target.value) {
      $("body").addClass("offcanvas");
    } else {
      $("body").removeClass("offcanvas");
    }
  });
  $(".mode").on("click", function () {
    const bodyModeDark = $("body").hasClass("dark-only");

    if (!bodyModeDark) {
      $(".mode").addClass("active");
      localStorage.setItem("mode-cuba", "dark-only");
      $("body").addClass("dark-only");
      $("body").removeClass("light");
    }
    if (bodyModeDark) {
      $(".mode").removeClass("active");
      localStorage.setItem("mode-cuba", "light");
      $("body").removeClass("dark-only");
      $("body").addClass("light");
    }
  });
  $("body").addClass(localStorage.getItem("mode-cuba") ? localStorage.getItem("mode-cuba") : "light");
  $(".mode").addClass(localStorage.getItem("mode-cuba") === "dark-only" ? "active" : " ");

  // sidebar filter
  $(".md-sidebar .md-sidebar-toggle ").on("click", function (e) {
    $(".md-sidebar .md-sidebar-aside ").toggleClass("open");
  });

  $(".loader-wrapper").fadeOut("slow", function () {
    $(this).remove();
  });

  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 600) {
      $(".tap-top").fadeIn();
    } else {
      $(".tap-top").fadeOut();
    }
  });

  $(".tap-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      600
    );
    return false;
  });

  // active link

  $(".chat-menu-icons .toogle-bar").click(function () {
    $(".chat-menu").toggleClass("show");
  });
  $(".mobile-title svg").click(function () {
    $(".header-mega").toggleClass("d-block");
  });

  $(".onhover-dropdown").on("click", function () {
    $(this).children(".onhover-show-div").toggleClass("active");
  });

  $("#flip-btn").click(function () {
    $(".flip-card-inner").addClass("flipped");
  });

  $("#flip-back").click(function () {
    $(".flip-card-inner").removeClass("flipped");
  });
  if($("[dataTable]").length) {
     var dataTable = $("[dataTable]").DataTable();
  }
  if($("[data-select]").length) {
      $("[data-select]").select2()
      .on('change', function (e) {
        if(typeof jQuery(e.target).attr('wire:model') !== 'undefined'){
          Livewire.all()[4].$wire.$set(jQuery(e.target).attr('wire:model'), e.target.value, false)
        }
      });
  }

  if($("[data-datepicker]").length) {
   flatpickr("[data-datepicker]", {
        dateFormat: "d-m-Y"
    })
 }
 var myElement = document.getElementById("simple-bar");
 new SimpleBar(myElement, { autoHide: true });


 $(document).click(function (e) {
  $(".translate_wrapper, .more_lang").removeClass("active");
});
$(".translate_wrapper .current_lang").click(function (e) {
  e.stopPropagation();
  $(this).parent().toggleClass("active");

  setTimeout(function () {
    $(".more_lang").toggleClass("active");
  }, 5);
});


$(document).on('click', '[data-select-workspace]', function (){
  $.ajax({
      type: "POST",
      url: baseURL+'/ajax/change-workspace',
      data: 'workspace_id='+$(this).attr('data-value'),
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (result) {
          location.reload();
      },
      error: function (result){

      }
  });
});

$( document).on('keypress', "#plate_alphabet", function(e) {
  var key = e.keyCode;
  if (key >= 48 && key <= 57) {
      e.preventDefault();
  }
});

$( document).on('keydown keyup', '[number]', function(e) {
  let key = e.charCode || e.keyCode || 0;
  // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
  // home, end, period, and numpad decimal
  if (!(key == 8 || //Backspace
      key == 9 || //Tab
      key == 37 || //Setas
      key == 38 || //Setas
      key == 39 || //Setas
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
  $(this).val(text.replace(/[^0-9.]/g, ''));
});

 })(jQuery);
