---
name: responsive-web-design
description: Responsive and adaptive layout skill covering fluid typography with clamp(), modern CSS Grid/Flexbox, multi-breakpoint design, and mobile-first touch optimization.
---

# Responsive Web Design Skill

## 1. Breakpoint Strategy
- Mobile (< 640px)
- Tablet (640px - 1024px)
- Desktop (1024px - 1440px)
- Ultra-wide (> 1440px)

## 2. Fluid Scaling
- Fluid typography: `font-size: clamp(1.125rem, 2vw + 1rem, 2.5rem);`
- Fluid spacing: `padding: clamp(1rem, 3vw, 4rem);`
- Fluid container widths with `max-width` and `min()` / `max()`.

## 3. Mobile First & Touch Optimization
- Min tap target size: 44x44px for buttons and interactive controls.
- Safe area insets: `env(safe-area-inset-top)`, `env(safe-area-inset-bottom)`.
- Collapsible navigation (drawer / hamburger) with smooth backdrop transitions.
