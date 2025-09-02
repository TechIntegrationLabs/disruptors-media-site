# PRD: AI Blog Post Detail Page Generator & Styling Guidebook

## 1. Purpose
We want to automate the creation of highly visual, magazine-style blog post detail pages using AI. The goal is to replicate the aesthetic and readability patterns of *Make: Magazine* while maintaining unique, brand-specific flair for every post.

This PRD defines the layout, styling rules, and AI workflow so developers can implement this system in our blog stack using Claude/Code/Cursor IDE.

---

## 2. Key Objectives
- **Consistency:** All blog posts follow a coherent visual style.
- **Modularity:** Pages use interchangeable layout modules (hero, steps, pull quotes, etc.)
- **Readability:** Typographic scale, line length, and spacing meet modern UX standards.
- **Automation:** AI ingests plain text and outputs structured layouts, styled HTML/CSS, and asset suggestions.
- **Uniqueness:** Randomized yet on-brand module order, accent colors, and side motifs prevent cookie-cutter designs.

---

## 3. Inputs & Outputs
### Inputs
- Raw text draft (Markdown or plain text)
- Optional: images, numeric data, metadata (category, author, read time)

### Outputs
- JSON layout map (module order + content)
- HTML/CSS with design tokens (colors, fonts, spacing)
- Optional: AI-generated diagrams, icons, hero images

---

## 4. Page Structure & Modules
Each page uses a **modular grid** approach. Modules can be rearranged depending on the post type (feature, tutorial, news, opinion).

### Required Modules
1. **Hero Section**
   - Full-bleed hero image
   - Kicker (small category text)
   - H1 Headline (bold, condensed)
   - Dek (1–3 sentence summary)
   - Meta row (author, date, read time)

2. **Body Sections**
   - Two-column or single-column text blocks
   - Subhead every ~200 words

3. **Callout Boxes**
   - Materials/Tools lists
   - Time/Cost/Difficulty boxes (for tutorials)

4. **Pull Quotes & Sidebars**
   - Short, bold callouts breaking up long text

5. **Media Blocks**
   - Image strips, diagrams, video embeds

6. **Further Reading / Related Links**
   - Auto-pulled internal or external links

---

## 5. Design Tokens & Style Rules
### Typography
- **Headline:** Condensed display font (e.g., Oswald, Archivo Narrow)
- **Body:** Humanist sans (e.g., Inter, Source Sans 3)
- **Scale:**
  - H1: 36–48px
  - H2: 24–28px
  - Body: 16–18px
- **Line length:** max 70–80 characters
- **Line height:** 1.5–1.7

### Colors
- One **primary accent** per category (auto-assigned by AI)
- Neutral grays for text/background
- WCAG AA contrast compliance

### Layout
- **Grid:** 12-column, 72–96px gutters
- **Margins:** Ample white space; min 24px padding per side on mobile
- **Breakpoints:** Mobile-first; 3–4 breakpoints for responsiveness

### Imagery
- Hero: 16:9 full-bleed
- Inline: 4:3 or square
- Diagrams: Auto-generated if data present

---

## 6. AI Workflow
1. **Content Analysis:**
   - Classify article type (feature, tutorial, news)
   - Extract lists, steps, key quotes, stats, and entities

2. **Module Mapping:**
   - Match content chunks to layout modules
   - Auto-insert callouts, quotes, and steps

3. **Styling Decisions:**
   - Assign accent color, icon motif, typography scale
   - Place pull quotes/images for rhythm and scannability

4. **Asset Generation (Optional):**
   - Hero image prompt → image model
   - Icons/diagrams from data → chart generator

5. **Output:**
   - JSON structure → HTML/CSS render → Final page

---

## 7. JSON Schema Example
```json
{
  "hero": {
    "image": "/img/hero.jpg",
    "kicker": "DIY",
    "headline": "Build a Solar Charger",
    "dek": "A weekend project for off-grid power.",
    "meta": {"author": "Will", "readTime": "5 min"}
  },
  "modules": [
    {"type": "TwoColBody", "content": "..."},
    {"type": "PullQuote", "quote": "Power anywhere, anytime."},
    {"type": "MaterialsBox", "items": ["Panel", "Battery", "Controller"]},
    {"type": "Steps", "items": [{"title": "Plan", "text": "..."}]},
    {"type": "ImageStrip", "images": ["/img/a.jpg"]}
  ],
  "theme": {"accent": "#D91E18", "icon": "bolt"}
}
```

---

## 8. Acceptance Criteria
- **Visual Consistency:** Pages use defined typography, colors, and spacing rules.
- **Automated Module Placement:** AI correctly assigns text to layout components.
- **Responsiveness:** Pages render well on mobile, tablet, and desktop.
- **Accessibility:** WCAG AA compliance for color contrast and font sizing.
- **Extensibility:** New modules can be added without rewriting core logic.

---

## 9. Next Steps
- Implement parser for raw text → structured outline
- Build modular React/Vue components matching this spec
- Train prompt templates for AI layout mapping
- Integrate image/icon generation if assets missing
- Test on sample blog posts and refine templates

