# The Peaceful Birth · Doula

A static website promoting a birth & postpartum doula business, laid out like the
[@thepeacefulbirth](https://www.instagram.com/thepeacefulbirth/) Instagram profile:

- **Profile header** — avatar, handle, stats, bio and "Book a consult" button
- **Story highlights** that filter posts: Birth tips, Services, Birth stories, Postpartum, Kind words
- **Posts / Kind words / Saved** tabs
- **3-column post grid** — designed quote/tip cards (drawn in CSS, no images needed) mixed with photo posts
- **Post pop-up** with caption, hashtags, like/save (double-tap to like) and "Book a free consultation"
- **Services & pricing**, an About section, FAQ, and a consultation form (due date, birth place, service) that opens the visitor's email app — no backend needed

## Editing content

Everything lives in `js/content.js`:

- `SITE` — name, handle, bio lines, email, phone, service area, stats
- `HIGHLIGHTS` — the story-highlight categories
- `POSTS` — grid posts. `type: "card"` posts are text graphics (`theme`: sage, clay, cream, blush, ink); `type: "photo"` posts use `image`
- `SERVICES` — packages and prices
- `FAQ` — question/answer pairs

To use real photos from Instagram, save them to an `images/` folder and set `image: "images/your-photo.jpg"`.

## Running locally

No build step. Open `index.html`, or run `python3 -m http.server 8000` in this folder.

## GitHub Pages

Settings → Pages → Deploy from a branch → pick this branch and `/ (root)`.
