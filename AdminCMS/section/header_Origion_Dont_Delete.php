<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center justify-content-between">

  <div class="d-flex align-items-center justify-content-between">

    <div class="d-flex">
      <i class="bi bi-list toggle-sidebar-btn"></i>
      <!--
      <span class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">PhSoft</span>
      </span>
      -->
    </div>

    <div class="d-none d-sm-block d-flex align-items-center justify-content-center justify-content-sm-start px-3">
      <h4 class="d-none d-sm-block"></h4>
    </div>

    <div class="search-bar d-none">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input class="form-control" type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

  </div><!-- End Logo -->

  <nav class="header-nav text-end">
    <ul class="d-flex align-items-center">

      <!-- Start Search Icon
      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item">
        <span class="nav-link nav-icon btn">
          <i id="dir-rtl" class="dir-toggle bi bi-caret-left  <?php echo ($nDir == 1) ? 'd-none' : '' ?>" title="Right to Left" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Right to Left" data-bs-custom-class="tooltip-primary-bg"></i>
          <i id="dir-ltr" class="dir-toggle bi bi-caret-right <?php echo ($nDir == 0) ? 'd-none' : '' ?>" title="Left to Right" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Left to Right" data-bs-custom-class="tooltip-primary-bg"></i>
        </span>
      </li>

      <li class="nav-item">
        <a class="nav-link nav-icon" href="#">
          <i id="theme-dark" class="theme-toggle bi bi-record-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-primary-bg" data-bs-title="Toggle Theme" title="Toggle Theme"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link nav-icon" href="#">
          <i id="setting-bar" class="bi bi-gear" target="#settingsBar" aria-controls="settingsBar" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-animation="true"  data-bs-custom-class="tooltip-primary-bg" data-bs-title="Settings" title="Settings"></i>
        </a>
      </li>

      <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Notifications">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-primary-bg" data-bs-title="Notifications" title="Notifications">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>Lorem Ipsum</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>30 min. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
              <h4>Atque rerum nesciunt</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>1 hr. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
              <h4>Sit rerum fuga</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>2 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
              <h4>Dicta reprehenderit</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>4 hrs. ago</p>
            </div>
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Messages" title="Messages">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
              <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center px-0" href="#" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle px-2"><?php echo $oUser->Name; ?></span>
          <img src="assets/media/avatars/manager1.png" alt="Profile" class="rounded-circle">
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $oUser->Name; ?></h6>
            <span><?php echo $oUser->oGrp->Name; ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="settings">
              <i class="bi bi-gear"></i>
              <span>Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="logout">
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
