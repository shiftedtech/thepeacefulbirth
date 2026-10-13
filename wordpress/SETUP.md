# The Peaceful Birth — WordPress setup guide

Three steps: **(1) install the theme, (2) give the owner her own login, (3) add visitor stats.**
You stay the Administrator; she gets an Editor login with her Gmail.

---

## Before you start: choose hosting

The theme is a custom upload, so you need a host that allows custom themes and plugins:

| Option | Works? | Notes |
|---|---|---|
| **Self-hosted WordPress** (Hostinger, Exabytes, SiteGround …) | ✅ | Cheapest. Use the host's "1-click WordPress install". |
| **WordPress.com — Business plan or higher** | ✅ | Custom themes and plugins are allowed from Business up. |
| WordPress.com Free / Personal / Premium | ❌ | Can't upload themes or install plugins. |

---

## Step 1 — Install the theme

1. Log in to `yoursite.com/wp-admin` as the admin.
2. **Appearance → Themes → Add New Theme → Upload Theme** → choose `peaceful-birth.zip` → **Install Now** → **Activate**.
   - A **Home** page and a **Leave a Review** page are created automatically, and Home becomes the front page.
3. **Appearance → Customize → Peaceful Birth settings**, then fill in:
   - WhatsApp number (with country code, e.g. `60123456789`)
   - Email, Instagram link
   - **Google review link**: Google Business Profile → *Ask for reviews* → copy (`https://g.page/r/…/review`)
   - Click **Publish**.
4. **Site Identity** (same Customize screen): site title, optional logo, and a **Site Icon** (browser tab icon).
5. **Pages → Home → Edit**: change any text, and click each illustration → **Replace** to upload her real photos.
   - Deleted a section by mistake? Click **+** → **Patterns** → **Peaceful Birth** to add it back.
   - Button links can be `#whatsapp`, `#instagram`, `#review` or `#contact`. They use the links from step 3.

**The review link to give clients:** `yoursite.com/review/`

---

## Step 2 — Give the owner her own login (with her Gmail)

1. **Users → Add New User**
   - Username: e.g. her name
   - Email: **her Gmail address**
   - Role: **Editor**. She can edit all pages, posts and photos, but can't change the theme or plugins, or remove you.
   - Tick **Send the new user an email**, then click **Add New User**.
2. She receives an email to set her password, then logs in at `yoursite.com/wp-admin`.
3. **Optional "Sign in with Google" button** (self-hosted / Business plan):
   - **Plugins → Add New** → search **Nextend Social Login** → Install → Activate.
   - Follow the plugin's Google setup guide: create OAuth credentials in Google Cloud Console and paste the Client ID and Secret.
   - Because her WordPress account uses her Gmail address, "Continue with Google" logs her straight into that account.
   - On WordPress.com, accounts already support "Continue with Google". Invite her via **Users → Add New** with her Gmail, then she signs in with Google.

The dashboard has a **"The Peaceful Birth — getting started"** box with shortcuts to all of this.

---

## Step 3 — Visitor stats she can see (Site Kit by Google)

1. **Plugins → Add New** → search **Site Kit by Google** → Install → Activate.
2. Click **Start setup** and sign in with the Google account that should own the data.
   Connect **Search Console** and **Analytics** when asked.
3. Let her see the stats without being an admin:
   **Site Kit → Dashboard → Share (icon at the top)** → tick **Editor** for Search Console and Analytics → **Apply**.
4. She now sees visitors, top pages and Google searches on her dashboard.

---

## Who owns what (recommended)

| Thing | Owner | You |
|---|---|---|
| WordPress site | **You** (Administrator) | — |
| Google Business Profile (reviews) | **Her** (Owner) | Manager |
| Instagram, WhatsApp | Her | — |

That way she keeps her reviews and listing even if your work together ends.
