<footer id="contact">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-col">
        <h4 class="footer-logo">
          <!--<img src="assets/media/img/logo.png" height="60px" alt="Sabbagh"/>-->
          Sabbagh
        </h4>
        <ul class="contact-info">
          <li>
            <i class="fa-solid fa-location-dot"></i>
            <span>Saboura, Damascus, Syria</span>
          </li>
          <li>
            <i class="fa-solid fa-phone"></i>
            <span>
              +963-11-3932307
              <br />
              +963-11-3932308
              <br />
              +963-11-3932309
            </span>
          </li>
          <li>
            <i class="fa-solid fa-mobile"></i>
            <span>+963-956506011</span>
          </li>
          <li>
            <i class="fa-solid fa-envelope"></i>
            <span>info@sabbaghest.com</span>
          </li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Products</h4>
        <ul>
          <?php
          foreach ($aCats as $cat) {
            ?>
            <li><a href="products.php?qid=<?= $cat->Id ?>#cat-<?= $cat->Id ?>"><?= $cat->Name1 ?></a></li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="contact.php">Contact us</a></li>
          <!--<li><a href="#">Privacy Policy</a></li>-->
        </ul>
      </div>
      <div class="footer-col">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <?php
          foreach ($aSocial as $social) {
            ?>
            <a href="<?= $social->url ?>"><?= $social->icon ?></a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="copyright">
      <div style="width: 10%;"></div>
      <div>&copy; 2026 Sabbagh Est. All Rights Reserved.</div>
      <div>Pwoered By <a href="https://phsoft.me" target="_BLANK">PhSoft Team</a></div>
    </div>
  </div>
</footer>
