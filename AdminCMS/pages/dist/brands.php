<?php
$vBreadCrumb = Ph_getBreadCrumb($requestProg);
$aSuppliers = cDistSuppliers::getArray();
?>
<section class="content-main">
  <div class="contaner-fluid mb-3">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="content-title">
          <i class="icon-xxl <?php echo $requestProg->Icon; ?>"></i>
          <?php echo getLabel($requestProg->Name); ?>
        </h2>
        <div>
          <?php echo $vBreadCrumb; ?>
        </div>
      </div>
      <div class="col-6 col-sm-3 text-start">
        <?php
        if ($perms->Query === 1) {
          ?>
          <button id="result-type-0" class="result-type btn btn-warning" data-val="0"><i class="bi bi-grid"></i></button>
          <button id="result-type-1" class="result-type btn btn-outline-warning" data-val="1"><i class="bi bi-table"></i></button>
          <?php
        }
        ?>
      </div>
      <div class="col-6 col-sm-3 text-end">
        <?php
        if ($perms->Insert === 1) {
          include "section/btn_new.php";
        }
        ?>
      </div>
    </div>
  </div>

  <div id="content-list" class="container">
    <div class="row pt-2">
      <div class="col-sm-12">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row pt-2">
              <?php
              if ($perms->Query) {
                ?>
                <div class="col-sm-3 ps-0">
                  <input id="ph-search-text" class="form-control form-control-sm text-center" type="text" value="" autocomplete="off" required="true" />
                </div>
                <div class="col-sm-1 text-start align-self-center">
                  <span id="resultCount"></span>
                </div>
                <?php
              }
              ?>
            </div>
          </div>
          <div class="row pt-2">
            <div class="col-12 text-center">
              <div id="pagingTop" class="pagination d-flex justify-content-center"></div>
            </div>
          </div>
          <div class="row p-2 g-3" id="resultData">
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

  <div id="content-form" class="container d-none">
    <form id="ph_Form">
      <div class="row">
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-custom">
                <div class="card-body">
                  <div class="row pt-1 mb-4">
                    <div class="col-sm-12">
                      <h2><?php echo getLabel('lbl.cms.Basic'); ?></h2>
                    </div>
                  </div>
                  <input id="fldId" type="hidden" value="0"/>
                  <div class="row pt-1">
                    <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
                    <label for="fldSupplierId" class="col-form-label col-sm-2 text-end"><?php echo getLabel('lbl.cms.SupplierId'); ?></label>
                    <div class="col-12 col-sm-4">
                      <select id="fldSupplierId" class="form-control form-control-sm form-select">
                        <?php
                        foreach ($aSuppliers as $element) {
                          ?>
                          <option value="<?php echo $element->Id; ?>"><?php echo $element->Name; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <label for="fldName" class="col-form-label col-sm-2 text-end"><?php echo getLabel('lbl.cms.Name'); ?></label>
                    <div class="col-12 col-sm-4">
                      <input id="fldName" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="card card-custom">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12 text-center">
                      <div class="row">
                        <div class="col-sm-10 mx-auto p-2">
                          <label for="fldFile" class="btn btn-outline-secondary" data-toggle="tooltip" title="Change image" data-original-title="<?php echo getLabel('lbl.cms.Change Image'); ?>">
                            <i class="bi bi-file-image"></i>&nbsp;&nbsp;<?php echo getLabel('lbl.cms.Select Image'); ?>
                          </label>
                          <input id="fldImage" class="form-control form-control-sm" type="hidden" value="" autocomplete="off" required="true" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="w-100 p-0 text-center">
                            <input id="fldFile" type="file" class="fileField d-none" accept="image/*" value="" data-previewer="fldImagePreview" data-relfld="fldAttach" data-filename="fldFileName"  data-relname="fldFName" data-relext="fldFExt" data-folder="itemcat">
                            <input id="fldFName" type="hidden" value="">
                            <input id="fldFileName" type="hidden" value="">
                            <input id="fldFExt" type="hidden" value="">
                            <input id="fldAttach" type="hidden" value="">
                            <img id="fldImagePreview" src="" width="100%">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <?php
              if ($perms->Insert === 1 || $perms->Update === 1) {
                include "section/btn_submit.php";
              }
              ?>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>

</section>

