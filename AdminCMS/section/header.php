<header class="main-header navbar">
  <div class="col-search">

  </div>
  <div class="col-nav">
    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside">
      <i class="icon bi bi-text-indent-right"></i>
    </button>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link btn-icon darkmode">
          <i class="icon bi bi-sun-fill"></i>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="requestfullscreen nav-link btn-icon">
          <i class="icon bi bi-arrows-angle-expand"></i>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="exitfullscreen nav-link btn-icon" style="display: none;">
          <i class="icon bi bi-arrows-angle-contract"></i>
        </a>
      </li>
      <li class="dropdown nav-item">
        <a class="dropdown-toggle btn-icon" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false">
          <i class="icon bi bi-translate"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
          <?php
          foreach ($aLangs as $lang) {
            ?>
            <a class="dropdown-item change-language <?php echo ($lang->Id === $oLang->Id ? 'active' : ''); ?>" data-value="<?php echo $lang->Id; ?>" data-code="<?php echo $lang->Code; ?>" data-dir="<?php echo $lang->Dir; ?>" data-name="<?php echo $lang->Name; ?>">
              <?php echo $lang->Name; ?>
            </a>
            <?php
          }
          ?>
        </div>
      </li>
      <li class="dropdown nav-item">
        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false">
          <img class="img-xs rounded-circle" src="assets/media/avatars/manager<?php echo $oUser->GenderId; ?>.png" alt="User" />
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
          <a class="dropdown-item" href="user/changePassword">
            <i class="icon bi bi-key"></i><?php echo getLabel("lbl.cms.Change Password"); ?>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger logout" href="#">
            <i class="icon bi bi-box-arrow-right"></i><?php echo getLabel("lbl.cms.Sign Out"); ?>
          </a>
        </div>
      </li>
    </ul>
  </div>
</header>
