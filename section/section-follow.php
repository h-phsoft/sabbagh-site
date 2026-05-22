<section id="follow" class="follow-section mb-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Follow us</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-4 text-center d-ineline">
        <?php
        foreach ($aSocial as $social) {
          ?>
          <a href="<?= $social['url'] ?>" class="ms-3 d-inline"><?= $social['icon'] ?></a>
          <?php
        }
        ?>
      </div>
    </div>
    <div class="row text-center">
      <?php
      foreach ($aFollow as $follow) {
        ?>
        <div class="col-2 mx-auto p-0">
          <a href="<?= $follow['url'] ?>">
            <img src="assets/media/follow/<?= $follow['Image'] ?>" width="100%" alt="Sabbagh">
          </a>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>
