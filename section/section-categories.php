<section class="products-section">
  <div class="container">
    <h2 class="section-title">Our Product Categories</h2>
    <div class="products-grid">
      <?php
      foreach ($aCats as $cat) {
        ?>
        <a href="products/<?= $cat->Id ?>#cat-<?= $cat->Id ?>" class="product-card-div">
          <div class="product-card product-img-placeholder responsive-square">
            <img src="assets/media/cats/<?= $cat->Image ?>" alt="<?= $vLang == 'en' ? $cat->Name1 : $cat->Name2 ?>">
          </div>
          <h3><?= $vLang == 'en' ? $cat->Name1 : $cat->Name2 ?></h3>
        </a>
        <?php
      }
      ?>
    </div>
  </div>
</section>
