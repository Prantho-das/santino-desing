---
name: anthropic-frontend-design
description: Anthropic official frontend design principles for high-quality, distinctive, non-generic UI/UX design. Enforces plan-before-code, custom design tokens, anti-AI-slop rules, intentional typography and layouts.
---

# Anthropic Frontend Design Skill

## 1. Core Workflow: Plan Before Code
- Clarify context, brand tone, audience, and visual direction before coding.
- Define two descriptive adjectives (e.g., "warm editorial", "sleek brutalist").
- Pick one specific layout strategy (e.g., asymmetric grid, layered hero).
- Pick one dominant visual anchor (e.g., dramatic typography, tactile glass card).

## 2. Design Tokens First
Always establish CSS variables / tokens upfront:
- **Colors**: 1 primary accent, 2-3 tailored neutrals (avoid pure saturated primaries).
- **Typography**: 1 distinctive display/header font + 1 clean body font.
- **Spacing**: 4px/8px scale system (`--space-1` to `--space-8`).
- **Type Scale**: Clear hierarchical jumps (14px, 16px, 20px, 28px, 42px, 60px).

## 3. Anti-Generic ("Anti-AI-Slop") Rules
- NO generic centered card grids with plain emoji icons.
- NO default purple-to-blue generic gradients.
- NO standard unstyled sans-serif fallback as sole personality.
- NO `lorem ipsum` placeholder text — use contextual, engaging copy.
- Vary section rhythms, alignments, asymmetric compositions, and background depths.

## 4. Interaction & Detail Passes
- Micro-interactions on all clickable & hoverable elements.
- Smooth transitions: 150ms-300ms ease-out.
- Full mobile responsiveness across 360px, 768px, 1024px, 1440px.
- High contrast accessibility (WCAG AA).
