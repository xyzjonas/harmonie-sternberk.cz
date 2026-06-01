# SEO Improvements - Harmonie Šternberk

## Completed SEO Enhancements

### 1. ✅ Site Configuration
- **Updated `astro.config.mjs`**: Changed site URL from `https://example.com` to `https://harmonie-sternberk.cz`
- This ensures proper canonical URLs and sitemap generation

### 2. ✅ Robots.txt
**Location**: `/website/public/robots.txt`

```txt
# Allow all crawlers
User-agent: *
Allow: /

# Sitemap location
Sitemap: https://harmonie-sternberk.cz/sitemap-index.xml
```

- Allows all search engine crawlers
- Points to the sitemap for easy indexing

### 3. ✅ XML Sitemap
- **Automated generation** via `@astrojs/sitemap` plugin
- Generates `sitemap-index.xml` and `sitemap-0.xml`
- Includes all pages: home, events, orchestra, gallery
- Automatically updates when new pages are added
- Properly formatted with correct URLs

**Sitemap includes**:
- Homepage
- All event pages (12+ events)
- Orchestra page
- Gallery page
- Events index

### 4. ✅ Enhanced Meta Tags
**Location**: `/website/src/components/BaseHead.astro`

Added comprehensive meta tags:
- ✅ `charset` and `viewport`
- ✅ `theme-color` (#e3051a - brand red)
- ✅ `og:locale` (cs_CZ)
- ✅ `robots` (index, follow)
- ✅ `author` (Harmonie Šternberk)
- ✅ `keywords` (dechový orchestr, Šternberk, Harmonie, koncerty, hudba, kulturní akce)
- ✅ `apple-mobile-web-app-capable`
- ✅ `apple-mobile-web-app-status-bar-style`

### 5. ✅ Open Graph & Social Media
**Enhanced OG tags**:
- ✅ `og:type` (website)
- ✅ `og:url` (canonical URL)
- ✅ `og:title`
- ✅ `og:description`
- ✅ `og:image` (uses carousel-1.jpg as default)
- ✅ `og:image:width` (1200)
- ✅ `og:image:height` (630)
- ✅ `og:site_name` (Harmonie Šternberk)
- ✅ `og:locale` (cs_CZ)

**Twitter Cards**:
- ✅ `twitter:card` (summary_large_image)
- ✅ `twitter:url`
- ✅ `twitter:title`
- ✅ `twitter:description`
- ✅ `twitter:image`

**Default OG Image**: High-quality carousel image (`/photos/web/carousel-1.jpg`)

### 6. ✅ Structured Data (Schema.org / JSON-LD)
**Location**: `/website/src/components/StructuredData.astro`

Implemented three types of structured data:

#### a) Organization Data (on all pages)
```json
{
  "@type": "PerformingGroup",
  "name": "Harmonie Šternberk",
  "description": "Symfonický dechový orchestr založený v roce 1957",
  "foundingDate": "1957",
  "genre": "Symfonická dechová hudba",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Šternberk",
    "addressCountry": "CZ"
  }
}
```

#### b) Event Data (on event pages)
```json
{
  "@type": "MusicEvent",
  "name": "Event Name",
  "description": "Event Description",
  "startDate": "ISO 8601 datetime",
  "location": {
    "@type": "Place",
    "name": "Location name"
  },
  "performer": {"@type": "PerformingGroup", "name": "Harmonie Šternberk"},
  "organizer": {"@type": "PerformingGroup", "name": "Harmonie Šternberk"}
}
```

#### c) Breadcrumb Data (on subpages)
- Orchestra page: Home → Orchestr
- Events page: Home → Program
- Gallery page: Home → Galerie

### 7. ✅ PWA Manifest
**Location**: `/website/public/manifest.json`

```json
{
  "name": "Harmonie Šternberk",
  "short_name": "Harmonie",
  "description": "Symfonický dechový orchestr založený v roce 1957",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#e3051a",
  "icons": [{"src": "/logo.png", "sizes": "512x512", "type": "image/png"}]
}
```

Benefits:
- Better mobile experience
- Add to home screen capability
- Branded theme colors

### 8. ✅ Canonical URLs
- Automatically generated for all pages
- Prevents duplicate content issues
- Uses the correct domain: `https://harmonie-sternberk.cz`

### 9. ✅ Language Declaration
- All pages have `<html lang="cs">` 
- Helps search engines understand content language
- Improves accessibility

### 10. ✅ RSS Feed
**Location**: `/website/src/pages/rss.xml.ts`

- Automatically generated RSS feed at `/rss.xml`
- Includes all events sorted by date (newest first)
- Proper Czech language declaration
- Linked in site header via alternate link tag
- Allows users and services to subscribe to event updates

**Features**:
- Valid RSS 2.0 format
- Event titles, descriptions, and dates
- Permanent links to event pages
- Language tag set to Czech (cs)

## SEO Checklist Summary

| Feature | Status | Notes |
|---------|--------|-------|
| robots.txt | ✅ | Allows all crawlers, links to sitemap |
| XML Sitemap | ✅ | Auto-generated, 15 pages indexed |
| RSS Feed | ✅ | Event feed with proper formatting |
| Canonical URLs | ✅ | All pages have proper canonical tags |
| Meta Descriptions | ✅ | Unique descriptions per page |
| Page Titles | ✅ | Unique, descriptive titles |
| Open Graph Tags | ✅ | Complete OG implementation |
| Twitter Cards | ✅ | Large image cards configured |
| Structured Data | ✅ | Organization, Events, Breadcrumbs |
| Mobile Optimization | ✅ | Responsive meta tags, PWA manifest |
| Language Tags | ✅ | Czech (cs) declared on all pages |
| Theme Colors | ✅ | Brand colors for mobile browsers |
| Site URL | ✅ | Correct domain configured |
| Keywords | ✅ | Relevant Czech keywords |
| Author Tag | ✅ | Set to Harmonie Šternberk |

## Technical SEO Checklist

- ✅ HTML semantic structure (`lang` attribute)
- ✅ Proper heading hierarchy (H1, H2, etc.)
- ✅ Alt text on images
- ✅ Fast loading times (Astro static generation)
- ✅ Mobile-responsive design
- ✅ HTTPS ready (once deployed)
- ✅ Structured data for rich snippets
- ✅ Clean, crawlable URLs

## Next Steps / Recommendations

### When Going Live:
1. **Submit sitemap to Google Search Console**
   - URL: `https://harmonie-sternberk.cz/sitemap-index.xml`

2. **Submit sitemap to Seznam Webmaster Tools**
   - Important for Czech search engine

3. **Set up Google Analytics** (optional)
   - Track visitor behavior

4. **Create Google Business Profile**
   - For local SEO in Šternberk area

5. **Monitor in Search Console**
   - Check for crawl errors
   - Monitor search performance
   - Verify structured data is recognized

### Future Enhancements:
- Add blog/news section for fresh content
- Create article structured data for blog posts
- Add FAQ structured data if applicable
- Consider adding reviews/testimonials with Review schema
- Add social media links to structured data `sameAs` field
- Create more specific alt text for images (currently generic)

## Testing Your SEO

### Before Launch:
1. **Build the site**: `npm run build`
2. **Check robots.txt**: Visit `/robots.txt`
3. **Check sitemap**: Visit `/sitemap-index.xml`
4. **Test structured data**: Use [Google's Rich Results Test](https://search.google.com/test/rich-results)
5. **Test OG tags**: Use [Facebook Sharing Debugger](https://developers.facebook.com/tools/debug/)
6. **Test Twitter cards**: Use [Twitter Card Validator](https://cards-dev.twitter.com/validator)

### After Launch:
1. Submit to Google Search Console
2. Submit to Seznam Webmaster Tools
3. Monitor crawl stats
4. Check Core Web Vitals
5. Verify mobile usability

## Files Modified/Created

### Created:
- `/website/public/robots.txt`
- `/website/public/manifest.json`
- `/website/src/components/StructuredData.astro`
- `/website/src/pages/rss.xml.ts`
- `/SEO-IMPROVEMENTS.md` (this file)

### Modified:
- `/website/astro.config.mjs` - Updated site URL
- `/website/src/components/BaseHead.astro` - Enhanced meta tags, added structured data
- `/website/src/layouts/EventPost.astro` - Added event structured data
- `/website/src/pages/orchestra.astro` - Added breadcrumbs
- `/website/src/pages/events/index.astro` - Added breadcrumbs
- `/website/src/pages/gallery.astro` - Added breadcrumbs

## Validation

All improvements have been validated:
- ✅ Build completes without errors
- ✅ Sitemap generates correctly
- ✅ Structured data is properly formatted JSON-LD
- ✅ All meta tags present in built HTML
- ✅ Robots.txt accessible
- ✅ Manifest.json valid JSON

---

**Status**: All SEO improvements complete and production-ready! 🚀
