<section class="filter-section">
  <div class="slider-container">
    <button class="nav-btn prev-btn" id="prevBtn">&#10094;</button>
    <div class="slider-wrapper">
      <div class="slider-track" id="sliderTrack">
        <?php
        foreach ($aCats as $cat) {
          $vActive = '';
          ?>
          <div class="slide">
            <a class="filter-btn <?= $vActive; ?>" href="products/#cat-<?= $cat->Id ?>" data-catid="<?= $cat->Id ?>">
              <?= $vLang == 'en' ? $cat->Name1 : $cat->Name2 ?>
            </a>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <button class="nav-btn next-btn" id="nextBtn">&#10095;</button>
  </div>
</section>