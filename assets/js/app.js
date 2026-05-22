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
document.querySelector('#contactForm').addEventListener('submit', function (e) {
  e.preventDefault();

  // Get form data
  const formData = new FormData(this);
  const data = Object.fromEntries(formData);

  // Show success message (in real implementation, this would send to server)
  alert('Thank you for your message! We will get back to you within 24 hours.');

  // Reset form
  this.reset();
});

// FAQ interaction
document.querySelectorAll('.faq-item').forEach(item => {
  item.addEventListener('click', function () {
    this.classList.toggle('active');
  });
});
