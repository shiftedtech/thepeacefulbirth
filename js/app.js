(() => {
  const $ = (sel) => document.querySelector(sel);

  const store = {
    get(key) {
      try { return JSON.parse(localStorage.getItem(key)) || []; } catch { return []; }
    },
    set(key, value) {
      try { localStorage.setItem(key, JSON.stringify(value)); } catch { /* storage unavailable */ }
    },
  };

  const state = {
    filter: "all",
    liked: new Set(store.get("tpb-liked")),
    saved: new Set(store.get("tpb-saved")),
    current: null,
  };

  const categoryLabel = Object.fromEntries(HIGHLIGHTS.map((h) => [h.id, h.label]));
  const initials = SITE.name.split(/\s+/).filter((w) => /^[A-Z]/.test(w) && w !== "The").slice(0, 2).map((w) => w[0]).join("");
  const likes = (p) => p.likes + (state.liked.has(p.id) ? 1 : 0);

  // ---------- profile & static sections ----------
  function renderProfile() {
    $("#brand").textContent = SITE.name;
    $("#avatar-initials").textContent = initials;
    $("#handle").textContent = SITE.handle;
    $("#name").textContent = SITE.name;
    $("#tagline").textContent = SITE.tagline;
    $("#bio").innerHTML = SITE.bio.map((line) => `<p>${line}</p>`).join("");
    $("#stat-posts").textContent = POSTS.length;
    $("#stat-followers").textContent = SITE.followers;
    $("#stat-births").textContent = SITE.births;
    $("#ig-link").href = SITE.instagram;
    $("#footer-ig").href = SITE.instagram;
    $("#footer-ig").textContent = "@" + SITE.handle;
    $("#footer-name").textContent = SITE.name;
    $("#year").textContent = new Date().getFullYear();
    $("#contact-email").href = "mailto:" + SITE.email;
    $("#contact-email").textContent = SITE.email;
    $("#contact-phone").href = "tel:" + SITE.phone.replace(/[^\d+]/g, "");
    $("#contact-phone").textContent = SITE.phone;
    $("#contact-area").textContent = SITE.area;

    $("#services-list").innerHTML = SERVICES.map((s) => `
      <article class="service ${s.featured ? "service--featured" : ""}">
        ${s.featured ? `<span class="service__flag">Most booked</span>` : ""}
        <h3>${s.name}</h3>
        <p class="service__price">${s.price}</p>
        <p class="service__blurb">${s.blurb}</p>
        <ul>${s.items.map((i) => `<li>${i}</li>`).join("")}</ul>
        <a href="#contact" class="btn ${s.featured ? "" : "btn--ghost"} btn--wide" data-service="${s.name}">Enquire</a>
      </article>`).join("");
    $("#service-select").innerHTML += SERVICES.map((s) => `<option>${s.name}</option>`).join("");

    $("#faq-list").innerHTML = FAQ.map(([q, a]) => `
      <details><summary>${q}</summary><p>${a}</p></details>`).join("");
  }

  function renderHighlights() {
    $("#highlights").innerHTML = HIGHLIGHTS.map((h) => `
      <button class="highlight ${h.id === state.filter ? "is-active" : ""}" data-filter="${h.id}">
        <span class="highlight__ring"><span class="highlight__circle">${h.emoji}</span></span>
        <span class="highlight__label">${h.label}</span>
      </button>`).join("");
  }

  // ---------- post visuals ----------
  // Text posts are drawn with HTML/CSS, like the quote and tip graphics on the Instagram grid.
  function cardHTML(p) {
    let body = "";
    if (p.quote) body = `<p class="card__quote">“${p.quote}”</p><p class="card__author">${p.author}</p>`;
    else if (p.list) body = `<h3 class="card__headline">${p.headline}</h3><ol class="card__list">${p.list.map((i) => `<li>${i}</li>`).join("")}</ol>`;
    else body = `<h3 class="card__headline">${p.headline}</h3>${p.sub ? `<p class="card__sub">${p.sub}</p>` : ""}`;
    return `<div class="card card--${p.theme}">
      <span class="card__kicker">${p.kicker}</span>
      <div class="card__body">${body}</div>
      <span class="card__handle">@${SITE.handle}</span>
    </div>`;
  }

  function mediaHTML(p) {
    return p.type === "card"
      ? cardHTML(p)
      : `<div class="photo"><img src="${p.image}" alt="${p.title}" loading="lazy" /><span class="photo__fallback">${p.title}</span></div>`;
  }

  // Image hosts can fail; fall back to a soft branded tile instead of a broken icon.
  function attachImageFallbacks(root) {
    root.querySelectorAll("img").forEach((img) => {
      img.addEventListener("error", () => img.closest(".photo").classList.add("is-broken"), { once: true });
    });
  }

  // ---------- grid ----------
  function matches(p) {
    if (state.filter === "all") return true;
    if (state.filter === "saved") return state.saved.has(p.id);
    return p.category === state.filter;
  }

  function renderGrid() {
    const items = POSTS.filter(matches);
    $("#empty").hidden = items.length > 0;
    $("#feed").innerHTML = items.map((p) => `
      <button class="tile" data-id="${p.id}" aria-label="${p.title}">
        ${mediaHTML(p)}
        <span class="tile__overlay">
          <span>♥ ${likes(p).toLocaleString()}</span>
        </span>
      </button>`).join("");
    attachImageFallbacks($("#feed"));
  }

  function setFilter(filter) {
    state.filter = filter;
    renderHighlights();
    document.querySelectorAll(".tab").forEach((t) => {
      const on = t.dataset.tab === filter || (t.dataset.tab === "all" && !["reviews", "saved"].includes(filter));
      t.classList.toggle("is-active", on);
    });
    renderGrid();
  }

  // ---------- modal ----------
  function openPost(id) {
    const p = POSTS.find((x) => x.id === id);
    if (!p) return;
    state.current = p;
    $("#post-media").innerHTML = mediaHTML(p);
    attachImageFallbacks($("#post-media"));
    $("#post-avatar").textContent = initials;
    $("#post-handle").textContent = SITE.handle;
    $("#post-category").textContent = categoryLabel[p.category] || "";
    $("#post-title").textContent = p.title;
    $("#post-caption").innerHTML = `<strong>${SITE.handle}</strong> ${p.caption}`;
    $("#post-tags").textContent = p.tags.map((t) => "#" + t).join(" ");
    renderPostActions();
    $("#modal").hidden = false;
    document.body.classList.add("no-scroll");
    $(".modal__close").focus();
  }

  function renderPostActions() {
    const p = state.current;
    $("#post-like").classList.toggle("is-on", state.liked.has(p.id));
    $("#post-save").classList.toggle("is-on", state.saved.has(p.id));
    $("#post-likes").textContent = `${likes(p).toLocaleString()} likes`;
  }

  function closePost() {
    $("#modal").hidden = true;
    document.body.classList.remove("no-scroll");
  }

  function toggle(setName, storageKey) {
    const set = state[setName];
    const id = state.current.id;
    set.has(id) ? set.delete(id) : set.add(id);
    store.set(storageKey, [...set]);
    renderPostActions();
    renderGrid();
  }

  // ---------- events ----------
  $("#highlights").addEventListener("click", (e) => {
    const btn = e.target.closest("[data-filter]");
    if (btn) setFilter(btn.dataset.filter);
  });
  $("#tabs").addEventListener("click", (e) => {
    const btn = e.target.closest("[data-tab]");
    if (btn) setFilter(btn.dataset.tab);
  });
  $("#feed").addEventListener("click", (e) => {
    const tile = e.target.closest(".tile");
    if (tile) openPost(Number(tile.dataset.id));
  });
  $("#services-list").addEventListener("click", (e) => {
    const link = e.target.closest("[data-service]");
    if (link) $("#service-select").value = link.dataset.service;
  });

  $("#modal").addEventListener("click", (e) => {
    if (e.target.closest("[data-close]")) closePost();
  });
  $("#post-like").addEventListener("click", () => toggle("liked", "tpb-liked"));
  $("#post-save").addEventListener("click", () => toggle("saved", "tpb-saved"));
  $("#post-media").addEventListener("dblclick", () => {
    if (!state.liked.has(state.current.id)) toggle("liked", "tpb-liked");
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !$("#modal").hidden) closePost();
  });

  // No backend: hand the enquiry to the visitor's email app.
  $("#contact-form").addEventListener("submit", (e) => {
    e.preventDefault();
    const d = new FormData(e.target);
    const subject = `Free consultation request${d.get("service") ? " – " + d.get("service") : ""}`;
    const body = [
      `Name: ${d.get("name")}`,
      `Email: ${d.get("email")}`,
      `Due date: ${d.get("due") || "—"}`,
      `Birth place: ${d.get("place")}`,
      "",
      d.get("message"),
    ].join("\n");
    window.location.href = `mailto:${SITE.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
  });

  renderProfile();
  renderHighlights();
  renderGrid();
})();
