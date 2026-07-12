<section class="filter-section">
  <div class="slider-container">
    <button class="nav-btn prev-btn" id="prevBtn">&#10094;</button>
    <div class="slider-wrapper">
      <div class="slider-track" id="sliderTrack">
        <?php
        $nFlg = 1;
        foreach ($aCats as $cat) {
          if ($nQId == 0) {
            if ($nFlg == 1) {
              $vActive = 'active';
            }
          } else {
            if ($nQId == $cat->Id) {
              $vActive = 'active';
            }
          }
          ?>
          <div class="slide">
            <a class="filter-btn <?= $vActive; ?>" href="products/#cat-<?= $cat->Id ?>" data-catid="<?= $cat->Id ?>">
              <?= $vLang == 'en' ? $cat->Name1 : $cat->Name2 ?>
            </a>
          </div>
          <?php
          $vActive = '';
          $nFlg = 0;
        }
        ?>
      </div>
    </div>
    <button class="nav-btn next-btn" id="nextBtn">&#10095;</button>
  </div>
</section>