<?php
/**
 * Menu Modals & Offcanvas Components
 * 
 * Includes:
 * 1. Item Customization Modal (#itemCustomModal)
 * 2. Shopping Order Offcanvas (#cartOffcanvas)
 *
 * @package Santino
 */
?>

<!-- ITEM CUSTOMIZATION MODAL -->
<div class="modal fade" id="itemCustomModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0 overflow-hidden shadow-lg">
      
      <div class="modal-header border-0 pb-0">
        <div>
          <span class="badge-theme-teal mb-1" id="modalItemTag">HERO ITEM</span>
          <h3 class="modal-title font-heading fw-bold text-dark mt-1" id="modalItemTitle">Drink Title</h3>
          <div class="text-muted small" id="modalItemCalories">180 kcal</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body pt-3">
        <div class="row g-4">
          
          <div class="col-md-5 text-center">
            <div class="rounded-4 overflow-hidden shadow-sm mb-3" style="height: 220px; background: #f8f9fa;">
              <img id="modalItemImg" src="" alt="Drink" class="w-100 h-100 object-fit-cover">
            </div>
            <p class="text-muted small text-start" id="modalItemDescription">Drink description...</p>
            <div class="p-3 bg-light rounded-3 text-start">
              <div class="text-muted small">Base Price:</div>
              <div class="fs-4 fw-black font-heading text-dark" id="modalItemPrice">৳ 0</div>
            </div>
          </div>

          <div class="col-md-7">
            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">1. Size</label>
              <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="sizeOption" id="sizeRegular" value="Regular" checked>
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="sizeRegular">Regular Size</label>
                
                <input type="radio" class="btn-check" name="sizeOption" id="sizeLarge" value="Large">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="sizeLarge">Large Size</label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">2. Temperature</label>
              <div class="d-flex gap-2">
                <input type="radio" class="btn-check" name="tempOption" id="tempIced" value="Iced" checked>
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempIced"><i class="bi bi-snow me-1"></i> Iced (Standard)</label>
                
                <input type="radio" class="btn-check" name="tempOption" id="tempHot" value="Hot">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempHot"><i class="bi bi-cup-hot me-1"></i> Hot</label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">3. Sweetness</label>
              <div class="d-flex gap-2 flex-wrap">
                <input type="radio" class="btn-check" name="sweetOption" id="sw100" value="100% Regular" checked>
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw100">100% Regular</label>
                
                <input type="radio" class="btn-check" name="sweetOption" id="sw70" value="70% Less">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw70">70% Less</label>
                
                <input type="radio" class="btn-check" name="sweetOption" id="sw0" value="0% Sugar">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw0">0% Sugar</label>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">4. Milk Selection</label>
              <div class="d-flex gap-2 flex-wrap">
                <input type="radio" class="btn-check" name="milkOption" id="milkFresh" value="Fresh Farm Milk" checked>
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkFresh">Fresh Milk (+৳0)</label>
                
                <input type="radio" class="btn-check" name="milkOption" id="milkOat" value="Oat Milk (+৳50)">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkOat">Oat (+৳50)</label>
                
                <input type="radio" class="btn-check" name="milkOption" id="milkCoconut" value="Coconut Milk (+৳40)">
                <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkCoconut">Coconut (+৳40)</label>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
              <label class="form-label small fw-bold text-uppercase mb-0" style="letter-spacing: 0.5px;">Quantity</label>
              <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyMinusBtn" style="width: 32px; height: 32px; padding: 0;">-</button>
                <span class="fw-bold px-2 font-heading" id="modalQtyDisplay">1</span>
                <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyPlusBtn" style="width: 32px; height: 32px; padding: 0;">+</button>
              </div>
            </div>

            <button type="button" class="btn-hero-lifestyle w-100 py-3" id="modalAddToCartBtn">
              Add To Order • <span id="modalTotalCalculate">৳ 0</span>
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- SHOPPING ORDER OFFCANVAS -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title font-heading fw-bold"><i class="bi bi-cart3 me-2" style="color: var(--santino-teal);"></i> Your Santino Order</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column justify-content-between">
    
    <div id="cartItemsList" class="d-flex flex-column gap-3 overflow-auto">
      <div id="emptyCartMessage" class="text-center py-5 text-muted">
        <i class="bi bi-cart-x fs-1 text-muted"></i>
        <p class="mt-2 mb-0">Your order is currently empty</p>
      </div>
    </div>

    <div class="pt-3 border-top" id="cartFooterBox" style="display: none;">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Total Payable:</span>
        <span class="fw-black font-heading fs-5" style="color: var(--santino-teal);" id="cartTotalPayable">৳ 0</span>
      </div>
      <button class="btn-hero-lifestyle w-100 py-3" onclick="alert('Thank you for ordering with Santino Caffè! Please show this confirmation to your barista.');">
        Proceed To Checkout →
      </button>
    </div>

  </div>
</div>
