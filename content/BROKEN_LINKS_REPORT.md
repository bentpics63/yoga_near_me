# Broken Links Report

*Last updated: January 2026*

## Summary

Audit of internal links across glossary HTML files. Issues found and status:

| Issue | Status | Action |
|-------|--------|--------|
| `yoga--defined` typo (double hyphen) | FIXED | Changed to `yoga-defined` |
| `inversions-defined` inconsistency | FIXED | Changed to `inversion-defined` in 3 files |
| Missing `asana-defined.html` | FIXED | Created in LOCKED 1.1.26/1.16 NEEDS folder |
| Missing `nadi-defined.html` | FIXED | Created in LOCKED 1.1.26/1.16 NEEDS folder |
| Missing `dharana-defined.html` | FIXED | Created in LOCKED 1.1.26/1.16 NEEDS folder |

---

## Fixed Issues

### 1. yoga--defined Typo
**File:** `glossary-hub-FINAL-template.html`
**Issue:** Double hyphen in URL (`yoga--defined`)
**Fix:** Replaced with `yoga-defined` (3 occurrences)
**Status:** COMPLETE

### 2. inversions-defined vs inversion-defined
**Issue:** Some files linked to `inversions-defined` (plural) instead of canonical `inversion-defined`
**Files Fixed:**
- `shoulderstand-sarvangasana-defined.html`
- `plow-pose-halasana-defined.html`
- `headstand-sirsasana-defined.html`
**Status:** COMPLETE

### 3. asana-defined.html Missing Page
**Issue:** 78 files referenced `asana-defined.html` which did not exist
**Fix:** Created complete page from glossary-definition-template.html
**Location:** `/content/glossary/glossary terms-hub/LOCKED 1.1.26/1.16 NEEDS/asana-defined.html`
**Status:** COMPLETE

### 4. dharana-defined.html Missing Page
**Issue:** 5 files referenced `dharana-defined.html` which did not exist
**Fix:** Created complete page with Eight Limbs context (6th limb - concentration)
**Location:** `/content/glossary/glossary terms-hub/LOCKED 1.1.26/1.16 NEEDS/dharana-defined.html`
**Status:** COMPLETE

### 5. nadi-defined.html Missing Page
**Issue:** 3 files referenced `nadi-defined.html` which did not exist
**Fix:** Created complete page covering subtle energy channels (Ida, Pingala, Sushumna)
**Location:** `/content/glossary/glossary terms-hub/LOCKED 1.1.26/1.16 NEEDS/nadi-defined.html`
**Status:** COMPLETE

---

## Link Audit Methodology

1. Extracted all internal links matching `yoganearme.info/yoga-glossary/*-defined/`
2. Cross-referenced against existing HTML files in `/content/glossary/`
3. Identified URLs with no matching file
4. Checked for typos and inconsistencies (double hyphens, plural/singular)

---

## Recommended Actions

### Immediate (This Week)
1. ~~Fix yoga--defined typo~~ DONE
2. ~~Fix inversions-defined inconsistency~~ DONE
3. ~~Create `asana-defined.html` (blocks 78 internal links)~~ DONE

### Short-term (Next 2 Weeks)
4. ~~Create `dharana-defined.html` (needed for Eight Limbs series)~~ DONE
5. ~~Create `nadi-defined.html` (philosophy content)~~ DONE

**ALL BROKEN LINKS RESOLVED as of January 2026**

### Ongoing
- Run link audit monthly
- Verify new glossary pages have correct related term links
- Ensure canonical URL patterns are consistent (singular, not plural)

---

## URL Naming Convention (Reference)

**Standard pattern:** `[term]-defined.html`
- Use singular form: `inversion-defined` not `inversions-defined`
- Use hyphens for multi-word: `yoga-nidra-defined`
- Sanskrit poses: `[english]-[sanskrit]-defined` e.g., `cobra-pose-bhujangasana-defined`
- No double hyphens

---

## Files Audited

Total glossary HTML files scanned: 100+
Unique internal glossary links found: 118
Broken links identified: 5 (5 fixed, 0 pending) ✓ ALL RESOLVED

---

*Next audit scheduled: After Eight Limbs series Phase 1 completion*
