const data = [
    { img: "images/1.jpg", text: "Kos Nyaman & Adem" },
    { img: "images/2.png", text: "Anti Banjir 200m dari Telkom" },
    { img: "images/3.png", text: "Dekat Warteg" },
    { img: "images/4.png", text: "Kos Nyaman & Aman" },
    { img: "images/5.png", text: "Ada Wifi Kenceng" }
  ];
  
  let currentIndex = 0;
  
  function renderCarousel() {
    const carousel = document.getElementById("carousel");
    carousel.innerHTML = '';
  
    const len = data.length;
    const left = (currentIndex - 1 + len) % len;
    const center = currentIndex;
    const right = (currentIndex + 1) % len;
  
    [left, center, right].forEach((i, idx) => {
      const item = data[i];
      const card = document.createElement("div");
      card.className = "card" + (idx === 1 ? " center" : "");
      card.innerHTML = `
        <img src="${item.img}" alt="">
        <div class="text">${item.text}</div>
      `;
      carousel.appendChild(card);
    });
  }
  
  function nextSlide() {
    currentIndex = (currentIndex + 1) % data.length;
    renderCarousel();
  }
  
  function prevSlide() {
    currentIndex = (currentIndex - 1 + data.length) % data.length;
    renderCarousel();
  }
  
  // Inisialisasi
  renderCarousel();