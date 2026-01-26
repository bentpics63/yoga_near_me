# Product Requirements Document (PRD)
## Visibility Optimizer for Yoga Studios

**Version:** 1.0  
**Date:** January 24, 2026  
**Status:** Draft (Ready for Review)  
**Product Line:** YogaNearMe Studio Suite

---

## 1. Executive Summary

**Product:** Visibility Optimizer — A local SEO analysis and automation tool built specifically for yoga studio owners.

**Vision:** Help yoga studios get found on Google without requiring technical knowledge. Automate what's tedious, recommend what requires human judgment, ignore vanity metrics.

**Primary Outcome:** More students discovering studios through local search.

**Secondary Outcomes:**
- Higher Google Maps rankings
- Faster website load times
- Better technical SEO health
- Competitive visibility insights

**Target Market:** Yoga studio owners in North America, 1-5 staff, who ask "Why don't I show up on Google?" (Pain point #1 in Studio Suite customer research)

**Wedge:** Directory-integrated competitive analysis — we have data on 30,000+ studios that no generic SEO tool has.

---

## 2. Problem Statement

**User pain:** Studio owners don't understand why they don't rank on Google. They lack technical knowledge to diagnose or fix issues. Generic SEO tools (SEMrush, Ahrefs) are expensive and overwhelming for non-technical users.

**Measurable outcome:** Studio owners can see their "Visibility Score" improve from baseline (typically 30-50) to competitive range (70-85) within 60 days of using the tool.

**Market opportunity:** No yoga-specific local SEO tool exists. Generic tools don't understand studio-specific schemas, don't compare against local yoga competitors, and don't integrate with studio directories.

---

## 3. Scope Definition

### 3.1 Must-Have Features (MVP Launch)

#### FREE TIER: Homepage Visibility Scan

**What It Analyzes (Read-Only):**

1. **Speed & Performance**
   - Page load time (mobile + desktop)
   - Core Web Vitals: LCP, FID, CLS
   - Score + benchmark comparison

2. **Mobile Experience**
   - Mobile-friendly test
   - Viewport configuration
   - Touch element sizing

3. **On-Page SEO Basics**
   - Title tag (present? optimized? location keywords?)
   - Meta description (present? compelling?)
   - H1 tag (present? contains target keyword?)
   - Image ALT text (count of missing)

4. **Local SEO Check**
   - NAP (Name, Address, Phone) on homepage
   - Schema markup present (LocalBusiness/YogaStudio)
   - Google Business Profile linked
   - Embedded map

5. **Basic Keyword Analysis**
   - Keywords homepage currently targets
   - City/neighborhood names mentioned
   - Yoga style variations present

**Output Format:**
```
🔴 Critical Issues (4)
→ Page speed: 6.2 seconds (loses 40% of visitors)
→ No schema markup (Google can't understand your business)
→ 8 images missing ALT text (bad for SEO + accessibility)
→ Phone number format inconsistent (confuses Google)

🟡 Improvements (3)
→ Meta description missing (Google writes its own)
→ No location keywords in H1
→ Google Business Profile not linked

🟢 Looking Good (2)
✓ Mobile-friendly design
✓ Valid SSL certificate

Your Visibility Score: 47/100

[Upgrade to fix these automatically →]
```

#### STARTER TIER ($39/month): Comprehensive Scan + Automation

**Automated Technical SEO:**

1. **Schema Markup Generation & Injection**
   - Generates LocalBusiness + YogaStudio schema
   - Injects into homepage automatically (with site access)
   - Impact: Google understands business type, hours, services

2. **Image Optimization**
   - Compresses all images (lossless, 60-70% size reduction)
   - Generates descriptive ALT text for each image
   - Converts to WebP format (with fallback)
   - Implements lazy loading
   - Impact: 40-60% faster load times

3. **Meta Tag Optimization**
   - Generates SEO-optimized title tags
   - Writes compelling meta descriptions
   - Adds Open Graph tags for social sharing
   - Impact: Better click-through from search results

4. **NAP Consistency Checker & Fixer**
   - Scans website for all NAP mentions
   - Flags inconsistencies
   - Auto-fixes formatting across site
   - Compares to GBP listing

5. **Sitemap Generation + Submission**
   - Creates XML sitemap
   - Submits to Google Search Console (with integration)
   - Updates automatically

**Monitoring:**
- 10 keyword tracking
- Monthly reports
- Competitor tracking (3 competitors from YogaNearMe directory)

#### GROWTH TIER ($79/month): Full Automation + GBP

**Everything in Starter, plus:**

1. **Google Business Profile Automation**
   - Weekly post scheduling (write once, auto-post)
   - Q&A monitoring + alerts
   - Hours sync (update in app → pushes to GBP)
   - Service menu sync
   - Recommendations (not automated): category optimization, attribute suggestions

2. **Content Recommendations**
   - Keyword gap analysis vs. competitors
   - Content quality scoring
   - Specific suggestions ("You don't mention 'prenatal yoga' anywhere. 3 competitors rank for this. Monthly searches: 320.")

3. **Backlink Opportunity Finder**
   - Local directories
   - Yoga-specific sites
   - Partnership opportunities
   - One-click outreach templates

4. **Extended Monitoring:**
   - 50 keyword tracking
   - 5 competitor tracking
   - Weekly reports
   - Google Search Console integration

### 3.2 Should-Have Features (Week 2-4)

- Mobile app notifications for ranking changes
- AI-generated GBP post suggestions (yoga-specific)
- Competitor alert: "Studio X just added prenatal yoga to their GBP"
- Integration with MindBody/WellnessLiving for schedule schema

### 3.3 Could-Have Features (Backlog)

- Review monitoring + response suggestions
- Social media SEO audit
- Multi-location support
- Agency/consultant white-label
- Automated citation building

### 3.4 Explicit Out-of-Scope

- Backlink building automation (requires human relationships)
- Content writing (requires brand voice)
- Social media posting (separate tool)
- International SEO
- Advanced technical SEO (CDN, server configs)
- Rank tracking for 1000s of keywords

---

## 4. User Flows

### 4.1 Free Tier: First-Time Scan

```
1. Studio owner enters website URL
2. System crawls homepage (30-60 seconds)
3. Results displayed with Visibility Score
4. Issues categorized (Critical / Improvement / Good)
5. Each issue shows:
   - What's wrong
   - Why it matters
   - How to fix (teaser)
6. CTA: "Fix these automatically for $39/month"
```

### 4.2 Starter Tier: Image Optimization Flow

```
1. Weekly scan runs automatically
2. App detects: "You uploaded 6 new photos to your website"
3. Notification: "6 new images found. Optimize now?"
4. User clicks: "Optimize"
5. App does:
   - Compresses each image (60-70% size reduction)
   - Generates ALT text: "Woman practicing tree pose in bright yoga studio with wooden floors"
   - Converts to WebP (with fallback)
   - Implements lazy loading
6. Result: "Images optimized. Load time reduced by 2.3 seconds."
```

### 4.3 Dashboard Home View

```
Your Visibility Score: 47 → 82 (Since using Visibility Optimizer)

🎯 Active Automations
✓ Schema markup (installed 14 days ago)
✓ Image optimization (compressed 24 images)
✓ Weekly GBP posts (3 scheduled this month)
✓ Meta tags (optimized 8 pages)

📊 This Month
→ Your ranking improved for 6 keywords
→ Homepage load time: 6.2s → 2.1s
→ 8 new backlink opportunities found
→ GBP views: +34% vs. last month

⚠️ Needs Attention
→ You're missing "hot yoga" on your site (240 monthly searches)
→ Competitor rankings improved for "yoga [city]"
→ 2 class descriptions need optimization

[View Full Report →]
```

### 4.4 Quick Actions Panel

```
One-Click Fixes Available:

[ Fix Now ] - Add location keywords to homepage H1
[ Fix Now ] - Optimize 3 class descriptions for SEO
[ Fix Now ] - Schedule 4 GBP posts for next month
[ Review ]  - 5 backlink opportunities (requires outreach)
```

---

## 5. Technical Approach

### 5.1 Stack Components

| Component | Tool/API | Purpose |
|-----------|----------|---------|
| Website Crawler | Custom or Screaming Frog API | Scan site structure |
| Speed Testing | Google PageSpeed Insights API | Core Web Vitals |
| Schema Generator | Custom templates | LocalBusiness + YogaStudio schema |
| Image Optimization | TinyPNG API or ImageOptim | Compression |
| GBP Integration | Google My Business API | GBP management |
| Search Console | Google Search Console API | Indexing, performance data |
| Rank Tracking | DataForSEO or SERPWatcher API | Keyword positions |
| Competitor Analysis | Custom + YogaNearMe directory | Competitor data |

### 5.2 Data Model Essentials

**Studio Record:**
```
- studio_id (links to YogaNearMe directory if claimed)
- website_url
- last_scan_date
- visibility_score
- issues[] (type, severity, status, auto_fixable)
- competitors[] (studio_ids from same city)
```

**Scan Results:**
```
- scan_id
- studio_id
- scan_date
- speed_metrics (LCP, FID, CLS, load_time)
- seo_metrics (title, meta, h1, alt_count, schema_present)
- local_metrics (nap_consistent, gbp_linked, map_present)
- keyword_data[]
```

**Automation Log:**
```
- automation_id
- studio_id
- action_type (schema_inject, image_compress, meta_update)
- status (pending, completed, failed)
- before_state
- after_state
- timestamp
```

### 5.3 Integration Points

| Integration | Purpose | Priority |
|-------------|---------|----------|
| YogaNearMe Directory | Competitor data, auto-populate studio info | P0 |
| Google Business Profile | GBP optimization features | P1 |
| Google Search Console | Performance data, sitemap submission | P1 |
| MindBody/WellnessLiving | Schedule data for schema | P2 |
| WordPress (via plugin) | Direct site modification for automations | P2 |

### 5.4 Risk/Complexity Flags

**High Risk:**
- Site modification automations (schema injection, meta updates) require careful error handling
- GBP API has strict rate limits and review processes
- Studios on non-WordPress platforms need alternative approaches

**Medium Risk:**
- Competitor tracking depends on YogaNearMe data completeness
- Image optimization may not work on all hosting setups

**Low Risk:**
- Scan-only features (free tier)
- Reporting and recommendations

---

## 6. Pricing & Packaging

| Tier | Price | Features | Target |
|------|-------|----------|--------|
| Free | $0 | Homepage scan, Visibility Score, issue list (read-only) | Lead gen |
| Starter | $39/month | Automated fixes, 10 keyword tracking, 3 competitors, monthly reports | Quick wins |
| Growth | $79/month | GBP automation, 50 keywords, 5 competitors, content recommendations, weekly reports | Ongoing marketing |
| Growth Suite Bundle | $99/month | Visibility Optimizer (Growth) + Photo Optimizer + Review Monitor + Profit Calculator | Full marketing |

**14-day free trial** on Starter and Growth tiers.

---

## 7. Directory Integration Advantage

**Why this tool is better because of YogaNearMe:**

| Feature | Directory Integration |
|---------|----------------------|
| Competitor Tracking | Compare to other studios in same city from our 30,000+ database |
| Auto-Population | Pre-fill studio info from directory listing |
| NAP Sync | Sync NAP across YogaNearMe listing + GBP + website |
| Backlink Opportunities | Suggest linking from YogaNearMe listing |
| Benchmark Data | "Studios in your city average 72 Visibility Score" |

---

## 8. Launch Strategy

**Month 1: Free Tier + Content**
- Article: "Why Your Studio Doesn't Show Up on Google"
- Offer: Free homepage scan
- CTA: "Get your Visibility Score"
- Goal: 500 free scans, 50 email captures

**Month 2: Paid Tier Launch**
- Article: "The 6 Technical SEO Fixes Every Studio Needs"
- Offer: $39/month Starter tier with 14-day trial
- CTA: "Fix these automatically"
- Goal: 20 paying subscribers

**Month 3: Growth Tier + Social Proof**
- Article: "How [Studio Name] Went from Page 3 to Page 1 in 60 Days"
- Case study with before/after
- Offer: Growth tier or bundle
- Goal: 10 Growth tier upgrades, 5 bundle sales

---

## 9. Success Metrics

| Metric | Target | Timeline |
|--------|--------|----------|
| Free → Starter conversion | 10-15% | Month 2+ |
| Starter → Growth upgrade | 20-30% | Month 3+ |
| Monthly churn | <5% | Ongoing |
| Time to first value | <5 minutes | Launch |
| Average Visibility Score improvement | +25 points | 60 days |

---

## 10. Acceptance Criteria

### Free Tier MVP
- [ ] User can enter URL and receive scan results within 60 seconds
- [ ] Visibility Score calculated and displayed
- [ ] Issues categorized by severity (Critical/Improvement/Good)
- [ ] Each issue includes explanation and fix preview
- [ ] Email capture before showing full results
- [ ] CTA to upgrade visible on results page

### Starter Tier MVP
- [ ] User can connect website (WordPress plugin or manual)
- [ ] Schema markup generated and injectable
- [ ] Image optimization runs on demand
- [ ] Meta tag suggestions provided
- [ ] 10 keywords tracked with weekly updates
- [ ] 3 competitors tracked from YogaNearMe directory
- [ ] Monthly report emailed to user

### Growth Tier MVP
- [ ] GBP connection via OAuth
- [ ] GBP post scheduling functional
- [ ] Keyword gap analysis vs. competitors
- [ ] 50 keywords tracked
- [ ] Weekly report emailed
- [ ] Search Console integration optional

---

## 11. Open Questions

1. **WordPress-only or platform-agnostic?** 
   - WordPress plugin simplifies automations
   - Platform-agnostic increases TAM but limits automation depth
   - Recommendation: WordPress-first, manual instructions for others

2. **GBP API access?**
   - Google has strict approval process
   - May need to start with recommendations-only, add automation later
   - Alternative: Use existing GBP management tool via integration

3. **Pricing validation?**
   - $39 and $79 based on comparable tools
   - Need to validate with actual studio owners
   - Consider $29 entry point to match Studio Suite tier structure

4. **Build vs. white-label?**
   - Could white-label existing tool (e.g., AgencyAnalytics, BrightLocal)
   - Custom build gives directory integration advantage
   - Recommendation: Evaluate white-label cost vs. build time

---

## 12. What We DON'T Build (And Why)

| Feature | Reason |
|---------|--------|
| Backlink building | Requires human relationships |
| Content writing | Requires expertise and brand voice |
| Social media SEO | Different tool category |
| International SEO | Not relevant for local studios |
| Advanced technical SEO | Too technical for audience |
| Keyword research tools | Would compete with SEMrush, not our strength |
| Rank tracking for 1000s of keywords | Overkill for local business |

---

## 13. Appendix: Technical Stack Options

### Option A: Build Custom (Recommended)
- **Pros:** Full directory integration, yoga-specific features, own the moat
- **Cons:** Longer build time, more maintenance
- **Timeline:** 8-12 weeks to MVP

### Option B: White-Label Existing Tool
- **Candidates:** BrightLocal, AgencyAnalytics, SE Ranking
- **Pros:** Faster to market, proven technology
- **Cons:** Monthly cost (~$100-300/agency), limited customization, no directory integration
- **Timeline:** 2-4 weeks to launch

### Option C: Hybrid
- White-label for scanning/tracking
- Custom dashboard with directory integration
- **Pros:** Best of both
- **Cons:** Integration complexity
- **Timeline:** 4-6 weeks

---

## 14. Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0 | Jan 24, 2026 | Initial PRD created from conversation history |

---

*Document compiled from YogaNearMe Studio Suite planning conversations (November 2025 - January 2026)*
