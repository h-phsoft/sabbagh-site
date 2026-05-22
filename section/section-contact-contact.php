<section class="contact-section">
  <div class="container">
    <div class="contact-grid">
      <!-- Contact Info -->
      <div class="contact-info">
        <div class="info-card">
          <div class="info-icon">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div class="info-content">
            <h3>Our Location</h3>
            <p>Saboura, Damascus, Syria</p>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon">
            <i class="fa-solid fa-phone"></i>
          </div>
          <div class="info-content">
            <h3>Phone Numbers</h3>
            <p>
              +963-11-3932307
              <br />
              +963-11-3932308
              <br />
              +963-11-3932309
            </p>

          </div>
        </div>
        <div class="info-card">
          <div class="info-icon">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div class="info-content">
            <h3>Email Addresses</h3>
            <p>info@sabbaghest.com</p>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon">
            <i class="fa-solid fa-building"></i>
          </div>
          <div class="info-content">
            <h3>P.O.Box</h3>
            <p>1075 Damascus (S.A.R.)</p>
          </div>
        </div>
      </div>
      <!-- Contact Form -->
      <div class="contact-form-container">
        <h2 class="form-title">Send Us a Message</h2>
        <p class="form-subtitle">Fill out the form below and we'll get back to you within 24 hours</p>

        <form id="contactForm">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name *</label>
              <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
              <label for="lastName">Last Name *</label>
              <input type="text" id="lastName" name="lastName" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone">
            </div>
          </div>
          <div class="form-group">
            <label for="company">Company Name</label>
            <input type="text" id="company" name="company">
          </div>
          <div class="form-group">
            <label for="subject">Subject *</label>
            <select id="subject" name="subject" required>
              <option value="">Select a subject</option>
              <option value="general">General Inquiry</option>
              <option value="products">Product Information</option>
              <option value="pricing">Pricing & Quotation</option>
              <option value="partnership">Partnership Opportunities</option>
              <option value="custom">Custom Formulation</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Your Message *</label>
            <textarea id="message" name="message" placeholder="Tell us about your requirements..." required></textarea>
          </div>
          <button type="submit" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>
    </div>

    <?php
    //include_once 'section/paragraph-hours.php';
    //include_once 'section/paragraph-map.php';
    //include_once 'section/paragraph-faq.php';
    ?>
  </div>
</section>
