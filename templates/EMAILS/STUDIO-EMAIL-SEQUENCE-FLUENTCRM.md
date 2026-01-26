# Studio Email Sequence - FluentCRM Format

## Setup in FluentCRM

### Tags to Create
- `studio-owner`
- `profile-incomplete`
- `no-photos`
- `no-intro-offer`
- `retreat-interest`
- `nurture-sequence`

### Lists to Create
- **Studio Owners** - All claimed studios
- **Onboarding** - Currently in welcome sequence

### Automations to Create
1. Welcome Sequence (triggered by: tag added `studio-owner`)
2. Photo Nudge (triggered by: 2 days after welcome, if tag `no-photos`)
3. Intro Offer (triggered by: 5 days after welcome, if tag `no-intro-offer`)

---

## EMAIL 1: WELCOME

**Automation Trigger:** Tag added: `studio-owner`
**Send Timing:** Immediately
**Subject:** You're live on YogaNearMe
**Preview Text:** Students in {{city}} can now find you.

---

**Email Body (HTML):**

```html
<p>{{studio_name}},</p>

<p>You're listed. Students searching for yoga in {{city}} can now find you.</p>

<p><strong>Your listing is live:</strong> <a href="{{listing_url}}">View My Listing</a></p>

<p>A few things worth knowing:</p>

<p><strong>You're already in search results.</strong> No waiting period, no approval queue. Someone searching "yoga near me" in your area sees you now.</p>

<p><strong>Complete profiles perform better.</strong> Right now yours is {{profile_completion}}% complete. Studios with photos, an intro offer, and a clear one-sentence identity get more inquiries. The ones without get scrolled past.</p>

<p><strong>We don't charge for listings.</strong> YogaNearMe is free for studios. We're building a directory that actually helps students find good teaching—not another platform extracting fees.</p>

<p>If you have 5 minutes, add a photo and an intro offer. That's the fastest way to move from "listed" to "found."</p>

<p><a href="{{edit_listing_url}}" style="display: inline-block; background: #61948B; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">Complete My Profile</a></p>

<p>— The YogaNearMe Team</p>
```

**Custom Fields Needed:**
- `{{studio_name}}` - From GD listing
- `{{city}}` - From GD listing
- `{{listing_url}}` - Permalink
- `{{edit_listing_url}}` - Frontend edit link
- `{{profile_completion}}` - Calculated percentage

---

## EMAIL 2: PHOTO NUDGE

**Automation Trigger:** 2 days after Email 1
**Condition:** Contact has tag `no-photos`
**Skip If:** Profile completion > 70%
**Subject:** The one thing that gets students to click
**Preview Text:** It's not your schedule or your prices.

---

**Email Body (HTML):**

```html
<p>Quick one.</p>

<p>We looked at what makes students click on a studio listing. The answer wasn't class variety, pricing, or location.</p>

<p>It was photos.</p>

<p>Listings with at least one photo get 2.3x more clicks than those without. Three or more? 4x.</p>

<p>Students want to know what they're walking into. A photo of your space—even from a phone—answers the question "will I feel comfortable here?" before they have to ask.</p>

<p>Your listing currently has no photos.</p>

<p><a href="{{edit_listing_url}}" style="display: inline-block; background: #61948B; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">Add a Photo</a></p>

<p>Doesn't need to be professional. Authentic beats polished.</p>

<p>— YogaNearMe</p>

<p style="color: #6B7C78; font-size: 14px;"><strong>P.S.</strong> What works: your practice room with natural light, your entrance (so students recognize it), and one shot that captures the feel—students mid-practice, an altar, whatever's true to your space.</p>
```

**After Send:** Remove tag `no-photos` if they add photo (via webhook or manual)

---

## EMAIL 3: INTRO OFFER

**Automation Trigger:** 5 days after Email 1
**Condition:** Contact has tag `no-intro-offer`
**Subject:** Why students leave without booking
**Preview Text:** The hesitation happens at the same moment every time.

---

**Email Body (HTML):**

```html
<p>Here's how most students choose a new studio:</p>

<ol>
<li>Search "yoga near me"</li>
<li>See several options</li>
<li>Click the one that looks interesting</li>
<li>Look for a new student deal</li>
<li>If there isn't one, go back to step 2</li>
</ol>

<p>That's the decision path. The hesitation is at step 4.</p>

<p><strong>Studios with intro offers convert 3x better</strong> than those without. Not because students are bargain-hunting—because trying something new feels risky. An intro offer lowers the barrier.</p>

<p>You don't have one on your listing yet. Here's what works:</p>

<ul>
<li><strong>"First Class Free"</strong> — lowest friction</li>
<li><strong>"2 Weeks Unlimited for $40"</strong> — attracts students who'll commit</li>
<li><strong>"$30 for 30 Days"</strong> — good middle ground</li>
</ul>

<p>You can limit it: "First-time visitors only" or "Local residents" keeps it from being abused.</p>

<p><a href="{{edit_listing_url}}#intro-offer" style="display: inline-block; background: #bd371a; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">Add an Intro Offer</a></p>

<p>One field. Takes 10 seconds.</p>

<p>— YogaNearMe</p>
```

---

## EMAIL 4: FIRST STUDENT (Day 10)

**Automation Trigger:** 10 days after Email 1
**Condition:** All studio owners
**Subject:** "I found them on YogaNearMe"
**Preview Text:** What we're hearing from studios.

---

**Email Body (HTML):**

```html
<p>Wanted to share something we heard last week.</p>

<p>A studio owner in {{nearby_city}} told us a new student came in and said, "I found you on YogaNearMe—your intro offer got me in the door."</p>

<p>That's the entire point.</p>

<p>We're not building another Yelp where you pay to avoid being buried. We're not Mindbody trying to own your student relationships. We're a directory that does one job: help students find studios they'll actually return to.</p>

<p>You're part of that now.</p>

<p>A few studios have asked what they can do to get more visibility. The honest answer:</p>

<ol>
<li><strong>Complete your profile.</strong> Photos, intro offer, vibe tags. Students filter by these.</li>
<li><strong>Keep your hours current.</strong> Nothing loses trust faster than a student showing up to a closed door.</li>
<li><strong>Ask happy students to leave a Google review.</strong> We pull those ratings automatically.</li>
</ol>

<p>That's it. No algorithm to game. No ads to buy.</p>

<p><a href="{{listing_url}}" style="display: inline-block; background: #5F7470; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">Check My Listing</a></p>

<p>— YogaNearMe</p>
```

**Dynamic Field:** `{{nearby_city}}` - Major city in their state/region

---

## EMAIL 5: HOW'S IT GOING (Day 21)

**Automation Trigger:** 21 days after Email 1
**Condition:** All studio owners
**From Name:** Eddie (personal)
**Reply-To:** eddie@yoganearme.info
**Subject:** Quick question
**Preview Text:** How's your listing working?

---

**Email Body (HTML):**

```html
<p>You've been on YogaNearMe for about three weeks. Checking in.</p>

<p><strong>Have you seen any new students come through?</strong></p>

<p>We're building this based on what actually helps studios grow—not what we assume might work. Your feedback matters more than you'd guess.</p>

<p>Reply and tell me:</p>

<ul>
<li>Have any students mentioned finding you here?</li>
<li>Is there anything about your listing you wish you could change?</li>
<li>What would make this more useful?</li>
</ul>

<p>No form. Just reply. I read every one.</p>

<p>— Eddie<br>
Co-founder, YogaNearMe</p>

<p style="color: #6B7C78; font-size: 14px;"><strong>P.S.</strong> If you haven't seen results yet, that's useful to know too.</p>
```

---

## EMAIL 6: WAKE UP (Day 45)

**Automation Trigger:** 45 days after Email 1
**Condition:** Profile completion < 70% AND no login in 30 days
**Subject:** Still there?
**Preview Text:** Your listing is live but incomplete.

---

**Email Body (HTML):**

```html
<p>{{studio_name}},</p>

<p>Your YogaNearMe listing is still live—students can find you in search. But it's {{profile_completion}}% complete, which means you're likely getting passed over.</p>

<p>Here's the reality: students decide in seconds. They see a list of studios. The ones with photos, intro offers, and a clear identity get clicked. The others don't.</p>

<p>Right now your listing is in the second category.</p>

<p>If you've got 5 minutes:</p>

<ol>
<li>Add one photo (phone shot is fine)</li>
<li>Set an intro offer (even "First Class Free")</li>
<li>Write one sentence: why do students choose you?</li>
</ol>

<p><a href="{{edit_listing_url}}" style="display: inline-block; background: #bd371a; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">Fix My Listing</a></p>

<p>If YogaNearMe isn't the right fit for how you find students, no problem—reply and I'll remove you from these emails.</p>

<p>— Eddie</p>
```

---

## TRIGGERED: FIRST OFFER CLICK

**Trigger:** Webhook from GA4 or custom tracking when first `claim_offer_click` event fires
**Subject:** Someone just clicked your intro offer
**Preview Text:** A student in {{city}} is interested.

---

**Email Body (HTML):**

```html
<p>Heads up—a student just clicked "Claim Offer" on your listing.</p>

<p>They saw your intro offer ("{{intro_offer}}") and wanted to learn more. Whether they book or not, that's a real person in your area looking for a studio.</p>

<p>A few things that help convert interest into attendance:</p>

<ul>
<li><strong>Respond quickly</strong> if they reached out directly</li>
<li><strong>Make booking easy</strong>—if your website takes 5 clicks to book, you'll lose people</li>
<li><strong>Honor the offer</strong>—nothing kills trust like showing up and being told it doesn't apply</li>
</ul>

<p>More clicks usually follow the first. Keep an eye on your listing.</p>

<p><a href="{{listing_url}}" style="display: inline-block; background: #5F7470; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">View My Listing</a></p>

<p>— YogaNearMe</p>
```

---

## TRIGGERED: PROFILE COMPLETE (100%)

**Trigger:** `profile_completion` field = 100
**Subject:** Your profile is complete
**Preview Text:** You're now in the top 20% of studios on YogaNearMe.

---

**Email Body (HTML):**

```html
<p>Your YogaNearMe profile is now 100% complete.</p>

<p>That puts you in the top 20% of studios on the platform. Students searching in {{city}} see the full picture—who you are, what you offer, why they should visit.</p>

<p><strong>What this means:</strong></p>

<ul>
<li>You appear in more filtered searches (because you have the data students filter by)</li>
<li>Your intro offer shows on search results, not just your profile</li>
<li>Your "why students love us" line shows on your card</li>
</ul>

<p>Keep your hours current and encourage happy students to leave Google reviews. We pull those in automatically.</p>

<p><a href="{{listing_url}}" style="display: inline-block; background: #61948B; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">View My Listing</a></p>

<p>— YogaNearMe</p>
```

---

## FluentCRM Custom Fields Setup

Create these custom fields for contacts:

| Field Name | Field Key | Type |
|------------|-----------|------|
| Studio Name | `studio_name` | Text |
| City | `city` | Text |
| Listing URL | `listing_url` | URL |
| Edit Listing URL | `edit_listing_url` | URL |
| Profile Completion | `profile_completion` | Number |
| Intro Offer | `intro_offer` | Text |
| Listing ID | `listing_id` | Number |
| Last Login | `last_login` | Date |

---

## Sync with GeoDirectory

When a studio claims their listing:

1. Create contact in FluentCRM
2. Add to "Studio Owners" list
3. Add tag `studio-owner`
4. Add tag `nurture-sequence`
5. Populate custom fields from GD listing
6. Conditionally add `no-photos`, `no-intro-offer`, `profile-incomplete` tags

**PHP Hook Location:** In `NINJA-FORMS-TO-GEODIRECTORY.php` after successful save, add FluentCRM API calls.
