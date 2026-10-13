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
    filter: "all",   // highlight / tab filter
    query: "",
    liked: new Set(store.get("tpb-liked")),
    saved: new Set(store.get("tpb-saved")),
    current: null,   // listing open in the modal
    photo: 0,
  };

  const money = (l) =>
    "$" + l.price.toLocaleString("en-US") + (l.status === "rent" ? "/mo" : "");
  const statusLabel = { sale: "For sale", rent: "For rent", sold: "Sold" };
  const initials = SITE.name.split(/\s+/).filter((w) => /^[A-Z]/.test(w)).slice(0, 2).map((w) => w[0]).join("");

  // ---------- profile ----------
  function renderProfile() {
    $("#brand").textContent = SITE.name;
    $("#avatar-initials").textContent = initials;
    $("#handle").textContent = SITE.handle;
    $("#name").textContent = SITE.name;
    $("#tagline").textContent = SITE.tagline;
    $("#bio").innerHTML = SITE.bio.map((line) => `<p>${line}</p>`).join("");
    $("#stat-posts").textContent = LISTINGS.filter((l) => l.status !== "sold").length;
    $("#stat-followers").textContent = SITE.followers;
    $("#stat-sold").textContent = LISTINGS.filter((l) => l.status === "sold").length;
    $("#ig-link").href = SITE.instagram;
    $("#footer-ig").href = SITE.instagram;
    $("#footer-ig").textContent = "@" + SITE.handle;
    $("#footer-name").textContent = SITE.name;
    $("#year").textContent = new Date().getFullYear();
    $("#contact-email").href = "mailto:" + SITE.email;
    $("#contact-email").textContent = SITE.email;
    $("#contact-phone").href = "tel:" + SITE.phone.replace(/[^\d+]/g, "");
    $("#contact-phone").textContent = SITE.phone;
    $("#listing-select").innerHTML += LISTINGS.filter((l) => l.status !== "sold")
      .map((l) => `<option value="${l.title}">${l.title} — ${l.location}</option>`).join("");
  }

  function renderHighlights() {
    $("#highlights").innerHTML = HIGHLIGHTS.map((h) => `
      <button class="highlight ${h.id === state.filter ? "is-active" : ""}" data-filter="${h.id}">
        <span class="highlight__ring"><span class="highlight__circle">${h.emoji}</span></span>
        <span class="highlight__label">${h.label}</span>
      </button>`).join("");
  }

  // ---------- grid ----------
  function matches(l) {
    const f = state.filter;
    if (f === "saved" && !state.saved.has(l.id)) return false;
    if (f !== "all" && f !== "saved" && l.status !== f && !l.tags.includes(f)) return false;
    if (!state.query) return true;
    const hay = [l.title, l.location, l.caption, statusLabel[l.status], ...l.features].join(" ").toLowerCase();
    return hay.includes(state.query);
  }

  function renderGrid() {
    const items = LISTINGS.filter(matches);
    $("#empty").hidden = items.length > 0;
    $("#feed").innerHTML = items.map((l) => `
      <button class="tile" data-id="${l.id}" aria-label="${l.title}, ${money(l)}">
        <img src="${l.images[0]}" alt="" loading="lazy" />
        <span class="tile__badge tile__badge--${l.status}">${statusLabel[l.status]}</span>
        ${l.images.length > 1 ? `<svg class="tile__multi" viewBox="0 0 24 24"><rect x="7" y="3" width="14" height="14" rx="2"/><path d="M17 21H5a2 2 0 0 1-2-2V7"/></svg>` : ""}
        <span class="tile__overlay">
          <strong>${money(l)}</strong>
          <span>${l.beds} bd · ${l.baths} ba · ${l.sqft.toLocaleString()} sqft</span>
          <span>♥ ${(l.likes + (state.liked.has(l.id) ? 1 : 0)).toLocaleString()}</span>
        </span>
      </button>`).join("");
    attachImageFallbacks($("#feed"));
  }

  // Image hosts can fail; show a soft branded placeholder instead of a broken icon.
  function attachImageFallbacks(root) {
    root.querySelectorAll("img").forEach((img) => {
      img.addEventListener("error", () => img.classList.add("is-broken"), { once: true });
    });
  }

  function setFilter(filter) {
    state.filter = filter;
    renderHighlights();
    document.querySelectorAll(".tab").forEach((t) => {
      const on = t.dataset.tab === filter || (t.dataset.tab === "all" && !["open", "saved"].includes(filter));
      t.classList.toggle("is-active", on);
    });
    renderGrid();
  }

  // ---------- modal ----------
  function openPost(id) {
    const l = LISTINGS.find((x) => x.id === id);
    if (!l) return;
    state.current = l;
    state.photo = 0;
    $("#post-avatar").textContent = initials;
    $("#post-handle").textContent = SITE.handle;
    $("#post-location").textContent = l.location;
    $("#post-title").textContent = l.title;
    $("#post-price").textContent = `${money(l)} · ${statusLabel[l.status]}`;
    $("#post-facts").innerHTML = [
      `${l.beds} beds`, `${l.baths} baths`, `${l.sqft.toLocaleString()} sqft`,
    ].map((f) => `<li>${f}</li>`).join("");
    $("#post-open").hidden = !l.openHouse;
    $("#post-open").textContent = l.openHouse ? `📅 Open house: ${l.openHouse}` : "";
    $("#post-caption").innerHTML = `<strong>${SITE.handle}</strong> ${l.caption}`;
    $("#post-tags").textContent = l.features.map((f) => "#" + f.replace(/[^a-z0-9]/gi, "").toLowerCase()).join(" ");
    $("#post-book").textContent = l.status === "sold" ? "Find a home like this" : "Book a viewing";
    renderPhoto();
    renderPostActions();
    $("#modal").hidden = false;
    document.body.classList.add("no-scroll");
    $(".modal__close").focus();
  }

  function renderPhoto() {
    const l = state.current;
    const img = $("#post-img");
    img.classList.remove("is-broken");
    img.src = l.images[state.photo];
    img.alt = `${l.title} photo ${state.photo + 1} of ${l.images.length}`;
    const multi = l.images.length > 1;
    $("#post-prev").hidden = !multi || state.photo === 0;
    $("#post-next").hidden = !multi || state.photo === l.images.length - 1;
    $("#post-dots").innerHTML = multi
      ? l.images.map((_, i) => `<span class="${i === state.photo ? "is-active" : ""}"></span>`).join("")
      : "";
  }

  function renderPostActions() {
    const l = state.current;
    const liked = state.liked.has(l.id);
    $("#post-like").classList.toggle("is-on", liked);
    $("#post-save").classList.toggle("is-on", state.saved.has(l.id));
    $("#post-likes").textContent = `${(l.likes + (liked ? 1 : 0)).toLocaleString()} likes`;
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
  $("#search").addEventListener("input", (e) => {
    state.query = e.target.value.trim().toLowerCase();
    renderGrid();
  });

  $("#modal").addEventListener("click", (e) => {
    if (e.target.closest("[data-close]")) {
      if (e.target.closest("#post-message, #post-book") && state.current?.status !== "sold") {
        $("#listing-select").value = state.current.title;
      }
      closePost();
    }
  });
  $("#post-prev").addEventListener("click", () => { state.photo--; renderPhoto(); });
  $("#post-next").addEventListener("click", () => { state.photo++; renderPhoto(); });
  $("#post-like").addEventListener("click", () => toggle("liked", "tpb-liked"));
  $("#post-save").addEventListener("click", () => toggle("saved", "tpb-saved"));
  $("#post-img").addEventListener("error", (e) => e.target.classList.add("is-broken"));
  $("#post-img").addEventListener("dblclick", () => {
    if (!state.liked.has(state.current.id)) toggle("liked", "tpb-liked");
  });

  document.addEventListener("keydown", (e) => {
    if ($("#modal").hidden) return;
    if (e.key === "Escape") closePost();
    const n = state.current.images.length;
    if (e.key === "ArrowRight" && state.photo < n - 1) { state.photo++; renderPhoto(); }
    if (e.key === "ArrowLeft" && state.photo > 0) { state.photo--; renderPhoto(); }
  });

  // No backend: hand the enquiry to the visitor's email client.
  $("#contact-form").addEventListener("submit", (e) => {
    e.preventDefault();
    const data = new FormData(e.target);
    const subject = `Viewing request${data.get("listing") ? ": " + data.get("listing") : ""}`;
    const body = `Name: ${data.get("name")}\nEmail: ${data.get("email")}\n\n${data.get("message")}`;
    window.location.href = `mailto:${SITE.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
  });

  renderProfile();
  renderHighlights();
  renderGrid();
})();
