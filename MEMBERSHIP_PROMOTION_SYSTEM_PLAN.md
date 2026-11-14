# Santino VIP Membership & Dynamic 7-Day Promotion Architecture Plan

---

## ১. সারসংক্ষেপ (Overview)
বিদ্যমান Santino VIP Coffee Club মেম্বারশিপ ও ডিজিটাল ৫-কাপ স্ট্যাম্প লয়্যালটি সিস্টেমের সাথে নতুন **"7 Days, 7 Reasons to Celebrate" (3 + 1 FREE)** অফারকে সম্পূর্ণ ডায়নামিক ও ব্যাকএন্ড ম্যানেজেবল করে ইন্টিগ্রেট করার আর্কিটেকচার প্ল্যান।

---

## ২. বিদ্যমান মেম্বারশিপ সিস্টেম আর্কিটেকচার (Current System Retained)

### ২.১ কোর মেকানিজম (Core Mechanics)
- **CPT Structure:**
  - `santino_member`: ভিআইপি মেম্বার রেকর্ড (Member ID: `SNT-VIP-XXXX`, ফোন, ইমেইল, স্ট্যাম্প ব্যালেন্স, রিডিম হিস্টোরি)।
  - `santino_invoice`: ক্যাফে মেমো সাবমিশন (ইনভয়েস #, ক্যাফে ব্রাঞ্চ, রিসিপ্ট ফটো, স্ট্যাটাস: Pending/Approved/Rejected)।
  - `santino_voucher`: ৫টি স্ট্যাম্প অর্জিত হলে স্বয়ংক্রিয়ভাবে জেনারেট হওয়া ফ্রি কফি ভাউচার কোড (`FREE-CUP-XXXX`)।
  - `santino_redeem`: ব্রাঞ্চ বারিস্তা কর্তৃক ভাউচার ও ফ্রি কাপ রিডেম্পশন ট্র্যাকিং।
- **VIP মেম্বারশিপ প্রিভিলেজসমূহ:**
  1. **Buy 5, Get 1 Free:** ৫ কাপ কফি ক্রয়ে ৬ষ্ঠ কাপ ফ্রি।
  2. **15% Beans Privilege:** ২৫০ গ্রাম ও ১ কেজি রোস্টেড বিন ব্যাগে বছরজুড়ে ১৫% ছাড়।
  3. **Birthday Month Treat:** জন্মদিনের মাসে ১টি হ্যান্ডক্রাফটেড ড্রিংক সম্পূর্ণ ফ্রি।
  4. **Micro-Lot Reserves:** স্পেশালিটি গেইশা/মাইক্রো-লটে ৪৮ ঘণ্টা অগ্রিম অ্যাক্সেস।
  5. **Cupping Masterclass:** তেজগাঁও রোস্টারি ল্যাবে SCA ও WBC ট্রেইনারদের ফ্রি সেশন পাস।
  6. **Gear Calibration & Express Order:** ডিরেক্ট টেকনিক্যাল সাপোর্ট ও হোয়াটসঅ্যাপ অর্ডার-অ্যাহেড।

---

## ৩. ডায়নামিক "7 Days, 7 Reasons to Celebrate" প্রমোশন সিস্টেম

### ৩.১ উইকলি শিডিউল ম্যাপিং (Schedule Matrix)
| দিন (Day) | অফার টাইপ | নির্ধারিত আইটেম (Featured Items) |
| :--- | :--- | :--- |
| **Sunday** | 3 + 1 FREE | Hot or Iced Chocolate |
| **Monday** | 3 + 1 FREE | Hot or Cold Latte |
| **Tuesday** | 3 + 1 FREE | Mocha / Caramel / Hazelnut Frappe |
| **Wednesday** | 3 + 1 FREE | Chai Latte |
| **Thursday** | 3 + 1 FREE | Hot Cappuccino |
| **Friday** | 3 + 1 FREE | Iced Mocha |
| **Saturday** | 3 + 1 FREE | Iced Latte |

---

## ৪. ব্যাকএন্ড ইমপ্লিমেন্টেশন প্ল্যান (WordPress)

### ৪.১ WP Admin Options প্যানেল (`santino-theme/inc/membership-system.php`)
- **Settings Submenu:** `edit.php?post_type=santino_member` (`Club Members` মেনুর আন্ডারে `add_submenu_page`) -> `Daily Promotions`
- **Data Model (`santino_daily_promotions` option):**
```php
[
    'sunday'    => ['title' => '3 + 1 FREE', 'items' => 'Hot or Iced Chocolate', 'badge' => 'Weekend Kickoff', 'active' => true],
    'monday'    => ['title' => '3 + 1 FREE', 'items' => 'Hot or Cold Latte', 'badge' => 'Monday Fuel', 'active' => true],
    'tuesday'   => ['title' => '3 + 1 FREE', 'items' => 'Mocha / Caramel / Hazelnut Frappe', 'badge' => 'Frappe Mania', 'active' => true],
    'wednesday' => ['title' => '3 + 1 FREE', 'items' => 'Chai Latte', 'badge' => 'Midweek Comfort', 'active' => true],
    'thursday'  => ['title' => '3 + 1 FREE', 'items' => 'Hot Cappuccino', 'badge' => 'Classic Thursday', 'active' => true],
    'friday'    => ['title' => '3 + 1 FREE', 'items' => 'Iced Mocha', 'badge' => 'Friday Chill', 'active' => true],
    'saturday'  => ['title' => '3 + 1 FREE', 'items' => 'Iced Latte', 'badge' => 'Weekend Vibes', 'active' => true],
]
```
- **Customization Access:** অ্যাডমিন যেকোনো সময় অফার টেক্সট, আইটেমের নাম এবং টগল স্ট্যাটাস পরিবর্তন করতে পারবে।

---

## ৫. ফ্রন্টএন্ড UI & ডায়নামিক লজিক (Elementor & HTML)

### ৫.১ অটো ডে ডিটেকশন ও রিয়েল-টাইম হাইলাইট (Cache-Safe)
- PHP সাইডে ডিফল্ট রেন্ডার (`strtolower(wp_date('l'))`) থাকলেও WP Page Cache এড়াতে ক্লায়েন্ট JS সাইডে `Asia/Dhaka` (UTC+6) টাইমজোন অনুযায়ী আজকের দিনের কার্ডে ডায়নামিক্যালি `is-today-active` ক্লাস ও মিডনাইট কাউন্টডাউন টাইমার অ্যাপ্লাই হবে।
- আজকের কার্ডটিতে গোল্ডেন গ্লো, "TODAY'S SPECIAL" ব্যাজ এবং লাইভ কাউন্টডাউন টাইমার (মিডনাইট পর্যন্ত) ডিসপ্লে হবে।

### ৫.২ উইজেট, রেজিস্ট্রেশন ও টেমপ্লেট
1. **নতুন Elementor Widget:** `santino-theme/inc/widgets/daily-promotions-widget.php`
2. **Widget Registration:** `santino-theme/functions.php` এ `santino_register_elementor_widgets()` এর ভেতর রেজিস্টার + `santino_ajax` লোকালাইজেশনে ডেটা পাস।
3. **REST API Endpoint:** `santino-theme/inc/rest-api.php` এ `/santino/v1/promotions` রুট যুক্ত করা।
4. **Shortcode Support:** `[santino_daily_promotions layout="grid|carousel|banner"]`
5. **HTML Designs & Page Integration:**
   - `html-designs/membership.html`
   - `santino-theme/page-membership.php` (`the_content()` দিয়ে Elementor রেন্ডার করে; `templates/template-membership.php` এটিকেই `require` করে)

---

## ৬. মেম্বারশিপ ও লয়্যালটি ক্রস-ইন্টিগ্রেশন
- **স্ট্যাম্প এক্যুমুলেশন রুল:** বিদ্যমান `handle_ajax_invoice_submit()` ও `credit_invoice_cups_to_member()` অলরেডি `order_items[]` ও `order_qtys[]` অনুযায়ী স্ট্যাম্প ক্রেডিট করে। ৩+১ অফারের ক্ষেত্রে ফ্রি ১ কাপ যাতে স্ট্যাম্প হিসেবে কাউন্ট না হয়, সেজন্য কেবল **৩টি পেইড কাপ** ক্রেডিট হবে এবং ইনভয়েস মেটাতে `_santino_invoice_promo_claimed` ও `_santino_invoice_promo_day` সেভ হবে।
- **স্মার্ট ইনভয়েস ফর্ম (All Portals Sync):** নিচের সব পোর্টাল ফর্ম ও JS হ্যান্ডলারে *"Claimed Today's 3+1 Offer?"* অপশন যুক্ত করতে হবে:
  - `santino-theme/inc/widgets/membership-portal-widget.php`
  - `santino-theme/inc/widgets/member-portal-widget.php`
  - `santino-theme/inc/membership-system.php` (`render_stamp_portal_shortcode`)
  - `santino-theme/assets/js/script.js` (`santinoInvoiceForm` হ্যান্ডলার)
- **হোয়াটসঅ্যাপ ক্লেইম লিঙ্ক:** প্রতিটি কার্ডে ডিরেক্ট বাটন থাকবে যা প্রি-ফিল্ড মেসেজ পাঠাবে:
  `"Hi Santino! I want to order today's (Friday) 3+1 FREE Iced Mocha offer at [Branch]. My VIP ID: [ID]"`

---

## ৭. ইমপ্লিমেন্টেশন স্টেপস (Execution Checklist)
1. `santino-theme/inc/membership-system.php` এ `edit.php?post_type=santino_member` এর আন্ডারে `Daily Promotions` সাবমেনু ও ডিফল্ট ৭ দিনের অপশন সিডিং।
2. `santino-theme/inc/rest-api.php` এ `/santino/v1/promotions` এন্ডপয়েন্ট যুক্ত করা।
3. `santino-theme/inc/widgets/daily-promotions-widget.php` তৈরি এবং `santino-theme/functions.php` এ রেজিস্টার করা।
4. সব পোর্টাল ফর্ম (`membership-portal-widget.php`, `member-portal-widget.php`, `render_stamp_portal_shortcode`) ও `assets/js/script.js` এ ৩+১ প্রোমো ট্যাগ ও ৩-কাপ স্ট্যাম্প লজিক সিঙ্ক করা।
5. `html-designs/membership.html` এ সেকশন অ্যাড ও `Asia/Dhaka` টাইমজোন-বেসড JS হাইলাইট/কাউন্টডাউন যুক্ত করা।
6. `santino-theme/inc/elementor-pages-sync.php` (`get_membership_four_sections_structure()`) এবং `santino-theme/inc/demo-importer.php` এর মেম্বারশিপ স্ট্রাকচার আপডেট করা।
