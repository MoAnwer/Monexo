/**
 * UI Toasts
 */

"use strict";

(function () {
  // Bootstrap toasts example
  // --------------------------------------------------------------------
  const toastPlacementExample = document.querySelector(".toast-placement-ex");
  let selectedType, selectedPlacement;

  // Dispose toast when open another

  // Placement Button click
  selectedType = "text-success";
  selectedPlacement = "top-0 end-0".split(" ");

  toastPlacementExample
    .querySelectorAll('i[class^="ri-"]')
    .forEach(function (element) {
      element.classList.add(selectedPlacement);
    });
  DOMTokenList.prototype.add.apply(
    toastPlacementExample.classList,
    selectedPlacement
  );
  toastPlacement = new bootstrap.Toast(toastPlacementExample);
  toastPlacement.show();
})();
