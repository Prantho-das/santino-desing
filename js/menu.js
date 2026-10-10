// Santino Coffee - Menu & Order Management System

const menuProducts = [
  // 1. Hot & Cold Hero Items (Official Poster Items)
  {
    id: 'hero-cappuccino',
    name: 'Hot Cappuccino',
    category: 'barista-coffee',
    price: 170,
    tag: 'HERO ITEM',
    badgeClass: 'badge-teal',
    img: 'images/menu-cappuccino-hot.jpg',
    desc: 'Rich Italian espresso topped with a velvety layer of foamed steamed milk and cocoa dusting.',
    calories: '140 kcal',
    type: 'hot',
    plantBased: false,
    bestseller: true,
    roast: 'Reg Tk. 170 | Large Tk. 220'
  },
  {
    id: 'hero-iced-latte',
    name: 'Iced Latte',
    category: 'barista-coffee',
    price: 200,
    tag: 'HERO ITEM',
    badgeClass: 'badge-teal',
    img: 'images/menu-iced-latte.jpg',
    desc: 'Fresh Italian espresso combined with chilled farm milk, served crisp over crystalline ice.',
    calories: '130 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Large Tk. 200 • Smooth & Refreshing'
  },
  {
    id: 'hero-hot-mocha',
    name: 'Hot Mocha',
    category: 'barista-coffee',
    price: 190,
    tag: 'HERO ITEM',
    badgeClass: 'badge-gold',
    img: 'images/menu-hot-mocha.jpg',
    desc: 'Espresso combined with rich artisanal chocolate syrup, steamed milk, and whipped chocolate drizzle.',
    calories: '210 kcal',
    type: 'hot',
    plantBased: false,
    bestseller: true,
    roast: 'Reg Tk. 190 | Large Tk. 230'
  },
  {
    id: 'hero-iced-mocha',
    name: 'Iced Mocha',
    category: 'barista-coffee',
    price: 210,
    tag: 'HERO ITEM',
    badgeClass: 'badge-gold',
    img: 'images/menu-iced-mocha.jpg',
    desc: 'Chilled espresso and Belgian dark cocoa sauce poured over silky cold milk and ice.',
    calories: '220 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Large Tk. 210 • Rich Belgian Cocoa'
  },
  {
    id: 'hero-mocha-frappe',
    name: 'Mocha Frappe',
    category: 'matcha-tea',
    price: 230,
    tag: 'HERO ITEM',
    badgeClass: 'badge-danger',
    img: 'images/menu-mocha-frappe.jpg',
    desc: 'Blended espresso, chocolate ganache, ice crystals, and cloud whipped cream topped with chocolate shavings.',
    calories: '290 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Large Tk. 230 • Ice Blended'
  },
  {
    id: 'hero-hazelnut-frappe',
    name: 'Hazelnut Frappe',
    category: 'matcha-tea',
    price: 230,
    tag: 'HERO ITEM',
    badgeClass: 'badge-danger',
    img: 'images/menu-hazelnut-frappe.jpg',
    desc: 'Roasted Italian hazelnut syrup blended with creamy dairy, espresso, and topped with golden praline crunch.',
    calories: '280 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Large Tk. 230 • Roasted Hazelnut'
  },
  {
    id: 'hero-iced-chocolate',
    name: 'Iced Chocolate',
    category: 'signature-lattes',
    price: 190,
    tag: 'HERO ITEM',
    badgeClass: 'badge-teal',
    img: 'images/menu-iced-chocolate.jpg',
    desc: 'Velvety cold chocolate crafted with premium cocoa solids, cold farm milk, and chocolate swirl.',
    calories: '200 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Large Tk. 190 • Non-Coffee Treat'
  },

  // 2. Signature Lattes
  {
    id: 'sig-coconut',
    name: 'Santino Raw Coconut Latte',
    category: 'signature-lattes',
    price: 380,
    tag: 'BESTSELLER',
    badgeClass: 'badge-danger',
    img: 'images/menu-raw-coconut-latte.jpg',
    desc: 'Our iconic creation. Cold-pressed raw coconut milk infused with a double shot of dark-roasted Italian Arabica espresso.',
    calories: '185 kcal',
    type: 'iced',
    plantBased: true,
    bestseller: true,
    roast: 'Dark Roast • Nutty & Tropical'
  },
  {
    id: 'sig-caramel',
    name: 'Vanilla Caramel Macchiato',
    category: 'signature-lattes',
    price: 390,
    tag: 'SIGNATURE',
    badgeClass: 'badge-gold',
    img: 'images/menu-caramel-macchiato.jpg',
    desc: 'Freshly steamed milk with Madagascar vanilla syrup, marked with espresso and drizzled with caramel glaze.',
    calories: '235 kcal',
    type: 'both',
    plantBased: false,
    bestseller: true,
    roast: 'Medium Dark • Vanilla Caramel'
  },
  {
    id: 'sig-saffron',
    name: 'Spanish Saffron Latte',
    category: 'signature-lattes',
    price: 450,
    tag: 'PREMIUM',
    badgeClass: 'badge-teal',
    img: 'images/menu-saffron-latte.jpg',
    desc: 'Condensed milk infused with pure Iranian saffron threads and rich double ristretto.',
    calories: '220 kcal',
    type: 'hot',
    plantBased: false,
    bestseller: false,
    roast: 'Dark Roast • Saffron & Sweet Milk'
  },

  // 3. Barista Classics & Americanos
  {
    id: 'bar-americano',
    name: 'Classic Caffè Americano',
    category: 'barista-coffee',
    price: 240,
    tag: 'CLASSIC',
    badgeClass: 'badge-dark',
    img: 'images/menu-americano.jpg',
    desc: 'Double shot of Rainforest Alliance certified Italian espresso diluted over pure hot or iced mountain water.',
    calories: '10 kcal',
    type: 'both',
    plantBased: true,
    bestseller: true,
    roast: 'Full City Roast • Dark Cocoa'
  },
  {
    id: 'bar-flatwhite',
    name: 'Australian Flat White',
    category: 'barista-coffee',
    price: 360,
    tag: 'BARISTA CHOICE',
    badgeClass: 'badge-teal',
    img: 'images/menu-flat-white.jpg',
    desc: 'Silky micro-foam poured seamlessly over double ristretto for maximum espresso sweetness.',
    calories: '150 kcal',
    type: 'hot',
    plantBased: false,
    bestseller: true,
    roast: 'Medium Roast • Milk Chocolate'
  },

  // 4. Fruity Americano
  {
    id: 'fruit-orange',
    name: 'Valencia Orange Sparkling Americano',
    category: 'fruity-americano',
    price: 370,
    tag: 'VIRAL HIT',
    badgeClass: 'badge-danger',
    img: 'images/menu-orange-sparkling.jpg',
    desc: 'Sun-ripened Valencia orange juice topped with sparkling soda and chilled double espresso.',
    calories: '95 kcal',
    type: 'iced',
    plantBased: true,
    bestseller: true,
    roast: 'Light Roast • Citrus Sparkle'
  },
  {
    id: 'fruit-grapefruit',
    name: 'Ruby Grapefruit Fizzy Americano',
    category: 'fruity-americano',
    price: 380,
    tag: 'REFRESHING',
    badgeClass: 'badge-teal',
    img: 'images/menu-grapefruit-americano.jpg',
    desc: 'Tangy ruby grapefruit pulp with artisanal tonic water and double shot Ethiopia Yirgacheffe.',
    calories: '90 kcal',
    type: 'iced',
    plantBased: true,
    bestseller: false,
    roast: 'Light Roast • Ruby Citrus'
  },

  // 5. Single Origin (SOE)
  {
    id: 'soe-ethiopia',
    name: 'SOE Ethiopia Yirgacheffe G1 Flat White',
    category: 'soe-espresso',
    price: 460,
    tag: 'SINGLE ORIGIN 90+ PTS',
    badgeClass: 'badge-gold',
    img: 'images/menu-flat-white.jpg',
    desc: '100% Washed Yirgacheffe roasted in-house. Bright jasmine florals, bergamot lemon, and sweet honey.',
    calories: '140 kcal',
    type: 'both',
    plantBased: false,
    bestseller: true,
    roast: 'Light-Medium • Jasmine & Bergamot'
  },
  {
    id: 'soe-geisha',
    name: 'SOE Colombia Geisha Pourover (V60)',
    category: 'soe-espresso',
    price: 550,
    tag: 'CHAMPIONSHIP RESERVE',
    badgeClass: 'badge-danger',
    img: 'images/menu-pourover-v60.jpg',
    desc: 'Exquisite Geisha varietal hand-dripped at 93°C. Complex notes of white peach, lavender, and sparkling tea finish.',
    calories: '5 kcal',
    type: 'both',
    plantBased: true,
    bestseller: true,
    roast: 'Filter Roast • Peach & Lavender'
  },

  // 6. Matcha & Teas
  {
    id: 'tea-matcha',
    name: 'Kyoto Uji Matcha Oat Latte',
    category: 'matcha-tea',
    price: 420,
    tag: 'ORGANIC UJI',
    badgeClass: 'badge-teal',
    img: 'images/menu-matcha-latte.jpg',
    desc: 'Ceremonial grade stone-ground Uji matcha whisked with creamy Oatly oat milk. Rich umami aroma.',
    calories: '175 kcal',
    type: 'both',
    plantBased: true,
    bestseller: true,
    roast: 'Ceremonial Uji Matcha'
  },

  // 7. Gourmet Bakery
  {
    id: 'bak-croissant',
    name: 'French Normandy Butter Croissant',
    category: 'bakery',
    price: 180,
    tag: 'BAKED FRESH DAILY',
    badgeClass: 'badge-gold',
    img: 'images/menu-croissant.jpg',
    desc: 'Flaky, honeycomb interior baked fresh every morning with 100% French AOP butter.',
    calories: '280 kcal',
    type: 'hot',
    plantBased: false,
    bestseller: true,
    roast: 'Fresh Daily Bakery'
  },
  {
    id: 'bak-cheesecake',
    name: 'New York Style Cheesecake Slice',
    category: 'bakery',
    price: 320,
    tag: 'GOURMET DESSERT',
    badgeClass: 'badge-gold',
    img: 'images/menu-cheesecake.jpg',
    desc: 'Caramelized golden top with a rich, creamy cream cheese and vanilla bean center.',
    calories: '340 kcal',
    type: 'iced',
    plantBased: false,
    bestseller: true,
    roast: 'Artisan Pastry'
  }
];

// Shopping Cart State
let shoppingCart = [];
let selectedItemForModal = null;
let currentModalQty = 1;

document.addEventListener('DOMContentLoaded', () => {
  renderMenuGrid(menuProducts);
  initCategoryTabs();
  initSearch();
  initDietaryFilter();
  initModalActions();
  initBranchFilters();
});

// Render Menu Cards
function renderMenuGrid(items) {
  const grid = document.getElementById('menuItemsGrid');
  const noResultsBox = document.getElementById('noResultsBox');
  const countText = document.getElementById('itemsCountText');

  if (!grid) return;

  if (items.length === 0) {
    grid.innerHTML = '';
    noResultsBox?.classList.remove('d-none');
    if (countText) countText.innerText = '0 items found';
    return;
  }

  noResultsBox?.classList.add('d-none');
  if (countText) countText.innerText = `Showing ${items.length} handcrafted beverages and items`;

  grid.innerHTML = items.map(item => `
    <div class="col-xl-3 col-lg-4 col-md-6 menu-card-col">
      <div class="menu-product-card" onclick="openItemCustomModal('${item.id}')">
        
        <!-- Image & Badges -->
        <div class="menu-card-image-wrap">
          <img src="${item.img}" alt="${item.name}" loading="lazy" class="menu-card-img">
          <span class="menu-badge-pill ${item.badgeClass}">${item.tag}</span>
          <div class="menu-card-quick-order">
            <button class="btn-quick-add" onclick="event.stopPropagation(); quickAddToCart('${item.id}')">
              <i class="bi bi-plus-lg"></i>
            </button>
          </div>
        </div>

        <!-- Body Details -->
        <div class="menu-card-body">
          <div class="menu-taste-notes">${item.roast}</div>
          <h3 class="menu-item-name">${item.name}</h3>
          <p class="menu-item-desc">${item.desc}</p>
          
          <div class="menu-card-footer d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
            <div>
              <span class="menu-item-price">৳ ${item.price}</span>
              <span class="menu-item-cal text-muted small ms-1">${item.calories}</span>
            </div>
            <button class="btn-customize-pill" onclick="event.stopPropagation(); openItemCustomModal('${item.id}')">
              Order <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

      </div>
    </div>
  `).join('');
}

// Category Tabs Logic
function initCategoryTabs() {
  const tabs = document.querySelectorAll('.btn-cat-tab');
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.getAttribute('data-filter');
      const heading = document.getElementById('currentCategoryHeading');
      if (heading) heading.innerText = tab.innerText.trim();

      if (filter === 'all') {
        renderMenuGrid(menuProducts);
      } else {
        const filtered = menuProducts.filter(p => p.category === filter);
        renderMenuGrid(filtered);
      }
    });
  });
}

// Live Search Filter
function initSearch() {
  const input = document.getElementById('menuSearchInput');
  const clearBtn = document.getElementById('clearSearchBtn');

  if (!input) return;

  input.addEventListener('input', (e) => {
    const val = e.target.value.toLowerCase().trim();
    if (val.length > 0) {
      clearBtn?.classList.remove('d-none');
    } else {
      clearBtn?.classList.add('d-none');
    }

    const filtered = menuProducts.filter(p => 
      p.name.toLowerCase().includes(val) ||
      p.desc.toLowerCase().includes(val) ||
      p.roast.toLowerCase().includes(val)
    );
    renderMenuGrid(filtered);
  });

  clearBtn?.addEventListener('click', () => {
    input.value = '';
    clearBtn.classList.add('d-none');
    renderMenuGrid(menuProducts);
    input.focus();
  });

  const resetBtn = document.getElementById('resetFiltersBtn');
  resetBtn?.addEventListener('click', () => {
    if (input) input.value = '';
    clearBtn?.classList.add('d-none');
    document.querySelectorAll('.btn-cat-tab').forEach(t => t.classList.remove('active'));
    document.querySelector('.btn-cat-tab[data-filter="all"]')?.classList.add('active');
    const heading = document.getElementById('currentCategoryHeading');
    if (heading) heading.innerText = 'All Handcrafted Items';
    renderMenuGrid(menuProducts);
  });
}

// Dietary Dropdown Filter
function initDietaryFilter() {
  const select = document.getElementById('dietaryFilter');
  if (!select) return;

  select.addEventListener('change', (e) => {
    const val = e.target.value;
    if (val === 'all') {
      renderMenuGrid(menuProducts);
    } else if (val === 'iced') {
      renderMenuGrid(menuProducts.filter(p => p.type === 'iced' || p.type === 'both'));
    } else if (val === 'hot') {
      renderMenuGrid(menuProducts.filter(p => p.type === 'hot' || p.type === 'both'));
    } else if (val === 'bestseller') {
      renderMenuGrid(menuProducts.filter(p => p.bestseller));
    } else if (val === 'plantbased') {
      renderMenuGrid(menuProducts.filter(p => p.plantBased));
    }
  });
}

// Open Item Customization Modal (Luckin Style)
function openItemCustomModal(itemId) {
  const item = menuProducts.find(p => p.id === itemId);
  if (!item) return;

  selectedItemForModal = item;
  currentModalQty = 1;

  document.getElementById('modalItemImg').src = item.img;
  document.getElementById('modalItemTitle').innerText = item.name;
  document.getElementById('modalItemTag').innerText = item.tag;
  document.getElementById('modalItemCalories').innerText = `${item.calories} • ${item.roast}`;
  document.getElementById('modalItemDescription').innerText = item.desc;
  document.getElementById('modalItemPrice').innerText = `৳ ${item.price}`;
  document.getElementById('modalQtyDisplay').innerText = currentModalQty;

  // Reset radio selections
  document.getElementById('tempIced').checked = true;
  document.getElementById('sw100').checked = true;
  document.getElementById('milkFresh').checked = true;

  updateModalTotal();

  const modalEl = document.getElementById('itemCustomModal');
  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  modal.show();
}

function updateModalTotal() {
  if (!selectedItemForModal) return;

  let basePrice = selectedItemForModal.price;
  const milkOat = document.getElementById('milkOat');
  const milkCoconut = document.getElementById('milkCoconut');

  if (milkOat && milkOat.checked) basePrice += 50;
  if (milkCoconut && milkCoconut.checked) basePrice += 40;

  const total = basePrice * currentModalQty;
  const totalDisplay = document.getElementById('modalTotalCalculate');
  if (totalDisplay) totalDisplay.innerText = `৳ ${total}`;
}

// Modal Actions (Qty +/- and Add to Cart)
function initModalActions() {
  document.getElementById('qtyPlusBtn')?.addEventListener('click', () => {
    currentModalQty++;
    document.getElementById('modalQtyDisplay').innerText = currentModalQty;
    updateModalTotal();
  });

  document.getElementById('qtyMinusBtn')?.addEventListener('click', () => {
    if (currentModalQty > 1) {
      currentModalQty--;
      document.getElementById('modalQtyDisplay').innerText = currentModalQty;
      updateModalTotal();
    }
  });

  // Watch milk radio changes for live price update
  document.querySelectorAll('input[name="milkOption"]').forEach(radio => {
    radio.addEventListener('change', updateModalTotal);
  });

  document.getElementById('modalAddToCartBtn')?.addEventListener('click', () => {
    if (!selectedItemForModal) return;

    const temp = document.querySelector('input[name="tempOption"]:checked')?.value || 'Iced';
    const sweet = document.querySelector('input[name="sweetOption"]:checked')?.value || '100%';
    const milk = document.querySelector('input[name="milkOption"]:checked')?.value || 'Standard Milk';

    let extra = 0;
    if (milk.includes('50')) extra += 50;
    if (milk.includes('40')) extra += 40;

    const cartItem = {
      id: selectedItemForModal.id,
      name: selectedItemForModal.name,
      unitPrice: selectedItemForModal.price + extra,
      qty: currentModalQty,
      img: selectedItemForModal.img,
      customs: `${temp} • Sweet: ${sweet} • ${milk}`
    };

    addToCartArray(cartItem);

    // Close modal & open offcanvas cart
    const modalEl = document.getElementById('itemCustomModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    modal?.hide();

    const cartOffcanvasEl = document.getElementById('cartOffcanvas');
    const offcanvas = bootstrap.Offcanvas.getOrCreateInstance(cartOffcanvasEl);
    offcanvas.show();
  });
}

function quickAddToCart(itemId) {
  const item = menuProducts.find(p => p.id === itemId);
  if (!item) return;

  const cartItem = {
    id: item.id,
    name: item.name,
    unitPrice: item.price,
    qty: 1,
    img: item.img,
    customs: 'Standard Iced • 100% Sweet • Regular Milk'
  };

  addToCartArray(cartItem);

  const cartOffcanvasEl = document.getElementById('cartOffcanvas');
  const offcanvas = bootstrap.Offcanvas.getOrCreateInstance(cartOffcanvasEl);
  offcanvas.show();
}

function addToCartArray(item) {
  const existing = shoppingCart.find(i => i.id === item.id && i.customs === item.customs);
  if (existing) {
    existing.qty += item.qty;
  } else {
    shoppingCart.push(item);
  }
  renderCart();
}

function renderCart() {
  const container = document.getElementById('cartItemsList');
  const emptyMsg = document.getElementById('emptyCartMessage');
  const footer = document.getElementById('cartFooterBox');
  const badge = document.getElementById('cartCountBadge');
  const subtotalEl = document.getElementById('cartSubtotal');
  const totalEl = document.getElementById('cartTotalPayable');

  const totalCount = shoppingCart.reduce((sum, item) => sum + item.qty, 0);
  if (badge) badge.innerText = totalCount;

  if (shoppingCart.length === 0) {
    if (container) container.innerHTML = '';
    container?.appendChild(emptyMsg);
    emptyMsg?.classList.remove('d-none');
    if (footer) footer.style.display = 'none';
    return;
  }

  emptyMsg?.classList.add('d-none');
  if (footer) footer.style.display = 'block';

  let subtotal = 0;
  if (container) {
    container.innerHTML = shoppingCart.map((item, idx) => {
      const itemTotal = item.unitPrice * item.qty;
      subtotal += itemTotal;
      return `
        <div class="cart-item-row d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
          <div class="d-flex align-items-center gap-3">
            <img src="${item.img}" alt="" class="rounded-2" style="width: 50px; height: 50px; object-fit: cover;">
            <div>
              <div class="fw-bold fs-6 text-dark">${item.name}</div>
              <div class="text-muted small" style="font-size: 11px;">${item.customs}</div>
              <div class="fw-bold text-dark mt-1">৳ ${item.unitPrice} × ${item.qty} = <span style="color: var(--santino-teal);">৳ ${itemTotal}</span></div>
            </div>
          </div>
          <button class="btn btn-sm btn-outline-danger border-0" onclick="removeCartItem(${idx})">
            <i class="bi bi-trash3-fill"></i>
          </button>
        </div>
      `;
    }).join('');
  }

  if (subtotalEl) subtotalEl.innerText = `৳ ${subtotal}`;
  if (totalEl) totalEl.innerText = `৳ ${subtotal}`;
}

function removeCartItem(idx) {
  shoppingCart.splice(idx, 1);
  renderCart();
}

// Branch Locations Filter (North End Style)
function initBranchFilters() {
  const btns = document.querySelectorAll('.branch-filter-btn');
  const cards = document.querySelectorAll('.branch-item-col');

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      btns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-branch-filter');
      cards.forEach(card => {
        const region = card.getAttribute('data-region');
        if (filter === 'all' || region === filter) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // Order from branch button
  document.querySelectorAll('.btn-order-branch').forEach(b => {
    b.addEventListener('click', function() {
      const branch = this.getAttribute('data-branch');
      const select = document.getElementById('orderBranchSelect');
      if (select) {
        for (let opt of select.options) {
          if (opt.text.includes(branch) || branch.includes(opt.value)) {
            opt.selected = true;
            break;
          }
        }
      }
      const enquiryModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
      enquiryModal.show();
    });
  });
}
