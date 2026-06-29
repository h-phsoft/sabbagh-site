<?php
$oProduct = cEcomProduct::getInstance($nQId);
$oCat = cEcomCat::getInstance($oProduct->CatId);
/*
  for ($ii = 0; $ii < count($aCats); $ii++) {
  $aProducts = $aCats[$ii]->aProducts;
  for ($jj = 0; $jj < count($aProducts); $jj++) {
  if ($aProducts[$jj]->Id == $nQId) {
  $oCat = $aCats[$ii];
  $oProduct = $aProducts[$jj];
  }
  }
  }
 */
?>
<section class="single-product-section py-5">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <div class="single-product-image">
          <img src="assets/media/products/<?= $oProduct->Image ?>" class="img-fluid rounded shadow-sm" alt="<?= $oProduct->Name ?>">
        </div>
      </div>
      <div class="col-md-6">
        <h1 class="mb-3"><a href="products/<?= $oCat->Id ?>#cat-<?= $oCat->Id ?>"><?= $vLang == 'en' ? $oCat->Name1 : $oCat->Name2 ?></a></h1>
        <h2 class="mb-3"> <?= $vLang == 'en' ? $oProduct->Name1 : $oProduct->Name2 ?></h2>
        <p class="text-muted mb-4"><?= $oProduct->Desc1 ?></p>
        <p class="text-muted mb-4"><?= $oProduct->Desc2 ?></p>
        <p class="text-muted mb-4"><?= $oProduct->Desc3 ?></p>
        <p class="text-muted mb-4"><?= $oProduct->Desc4 ?></p>
        <p class="text-muted mb-4"><?= $oProduct->Desc5 ?></p>
      </div>
    </div>
  </div>
</section>