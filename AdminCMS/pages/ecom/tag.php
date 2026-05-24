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

<div class="modal fade" id="ph_Modal" tabindex="-1" role="dialog" aria-labelledby="ph_Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ph_ModalLabel"><?php echo getLabel($requestProg->Name); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <form id="ph_Form">
              <div class="row pt-1">
                <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
                <label for="fldStatusId" class="col-form-label col-sm-2 text-center"><?php echo getLabel('StatusId'); ?></label>
                <div class="col-sm-2">
                  <select id="fldStatusId" class="form-control form-control-sm form-select">
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
                <label for="fldName" class="col-form-label col-sm-2 text-center"><?php echo getLabel('Name'); ?></label>
                <div class="col-sm-10">
                  <input id="fldName" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldClassname" class="col-form-label col-sm-2 text-center"><?php echo getLabel('Classname'); ?></label>
                <div class="col-sm-10">
                  <input id="fldClassname" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
            </form>
          </div>
        </div>
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
