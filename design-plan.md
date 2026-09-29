# Santino Coffee - New Design System & Implementation Plan

## 1. Typography Rules
- **Hero Headings (`h1`)**: `Playfair Display`, Weight: `600`
- **Section Headings (`h2`, `h3`)**: `Playfair Display`, Weight: `600`
- **Paragraph (`p`, body)**: `DM Sans`, Weight: `400`
- **Buttons, Navigation, Product Cards**: `DM Sans`, Weight: `500`–`600`

---

## 2. Google Fonts Imports
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
```

---

## 3. CSS Design Tokens
```css
:root {
  --font-heading: 'Playfair Display', Georgia, serif;
  --font-body: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
  
  --weight-regular: 400;
  --weight-medium: 500;
  --weight-semibold: 600;
  --weight-bold: 700;
}

h1, .hero-title {
  font-family: var(--font-heading);
  font-weight: 600;
}

h2, h3, .section-heading {
  font-family: var(--font-heading);
  font-weight: 600;
}

p, .body-text {
  font-family: var(--font-body);
  font-weight: 400;
}

button, .btn, nav, .nav-link, .product-card, .card-title {
  font-family: var(--font-body);
  font-weight: 500;
}

.btn-primary, .product-card-title {
  font-weight: 600;
}
```

---

## 4. Execution Steps
1. **Global CSS Setup**: Update font family declarations, font weights & CSS vars across stylesheet.
2. **Typography Refactor**:
   - Apply `Playfair Display, 600` to Hero & Section headings.
   - Apply `DM Sans, 400` to all paragraph/body text.
   - Apply `DM Sans, 500-600` to buttons, navigation bar, and product card elements.
3. **Template Rollout**:
   - `index.html`
   - `beans.html`
   - `machines.html`
   - `bfc.html`
   - `swapno.html`
   - `membership.html`
   - `menu.html`
   - `office-cafe.html`
   - `our-story.html`
   - `training.html`
   - `brands.html`
