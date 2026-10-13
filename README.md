# The Peaceful Birth · Doula website

A business website for [@thepeacefulbirth](https://www.instagram.com/thepeacefulbirth/) — doula support
and birth classes helping couples achieve a positive birth experience. Content follows her Instagram
posts ("Signs that tell you that you need a doula in your birth team", "Birth Support Service",
"How to work with me", client testimonies / story time) and her earthy terracotta palette.

## Sections

Hero · Signs you need a doula · Services (Birth Classes, Doula Support, Consultation) ·
How to work with me · About · Testimonials + Instagram · FAQ · Booking form · Floating WhatsApp button

## Editing

- **Contact details** — top of `js/main.js` (`CONTACT.whatsapp`, `instagram`, `email`).
  The booking form opens WhatsApp with the visitor's details filled in.
- **Photos** — add `images/doula.jpg` (hero, portrait ~4:5) and `images/about.jpg` (about section).
  Until then, an illustrated placeholder is shown.
- **Text, services, testimonials, FAQ** — edit directly in `index.html`.

## Running / hosting

No build step: open `index.html`, or `python3 -m http.server 8000`.
GitHub Pages: Settings → Pages → Deploy from a branch → this branch, `/ (root)`.

## Google review page (`review.html`)

A page to send clients after their birth: `https://shiftedtech.github.io/thepeacefulbirth/review.html`

1. In **Google Business Profile** → **Ask for reviews**, copy the review link (`https://g.page/r/…/review`).
2. Paste it into `GOOGLE_REVIEW_URL` near the bottom of `review.html`.
3. Share the page link on WhatsApp/Instagram, or tap **Print QR** for thank-you cards.

Every client is sent straight to Google — the page does not filter out lower ratings, which Google's review policy does not allow.
