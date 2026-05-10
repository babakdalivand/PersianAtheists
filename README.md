# Persian Atheists — WordPress Theme

> A professional bilingual (Persian/English) WordPress theme for the **RAHA Network** — Iranian Atheists Community Platform.

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759b)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-777bb4)
![License](https://img.shields.io/badge/license-GPL--2.0-green)

---

## 📋 Overview

**Persian Atheists** is a custom-built WordPress theme designed for a bilingual content platform supporting Persian (RTL) and English (LTR) audiences. Built for the **RAHA Network** — a community platform for Iranian atheists, agnostics, humanists, and rationalists worldwide.

---

## ✨ Features

### 🌐 Bilingual Support
- Full **Persian (RTL)** and **English (LTR)** support
- Compatible with **Polylang** plugin for content translation
- Separate menus per language (`primary`, `primary-en`, `footer`)
- Automatic direction switching (`dir="rtl"` / `dir="ltr"`)
- Language switcher dropdown in header

### 🎨 Design System
- **Light / Dark mode** toggle with cookie persistence
- CSS Custom Properties (design tokens) for consistent theming
- **Light mode**: Clean white/cream background (`#F8F9FB`) with golden accent (`#D4A017`)
- **Dark mode**: Deep navy (`#0F172A`) with warm golden accent
- Responsive grid layout with sidebar
- Smooth animations and hover transitions

### 📱 Fully Responsive
- Mobile-first approach
- Hamburger menu with smooth slide-in animation (RTL/LTR aware)
- Sticky header with scroll-hide behavior
- Responsive grids: 3-col → 2-col → 1-col
- Touch-friendly interactions

### 📦 Custom Post Types

| Post Type | Slug | Description |
|-----------|------|-------------|
| `pa_video` | `/videos` | YouTube video embeds with thumbnail preview |
| `pa_podcast` | `/podcasts` | Podcast episodes with audio player |
| `pa_short` | `/shorts` | YouTube Shorts (vertical 9:16 format) |
| `pa_member_app` | — | Private membership applications (admin only) |

### 🔧 Custom Meta Boxes

| Post Type | Fields |
|-----------|--------|
| **Videos** | YouTube ID, Duration (auto-thumbnail preview) |
| **Podcasts** | Episode number, Duration, MP3 URL, Anchor/Spotify links |
| **Shorts** | YouTube Shorts ID, Duration |
| **Posts** | Featured flag (hero display), Recommended flag (sidebar) |
| **Member Applications** | Full applicant info, Approve/Reject workflow |

### 👥 User Roles

| Role | Slug | Capabilities |
|------|------|-------------|
| Member | `pa_member` | Read + Comment |
| Co-Admin | *(via ACL)* | Edit/Approve all content, Manage users |
| Author | *(via ACL)* | Write & submit own articles (pending approval) |
| Administrator | `administrator` | Full access |

### 🔐 Security
- WordPress version hidden
- XML-RPC disabled
- Generic login error messages
- Nonce verification on all forms and AJAX calls
- Input sanitization throughout

### 📬 Membership System
- Public membership application form with file upload
- Admin email notification on new submission
- Approve/Reject workflow with automatic applicant notification
- Private `pa_member_app` post type (admin only)

---

## 🗂️ Theme Structure

```
persian-atheists/
├── style.css                   # Theme header + global CSS design system
├── functions.php               # Theme setup, CPTs, roles, AJAX handlers
├── theme.json                  # Block editor settings
├── index.php                   # Main template fallback
├── header.php                  # Header: nav, search, lang switcher, dark mode
├── footer.php                  # Footer: links, social, donate section
├── single.php                  # Single article template
├── single-pa_podcast.php       # Single podcast template
├── single-pa_video.php         # Single video template
├── single-pa_short.php         # Single YouTube Short template
├── archive.php                 # Generic archive template
├── archive-pa_podcast.php      # Podcast archive
├── archive-pa_video.php        # Video archive
├── page.php                    # Default page template
├── author.php                  # Author profile page
├── comments.php                # Comments template
├── search.php                  # Search results
├── taxonomy.php                # Taxonomy archive
├── 404.php                     # 404 error page
│
├── inc/
│   ├── meta-boxes.php          # Custom meta boxes for all CPTs
│   └── admin.php               # Admin panel customizations & styles
│
├── assets/
│   ├── css/
│   │   ├── header.css          # Header, nav, hero, home layout
│   │   └── components.css      # Shared UI components
│   ├── js/
│   │   └── main.js             # Dark mode, hamburger menu, interactions
│   └── images/
│       └── logo.png            # Site logo
│
├── parts/                      # Reusable template parts
└── templates/                  # Custom page templates
```

---

## 🎨 Design Tokens

```css
/* ── Light Mode (default) ── */
--bg:           #F8F9FB;   /* Page background — cream white */
--surface:      #FFFFFF;   /* Cards and components */
--primary:      #1E2A38;   /* Dark navy — used in header/footer */
--accent:       #D4A017;   /* Golden accent */
--accent-hover: #B8880F;   /* Accent hover state */
--text:         #1A1A1A;   /* Body text */
--muted:        #6B7280;   /* Secondary/meta text */
--border:       #E5E7EB;   /* Borders and dividers */
--radius:       12px;      /* Card border radius */
--shadow:       0 2px 16px rgba(0,0,0,0.08);

/* ── Dark Mode ── */
--bg:           #0F172A;
--surface:      #1E293B;
--text:         #F9FAFB;
--muted:        #94A3B8;
--border:       #334155;
```

---

## ⚙️ Requirements

| Requirement | Minimum Version |
|-------------|----------------|
| WordPress | 6.0+ |
| PHP | 8.0+ |
| MySQL | 5.7+ |

---

## 🔌 Recommended Plugins

| Plugin | Purpose | Required? |
|--------|---------|-----------|
| [Polylang](https://wordpress.org/plugins/polylang/) | Bilingual FA/EN content | ⭐ Recommended |
| [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) | SEO meta, sitemaps | ⭐ Recommended |
| [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) | Reliable email delivery | ⭐ Recommended |
| [UpdraftPlus](https://wordpress.org/plugins/updraftplus/) | Automated backups | Optional |

---

## 🚀 Installation

1. Download or clone this repository
2. Upload the `persian-atheists` folder to `/wp-content/themes/`
3. Activate via **Appearance → Themes** in WordPress admin
4. Install recommended plugins
5. Configure menus under **Appearance → Menus**:
   - `منوی اصلی / Primary Menu` → for Persian navigation
   - `Primary Menu English` → for English navigation
   - `منوی فوتر / Footer Menu` → footer links
6. Upload logo via **Appearance → Customize → Site Identity**

---

## 📋 Content Management

### ▶️ Adding a Video
1. **ویدیوها → افزودن ویدیو** in admin
2. Fill in title and description
3. In **اطلاعات ویدیو** meta box, enter the YouTube video ID
   - From `https://youtube.com/watch?v=dQw4w9WgXcQ` → enter `dQw4w9WgXcQ`
4. Set duration (`MM:SS` or `HH:MM:SS`)
5. Publish

### 🎙️ Adding a Podcast
1. **پادکست‌ها → افزودن پادکست**
2. Enter title, description, and show notes
3. Fill in meta box: episode number, duration, MP3 file URL
4. Optionally add Anchor or Spotify embed links
5. Publish

### 📱 Adding a YouTube Short
1. **شورت‌ها** in admin
2. Enter the YouTube Shorts video ID
3. Publish (displays in vertical 9:16 format)

### 📝 Article Workflow (Authors)
1. Author writes article and submits
2. Co-Admin receives notification and reviews
3. Co-Admin approves → published + author notified
4. Co-Admin rejects → author notified with feedback

### 👤 Membership Applications
- Applications appear under **درخواست‌های عضویت**
- Use **تأیید عضویت** to approve → applicant receives confirmation email
- Use **رد درخواست** to reject → moves to trash + applicant notified

---

## 🌙 Dark Mode

Toggled via the ☀️/🌙 button in the header. Preference saved as a cookie.

| Property | Value |
|----------|-------|
| Cookie name | `pa_theme` |
| Values | `light` \| `dark` |
| Applied via | `data-theme` attribute on `<html>` |
| Persistence | 1 year |

---

## 🌐 Bilingual Setup (Polylang)

1. Install and activate **Polylang**
2. Add languages: Persian (`fa`) and English (`en`)
3. Set Persian as the default language
4. For each post/page → create translation via **Languages** panel in editor
5. Language switcher in header auto-detects available translations

> **Without Polylang**: Theme falls back to static `/` (FA) and `/en/` (EN) links.

---

## 🧩 Helper Functions

```php
// Current language slug
pa_current_lang();          // Returns 'fa' or 'en'

// Check if current language is RTL
pa_is_rtl();                // Returns true (Persian) or false (English)

// Estimated reading time
pa_reading_time( $post_id );   // Returns "5 دقیقه"

// Relative time
pa_time_ago( $post_id );       // Returns "3 ساعت پیش"

// YouTube video ID from post meta
pa_get_youtube_id( $post_id ); // Returns YouTube ID string

// Current theme preference
pa_get_theme();             // Returns 'light' or 'dark'

// Get featured article query
pa_get_featured_article();  // Returns WP_Query object
```

---

## 🔗 AJAX Actions

| Action Hook | Visibility | Description |
|-------------|-----------|-------------|
| `pa_membership_submit` | Public | Submit membership application form |
| `pa_set_dark_mode` | Public | Save dark/light mode preference to cookie |

---

## 🤝 User Role Architecture

```
Super Admin (1 person — Babak Dalivand)
└── Full system access

Co-Admin (6 co-founders)
├── Approve/reject articles
├── Publish directly
├── Moderate comments
├── Manage users (except Super Admin)
└── Add videos and podcasts

Author (select members)
├── Write articles under own name
├── Set title, slug, tags, categories
├── Configure SEO fields
├── Upload article images
└── Submit for Co-Admin approval

Member (public users)
├── Read all content
├── Submit comments (pending approval)
└── Like and bookmark content
```

---

## 📄 License

**GNU General Public License v2 or later**
[http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html)

---

## 👤 Author & Credits

**RAHA Network — Persian Atheists Team**

- 🌐 Website: [persianAtheists.org](https://persianAtheists.org)
- 🏗️ Built by: **Babak Dalivand**
- 📧 Contact: via website

---

## 🗺️ Roadmap

- [ ] Member dashboard with reputation system
- [ ] Comment system with likes and replies
- [ ] Google OAuth login
- [ ] Gamification — points and level progression
- [ ] Full SEO meta fields for Authors

---

*RAHA — **R**ationalist · **A**theist · **H**umanist · **A**gnostic*
