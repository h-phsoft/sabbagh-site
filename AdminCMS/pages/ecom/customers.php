<?php
$aStatuss = cPhsCode::getArray(cPhsCode::STATUS);
?>
<div class="pagetitle">
  <div class="row">
    <div class="col-12 col-sm-3">
      <div class="row">
        <div class="col-12">
          <h1><?php echo getLabel($requestProg->Name); ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <?php echo Ph_getBreadCrumb($requestProg); ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center">
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-end">
      <?php include "section/btn_new.php" ?>
    </div>
  </div>
</div>

<div class="container">
  <div class="row pt-2">
    <div class="col-sm-12">
      <div class="card card-custom">
        <div class="card-body">
          <div class="row pt-2">
            <div class="col-sm-2 text-center">
              <button id="result-type-0" class="result-type btn btn-warning" data-val="0"><i class="bi bi-grid"></i></button>
              <button id="result-type-1" class="result-type btn btn-outline-warning" data-val="1"><i class="bi bi-view-stacked"></i></button>
              <button id="result-type-2" class="result-type btn btn-outline-warning" data-val="2"><i class="bi bi-hdd-stack"></i></button>
            </div>
            <div class="col-sm-8 text-center">
              <?php
              if ($perms->Query) {
                ?>
                <input id="ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />
                <?php
              }
              ?>
            </div>
            <div class="col-sm-2 text-center">
            </div>
          </div>
          <div class="row pt-2">
            <div class="col-12 text-center">
              <div id="pagingTop" class="pagination d-flex justify-content-center"></div>
            </div>
          </div>
          <div class="row pt-2 g-3" id="resultData">

          </div>
          <div class="row pt-2">
            <div class="col-12 text-center">
              <div id="pagingBottom" class="pagination d-flex justify-content-center"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel"><?php echo getLabel($requestProg->Name); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="ph_edit_form">
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Name'); ?></label>
            <div class="col-sm-4">
              <input id="editUserId" type="hidden" value="" />
              <input id="editUserName" class="form-control form-control-sm" type="text" value="" required="true" />
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Logon'); ?></label>
            <div class="col-sm-4">
              <input id="editUserLogon" class="form-control form-control-sm" type="text" value="" required="true" />
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('OrgNum'); ?></label>
            <div class="col-sm-4">
              <input id="editUserOrgnum" class="form-control form-control-sm" type="text" value="" required="true" />
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Status'); ?></label>
            <div class="col-sm-4">
              <select id="editUserStatus" class="form-control form-control-sm form-select">
                <?php
                foreach ($aStatuss as $element) {
                  ?>
                  <option value="<?php echo $element->Id; ?>"><?php echo $element->Name; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Mobile'); ?></label>
            <div class="col-sm-4">
              <input id="editUserMobile" class="form-control form-control-sm" type="text" value="" required="true" />
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Phone'); ?></label>
            <div class="col-sm-4">
              <input id="editUserPhone" class="form-control form-control-sm" type="text" value="" />
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Address'); ?></label>
            <div class="col-sm-10">
              <input id="editUserAddress" class="form-control form-control-sm" type="text" value="" />
            </div>
          </div>
        </form>
      </div>
      <div class="ph-modal-footer">
        <div class="row pt-1">
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-start">
            <?php include "section/btn_save.php" ?>
          </div>
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
          </div>
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-end justify-content-sm-end">
            <span class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("Close"); ?>">
              <i class="bi bi-box-arrow-left"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetPasswordModalLabel"><?php echo getLabel('Reset Password'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="ph_resetPassword_form">
          <div class="row pt-1">
            <label class="col-form-label col-sm-4 text-center"><?php echo getLabel('New Password'); ?></label>
            <div class="col-8">
              <input id="resetUserId" type="hidden" value="" />
              <input class="form-control form-control-sm" type="password" name="resetNPassword" id="resetNPassword" value="" required="true"/>
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-4 text-center"><?php echo getLabel('Verify Password'); ?></label>
            <div class="col-8">
              <input class="form-control form-control-sm" type="password"  name="resetVPassword" id="resetVPassword" value="" required="true"/>
            </div>
          </div>
        </form>
      </div>
      <div class="ph-modal-footer">
        <div class="row pt-1">
          <div class="col-6 pt-1 pt-sm-0 d-flex align-items-center justify-content-start">
            <span id="ph-reset" class="btn btn-warning mx-1" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel('Reset Password'); ?>">
              <i class="bi bi-key"></i>
            </span>
          </div>
          <div class="col-6 pt-1 pt-sm-0 d-flex align-items-center justify-content-end justify-content-sm-end">
            <span class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("Close"); ?>">
              <i class="bi bi-box-arrow-left"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel"><?php echo $requestProg->Name ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="ph_add_form">
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Name'); ?></label>
            <div class="col-sm-4">
              <input id="addUserName" class="form-control form-control-sm" type="text" value="" required="true"/>
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Logon'); ?></label>
            <div class="col-sm-4">
              <input id="addUserLogon" class="form-control form-control-sm" type="text" value="" required="true"/>
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('OrgNum'); ?></label>
            <div class="col-sm-4">
              <input id="addUserOrgnum" class="form-control form-control-sm" type="text" value="" required="true"/>
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Status'); ?></label>
            <div class="col-sm-4">
              <select id="addUserStatus" class="form-control form-control-sm form-select">
                <?php
                foreach ($aStatuss as $element) {
                  ?>
                  <option value="<?php echo $element->Id; ?>"><?php echo $element->Name; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Password'); ?></label>
            <div class="col-sm-4">
              <input class="form-control form-control-sm" type="password" name="addUsernpassword" id="addnpassword" value="" required="true"/>
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Verify Password'); ?></label>
            <div class="col-sm-4">
              <input class="form-control form-control-sm" type="password"  name="addUservpassword" id="addvpassword" value="" required="true"/>
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Mobile'); ?></label>
            <div class="col-sm-4">
              <input id="addUserMobile" class="form-control form-control-sm" type="text" value="" required="true"/>
            </div>
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Phone'); ?></label>
            <div class="col-sm-4">
              <input id="addUserPhone" class="form-control form-control-sm" type="text" value="" />
            </div>
          </div>
          <div class="row pt-1">
            <label class="col-form-label col-sm-2 text-center"><?php echo getLabel('Address'); ?></label>
            <div class="col-sm-10">
              <input id="addUserAddress" class="form-control form-control-sm" type="text" value="" />
            </div>
          </div>
        </form>
      </div>
      <div class="ph-modal-footer">
        <div class="row pt-1">
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-start">
            <?php include "section/btn_submit.php" ?>
          </div>
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
          </div>
          <div class="col-4 pt-1 pt-sm-0 d-flex align-items-center justify-content-end justify-content-sm-end">
            <span class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("Close"); ?>">
              <i class="bi bi-box-arrow-left"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
