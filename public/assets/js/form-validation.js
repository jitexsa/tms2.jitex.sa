// Form Validation
(function () {
  (() => {
    "use strict";
    const forms = document.querySelectorAll("[data-form-validation]");
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
            console.log(event);
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add("was-validated");
        },
        false
      );
    });
  })();
})();
