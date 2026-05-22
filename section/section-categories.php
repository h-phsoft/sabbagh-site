<section class="products-section">
  <div class="container">
    <h2 class="section-title">Our Product Categories</h2>
    <div class="products-grid">
      <?php
      foreach ($aCats as $cat) {
        ?>
        <a href="products/<?= $cat['Id'] ?>#cat-<?= $cat['Id'] ?>" class="product-card-div">
          <div class="product-card product-img-placeholder responsive-square">
            <img src="assets/media/cats/<?= $cat['Image'] ?>" alt="<?= $cat['Name'] ?>">
          </div>
          <h3><?= $cat['Name'] ?></h3>
        </a>
        <?php
      }
      ?>
    </div>
  </div>
</section>
