# The Peaceful Birth Realty

A static real estate website for [@thepeacefulbirth](https://www.instagram.com/thepeacefulbirth/), laid out like an Instagram profile:

- **Profile header** with avatar, handle, stats and bio
- **Story highlights** that filter homes (For sale, Rentals, Open house, Family homes, Just sold)
- **Posts / Open houses / Saved** tabs
- **3-column square post grid** — each listing is a post with price, beds/baths and likes on hover
- **Post modal** with a photo carousel, caption, hashtags, like/save (double-tap the photo to like) and "Book a viewing"
- About and contact sections; the contact form opens the visitor's email app (no backend needed)

## Editing content

All content lives in `js/listings.js`:

- `SITE` — name, handle, bio lines, email, phone, follower count
- `HIGHLIGHTS` — the story-highlight filters
- `LISTINGS` — one object per home/post (`status` is `sale`, `rent` or `sold`; `tags` can include `family` and `open`)

To use real photos from the Instagram posts, save them to an `images/` folder and replace the `IMG(...)` entries with paths like `"images/sage-cottage-1.jpg"`.

## Running locally

No build step. Open `index.html` in a browser, or serve the folder:

```sh
python3 -m http.server 8000
```

Deploys as-is to GitHub Pages, Netlify or any static host.
