---
name: motion-and-animation
description: Web animations and micro-interactions skill covering CSS transitions, keyframes, hover feedback, spring physics curves, and scroll-triggered animations.
---

# Motion & Animation Design Skill

## 1. Animation Principles
- Purposeful motion: provide feedback, establish spatial continuity, guide user focus.
- Timing: Micro-interactions (150ms-250ms), structural transitions (300ms-500ms).
- Easing: Use natural cubic bezier curves (e.g., `cubic-bezier(0.16, 1, 0.3, 1)` for snappy ease-out).

## 2. Interactive States
- Hover: Subtle translate (`transform: translateY(-2px)`), scale up (`scale(1.02)`), glow transitions.
- Active/Click: Tactile depression (`transform: scale(0.98)`).
- Focus: Animated focus outline ring with smooth opacity.

## 3. Keyframe Animations
- Shimmer/skeleton loaders for loading states.
- Fade-in-up entrance reveals for sections and hero items.
- Smooth marquee / ticker animations for partner logos and badges.
