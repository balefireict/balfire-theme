# Balefire WordPress Theme

A modern, clean, and organized WordPress theme by Balefire Marketing + Advertising.

**Version:** 1.1.5  
**License:** GNU General Public License & MIT

---

## Table of Contents

- [Theme Overview](#theme-overview)
- [File Structure](#file-structure)
- [CSS Organization](#css-organization)
- [JavaScript Files](#javascript-files)
- [Template Structure](#template-structure)
- [Functions & Features](#functions--features)
- [Where to Make Changes](#where-to-make-changes)
- [Required Plugins](#required-plugins)
- [Local Development Setup](#local-development-setup)
- [Best Practices](#best-practices)

---

## Theme Overview

Balefire is a custom WordPress theme built for flexibility and maintainability. It features:

- **Organized CSS architecture** with clear section divisions
- **Mobile-first responsive design** with modern media query syntax
- **Off-canvas mobile navigation** with desktop dropdown menus
- **Custom post types** support (Reviews, Team, Portfolio)
- **Modular template parts** for easy customization
- **WordPress best practices** and accessibility features
- **Optimized for performance** with minimal dependencies

---

## File Structure

```
balefire/
├── style.css                    # Main stylesheet (organized & documented)
├── functions.php                # Theme functions loader
├── header.php                   # Site header
├── footer.php                   # Site footer
├── front-page.php              # Homepage template
├── page.php                     # Default page template
├── single.php                   # Single post template
├── archive.php                  # Archive template
├── search.php                   # Search results template
├── 404.php                      # 404 error page
├── assets/                      # Theme assets
│   ├── css/                     # Additional stylesheets
│   ├── js/                      # JavaScript files
│   ├── img/                     # Images and icons
│   └── video/                   # Video files
├── functions/                   # Modular PHP functions
│   ├── admin.php               # Admin customizations
│   ├── cleanup.php             # WordPress cleanup
│   ├── custom-post-type.php    # Custom post types
│   ├── enqueue-scripts.php     # Script/style enqueuing
│   ├── menu.php                # Menu registration
│   ├── pagination.php          # Pagination functions
│   ├── short-codes.php         # Custom shortcodes
│   └── theme-support.php       # Theme features
├── inc/                         # Template parts & partials
│   ├── partials/               # Reusable components
│   ├── archive-header.php      # Archive page headers
│   ├── page-heading.php        # Page title sections
│   ├── post-card.php           # Blog post card
│   ├── search-form.php         # Search form
│   └── off-canvas-menu.php     # Mobile navigation
├── page-templates/              # Custom page templates
│   └── template-custom.php     # Example custom template
└── acf-json/                    # ACF field group exports
```

---

## CSS Organization

The main `style.css` file is organized into clear, logical sections:

### Section Order

1. **Normalize & Reset** - Browser normalization
2. **Third-Party Libraries** - Owl Carousel, etc.
3. **CSS Variables** - Custom properties for colors, fonts, spacing
4. **Global Styles** - HTML, body, typography, links, buttons, images
5. **Utility Classes** - Helpers, wrappers, alignment, visibility
6. **Navigation** - Mobile and desktop navigation styles
7. **Header** - Site header and logo
8. **Main Content** - Hero sections, page headers, content areas
9. **Components** - Reviews, pagination, post cards, search
10. **Footer** - Footer styles and navigation
11. **WordPress-Specific** - Admin bar, edit links, Bakery overrides
12. **Cookies & Accessibility** - Cookie consent, focus states
13. **Media Queries** - Organized from small to large (768px, 1024px)

### CSS Variables

Customize brand colors, fonts, and spacing in the CSS Variables section:

```css
:root {
    --brand-color-red: #DA4926;
    --brand-color-yellow: #faab45;
    --brand-font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI"...;
    --section-padding: clamp(24px, 36.6667px + 4.7917vw, 75px);
}
```

---

## JavaScript Files

### Location: `/assets/js/`

- **scripts.js** - Main JavaScript file for custom functionality
  - Mobile menu toggle
  - Dropdown navigation
  - Cookie consent
  - Custom interactions

- **owl-slider.min.js** - Owl Carousel for sliders
- **cookies.js** - Cookie consent functionality

### Adding Custom JavaScript

Add your custom scripts to `assets/js/scripts.js` or create new files and enqueue them in `functions/enqueue-scripts.php`.

---

## Template Structure

### Main Templates

- `front-page.php` - Homepage
- `page.php` - Default pages
- `single.php` - Blog posts
- `archive.php` - Category/tag/date archives
- `search.php` - Search results
- `404.php` - Error page

### Template Parts (`/inc/`)

Reusable template partials that can be included:

```php
get_template_part('inc/page-heading');        // Page titles
get_template_part('inc/post-card');           // Blog post cards
get_template_part('inc/search-form');         // Search form
get_template_part('inc/off-canvas-menu');     // Mobile menu
get_template_part('inc/footer-edit-links');   // Admin edit links
```

### Custom Page Templates (`/page-templates/`)

Create custom page layouts by duplicating `template-custom.php` and modifying the template name.

---

## Functions & Features

### Location: `/functions/`

All functions are modular and loaded via `functions.php`.

#### Key Function Files

**admin.php**
- Custom admin dashboard modifications
- Admin menu customizations
- Login page branding

**cleanup.php**
- Remove WordPress bloat
- Disable unnecessary features
- Clean up wp_head()

**custom-post-type.php**
- Register custom post types (Reviews, Team, Portfolio)
- Custom taxonomies
- Post type labels and settings

**enqueue-scripts.php**
- Load stylesheets and scripts
- Conditional script loading
- Script dependencies

**menu.php**
- Register navigation menus
- Custom menu walkers (if needed)

**pagination.php**
- Custom pagination functions
- Archive navigation
- Post navigation

**short-codes.php**
- Custom shortcodes
- Reviews shortcode
- Social media embeds

**theme-support.php**
- Add theme features
- Post thumbnails
- HTML5 support
- Custom logo support

---

## Where to Make Changes

### 🎨 Visual Design Changes

**Colors & Branding**
- Edit CSS Variables in `style.css` (lines ~28-50)
- Logo files in `/assets/img/`
- Update theme info in `style.css` header

**Typography**
- Font families in CSS Variables
- Font sizes use fluid clamp() values
- Heading styles in Global Styles section

**Layout & Spacing**
- Section padding via `--section-padding` variable
- Grid layouts in Components section
- Container widths in Utility Classes

### 🧭 Navigation

**Menu Structure**
- WordPress Admin → Appearance → Menus
- Register new menus in `functions/menu.php`

**Mobile Menu Styles**
- Mobile navigation styles in `style.css` (Navigation section)
- Mobile menu HTML in `inc/off-canvas-menu.php`

**Desktop Dropdown Styles**
- Desktop nav styles in media query (1024px+)
- Dropdown colors, hover states, positioning

### 📄 Content Templates

**Homepage**
- Edit `front-page.php`
- Hero section styles in Main Content section

**Blog Layout**
- Post card template: `inc/post-card.php`
- Post styles in Components section
- Archive layout: `archive.php`

**Page Headers**
- Template: `inc/page-heading.php`
- Styles in Main Content section

### 🔧 Functionality

**Custom Post Types**
- Add/edit in `functions/custom-post-type.php`
- Create archive templates as needed

**Shortcodes**
- Add custom shortcodes in `functions/short-codes.php`
- Example: `[reviews]` shortcode

**Custom Fields (ACF)**
- Field groups export to `/acf-json/`
- Access fields with `get_field('field_name')`

### 🔌 WordPress Settings

**Theme Features**
- Enable/disable features in `functions/theme-support.php`
- Post thumbnails, custom backgrounds, etc.

**Admin Customizations**
- Modify `functions/admin.php`
- Login page, dashboard widgets, admin menu

---

## Required Plugins

### Core Plugins (Recommended)

1. **Advanced Custom Fields Pro** - Custom fields management
2. **Classic Editor** - Disable Gutenberg (optional)
3. **Gravity Forms** - Form builder
4. **Yoast SEO** or **Rank Math** - SEO optimization
5. **Wordfence Security** - Security (at launch)
6. **WP Migrate DB** - Database migration
7. **Smush Pro** - Image optimization
8. **Schema Pro** - Schema markup
9. **Hummingbird** - Performance optimization (pre-launch)

### Optional Plugins

- **WPBakery Page Builder** - Visual page builder
- **Social Warfare** - Social sharing buttons
- **Contact Form 7** - Simple forms (if not using Gravity Forms)

---

## Local Development Setup

### Prerequisites

1. **Laravel Herd** - Local PHP server environment
2. **Code Editor** - VS Code, Sublime Text, or PHPStorm
3. **FTP Client** - FileZilla or Cyberduck
4. **Database Tool** - TablePlus, phpMyAdmin, or HeidiSQL

### Installation Steps

1. **Download WordPress**
   - Download latest WordPress from wordpress.org
   - Extract to Herd folder with your project name
   - Herd will auto-create: `project-name.test`

2. **Database Setup**
   - Create database (utf8mb4_unicode_ci)
   - Create database user
   - Grant all privileges to user
   - Note credentials for wp-config.php

3. **WordPress Configuration**
   - Rename `wp-config-sample.php` to `wp-config.php`
   - Add database credentials
   - Change table prefix from `wp_` to something unique
   - Generate security salts: https://api.wordpress.org/secret-key/1.1/salt/

4. **Install WordPress**
   - Visit: `http://project-name.test`
   - Complete WordPress installation
   - Set admin username and password

5. **Theme Setup**
   - Upload Balefire theme to `/wp-content/themes/`
   - Activate theme in WordPress Admin
   - Install and activate required plugins

6. **Menu Setup**
   - Create primary navigation menu
   - Assign to "Primary Navigation" location
   - Optional: Create footer menu

7. **Homepage Setup**
   - Settings → Reading → Front page displays → Static page
   - Select homepage from dropdown

---

## Best Practices

### CSS Development

✅ **DO:**
- Use CSS variables for colors and spacing
- Add styles to appropriate sections
- Use modern media query syntax: `@media (width >= 768px)`
- Comment complex selectors
- Follow existing naming conventions

❌ **DON'T:**
- Use inline styles
- Add `!important` unless absolutely necessary
- Create duplicate selectors
- Use deprecated CSS properties

### PHP Development

✅ **DO:**
- Escape output: `esc_html()`, `esc_url()`, `esc_attr()`
- Sanitize input: `sanitize_text_field()`, `sanitize_email()`
- Use WordPress functions when available
- Keep functions modular and organized
- Add comments for complex logic

❌ **DON'T:**
- Modify WordPress core files
- Use global variables unnecessarily
- Hardcode URLs (use `get_template_directory_uri()`)
- Query database directly (use WP_Query)

### Performance

- Optimize images before uploading
- Minimize HTTP requests
- Use lazy loading for images
- Defer non-critical JavaScript
- Enable caching on production

### Security

- Keep WordPress and plugins updated
- Use strong passwords
- Enable Wordfence on production
- Validate and sanitize all inputs
- Use nonces for forms

---

## Theme Features

### ✨ Built-in Features

- 📱 **Responsive Design** - Mobile-first, tablet, and desktop optimized
- 🎨 **CSS Variables** - Easy color and spacing customization
- 🍔 **Off-Canvas Menu** - Smooth mobile navigation with submenu support
- 🔍 **Search Functionality** - Custom search form and results page
- 📊 **Custom Post Types** - Reviews, Team, Portfolio ready to use
- ♿ **Accessibility** - Skip links, focus states, ARIA labels
- 🍪 **Cookie Consent** - Built-in cookie notification
- 📝 **Blog Features** - Post cards, pagination, categories, tags
- 🎯 **SEO Ready** - Clean markup, schema support
- 🛠️ **Developer Friendly** - Organized code, clear documentation

### 🎨 Design System

- **Typography Scale** - Fluid font sizes with clamp()
- **Spacing System** - Consistent padding and margins
- **Color Palette** - Brand colors via CSS variables
- **Grid System** - Flexible grid layouts for posts
- **Component Library** - Reusable cards, buttons, forms

---

## Support & Documentation

### Resources

- **WordPress Codex:** https://codex.wordpress.org/
- **ACF Documentation:** https://www.advancedcustomfields.com/resources/
- **Bootstrap 5 Docs:** https://getbootstrap.com/docs/5.0/ (if using)
- **Gravity Forms Docs:** https://docs.gravityforms.com/

### Theme Support

For questions or issues with this theme, contact:  
**Balefire Marketing + Advertising**  
Website: https://www.balefireagency.com

---

## Changelog

### Version 1.1.5 (Current)
- Reorganized and optimized CSS structure
- Improved desktop dropdown navigation
- Added comprehensive section comments
- Updated to modern media query syntax
- Enhanced code documentation

### Version 1.1.4
- Bug fixes and improvements
- Mobile menu enhancements

### Version 1.1.0
- Initial theme release
- Core features implemented

---

## License

This theme is licensed under the GNU General Public License v2 or later and the MIT License.

**GNU General Public License:** http://www.gnu.org/licenses/gpl-2.0.html  
**MIT License:** Allows for open-source development and modification

---

**Built with ❤️ by Balefire Marketing + Advertising**

