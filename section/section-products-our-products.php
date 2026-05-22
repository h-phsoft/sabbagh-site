<section class="products-section">
  <div class="container-fluid px-5">
    <h2 class="section-title">Our Products</h2>
    <div id="cat-0" class="row">
      <?php
      foreach ($aCats as $cat) {
        ?>
        <div id="cat-<?= $cat['Id'] ?>" class="col-12">
          <div class="row">
            <div class="col-12 p-5 mb5 text-center">
              <h3><?= $cat['Name'] ?></h3>
            </div>
            <?php
            foreach ($cat['aProducts'] as $prod) {
              ?>
              <div class="col-2 text-center mx-auto">
                <a href="product/<?= $prod['Id'] ?>">
                  <img src="assets/media/products/<?= $prod['Image'] ?>" alt="Shampoo" width="100%">
                  <h5><?= $prod['Name'] ?></h5>
                </a>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>
