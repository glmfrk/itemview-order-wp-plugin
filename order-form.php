<?php

// Enqueue JavaScript
function itemview_enqueue_scripts() {

  // Enqueue Font Awesome from CDN
  wp_enqueue_style('itemview-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0-beta3', 'all');

  // Enqueue CSS files
  wp_enqueue_style('itemview-bootstrap', plugins_url('assets/css/bootstrap.min.css', __FILE__), array(), '1.0.0', 'all');
  wp_enqueue_style('itemview-style', plugins_url('assets/css/mainStyle.min.css', __FILE__), array(), '1.0.0', 'all');



  // javascript code enqueue

  wp_enqueue_script('itemview-bootstrap', plugins_url('assets/js/bootstrap.min.js', __FILE__), array('jquery'), '1.0.0', true);

  // wp_enqueue_script('itemview-script', plugins_url('assets/js/itemview-order.js', __FILE__), array('jquery'), '1.0.0', true);

  // wp_localize_script('itemview-script', 'itemview_ajax_obj', array(
  //     'ajax_url' => admin_url('admin-ajax.php'),
  // ));
}
add_action('wp_enqueue_scripts', 'itemview_enqueue_scripts');



// Shortcode for order checkout form
function itemview_form_shortcode() {
  ob_start(); ?>

<section class="order__page_sec">
  <div class="container text-center">
    <div class="row">
      <div class="col-7 mx-auto">
        <div class="order__box">
          <a href="#" class="logo">
            <img src="<?php echo plugins_url('/assets/images/pran.png', __FILE__); ?>" alt="pran.png" />
          </a>
          <h2 class="heading">আপনার অর্ডারকৃত পণ্য নির্ধারণ করুন </h2>
          <div class="product__table">
            <div class="product__table_row" data-id="table_row_01">
              <div class="single_item item_left">
                <figure class="product_demo">
                  <img src="<?php echo plugins_url('/assets/images/pran-potata.png', __FILE__); ?>"
                    alt="pran-potata.png" />
                </figure>
                <div class="pd_unit">
                  <input type="checkbox" id="pd_item_01" name="pd_item_01" />
                  <label for="pd_item_01"> প্রাণ পোঁটাটা <strong>( ১০০গ্রাম )</strong> </label>
                </div>
              </div>
              <div class="single_item item_right">
                <div class="pd_pricing">
                  Tk <span>45.00</span>
                </div>
                <div class="quantity">
                  <input type="button" value="-" class="minus" />
                  <input type="number" value="0" min="0" class="input-box" />
                  <input type="button" value="+" class="plus" />
                </div>
              </div>
            </div>
            <div class="product__table_row" data-id="table_row_02">
              <div class="single_item item_left">
                <figure class="product_demo">
                  <img src="<?php echo plugins_url('/assets/images/pran-mango-juice-can.png', __FILE__)?>"
                    alt="pran-mango-juice-can-250-ml.png" />
                </figure>
                <div class="pd_unit">
                  <input type="checkbox" id="pd_item_02" name="pd_item_02" />
                  <label for="pd_item_02"> প্রাণ ম্যাংগো জুস ক্যান <strong>(২৫০ মিলি)</strong> </label>
                </div>
              </div>
              <div class="single_item item_right">
                <div class="pd_pricing">
                  Tk <span>40.00</span>
                </div>
                <div class="quantity">
                  <input type="button" value="-" class="minus" />
                  <input type="number" value="0" min="0" class="input-box" />
                  <input type="button" value="+" class="plus" />
                </div>
              </div>
            </div>
            <div class="product__table_row" data-id="table_row_03">
              <div class="single_item item_left">
                <figure class="product_demo">
                  <img src="<?php echo plugins_url('/assets/images/pran_drink_water.png',  __FILE__ )?>"
                    alt="pran_drink_water.png" />
                </figure>
                <div class="pd_unit">
                  <input type="checkbox" id="pd_item_03" name="pd_item_03" />
                  <label for="pd_item_03"> প্রান ড্রিংক ওটার <strong>(২৫০ মিলি)</strong> </label>
                </div>
              </div>
              <div class="single_item item_right">
                <div class="pd_pricing">
                  Tk <span>20.00</span>
                </div>
                <div class="quantity">
                  <input type="button" value="-" class="minus" />
                  <input type="number" value="0" min="0" class="input-box" />
                  <input type="button" value="+" class="plus" />
                </div>
              </div>
            </div>
            <div class="product__table_row" data-id="table_row_04">
              <div class="single_item item_left">
                <figure class="product_demo">
                  <img src="<?php echo plugins_url('/assets/images/potato_crackers.png',  __FILE__ )?>"
                    alt="potato_crackers.png" />
                </figure>
                <div class="pd_unit">
                  <input type="checkbox" id="pd_item_04" name="pd_item_04" />
                  <label for="pd_item_04">প্রাণ পটেটো ক্র্যাকার <strong>(১৫গ্রাম)</strong> </label>
                </div>
              </div>
              <div class="single_item item_right">
                <div class="pd_pricing">
                  Tk <span>10.00</span>
                </div>
                <div class="quantity">
                  <input type="button" value="-" class="minus" />
                  <input type="number" value="0" min="0" class="input-box" />
                  <input type="button" value="+" class="plus" />
                </div>
              </div>
            </div>
          </div>

          <div class="shifting_table_wrapper">
            <h3 class="heading_h3 text-left"> শিপিং মেথড </h3>
            <div class="shifting_table">
              <div class="shifting_table_row" data-id="shifting_row_01">
                <div class="pd_unit">
                  <input type="radio" id="radio_item_01" name="shiftingCost" />
                  <label for="radio_item_01"> ঢাকা সিটির ভিতরে </label>
                </div>
                <strong>
                  Tk <span class="shiftingCost">70.00</span>
                </strong>
              </div>
              <div class="shifting_table_row" data-id="shifting_row_02">
                <div class="pd_unit">
                  <input type="radio" id="radio_item_02" name="shiftingCost" />
                  <label for="radio_item_02"> চট্টগ্রাম সিটির ভিতরে </label>
                </div>
                <strong>
                  Tk <span class="shiftingCost">70.00</span>
                </strong>
              </div>
              <div class="shifting_table_row" data-id="shifting_row_03">
                <div class="pd_unit">
                  <input type="radio" id="radio_item_03" name="shiftingCost" />
                  <label for="radio_item_03"> ঢাকা ও চট্টগ্রাম সিটির বাহিরে </label>
                </div>
                <strong>
                  Tk <span class="shiftingCost">130.00</span>
                </strong>
              </div>
            </div>
          </div>

          <div class="product_price_details">
            <div class="pd_grandTotal_price">
              <p>সাব টোটাল <strong class="net_price">Tk <span>00.00</span></strong></p>
              <p>ডেলিভারি চার্জ <strong>Tk <span class="delivery_charge">00.00</span></strong></p>
              <p>সর্বমোট<strong class="total_price">Tk <span>00.00</span></strong></p>
            </div>
            <div class="order_note_box">
              <label for="orderNote">Order note</label>
              <input type="text" name="orderNote" id="orderNote" placeholder="Order note" />
            </div>
          </div>

          <div class="delivary_order_form">
            <h2>ক্যাশ অন ডেলিভারিতে <br> অর্ডার করতে আপনার তথ্য দিন </h2>
            <form action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post" id="userInfoForm"
              class="userInfoForm">
              <div class="index_box">
                <label for="fullName">আপনার নাম <span>*</span></label>
                <div class="input_item">
                  <span><i class="fa-solid fa-user"></i></span>
                  <input type="text" name="userName" id="userName" placeholder="API Solutions" required />
                </div>
              </div>
              <div class="index_box">
                <label for="phoneNumber">আপনার নাম্বার <span>*</span></label>
                <div class="input_item">
                  <span><i class="fa-solid fa-phone"></i></span>
                  <input type="number" name="userPhone" id="userPhone" placeholder="02-55035911" required />
                </div>
              </div>
              <div class="index_box">
                <label for="userEmail">আপনার ইমেল আইডি <span>*</span></label>
                <div class="input_item">
                  <span><i class="fa-solid fa-envelope"></i></span>
                  <input type="email" name="userEmail" id="userEmail" placeholder="hello@apisolutionsltd.com"
                    required />
                </div>
              </div>
              <div class="index_box">
                <label for="address">এড্রেস <span>*</span></label>
                <div class="input_item">
                  <span><i class="fa-solid fa-location-dot"></i></span>
                  <input type="text" name="userAddress" id="userAddress"
                    placeholder="Block B, House -4 Road 23/A, Dhaka 1213" required />
                </div>
              </div>
              <input type="submit" value="আপনার অর্ডার কনফার্ম করতে ক্লিক করুন" class="btn submit_btn" />
              <p class="mgs_info">উপরের বাটনে ক্লিক করলে আপনার অর্ডারটি সাথে সাথে কনফার্ম হয়ে যাবে !</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script type="text/javascript">
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

document.addEventListener("DOMContentLoaded", function() {
  const handleInputChange = (item) => {
    item.addEventListener("keyup", function() {
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
    item.addEventListener("change", function() {
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
    item.addEventListener("click", function() {
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
    item.addEventListener("click", function() {
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
    item.addEventListener("change", function() {
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
  const ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";

  const formData = new FormData();
  formData.append("action", "itemview_handle_order");
  formData.append("userName", userName);
  formData.append("userPhone", userPhone);
  formData.append("userEmail", userEmail);
  formData.append("userAddress", userAddress);
  formData.append("shippingCost", initialObj.shippingCharge);
  formData.append("items", JSON.stringify(initialObj.items));

  console.log("Sending data:", {
    action: "itemview_handle_order",
    userName,
    userPhone,
    userEmail,
    userAddress,
    shippingCost: initialObj.shippingCharge,
    items: JSON.stringify(initialObj.items)
  });

  fetch(ajax_url, {
      method: "POST",
      body: formData,
    })
    .then((response) => {
      console.log("Response status:", response.status);
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        alert("Order submitted successfully!");
        console.log(data);
      } else {
        alert("There was an error submitting your order.");
        console.error(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("There was an error submitting your order.");
    });
}
</script>

<?php
  return ob_get_clean();
}
add_shortcode('itemview-order-form', 'itemview_form_shortcode'); ?>