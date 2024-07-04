<div class="modal fade" id="chgpswModal" tabindex="-1" aria-labelledby="chgpswModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php lng("Change Password") ?></h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="password" class="form-control" id="old_psw" placeholder="<?php lng("Old password") ?>" required>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="new_psw" placeholder="<?php lng("New password") ?>" required>
              <div class="input-group-append">
                <span id="password_show_hide_span" class="input-group-text h-100">
                  <svg id="show_eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                  </svg>
                  <svg id="hide_eye" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                  </svg>
                </span>
              </div>
          </div>
          <div class="col">
            <div class="row"><span class="text-primary"><?php lng("It should be at least 8 characters long: ********") ?></span></div>
            <div class="row"><span class="text-primary"><?php lng("It must have a number: [0 to 9]") ?></span></div>
            <div class="row"><span class="text-primary"><?php lng("It must have a capital alphabet: [A to Z]") ?></span></div>
            <div class="row"><span class="text-primary"><?php lng("It must have a small alphabet: [a to z]") ?></span></div>
            <div class="row"><span class="text-primary"><?php lng("It must have a special character: [!, @, #, $, %, ^, &, *]") ?></span></div>
          </div>
          <div class="col">

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-mdb-dismiss="modal"><?php lng("Cancel") ?></button>
        <button id="chgpsw_confirm_button" type="button" class="btn btn-danger"><?php lng("Change") ?></button>
      </div>
    </div>
  </div>
</div>
<?php

