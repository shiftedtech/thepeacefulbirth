/* global PB, QRCode */
(() => {
  const cfg = window.PB || {};
  const waLink = (text) =>
    cfg.whatsapp ? `https://wa.me/${cfg.whatsapp}${text ? "?text=" + encodeURIComponent(text) : ""}` : "";

  // Buttons/links in page content can use #whatsapp, #instagram or #review as their URL.
  const special = {
    "#whatsapp": () => waLink(cfg.waMessage),
    "#instagram": () => cfg.instagram,
    "#review": () => cfg.reviewPage,
  };
  document.querySelectorAll("a[href]").forEach((a) => {
    const key = a.getAttribute("href");
    if (!special[key]) return;
    const url = special[key]();
    if (!url) return;
    a.href = url;
    if (key !== "#review") { a.target = "_blank"; a.rel = "noopener"; }
  });

  // Mobile menu
  const toggle = document.querySelector(".pb-nav__toggle");
  const links = document.getElementById("pb-nav-links");
  if (toggle && links) {
    toggle.addEventListener("click", () => {
      const open = links.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open);
    });
    links.addEventListener("click", (e) => {
      if (e.target.closest("a")) { links.classList.remove("is-open"); toggle.setAttribute("aria-expanded", "false"); }
    });
  }

  // Nav shadow on scroll
  const nav = document.getElementById("pb-nav");
  const onScroll = () => nav && nav.classList.toggle("is-scrolled", window.scrollY > 10);
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // Service buttons preselect the form's service
  document.querySelectorAll(".pb-service").forEach((card) => {
    const name = card.querySelector("h3")?.textContent.trim();
    card.querySelectorAll('a[href="#contact"]').forEach((a) =>
      a.addEventListener("click", () => {
        const select = document.querySelector("[data-pb-form] select[name=service]");
        if (select && name && [...select.options].some((o) => o.text === name)) select.value = name;
      })
    );
  });

  // Search: on the home page jump to the matching section; otherwise normal WordPress search.
  const search = document.querySelector("[data-pb-search]");
  const front = document.querySelector(".pb-front");
  if (search && front) {
    const blocks = [...front.querySelectorAll(".pb-card, .pb-service, .pb-step, .pb-about__text, .pb-story, .wp-block-details, .pb-head")];
    search.addEventListener("submit", (e) => {
      const q = search.s.value.trim().toLowerCase();
      if (!q) { e.preventDefault(); return; }
      const hit = blocks.find((el) => el.textContent.toLowerCase().includes(q));
      if (!hit) return; // fall through to WordPress search results
      e.preventDefault();
      if (hit.tagName === "DETAILS") hit.open = true;
      hit.classList.add("pb-search-hit");
      hit.scrollIntoView({ behavior: "smooth", block: "center" });
      setTimeout(() => hit.classList.remove("pb-search-hit"), 2000);
    });
  }

  // Consultation form → WhatsApp
  document.querySelectorAll("[data-pb-form]").forEach((form) =>
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const d = new FormData(form);
      const text = [
        "Hi! I'd like to book a free consultation.",
        `Name: ${d.get("name")}`,
        d.get("phone") && `Phone: ${d.get("phone")}`,
        d.get("due") && `Due date: ${d.get("due")}`,
        `Interested in: ${d.get("service")}`,
        d.get("message") && `\n${d.get("message")}`,
      ].filter(Boolean).join("\n");
      const url = waLink(text);
      if (url) window.open(url, "_blank", "noopener");
      else if (cfg.email) location.href = `mailto:${cfg.email}?subject=${encodeURIComponent("Free consultation request")}&body=${encodeURIComponent(text)}`;
    })
  );

  // Review page: QR code + copy link
  const qr = document.querySelector("[data-pb-qr]");
  if (qr) {
    const data = qr.dataset.pbQr;
    if (window.QRCode) {
      new QRCode(qr, { text: data, width: 220, height: 220, colorDark: "#4a2c1e", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.M });
    } else {
      const img = new Image();
      img.alt = "QR code";
      img.src = "https://api.qrserver.com/v1/create-qr-code/?size=220x220&color=4a2c1e&data=" + encodeURIComponent(data);
      img.onerror = () => { qr.textContent = "🤍"; };
      qr.appendChild(img);
    }
  }
  document.querySelectorAll("[data-pb-copy]").forEach((btn) =>
    btn.addEventListener("click", async () => {
      const url = btn.dataset.pbCopy;
      const label = btn.textContent;
      try { await navigator.clipboard.writeText(url); btn.textContent = "Copied!"; }
      catch { window.prompt("Copy this link:", url); }
      setTimeout(() => (btn.textContent = label), 1800);
    })
  );
})();
