<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php lng("Logout") ?></h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php lng("Are you sure you want to log out?") ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal"><?php lng("Cancel") ?></button>
        <button id="logout_confirm_button" type="button" class="btn btn-danger"><?php lng("Logout") ?></button>
      </div>
    </div>
  </div>
</div>
<?php
