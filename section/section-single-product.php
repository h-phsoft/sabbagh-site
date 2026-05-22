<?php
$oProduct = array();
for ($ii = 0; $ii < count($aCats); $ii++) {
  $aProducts = $aCats[$ii]['aProducts'];
  for ($jj = 0; $jj < count($aProducts); $jj++) {
    if ($aProducts[$jj]['Id'] == $nQId) {
      $oCat = $aCats[$ii];
      $oProduct = $aProducts[$jj];
    }
  }
}
?>
<section class="single-product-section py-5">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <div class="single-product-image">
          <img src="assets/media/products/<?= $oProduct['Image'] ?>" class="img-fluid rounded shadow-sm" alt="<?= $oProduct['Name'] ?>">
        </div>
      </div>
      <div class="col-md-6">
        <h1 class="mb-3"><a href="products/<?= $oCat['Id'] ?>#cat-<?= $oCat['Id'] ?>"><?= $oCat['Name'] ?></a></h1>
        <h2 class="mb-3"> <?= $oProduct['Name'] ?></h2>
        <p class="text-muted mb-4">A short description or subtitle for the product goes here.</p>
        <ul class="list-unstyled mb-4">
          <li><strong>Price:</strong> $00.00</li>
          <li><strong>Size:</strong> 00 cm x 00 cm</li>
          <li><strong>Material:</strong> Premium aluminum</li>
          <li><strong>Availability:</strong> In stock</li>
        </ul>
        <p>Here are the product details. Use this space to explain the features, benefits, and what makes this product special.</p>
      </div>
    </div>
  </div>
</section>