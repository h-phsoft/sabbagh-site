<div class="pagetitle">
  <div class="row">
    <div class="col-12 col-sm-3">
      <div class="row">
        <div class="col-12">
          <h1><?php echo getLabel("Slider"); ?></h1>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-start">
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center">
    </div>
    <div class="col-12 col-sm-3 pt-1 pt-sm-0 d-flex align-items-center justify-content-center justify-content-sm-end">
      <?php include "section/btn_submit.php" ?>
      <?php include "section/btn_new.php" ?>
    </div>
  </div>
</div>

<section>
  <div class="row">
    <div class="col-sm-6 mx-auto">
      <div class="card card-custom">
        <div class="card-body">
          <form>
            <div class="row">
              <input id="fldId" type="hidden" value="0">
              <label for="fldOrder" class="col-sm-1 col-3 form-label text-start text-sm-end ps-sm-0 ps-3" data-label="Num"><?php echo getLabel('Order') ?></label>
              <div class="col-sm-3 py-sm-0 py-2">
                <input id="fldOrder" class="form-control form-control-sm" type="text">
              </div>
              <div class="col-sm-8 py-sm-0 py-2">
                <div class="input-group input-group-sm">
                  <input id="fldFile" class="form-control" type="file" accept="image/*">
                  <input id="fldAttache" type="hidden">
                </div>
              </div>
            </div>
            <div class="row pt-2">
              <div class="col-sm-5 mx-auto p-0" style="width: 250px; height: 150px;">
                <img id="fldImg" src="" class="img-thumbnail imgprod w-100 h-100">
              </div>
            </div>
          </form>
          <div class="row pt-2">
            <div class="col-sm-12 overflow-y-auto">
              <div id="tableData">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
