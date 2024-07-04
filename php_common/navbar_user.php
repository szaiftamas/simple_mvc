<div class="d-flex align-items-center" id="navbarUserContent">
  <span class="fw-bold" id="username">
    Hi, <?php echo $_SESSION[$GLOBALS["site"]]['user']; ?>
  </span>
  <a class="nav-link ms-2" id="navbarUserDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
    <img class="header-img" src="./img_common/user-details.png" alt="">
  </a>
  <ul class="dropdown-menu ul-fix-md-width dropdown-menu-md-end" aria-labelledby="navbarUserDropdown">
    <li>
      <a class="dropdown-item" data-mdb-toggle="modal" data-mdb-target="#logoutModal">
        <?php lng("Logout") ?>
      </a>
    </li>
    <li>
      <a class="dropdown-item" data-mdb-toggle="modal" data-mdb-target="#chgpswModal">
        <?php lng("Change Password") ?>
      </a>
    </li>
  </ul>
</div>
<?php
