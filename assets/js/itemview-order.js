const initialObj = {
  items: [],
  shippingInfo: {},
  shippingCharge: 0,
  subTotal: 0,
  grandTotal: 0,
  orderNote: "",
};

const checkBoxes = document.querySelectorAll('input[type="checkbox"]');
const radioBoxes = document.querySelectorAll('input[type="radio"]');
const inputBoxes = document.querySelectorAll(".input-box");
const minusButtons = document.querySelectorAll(".minus");
const plusButtons = document.querySelectorAll(".plus");
const orderNote = document.querySelector('input[name="orderNote"]');

document.addEventListener("DOMContentLoaded", function () {
  const handleInputChange = (item) => {
    item.addEventListener("keyup", function () {
      const itemRow = this.closest(".product__table_row");
      const quantity = parseInt(this.value);
      const checkbox = itemRow.querySelector('input[type="checkbox"]');

      if (!isNaN(quantity)) {
        checkbox.checked = true;
        initialObj.items = initialObj.items.filter(
          (i) => i.id !== itemRow.getAttribute("data-id")
        );
        initialObj.items.push(updateItemData(itemRow, quantity));
      } else {
        checkbox.checked = false;
        initialObj.items = initialObj.items.filter(
          (i) => i.id !== itemRow.getAttribute("data-id")
        );
      }

      updateTotals();
    });
  };

  const handleCheckboxChange = (item) => {
    item.addEventListener("change", function () {
      const itemRow = this.closest(".product__table_row");
      const quantityInput = itemRow.querySelector('input[type="number"]');
      let quantity = parseInt(quantityInput.value);

      if (this.checked) {
        quantity = isNaN(quantity) || quantity < 1 ? 1 : quantity;
        quantityInput.value = quantity;
        initialObj.items = initialObj.items.filter(
          (i) => i.id !== itemRow.getAttribute("data-id")
        );
        initialObj.items.push(updateItemData(itemRow, quantity));
      } else {
        initialObj.items = initialObj.items.filter(
          (i) => i.id !== itemRow.getAttribute("data-id")
        );
      }

      updateTotals();
    });
  };

  const handleDecrementButton = (item) => {
    item.addEventListener("click", function () {
      const itemRow = this.closest(".product__table_row");
      const quantityInput = itemRow.querySelector('input[type="number"]');
      let quantity = parseInt(quantityInput.value);

      quantity = isNaN(quantity) || quantity <= 1 ? 0 : quantity - 1;
      quantityInput.value = quantity;
      itemRow.querySelector('input[type="checkbox"]').checked = quantity > 0;

      initialObj.items = initialObj.items.filter(
        (i) => i.id !== itemRow.getAttribute("data-id")
      );
      if (quantity > 0)
        initialObj.items.push(updateItemData(itemRow, quantity));

      updateTotals();
    });
  };

  const handleIncrementButton = (item) => {
    item.addEventListener("click", function () {
      const itemRow = this.closest(".product__table_row");
      const quantityInput = itemRow.querySelector('input[type="number"]');
      let quantity = parseInt(quantityInput.value);

      quantity = isNaN(quantity) ? 1 : quantity + 1;
      quantityInput.value = quantity;
      itemRow.querySelector('input[type="checkbox"]').checked = true;

      initialObj.items = initialObj.items.filter(
        (i) => i.id !== itemRow.getAttribute("data-id")
      );
      initialObj.items.push(updateItemData(itemRow, quantity));

      updateTotals();
    });
  };

  const handleShippingMethod = (item) => {
    item.addEventListener("change", function () {
      const itemRow = this.closest(".shifting_table_row");
      const shippingCost = parseInt(
        itemRow.querySelector(".shiftingCost").textContent
      );
      initialObj.shippingCharge = shippingCost;
      updateTotals();
    });
  };

  const attachEventHandlers = (inputsArray) => {
    inputsArray.forEach((elements) => {
      elements.forEach((element) => {
        if (element.type === "number") handleInputChange(element);
        if (element.type === "checkbox") handleCheckboxChange(element);
        if (element.type === "radio") handleShippingMethod(element);
        if (element.classList.contains("minus")) handleDecrementButton(element);
        if (element.classList.contains("plus")) handleIncrementButton(element);
      });
    });
  };

  attachEventHandlers([
    checkBoxes,
    inputBoxes,
    minusButtons,
    plusButtons,
    radioBoxes,
  ]);
});

const updateItemData = (itemRow, quantity) => {
  const itemId = itemRow.getAttribute("data-id");
  const price = parseInt(itemRow.querySelector(".pd_pricing span").textContent);
  const title = itemRow.querySelector("label").textContent;
  const image = itemRow.querySelector("img").src;
  return {
    id: itemId,
    title,
    image,
    quantity,
    price,
  };
};

const updateTotals = () => {
  initialObj.subTotal = initialObj.items.reduce(
    (total, item) => total + item.price * item.quantity,
    0
  );
  initialObj.grandTotal = initialObj.subTotal + initialObj.shippingCharge;
  updateViewData();
};

const updateViewData = () => {
  document.querySelector(".net_price span").textContent = initialObj.subTotal;
  document.querySelector(".delivery_charge").textContent =
    initialObj.shippingCharge;
  document.querySelector(".total_price span").textContent =
    initialObj.grandTotal;
};

// Order Confirm Form Validation
document
  .getElementById("userInfoForm")
  .addEventListener("submit", handleFormValidation);

function handleFormValidation(event) {
  event.preventDefault();

  let userName = event.target.userName.value.replace(/\s+/g, " ").trim();
  let userPhone = event.target.userPhone.value.replace(/\s+/g, " ").trim();
  let userEmail = event.target.userEmail.value.replace(/\s+/g, " ").trim();
  let userAddress = event.target.userAddress.value.replace(/\s+/g, " ").trim();

  if (userName === "" || userPhone === "" || userAddress === "") {
    alert("All fields are required.");
    return false;
  } else {
    initialObj.shippingInfo = {
      userName,
      userPhone,
      userEmail,
      userAddress,
    };
    initialObj.orderNote = orderNote.value;
  }

  // Send data via AJAX
  fetch(itemview_ajax_obj.ajax_url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      action: "itemview_handle_order",
      orderData: initialObj,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Order submitted successfully!");
        console.log(data);
      } else {
        alert("There was an error submitting your order.");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("There was an error submitting your order.");
    });
}
