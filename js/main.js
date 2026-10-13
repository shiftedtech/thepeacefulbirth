// Contact details — edit these.
const CONTACT = {
  whatsapp: "60123456789",            // international format, digits only (e.g. 60 = Malaysia)
  instagram: "https://www.instagram.com/thepeacefulbirth/",
  email: "hello@thepeacefulbirth.com",
};

document.documentElement.classList.add("js");

(() => {
  const waLink = (text) =>
    `https://wa.me/${CONTACT.whatsapp}${text ? "?text=" + encodeURIComponent(text) : ""}`;

  // Fill every contact link on the page.
  document.querySelectorAll("[data-link]").forEach((a) => {
    const kind = a.dataset.link;
    if (kind === "whatsapp") a.href = waLink("Hi! I found your website and would like to know more about your doula services.");
    if (kind === "instagram") a.href = CONTACT.instagram;
    if (kind === "email") { a.href = "mailto:" + CONTACT.email; a.textContent ||= CONTACT.email; }
  });

  // Show the illustrated fallback until real photos are added to /images.
  document.querySelectorAll("img[data-fallback]").forEach((img) => {
    const fail = () => img.closest(".arch").classList.add("is-empty");
    if (img.complete && img.naturalWidth === 0) fail();
    else img.addEventListener("error", fail, { once: true });
  });

  // Mobile menu
  const toggle = document.getElementById("nav-toggle");
  const links = document.getElementById("nav-links");
  toggle.addEventListener("click", () => {
    const open = links.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", open);
  });
  links.addEventListener("click", (e) => {
    if (e.target.closest("a")) { links.classList.remove("is-open"); toggle.setAttribute("aria-expanded", false); }
  });

  // Nav shadow on scroll
  const nav = document.getElementById("nav");
  const onScroll = () => nav.classList.toggle("is-scrolled", window.scrollY > 10);
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // Service buttons preselect the form
  document.querySelectorAll("[data-service]").forEach((btn) =>
    btn.addEventListener("click", () => { document.getElementById("service-select").value = btn.dataset.service; })
  );

  // Gentle reveal on scroll
  const reveals = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add("is-in"); io.unobserve(en.target); } });
    }, { threshold: 0.12 });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add("is-in"));
  }

  // Form → WhatsApp message
  document.getElementById("contact-form").addEventListener("submit", (e) => {
    e.preventDefault();
    const d = new FormData(e.target);
    const text = [
      `Hi! I'd like to book a free consultation.`,
      `Name: ${d.get("name")}`,
      d.get("phone") && `Phone: ${d.get("phone")}`,
      d.get("due") && `Due date: ${d.get("due")}`,
      `Interested in: ${d.get("service")}`,
      d.get("message") && `\n${d.get("message")}`,
    ].filter(Boolean).join("\n");
    window.open(waLink(text), "_blank", "noopener");
  });

  // Minimal page search: scroll to the first block that mentions the query.
  const searchForm = document.getElementById("search");
  const searchInput = document.getElementById("search-input");
  const blocks = [...document.querySelectorAll(".sign, .service, .steps li, .about__text, .story, .faq details, .contact__text, .section__head")];
  searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const q = searchInput.value.trim().toLowerCase();
    if (!q) return;
    const hit = blocks.find((el) => el.textContent.toLowerCase().includes(q));
    searchForm.classList.toggle("is-miss", !hit);
    if (!hit) return;
    if (hit.tagName === "DETAILS") hit.open = true;
    hit.classList.add("is-in", "search-hit");
    hit.scrollIntoView({ behavior: "smooth", block: "center" });
    setTimeout(() => hit.classList.remove("search-hit"), 2000);
  });
  searchInput.addEventListener("input", () => searchForm.classList.remove("is-miss"));

  document.getElementById("year").textContent = new Date().getFullYear();
})();
