# Review Monitor — Product Exploration

**Status:** Exploration (Not yet in development)
**Source:** Claude.ai conversation notes (Jan 2026)
**Bundle:** Growth Suite ($99/mo)

---

## Concept

Aggregate and manage reviews from multiple platforms in one dashboard. Help studios respond faster and track reputation over time.

**Problem:** Studios get reviews on Google, Yelp, Facebook, and MindBody. Checking each platform is tedious. Many reviews go unanswered, hurting reputation.

**Solution:** One dashboard to see all reviews + smart response suggestions + alerts for new reviews.

---

## Potential Features

### Aggregation
- Pull reviews from Google, Yelp, Facebook, MindBody/WellnessLiving
- Unified dashboard view
- Filter by platform, rating, date, response status
- Search reviews by keyword

### Alerts
- Instant notification when new review arrives
- Priority alerts for negative reviews (< 3 stars)
- Daily/weekly digest option
- SMS alert for urgent reviews

### Response Tools
- Pre-written response templates (positive, neutral, negative)
- AI-generated personalized responses
- One-click post to platform (where API allows)
- Response time tracking

### Analytics
- Review velocity over time
- Average rating trend
- Sentiment analysis
- Competitor review comparison (from YogaNearMe data)

---

## Why This Matters

- Studios with 80%+ response rates appear more trustworthy
- Negative reviews left unanswered hurt conversions
- Response time matters—fast responses show engagement
- Review velocity is a ranking factor

---

## Technical Considerations

- Google Business Profile API for Google reviews
- Yelp Fusion API (read-only, limited)
- Facebook Graph API for page reviews
- MindBody/WellnessLiving API integration
- Response posting may be limited by platform TOS

---

## Competitive Landscape

| Tool | Price | Notes |
|------|-------|-------|
| BirdEye | $299+/mo | Enterprise-focused, overkill for studios |
| Podium | $399+/mo | Expensive, SMS-heavy |
| ReviewTrackers | $49+/mo | More accessible, but not yoga-specific |

**Our angle:** Yoga-specific, integrated with directory, affordable for small studios

---

## Open Questions

1. Which platforms can we actually post responses to via API?
2. Yelp API restrictions—can we show Yelp reviews at all?
3. Standalone product or always bundled?
4. How deep on sentiment analysis?

---

## Next Steps

- [ ] Research platform API capabilities and restrictions
- [ ] Validate demand with 10 studio owner interviews
- [ ] Define MVP feature set (start with read-only aggregation?)
- [ ] Estimate build time and cost

---

*Created: Jan 24, 2026*
*From: Claude.ai conversation about Visibility Optimizer bundle*
