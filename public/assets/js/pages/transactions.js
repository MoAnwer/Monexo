const submitBtn = document.querySelector("#newTransaction");

submitBtn.addEventListener("click", (e) => {
  const transactionData = {
    title: document.querySelector("#titleBackdrop").value,
    amount: document.querySelector("#amountBackdrop").value,
    date: document.querySelector("#dateBackdrop").value,
    type: document.querySelector("#typeBackdrop").value,
    category: document.querySelector("#categoryBackdrop").value,
    description: document.querySelector("#description").value,
    _token: document.querySelector("[name='_token']").value,
    _method: "POST",
  };
  fetch("http://127.0.0.1:8000/transactions/create", {
    method: "POST",
    headers: {
      "content-type": "application/json",
    },
    body: JSON.stringify(transactionData),
  })
    .then((res) => res.json())
    .then(function (res) {
      const data = res.message;
      const toastPlacementExample = document.querySelector(
        ".toast-placement-ex"
      );
      let selectedType, selectedPlacement;
      // Placement Button click
      selectedType = "text-success";
      selectedPlacement = "top-0 end-0".split(" ");

      function open() {
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
      }
      open();
      document.querySelector(".toast-body").innerHTML = data;
      // console.log(data);
    });
  e.preventDefault();
});
