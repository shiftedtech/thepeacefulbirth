// Site content. Edit this file to change the profile, posts, services and contact details.
// Each entry in POSTS renders as one tile in the Instagram-style grid.

const SITE = {
  handle: "thepeacefulbirth",
  name: "The Peaceful Birth",
  tagline: "Birth & postpartum doula",
  bio: [
    "🤍 Calm, informed, supported births",
    "🌿 Birth doula · Postpartum care · Childbirth classes",
    "🏥 Home · Birth centre · Hospital · VBAC · C-section",
    "👇 Book your free consultation",
  ],
  instagram: "https://www.instagram.com/thepeacefulbirth/",
  email: "hello@thepeacefulbirth.com",
  phone: "+1 (555) 010-2040",
  area: "Serving families in your city & nearby",
  followers: "12.4k",
  births: "150+",
};

const IMG = (id) => `https://images.unsplash.com/${id}?auto=format&fit=crop&w=1080&q=80`;

// Story highlights filter the grid by post category.
const HIGHLIGHTS = [
  { id: "all", label: "All posts", emoji: "🤍" },
  { id: "tips", label: "Birth tips", emoji: "🌿" },
  { id: "services", label: "Services", emoji: "🤲" },
  { id: "stories", label: "Birth stories", emoji: "👶" },
  { id: "postpartum", label: "Postpartum", emoji: "🍵" },
  { id: "reviews", label: "Kind words", emoji: "💌" },
];

// type "card" = designed text post (always renders), "photo" = image post.
// theme picks the card palette: sage, clay, cream, blush, ink.
const POSTS = [
  {
    id: 1, type: "card", category: "services", theme: "sage",
    kicker: "Now booking", headline: "Due in 2027?", sub: "Limited spots for spring births",
    title: "Now booking 2027 births",
    caption: "I take a small number of families each month so I can be fully present for every birth. If you're due next spring, now is a lovely time to chat. Free 30-minute consultations — link in bio.",
    tags: ["doula", "birthdoula", "pregnancy", "dueIn2027"],
    likes: 842,
  },
  {
    id: 2, type: "photo", category: "stories",
    image: IMG("photo-1555252333-9f8e92e65df9"),
    title: "A gentle water birth",
    caption: "\"I felt safe the whole time.\" After a long early labour at home, this mama welcomed her daughter in the birth pool just after sunrise. Honoured to hold space for you both. 🤍",
    tags: ["birthstory", "waterbirth", "homebirth"],
    likes: 2310,
  },
  {
    id: 3, type: "card", category: "tips", theme: "cream",
    kicker: "Birth tip", headline: "Pack these 5 things", list: ["Lip balm", "Long phone cable", "Snacks for your partner", "Your own pillow", "A playlist that calms you"],
    title: "5 hospital bag essentials",
    caption: "The little things make a big difference on the day. Save this for when you start packing your bag around 36 weeks. What would you add?",
    tags: ["hospitalbag", "birthprep", "thirdtrimester"],
    likes: 1564,
  },
  {
    id: 4, type: "card", category: "reviews", theme: "blush",
    kicker: "Kind words", quote: "She made us feel calm, prepared and completely heard. I can't imagine our birth without her.",
    author: "— Amira, first-time mum",
    title: "From Amira",
    caption: "Messages like this are why I do this work. Thank you for trusting me with your birth, Amira. 💌",
    tags: ["doulareview", "positivebirth"],
    likes: 976,
  },
  {
    id: 5, type: "photo", category: "postpartum",
    image: IMG("photo-1519689680058-324335c77eba"),
    title: "The fourth trimester",
    caption: "Postpartum support means warm meals, newborn care help, feeding support and someone asking how *you* are doing. The first weeks matter so much — you deserve to be cared for too.",
    tags: ["postpartum", "fourthtrimester", "postpartumdoula"],
    likes: 1189,
  },
  {
    id: 6, type: "card", category: "tips", theme: "ink",
    kicker: "Remember", headline: "You are allowed to ask questions.", sub: "Your birth. Your body. Your choices.",
    title: "You are allowed to ask questions",
    caption: "Try BRAIN when a decision comes up: Benefits, Risks, Alternatives, Intuition, and what happens if we do Nothing (for now). It helps you make informed choices you feel good about.",
    tags: ["informedchoice", "birthrights", "BRAIN"],
    likes: 3047,
  },
  {
    id: 7, type: "card", category: "services", theme: "clay",
    kicker: "Childbirth classes", headline: "Calm birth course", sub: "4 weeks · Small groups · Partners welcome",
    title: "Calm birth course",
    caption: "Breathing, positions, comfort measures, what to expect in each stage, and how partners can really help. Next group starts soon — message me to save your place.",
    tags: ["childbirtheducation", "hypnobirthing", "birthclass"],
    likes: 731,
  },
  {
    id: 8, type: "photo", category: "tips",
    image: IMG("photo-1493894473891-10fc1e5dbd22"),
    title: "Movement in pregnancy",
    caption: "Gentle movement, hip circles on the ball and lots of walking can help baby find a good position. Always check with your care provider first.",
    tags: ["pregnancyyoga", "optimalfetalpositioning"],
    likes: 905,
  },
  {
    id: 9, type: "card", category: "reviews", theme: "sage",
    kicker: "Kind words", quote: "Our VBAC was everything we hoped for. Her support for my husband was just as amazing as her support for me.",
    author: "— Jess & Tom",
    title: "From Jess & Tom",
    caption: "A beautiful VBAC and a very proud dad. Thank you both for letting me be part of your story. 🤍",
    tags: ["vbac", "doulareview"],
    likes: 1422,
  },
  {
    id: 10, type: "card", category: "postpartum", theme: "cream",
    kicker: "Postpartum", headline: "Ways to help a new mum", list: ["Bring a meal, don't stay long", "Hold baby so she can shower", "Fold the laundry", "Ask how she is sleeping"],
    title: "How to help a new mum",
    caption: "Share this with the people who keep asking \"what can I do?\" 🍵",
    tags: ["postpartumsupport", "newmom", "village"],
    likes: 2788,
  },
  {
    id: 11, type: "photo", category: "stories",
    image: IMG("photo-1515488042361-ee00e0ddd4e4"),
    title: "Welcome, little one",
    caption: "Twenty minutes old and already so loved. A calm hospital birth with dimmed lights, music and a very brave mama.",
    tags: ["birthstory", "hospitalbirth", "newborn"],
    likes: 1960,
  },
  {
    id: 12, type: "card", category: "services", theme: "blush",
    kicker: "Free", headline: "Let's have a chat", sub: "30-minute consultation · No obligation",
    title: "Free consultation",
    caption: "Not sure if a doula is right for you? Let's talk about your hopes for your birth and how I can support you. Book through the link in my bio.",
    tags: ["doula", "freeconsultation"],
    likes: 618,
  },
];

const SERVICES = [
  {
    name: "Birth doula",
    price: "From $1,600",
    blurb: "Continuous support from pregnancy through the first hours after birth.",
    items: ["2 prenatal visits", "Birth preferences planning", "On call from 38 weeks", "Continuous labour support", "1 postpartum visit"],
    featured: true,
  },
  {
    name: "Postpartum doula",
    price: "$45 / hour",
    blurb: "Practical and emotional care in the weeks after your baby arrives.",
    items: ["Feeding support", "Newborn care guidance", "Light meals & tidying", "Rest while I hold baby", "Day or overnight shifts"],
  },
  {
    name: "Calm birth course",
    price: "$350 per couple",
    blurb: "A 4-week small-group course for you and your birth partner.",
    items: ["Stages of labour", "Breathing & relaxation", "Comfort positions", "Partner support skills", "Postpartum planning"],
  },
];

const FAQ = [
  ["What does a doula do?", "A doula gives continuous emotional, physical and informational support before, during and after birth. I don't perform medical tasks — I work alongside your midwife or doctor so you feel calm, informed and cared for."],
  ["Will you support a hospital birth or C-section?", "Yes. I support births at home, in birth centres and in hospitals, including inductions, VBACs and planned or unplanned caesareans."],
  ["When should I book?", "Most families book in the second trimester, but it's never too late. Get in touch as soon as you know your due date to check availability."],
  ["Does my partner still have a role?", "Absolutely. I support partners too — suggesting ways to help, giving them breaks and making sure they feel confident and included."],
  ["Do you offer payment plans?", "Yes, payments can be spread across your pregnancy. Ask me about it during your free consultation."],
];
