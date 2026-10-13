// Site content. Edit this file to change the profile, listings and contact details.
// Each listing renders as one "post" tile in the Instagram-style grid.

const SITE = {
  handle: "thepeacefulbirth",
  name: "The Peaceful Birth Realty",
  tagline: "Real estate · Calm homes for new beginnings",
  bio: [
    "🏡 Helping growing families find their peaceful place",
    "🌿 Buyers · Sellers · First homes · Nursery-ready spaces",
    "📍 Serving the city & surrounding suburbs",
    "👇 Tap a post to see the home & book a viewing",
  ],
  instagram: "https://www.instagram.com/thepeacefulbirth/",
  email: "hello@thepeacefulbirth.com",
  phone: "+1 (555) 010-2040",
  followers: "12.4k",
  following: "318",
};

const IMG = (id) => `https://images.unsplash.com/${id}?auto=format&fit=crop&w=1080&q=80`;

const HIGHLIGHTS = [
  { id: "all", label: "All homes", emoji: "🏡" },
  { id: "sale", label: "For sale", emoji: "🔑" },
  { id: "rent", label: "Rentals", emoji: "🛋️" },
  { id: "open", label: "Open house", emoji: "📅" },
  { id: "family", label: "Family homes", emoji: "👶" },
  { id: "sold", label: "Just sold", emoji: "🎉" },
];

const LISTINGS = [
  {
    id: 1,
    title: "Sage Cottage",
    status: "sale",
    tags: ["family", "open"],
    price: 685000,
    beds: 4, baths: 3, sqft: 2450,
    location: "Willow Creek",
    openHouse: "Sat 11am – 2pm",
    images: [
      IMG("photo-1600596542815-ffad4c1539a9"),
      IMG("photo-1600585154340-be6161a56a0c"),
      IMG("photo-1600566753190-17f0baa2a6c3"),
    ],
    caption:
      "A quiet cul-de-sac, a sunny nursery off the primary suite and a garden made for slow mornings. Sage Cottage is the kind of home you grow into.",
    features: ["Nursery-ready room", "Fenced garden", "Walk to park", "New roof 2025"],
    likes: 1284,
  },
  {
    id: 2,
    title: "The Linen House",
    status: "sale",
    tags: ["family"],
    price: 899000,
    beds: 5, baths: 4, sqft: 3200,
    location: "Maple Heights",
    images: [
      IMG("photo-1600607687939-ce8a6c25118c"),
      IMG("photo-1600047509807-ba8f99d2cdde"),
    ],
    caption:
      "Soft light, linen tones and room for everyone. Open kitchen, a playroom downstairs and a primary suite with its own reading nook.",
    features: ["Playroom", "Chef's kitchen", "Top-rated schools", "2-car garage"],
    likes: 2091,
  },
  {
    id: 3,
    title: "Harbour Loft",
    status: "rent",
    tags: [],
    price: 2850,
    beds: 2, baths: 2, sqft: 1100,
    location: "Old Harbour",
    images: [IMG("photo-1502672260266-1c1ef2d93688"), IMG("photo-1522708323590-d24dbb6b0267")],
    caption:
      "Calm city living with water views. Perfect for a couple preparing for their first little one — lift access, stroller storage and a park next door.",
    features: ["Lift access", "Stroller storage", "Water views", "Pet friendly"],
    likes: 873,
  },
  {
    id: 4,
    title: "Meadow View",
    status: "sold",
    tags: ["family"],
    price: 540000,
    beds: 3, baths: 2, sqft: 1850,
    location: "Fernbrook",
    images: [IMG("photo-1568605114967-8130f3a36994")],
    caption:
      "SOLD 🎉 Congratulations to the M. family — welcoming baby and a new home in the same season. Thank you for trusting us with both big moments.",
    features: ["Sold over asking", "9 days on market"],
    likes: 3410,
  },
  {
    id: 5,
    title: "Olive Grove Bungalow",
    status: "sale",
    tags: ["open"],
    price: 459000,
    beds: 3, baths: 2, sqft: 1600,
    location: "Olive Grove",
    openHouse: "Sun 1pm – 4pm",
    images: [IMG("photo-1570129477492-45c003edd2be"), IMG("photo-1484154218962-a197022b5858")],
    caption:
      "Single-level living with a wraparound porch. Easy for new parents, easy for grandparents visiting to help out.",
    features: ["Single level", "Wraparound porch", "Updated kitchen"],
    likes: 1102,
  },
  {
    id: 6,
    title: "Stillwater Estate",
    status: "sale",
    tags: ["family"],
    price: 1450000,
    beds: 6, baths: 5, sqft: 4800,
    location: "Stillwater",
    images: [
      IMG("photo-1613490493576-7fde63acd811"),
      IMG("photo-1580587771525-78b9dba3b914"),
      IMG("photo-1605276374104-dee2a0ed3cd6"),
    ],
    caption:
      "Room to breathe. A pool, guest suite for the night nurse or visiting family, and acres of quiet.",
    features: ["Pool", "Guest suite", "1.2 acres", "Home office"],
    likes: 4520,
  },
  {
    id: 7,
    title: "Willow Townhome",
    status: "rent",
    tags: ["family"],
    price: 3200,
    beds: 3, baths: 2.5, sqft: 1700,
    location: "Willow Creek",
    images: [IMG("photo-1512917774080-9991f1c4c750")],
    caption:
      "A gentle first step — rent while you plan your forever home. Three bedrooms, a little yard and a playground across the street.",
    features: ["Private yard", "Playground nearby", "In-unit laundry"],
    likes: 640,
  },
  {
    id: 8,
    title: "Juniper Place",
    status: "sold",
    tags: [],
    price: 615000,
    beds: 4, baths: 3, sqft: 2200,
    location: "Juniper Hills",
    images: [IMG("photo-1564013799919-ab600027ffc6")],
    caption:
      "SOLD 🎉 Another family settled in before the due date. Peaceful moves are our favourite kind.",
    features: ["Sold in 6 days", "Multiple offers"],
    likes: 2876,
  },
  {
    id: 9,
    title: "Birch Studio",
    status: "rent",
    tags: ["open"],
    price: 1750,
    beds: 1, baths: 1, sqft: 650,
    location: "Downtown",
    openHouse: "Thu 5pm – 7pm",
    images: [IMG("photo-1493809842364-78817add7ffb")],
    caption: "Bright, simple and close to everything. A calm base in the middle of the city.",
    features: ["Utilities included", "Rooftop terrace"],
    likes: 455,
  },
];
