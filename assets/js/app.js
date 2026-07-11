// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
  });
});

// Horizantal Filter functionality
document.querySelectorAll('.hz-filter-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.hz-filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
  });
});

// Form submission
const contactForm = document.querySelector('#contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', function (e) {
    e.preventDefault();
    // Get form values
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const company = document.getElementById('company').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;

    // Build email body
    const body = `
        First Name: ${firstName}
        Last Name: ${lastName}
        Email: ${email}
        Phone: ${phone}
        Company: ${company}
        Subject: ${subject}
        Message: ${message}
    `;

    // Create mailto link
    const mailtoLink = `mailto:info@sabbaghest.com?subject=Contact Form: ${subject}&body=${encodeURIComponent(body)}`;

    // Open email client
    window.location.href = mailtoLink;

  });
}

// FAQ interaction
document.querySelectorAll('.faq-item').forEach(item => {
  item.addEventListener('click', function () {
    this.classList.toggle('active');
  });
});

// =============================================
// بناء الكاروسل باستخدام JavaScript
// =============================================

(function () {
  'use strict';

  // انتظار تحميل الصفحة
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function init() {
    // التحقق من وجود البيانات
    if (typeof aCats === 'undefined' || !aCats || aCats.length === 0) {
      console.warn('No categories found');
      return;
    }

    const container = document.getElementById('filterCarouselContainer');
    if (!container)
      return;

    // ===== إعدادات =====
    const lang = window.vLang || 'en';
    const activeCatId = window.nQId || 0;

    // عدد الأزرار في كل شريحة (يمكن تعديله)
    const itemsPerSlide = getItemsPerSlide();

    // ===== تقسيم الكاتيغوريات إلى مجموعات =====
    function chunkArray(arr, size) {
      const chunks = [];
      for (let i = 0; i < arr.length; i += size) {
        chunks.push(arr.slice(i, i + size));
      }
      return chunks;
    }

    // ===== تحديد عدد الأزرار حسب الشاشة =====
    function getItemsPerSlide() {
      const width = window.innerWidth;
      if (width >= 1200)
        return 6;
      if (width >= 992)
        return 5;
      if (width >= 768)
        return 4;
      if (width >= 576)
        return 3;
      return 2;
    }

    // ===== بناء الكاروسل =====
    function buildCarousel() {
      const chunks = chunkArray(aCats, itemsPerSlide);
      const hasMultipleSlides = chunks.length > 1;

      // بناء HTML
      let html = '';

      // Carousel wrapper
      html += `<div id="filterCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">`;

      // Carousel inner
      html += `<div class="carousel-inner">`;

      chunks.forEach((chunk, chunkIndex) => {
        const isActive = chunkIndex === 0 ? 'active' : '';
        html += `<div class="carousel-item ${isActive}">`;
        html += `<div class="d-flex justify-content-center">`;

        chunk.forEach((cat) => {
          const globalIndex = aCats.indexOf(cat);
          const btnText = lang === 'en' ? cat.Name1 : cat.Name2;
          const isActiveBtn = activeCatId == cat.Id ? 'active' : '';

          html += `
            <a class="filter-btn ${isActiveBtn}"
               href="products/#cat-${cat.Id}"
               data-catid="${cat.Id}"
               data-index="${globalIndex}"
               data-slide="${chunkIndex}">
              ${btnText}
            </a>
          `;
        });

        html += `</div>`;
        html += `</div>`;
      });

      html += `</div>`;

      // أزرار التنقل (تظهر فقط إذا كان هناك أكثر من شريحة)
      if (hasMultipleSlides) {
        html += `
          <button class="carousel-control-prev" type="button" data-bs-target="#filterCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#filterCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        `;
      }

      html += `</div>`;

      // نقاط التمرير (تظهر فقط إذا كان هناك أكثر من شريحة)
      if (hasMultipleSlides) {
        html += `<div class="filter-indicators">`;
        chunks.forEach((chunk, chunkIndex) => {
          const isActive = chunkIndex === 0 ? 'active' : '';
          html += `
            <button class="indicator ${isActive}"
                    type="button"
                    data-bs-target="#filterCarousel"
                    data-bs-slide-to="${chunkIndex}"
                    aria-label="Slide ${chunkIndex + 1}">
            </button>
          `;
        });
        html += `</div>`;
      }

      return html;
    }

    // ===== عرض الكاروسل =====
    container.innerHTML = buildCarousel();

    // ===== تهيئة Bootstrap Carousel =====
    const carouselElement = document.getElementById('filterCarousel');
    if (!carouselElement)
      return;

    let carousel;
    try {
      carousel = new bootstrap.Carousel(carouselElement, {
        interval: false,
        wrap: true,
        touch: true
      });
    } catch (e) {
      console.warn('Bootstrap Carousel not loaded');
      return;
    }

    // ===== ربط الأحداث =====
    const buttons = document.querySelectorAll('.filter-btn');
    const indicators = document.querySelectorAll('.indicator');

    // ===== تحديث المؤشرات =====
    function updateIndicators(slideIndex) {
      indicators.forEach((ind, index) => {
        ind.classList.toggle('active', index === slideIndex);
      });
    }

    // ===== تحديث الأزرار النشطة =====
    function updateActiveButtons() {
      const activeItem = document.querySelector('.carousel-item.active');
      if (!activeItem)
        return;

      buttons.forEach(btn => btn.classList.remove('active'));

      const activeButtons = activeItem.querySelectorAll('.filter-btn');
      const hash = window.location.hash.replace('#cat-', '');

      activeButtons.forEach(btn => {
        if (hash && btn.dataset.catid === hash) {
          btn.classList.add('active');
        }
      });
    }

    // ===== حدث تغيير الشريحة =====
    carouselElement.addEventListener('slid.bs.carousel', function (e) {
      if (indicators.length > 0) {
        updateIndicators(e.to);
      }
      updateActiveButtons();
    });

    // ===== النقر على الأزرار =====
    buttons.forEach((btn) => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();

        buttons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const slideIndex = parseInt(this.dataset.slide) || 0;
        if (carousel) {
          carousel.to(slideIndex);
          if (indicators.length > 0) {
            updateIndicators(slideIndex);
          }
        }

        const href = this.getAttribute('href');
        if (href && href !== '#') {
          setTimeout(() => {
            window.location.href = href;
          }, 400);
        }
      });
    });

    // ===== النقر على المؤشرات =====
    indicators.forEach((ind, index) => {
      ind.addEventListener('click', function () {
        if (carousel) {
          carousel.to(index);
          updateIndicators(index);
        }
      });
    });

    // ===== معالجة تغيير حجم الشاشة =====
    let resizeTimeout;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        // إعادة بناء الكاروسل إذا تغير عدد الأزرار المطلوب
        const newItemsPerSlide = getItemsPerSlide();
        if (newItemsPerSlide !== itemsPerSlide) {
          // إعادة التهيئة
          const currentSlide = carousel ? carousel._activeIndex || 0 : 0;
          container.innerHTML = buildCarousel();
          // إعادة تهيئة الكاروسل
          const newCarousel = document.getElementById('filterCarousel');
          if (newCarousel) {
            try {
              const newInstance = new bootstrap.Carousel(newCarousel, {
                interval: false,
                wrap: true,
                touch: true
              });
              // نقل المتغيرات
              window.__carouselInstance = newInstance;
            } catch (e) {
            }
          }
          // إعادة ربط الأحداث
          location.reload(); // إعادة تحميل بسيطة
        }
      }, 300);
    });

    // ===== التحديث الأولي =====
    setTimeout(() => {
      const hash = window.location.hash;
      if (hash && hash.startsWith('#cat-')) {
        const catId = hash.replace('#cat-', '');
        buttons.forEach((btn) => {
          if (btn.dataset.catid === catId) {
            const slideIndex = parseInt(btn.dataset.slide) || 0;
            btn.classList.add('active');
            if (carousel) {
              carousel.to(slideIndex);
              if (indicators.length > 0) {
                updateIndicators(slideIndex);
              }
            }
            setTimeout(() => {
              const target = document.querySelector(hash);
              if (target) {
                target.scrollIntoView({behavior: 'smooth'});
              }
            }, 300);
          }
        });
      }
    }, 300);

    // ===== جعل الدوال متاحة عالمياً =====
    window.updateCarouselIndicators = updateIndicators;
    window.updateCarouselButtons = updateActiveButtons;
    window.carouselInstance = carousel;
  }

})();

// ===== معالجة تغيير الهاش =====
window.addEventListener('hashchange', function () {
  const hash = window.location.hash;
  if (hash && hash.startsWith('#cat-')) {
    const catId = hash.replace('#cat-', '');
    const buttons = document.querySelectorAll('.filter-btn');
    const carousel = document.getElementById('filterCarousel');

    if (!carousel)
      return;

    const bsCarousel = bootstrap.Carousel.getInstance(carousel);
    if (!bsCarousel)
      return;

    buttons.forEach((btn) => {
      if (btn.dataset.catid === catId) {
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const slideIndex = parseInt(btn.dataset.slide) || 0;
        bsCarousel.to(slideIndex);

        const indicators = document.querySelectorAll('.indicator');
        indicators.forEach((ind, i) => {
          ind.classList.toggle('active', i === slideIndex);
        });
      }
    });
  }
});

// ===== تحديث عدد الأزرار عند تغيير حجم الشاشة =====
window.addEventListener('resize', function () {
  // يمكن إضافة منطق إعادة البناء هنا إذا لزم الأمر
});
