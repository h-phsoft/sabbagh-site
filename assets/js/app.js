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
const track = document.getElementById('sliderTrack');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const originalSlides = Array.from(track.children);

let currentIndex = 0;
let slidesVisible = 1;
let isTransitioning = false;

// 1. Define responsiveness rules
function getSlidesVisible() {
  const width = window.innerWidth;
  if (width >= 1024)
    return 6; // Desktop
  if (width >= 768)
    return 4;  // Tablet
  if (width >= 575)
    return 3;  // Tablet
  if (width >= 480)
    return 2;  // Tablet
  return 1;                   // Mobile
}

// 2. Setup track clones for infinite looping clones
function setupSlider() {
  track.innerHTML = ''; // Clear current track
  slidesVisible = getSlidesVisible();

  // Clone head and tail elements to create an infinite loop illusion
  const headClones = originalSlides.slice(0, slidesVisible).map(el => el.cloneNode(true));
  const tailClones = originalSlides.slice(-slidesVisible).map(el => el.cloneNode(true));

  const allSlides = [...tailClones, ...originalSlides, ...headClones];
  allSlides.forEach(slide => track.appendChild(slide));

  // Update widths dynamically
  const slideWidth = 100 / slidesVisible;
  Array.from(track.children).forEach(slide => {
    slide.style.width = `${slideWidth}%`;
  });

  // Set initial position jumping past the tail clones
  currentIndex = slidesVisible;
  updatePositionWithoutAnimation();
}

function updatePosition() {
  const slideWidth = 100 / slidesVisible;
  track.style.transition = 'transform 0.4s ease-in-out';
  track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;
}

function updatePositionWithoutAnimation() {
  const slideWidth = 100 / slidesVisible;
  track.style.transition = 'none';
  track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;
}

// 3. Handle Looping Jumps seamlessly
track.addEventListener('transitionend', () => {
  isTransitioning = false;

  // Jump to actual first slide if we hit the end clone boundary
  if (currentIndex >= originalSlides.length + slidesVisible) {
    currentIndex = slidesVisible;
    updatePositionWithoutAnimation();
  }
  // Jump to actual last slide if we hit the start clone boundary
  if (currentIndex < slidesVisible) {
    currentIndex = originalSlides.length + currentIndex;
    updatePositionWithoutAnimation();
  }
});

// 4. Button Controls (Scrolls one by one)
nextBtn.addEventListener('click', () => {
  if (isTransitioning)
    return;
  isTransitioning = true;
  currentIndex++;
  updatePosition();
});

prevBtn.addEventListener('click', () => {
  if (isTransitioning)
    return;
  isTransitioning = true;
  currentIndex--;
  updatePosition();
});

// 5. Adjust slider layout dynamically on window resize
let resizeTimeout;
window.addEventListener('resize', () => {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(setupSlider, 100);
});

// Initialize on page load
setupSlider();

document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
  });
});
