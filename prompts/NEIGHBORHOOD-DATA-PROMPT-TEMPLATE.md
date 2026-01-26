# Neighborhood Data Generation Prompt Template

## How to Use This Template

1. Copy the prompt below
2. Replace `{{CITY}}`, `{{STATE/PROVINCE}}`, and `{{COUNTRY}}` with your target
3. Adjust `{{CITY_SIZE}}` tier (Mega/Major/Mid-size/Small)
4. Paste into Claude or your preferred LLM
5. Output is ready for direct GeoDirectory CSV import

---

## The Prompt

```
You are a Senior Local SEO Strategist specializing in the wellness and yoga studio sector. Your task is to analyze {{CITY}}, {{STATE/PROVINCE}} and produce neighborhood data optimized for YogaNearMe.info's GeoDirectory import.

## CITY CONTEXT
- **City:** {{CITY}}, {{STATE/PROVINCE}}, {{COUNTRY}}
- **City Size Tier:** {{CITY_SIZE}}
  - Mega (NYC, LA): 25-40 neighborhoods
  - Major (Denver, Austin, Seattle): 15-25 neighborhoods
  - Mid-size (Boulder, Asheville, Charleston): 8-15 neighborhoods
  - Small/Destination (Sedona, Park City): 3-6 neighborhoods

## YOUR DELIVERABLES

### 1. Strategic Market Analysis (Provide First)

Before the CSV, provide a brief strategic analysis (3-5 bullet points) covering:

- **The Powerhouse(s):** Which neighborhoods are the commercial/cultural yoga hubs?
- **The Wellness Corridor:** Where do affluent, health-conscious residents cluster?
- **Growth Opportunities:** Which neighborhoods are gentrifying or seeing millennial/family influx?
- **Creative/Niche Pockets:** Any artsy, boutique-focused areas with independent studio culture?
- **Suburban Targets:** Key affluent suburbs with boutique fitness demand?

### 2. CSV Output (GeoDirectory Import Format)

Output a CSV with these exact columns in this exact order:

```
neighbourhood_id,neighbourhood_name,neighbourhood_slug,latitude,longitude,location_id,city,region,country,meta_title,meta_description,description
```

**Column Specifications:**

| Column | Format | Notes |
|--------|--------|-------|
| `neighbourhood_id` | BLANK | Leave empty - auto-assigned on import |
| `neighbourhood_name` | Title Case | e.g., "Capitol Hill", "West Hollywood" |
| `neighbourhood_slug` | kebab-case | e.g., "capitol-hill", "west-hollywood" |
| `latitude` | Decimal | 4 decimal places, neighborhood centroid |
| `longitude` | Decimal | 4 decimal places, negative for Western Hemisphere |
| `location_id` | BLANK | Leave empty - auto-assigned on import |
| `city` | Official Name | The municipality name (may differ from neighborhood) |
| `region` | Full State/Province | e.g., "California", "British Columbia" |
| `country` | Full Country | "United States" or "Canada" |
| `meta_title` | 50-60 chars | Format: "[Neighborhood] Yoga | [Hook] - YogaNearMe" |
| `meta_description` | 150-160 chars | Include: city name, neighborhood, 1-2 yoga style keywords, intent phrase |
| `description` | 2-3 sentences | Capture: vibe, demographic, yoga scene character, local landmarks/context |

### 3. SEO Optimization Rules

**Meta Title Patterns (rotate for variety):**
- `[Neighborhood] Yoga | Best Studios & Classes - YogaNearMe`
- `[Neighborhood] Yoga Studios | Find Your Practice - YogaNearMe`
- `Yoga in [Neighborhood] | [City] Wellness - YogaNearMe`
- `[Neighborhood] [City] Yoga | [Unique Hook] - YogaNearMe`

**Meta Description Must Include:**
- The neighborhood name
- The city name
- At least one yoga style keyword (Vinyasa, Hatha, Hot Yoga, etc.)
- A call-to-action or intent phrase ("Find," "Discover," "Explore")

**Description Voice:**
- Confident but not salesy
- Mention 1-2 local landmarks, parks, or cultural touchpoints
- Reference the demographic (creative professionals, families, students, etc.)
- Describe the yoga "vibe" (boutique, community-driven, high-end, laid-back)

### 4. Quality Checklist

Before outputting, verify:
- [ ] All lat/long coordinates are accurate (verify against Google Maps)
- [ ] City names match official municipality (e.g., "Saanich" not "Victoria" for Gordon Head)
- [ ] No duplicate slugs
- [ ] Meta titles are under 60 characters
- [ ] Meta descriptions are 150-160 characters
- [ ] Descriptions feel locally authentic, not generic

## OUTPUT FORMAT

First, provide the Strategic Market Analysis as bullet points.

Then output the complete CSV starting with the header row, ready for copy/paste into a .csv file.

---

Now analyze {{CITY}}, {{STATE/PROVINCE}}, {{COUNTRY}} and produce the neighborhood data.
```

---

## Example Filled Prompt (Denver)

```
You are a Senior Local SEO Strategist specializing in the wellness and yoga studio sector. Your task is to analyze Denver, Colorado and produce neighborhood data optimized for YogaNearMe.info's GeoDirectory import.

## CITY CONTEXT
- **City:** Denver, Colorado, United States
- **City Size Tier:** Major (15-25 neighborhoods)

[Rest of prompt continues...]
```

---

## City Size Quick Reference

| Tier | Neighborhoods | Example Cities |
|------|---------------|----------------|
| **Mega** | 25-40 | NYC, LA, Chicago, Toronto |
| **Major** | 15-25 | Denver, Austin, Seattle, Portland, Vancouver, Atlanta, Phoenix |
| **Mid-size** | 8-15 | Boulder, Asheville, Charleston, Madison, Providence, Victoria |
| **Small/Destination** | 3-6 | Sedona, Park City, Maui, Santa Fe, Bend |

---

## Post-Processing Checklist

After receiving the output:

1. **Verify coordinates** - Spot-check 2-3 lat/longs in Google Maps
2. **Check character counts** - Ensure meta_title < 60, meta_description 150-160
3. **Review city assignments** - Suburbs should map to correct municipality
4. **Save as UTF-8 CSV** - Required for special characters (é, ñ, etc.)
5. **Import to GeoDirectory** - Use the Neighborhoods import tool

---

## Tracking Spreadsheet

Maintain a master list of completed cities:

| City | State/Province | Country | Neighborhoods | Date Completed | Notes |
|------|----------------|---------|---------------|----------------|-------|
| Los Angeles | California | United States | 35 | 2025-12-01 | Includes OC |
| Denver | Colorado | United States | 22 | 2026-01-10 | Metro complete |
| Victoria | British Columbia | Canada | 18 | 2026-01-23 | CRD included |

---

## Version History

- **v1.0** (2026-01-23): Initial template created
