<?php
$aBrands = cEcomBrand::getArray();
$aCats = cEcomCat::getArray();
$aStatuss = cPhsCode::getArray(cPhsCode::STATUS);
$aTags = cEcomTag::getArray();
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
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ph_ModalLabel"><?php echo getLabel($requestProg->Name); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <form id="ph_Form">
          <div class="row">
            <div class="col-sm-8 py-2">
              <div class="row pt-1">
                <input id="fldId" class="form-control form-control-sm" type="hidden" value="0" autocomplete="off" required="true" />
                <label for="fldMnum" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Number'); ?></label>
                <div class="col-sm-4">
                  <input id="fldMnum" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldBrandId" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Brand'); ?></label>
                <div class="col-sm-4">
                  <select id="fldBrandId" class="form-control form-control-sm form-select">
                    <?php
                    foreach ($aBrands as $element) {
                      ?>
                      <option value="<?php echo $element->Id; ?>"><?php echo $element->Name1; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <label for="fldCatId" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Category'); ?></label>
                <div class="col-sm-4">
                  <select id="fldCatId" class="form-control form-control-sm form-select">
                    <?php
                    foreach ($aCats as $element) {
                      ?>
                      <option value="<?php echo $element->Id; ?>"><?php echo $element->Name1; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldStatusId" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Status'); ?></label>
                <div class="col-sm-4">
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
                <label for="fldTagId" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Tag'); ?></label>
                <div class="col-sm-4">
                  <select id="fldTagId" class="form-control form-control-sm form-select">
                    <?php
                    foreach ($aTags as $element) {
                      ?>
                      <option value="<?php echo $element->Id; ?>"><?php echo $element->Name; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldName1" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Name1'); ?></label>
                <div class="col-sm-10">
                  <input id="fldName1" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldName2" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Name2'); ?></label>
                <div class="col-sm-10">
                  <input id="fldName2" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldQnt" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Qnt'); ?></label>
                <div class="col-sm-4">
                  <input id="fldQnt" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldPrice" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Price'); ?></label>
                <div class="col-sm-4">
                  <input id="fldPrice" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
                <label for="fldCprice" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Currenct Price'); ?></label>
                <div class="col-sm-4">
                  <input id="fldCprice" class="form-control form-control-sm" type="text" value="" autocomplete="off" required="true" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldDesc1" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Ingrediens'); ?></label>
                <div class="col-sm-10">
                  <input id="fldDesc1" class="form-control form-control-sm" type="text" value="" autocomplete="off" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldDesc3" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Contains'); ?></label>
                <div class="col-sm-10">
                  <input id="fldDesc3" class="form-control form-control-sm" type="text" value="" autocomplete="off" />
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldDesc4" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('May Contain'); ?></label>
                <div class="col-sm-10">
                  <input id="fldDesc4" class="form-control form-control-sm" type="text" value="" autocomplete="off"/>
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldDesc5" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('More Details'); ?></label>
                <div class="col-sm-10">
                  <input id="fldDesc5" class="form-control form-control-sm" type="text" value="" autocomplete="off"/>
                </div>
              </div>
              <div class="row pt-1">
                <label for="fldDesc2" class="col-form-label col-sm-2 text-center text-sm-end"><?php echo getLabel('Daily Values'); ?></label>
                <div class="col-sm-10">
                  <input id="fldDesc2" class="form-control form-control-sm" type="text" value="" autocomplete="off"/>
                </div>
              </div>
            </div>
            <div class="col-sm-4 text-center">
              <div class="row">
                <div class="col-sm-6 mx-auto p-2">
                  <label for="fldFile" class="btn btn-primary" data-toggle="tooltip" title="Change image" data-original-title="<?php echo getLabel("Change Image"); ?>">
                    <?php echo getLabel("Change Image"); ?> <i class="bi bi-file-image"></i>
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
                    <img id="fldImagePreview" class="border border-info border-1" src="" width="50%">
                  </div>
                </div>
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
