<section class="filter-section">
  <div class="container-fluid">
    <div class="filter-container text-center">
      <?php
      $vActive = '';
      foreach ($aCats as $cat) {
        if ($nQId == $cat->Id) {
          $vActive = 'active';
        }
        ?>
        <a class="filter-btn mx-auto <?= $vActive ?>" href="products/#cat-<?= $cat->Id ?>" data-catid="<?= $cat->Id ?>"><?= $vLang == 'en' ? $cat->Name1 : $cat->Name2 ?></a>
        <?php
        $vActive = '';
      }
      ?>
    </div>
  </div>
</section>