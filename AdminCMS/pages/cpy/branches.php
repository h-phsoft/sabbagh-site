<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
?>
<section class="content-main">
  <div class="content-header">
    <div>
      <div class="row">
        <h2 class="content-title">
          <i class="icon-xxl <?php echo $requestProg->Icon; ?>"></i>
          <?php echo getLabel($requestProg->Name); ?>
        </h2>
        <div>
          <?php echo $vBreadCrumb; ?>
        </div>
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
                <input id="ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />
              </div>
              <div class="col-sm-2 text-center">
              </div>
            </div>
            <div class="row pt-2">
              <div class="col-12 text-center">
                <div id="pagingTop" class="pagination d-flex justify-content-center"></div>
              </div>
            </div>
            <div class="row pt-2 g-2" id="resultData">

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
</section>

<div class="modal fade" id="ph_Modal" tabindex="-1" role="dialog" aria-labelledby="ph_Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ph_ModalLabel"><?php echo getLabel($requestProg->Name); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <form id="ph_Form">
          <div class="row pt-1">
            <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
            <label for="fldName" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('lbl.cms.Name'); ?></label>
            <div class="col-sm-10">
              <input id="fldName" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
            </div>
          </div>
          <div class="row pt-1">
            <label for="fldPhone" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('lbl.cms.Phone'); ?></label>
            <div class="col-sm-5">
              <input id="fldPhone" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
            </div>
          </div>
          <div class="row pt-1">
            <label for="fldAddress" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('lbl.cms.Address'); ?></label>
            <div class="col-sm-10">
              <input id="fldAddress" class="form-control form-control-sm" type="text" value="" autocomplete="off" />
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
            <span class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="bottom" title="<?php echo getLabel("lbl.cms.Close"); ?>">
              <i class="bi bi-box-arrow-left"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
