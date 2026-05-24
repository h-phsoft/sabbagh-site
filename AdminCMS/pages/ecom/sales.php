<div class="pagetitle">
  <div class="row">
    <div class="col-12 col-md-3">
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
    <div class="col-12 col-md-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
    </div>
    <div class="col-12 col-md-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center">
    </div>
    <div class="col-12 col-md-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-end">
      <?php include "section/btn_new.php" ?>
    </div>
  </div>
</div>

<div class="container">
  <div class="row pt-2">
    <div class="col-md-12">
      <div class="card card-custom">
        <div class="card-body">
          <div class="row pt-2">
            <div class="col-md-2 text-center">
              <button id="result-type-0" class="result-type btn btn-warning" data-val="0"><i class="bi bi-grid"></i></button>
              <button id="result-type-1" class="result-type btn btn-outline-warning" data-val="1"><i class="bi bi-view-stacked"></i></button>
              <button id="result-type-2" class="result-type btn btn-outline-warning" data-val="2"><i class="bi bi-hdd-stack"></i></button>
            </div>
            <div class="col-md-8 text-center">
              <?php
              if ($perms->Query) {
                ?>
                <input id="ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />
                <?php
              }
              ?>
            </div>
            <div class="col-md-2 text-center">
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-6 text-start">
              <h5 class="modal-title" id="ph_ModalLabel"><?php echo getLabel($requestProg->Name); ?></h5>
            </div>
            <div class="col-6 text-end">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form id="ph_Form">
          <div class="tab-content">
            <div class="row pt-1">
              <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
              <label for="fldCustomer" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Customer'); ?></label>
              <div class="col-md-4">
                <input id="fldCustomer" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
              </div>
              <label for="fldCMobile" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Mobile'); ?></label>
              <div class="col-md-4">
                <input id="fldCMobile" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
              </div>
            </div>
            <div class="row pt-1">
              <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
              <label for="fldCAddress" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Address'); ?></label>
              <div class="col-md-10">
                <input id="fldCAddress" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
              </div>
            </div>
            <div class="row pt-1">
              <label for="fldCatId" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Category'); ?></label>
              <div class="col-md-4">
                <input id="fldCatId" type="hidden" value="" required="true" />
                <input id="fldCatName" class="form-control form-control-sm" type="text" value="" autocomplete="off" disabled="true" />
              </div>
              <label for="fldBrandId" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Brand'); ?></label>
              <div class="col-md-4">
                <input id="fldBrandId" type="hidden" value="" required="true" />
                <input id="fldBrandName" class="form-control form-control-sm" type="text" value="" autocomplete="off" disabled="true" />
              </div>
            </div>
            <div class="row pt-1">
              <label for="fldProdId" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Product'); ?></label>
              <div class="col-md-10">
                <input id="fldProdId" type="hidden" value="" required="true" />
                <input id="fldProdName" class="form-control form-control-sm" type="text" value="" autocomplete="off" disabled="true" />
              </div>
            </div>
            <div class="row pt-1">
              <label for="fldSerial" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Serial'); ?></label>
              <div class="col-md-4">
                <input id="fldSerial" data-acoperation="/Product/Autocomplete" type="hidden" value="" required="true" />
                <input id="fldSerialName" class="form-control form-control-sm phAutocomplete" data-acoperation="/Serial/Autocomplete" data-callback="getAutoSerial" data-params="" data-acrel="fldSerial" type="text" value="" autocomplete="off" required="true" />
              </div>
              <label for="fldWdays" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Warranty'); ?></label>
              <div class="col-md-4">
                <input id="fldWdays" class="form-control form-control-sm" type="number" value="" dir="ltr" autocomplete="off" required="true" />
              </div>
            </div>
            <div class="row pt-1">
              <label for="fldMdate" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Start Date'); ?></label>
              <div class="col-md-4">
                <input id="fldMdate" class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo ph_GetCurrentDate(); ?>" required="true" />
              </div>
              <label for="fldEdate" class="col-form-label col-md-2 text-center text-md-end"><?php echo getLabel('Expire Date'); ?></label>
              <div class="col-md-4">
                <input id="fldEdate" class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" required="true" />
              </div>
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
