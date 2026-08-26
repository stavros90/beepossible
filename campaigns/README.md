# Campaign landing pages

Everything an advertising landing page needs lives in this folder. Nothing here
loads on the rest of the site, and nothing here should reach outside it — that
isolation is the whole point, and it is what keeps the theme sane at ten
campaigns instead of one.

```
campaigns/
  shared/
    header.php          chrome: no navigation, logo scrolls to top
    footer.php          chrome: sticky CTA, contact details, privacy link
    parts/              reusable sections and elements
  websites/
    index.php           one campaign = one folder = one template file
  360-marketing-partner/
    index.php
```

Styles mirror this exactly, under `assets/styles/campaigns/`:

| PHP | SCSS |
| --- | --- |
| `shared/parts/faq.php` | `parts/_faq.scss` |
| `shared/header.php`, `shared/footer.php` | `_chrome.scss` |
| `websites/index.php` | `pages/_websites.scss` |
| `360-marketing-partner/index.php` | `pages/_360-marketing-partner.scss` |

Behaviour lives in one file: `assets/scripts/modules/campaign.js`. It exits
immediately when `.campaign` is not on the page, so it costs the rest of the
site nothing.

---

## Adding a campaign

1. **Create the folder and template.**

   ```
   campaigns/black-friday/index.php
   ```

   ```php
   <?php
   /**
    * Template Name: Campaign — Black Friday
    */

   bp_campaign_register( [
     'name'             => 'black-friday',
     'faqs'             => $faqs,
     'endpoint'         => 'https://formcarry.com/s/…',
     'whatsapp'         => false, // one switch for every WhatsApp link on the page
     'whatsapp_message' => 'Hi Bee Possible, I saw your Black Friday offer.',
   ] );

   bp_campaign_header();
   ?>

   <main class="campaign-main" id="top">
     <?php
     bp_campaign_part( 'hero', [ /* … */ ] );
     bp_campaign_part( 'enquire', [ /* … */ ] );
     ?>
   </main>

   <?php bp_campaign_footer(); ?>
   ```

2. **Add a stylesheet only if the campaign needs an override.** Create
   `assets/styles/campaigns/pages/_black-friday.scss`, scope it to
   `.campaign--black-friday`, and add one `@use` line to
   `assets/styles/campaigns/_index.scss`. Most campaigns need nothing here.

3. **Rebuild the CSS.** `npm run build` (or `npm start` while working). The
   compiled stylesheet is the build output — editing `style.css` does nothing.

4. **Publish.** Create a page in WordPress and pick the template under
   *Page Attributes → Template*. The template appears there automatically:
   `includes/campaign.php` scans this folder and registers whatever it finds,
   which is what allows a folder per campaign at all — WordPress on its own
   only looks one level deep.

Nothing else in the theme changes. No new file at the theme root, no new
partial in `/partials`.

---

## The parts

Call them with `bp_campaign_part( $name, $args )`. Each renders its own
`<section>`, so a campaign template is a list of sections and their copy.
Pass `'bg' => 'paper' | 'white' | 'dark'` to control the alternating rhythm.

| Part | What it is |
| --- | --- |
| `hero` | Eyebrow, headline, one paragraph, CTA + WhatsApp, optional visual slot |
| `devices` | The hero visual: a ready-made mockup via `image`, or a case study assembled onto a laptop with a phone beside it |
| `proof` | One yellow line of social proof under the hero |
| `cards` | Three-ish points. `variant: 'rule'` for problems, `'pillar'` for benefits |
| `work` | Portfolio grid. Curated mockups via `items`, or queried live from case studies |
| `logos` | Auto-scrolling strip of every client logo. CSS only, no JS, never pauses |
| `case-studies` | Written proof: client, service, one result, a short body, a quote. Each card reserves an image slot |
| `process` | Numbered steps |
| `testimonials` | Two or three written reviews, typed into the part itself |
| `faq` | Accordion, rendered from the same array as the FAQPage schema |
| `enquire` | Final CTA and the lead form. Always carries `#enquire` |
| `browser` | The browser frame on its own |
| `form` | The lead form on its own |
| `whatsapp-link` | Click-to-chat link |

Every part takes its copy as arguments. Nothing is pulled from ACF or the WP
editor except the case studies in `work` and `devices`, so a campaign reads
top to bottom in one file and cannot be broken by someone editing a page.

### Testimonials

Two or three written reviews in a row. The text is typed straight into
`shared/parts/testimonials.php` — no arguments, no review library, no video:

```php
bp_campaign_part( 'testimonials' );
```

Open the part, replace the placeholder text in each `<figure>`, and delete a
whole `<figure>` block if you only want two. The grid fits whatever is left.

### The work grid

Two ways to fill it. Pass `items` and you get a curated grid, two cards to a
row, built from the ready-made device mockups in `assets/images/campaigns`:

```php
bp_campaign_part( 'work', [
  'items' => [
    [
      'image'  => 'assets/images/campaigns/amira-com-cy.webp',
      'title'  => 'Amira',
      'sector' => 'Construction & development',
    ],
    // …
  ],
] );
```

Those files are composed artwork — browser chrome and phone are already in the
image — so they are shown whole and never wrapped in the `browser` part. Export
new ones at **2400 × 1260**. A row whose file is missing is dropped rather than
rendered broken.

Leave `items` out and the part queries case studies instead, three to a row,
inside our own browser frames.

An odd number of `items` centres the last card rather than stranding it in a
half-empty row, so five reads as finished.

### Case study card images

Each card reserves a 3:2 slot at the top. Leave `image` out and it renders as an
outlined box reading "Image to come" — that box is the brief for whoever is
making the artwork, and it holds its space so filling it later shifts nothing:

```php
bp_campaign_part( 'case-studies', [
  'items' => [
    [
      'client'  => 'Dior Cyprus',
      'service' => 'Event production',
      'image'   => 'assets/images/campaigns/case-dior.webp', // optional
      'result'  => '+171% Instagram growth',                 // or 'tagline'
      'text'    => '…',
    ],
  ],
] );
```

Export at **1200 × 800** into `assets/images/campaigns`. A path pointing at a
file that isn't there falls back to the empty box rather than rendering broken.

Use `result` when there is a number and `tagline` when there isn't — work whose
value isn't a percentage still needs a headline.

### The hero visual

`devices` takes the same two sources. Pass `image` and the mockup fills the hero
whole — no frame, and no case study needs to exist:

```php
bp_campaign_part( 'devices', [
  'image' => 'assets/images/campaigns/bee-possible-marketing.webp',
  'alt'   => 'The Bee Possible website on a laptop and a phone',
], true );
```

Leave `image` out and it assembles a case study into our own laptop with a phone
beside it. That path picks the most recent case study with a featured image,
which is not necessarily a website — pin one with `post_id` if you use it.

Either way the hero image is the page's LCP, so it renders `eager` with
`fetchpriority="high"`. Don't set `'eager' => false` on a hero.

---

## Rules worth keeping

- **One conversion path.** The only outbound links are the privacy policy and
  WhatsApp. Everything else points at `#enquire`.
- **WhatsApp is one switch, not three.** `'whatsapp' => false` in
  `bp_campaign_register()` hides the hero link, the final-CTA aside and the
  sticky-bar button together. The websites campaign has it off until the
  business number in `includes/campaign.php` is confirmed.
- **A browser frame is a claim.** It says what's inside is the live site, so
  `bp_campaign_shot()` only shows the address bar and scrolls the image when
  there is a real screenshot on the case study.
- **Placeholders should look unfinished.** The pending video renders with a
  dashed outline on purpose. Nothing half-done should be shippable by accident.
- **Reviews are quoted, not written.** Paste what the client said.
