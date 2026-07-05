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
  /*
   // Get form data
   const formData = new FormData(this);
   const data = Object.fromEntries(formData);
   // Show success message (in real implementation, this would send to server)
   alert('Thank you for your message! We will get back to you within 24 hours.');
   // Reset form
   this.reset();
   */

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

// FAQ interaction
document.querySelectorAll('.faq-item').forEach(item => {
  item.addEventListener('click', function () {
    this.classList.toggle('active');
  });
});
