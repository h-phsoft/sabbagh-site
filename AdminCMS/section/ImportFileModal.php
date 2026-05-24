<div class="modal fade" id="import-file-select-Modal" aria-labelledby="Queries-ModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header px-2 py-1">
        <h5><?php echo getLabel("Match fields"); ?></h5>
      </div>
      <div class="modal-body" style="height: 70vh; overflow-y: auto;">
        <form id="">
          <div class="row">
            <div class="col-sm-1 d-hide">
              <label for="fld_import_File_Attach" class="btn btn-primary">
                <i class="bi bi-cloud-upload"></i>
              </label>
              <input id="fldFile" type="hidden" value="" >
              <input id="fld_import_File_Attach" type="file" value="" class="d-none">
            </div>
            <div class="col-sm-3 d-hide">
              <input id="fld_import_name_File" class="form-control form-control-sm" type="text" value="" disabled/>
            </div>
          </div>
          <div class="row pt-2">
            <div id="import-file-tableMain" class="col-sm-12 ">
              <table class="table table-bordered table-striped text-center ">
                <thead>
                  <tr>
                    <td style="width: 40%" class="import-hide-file">
                      <select id="import-file-localFile" class="form-control form-select w-100">
                      </select>
                    </td>
                    <td style="width: 40%" class="import-hide-file">
                      <select id="import-file-infoFile" class="form-control form-select w-100"">
                      </select>
                    </td>
                    <td class="import-hide-file" style="width: 10%; text-align: center;">
                      <button  id="import-file-addTable" class="btn btn-info toolbar-btn" >
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><?php echo getLabel("Required Columns"); ?></td>
                    <td><?php echo getLabel("File Columns"); ?></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody id="import-file-tbodyTable">
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer p-1">
        <button type="button" class="btn btn-secondary" title="<?php echo getLabel("Close"); ?>" data-bs-dismiss="modal">
          <i class="bi bi-x-lg"></i>
        </button>
        <button id="submit-import-file" class="btn btn-primary toolbar-btn" title="<?php echo getLabel("Save"); ?>" data-bs-title="<?php echo getLabel("Save"); ?>" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus">
          <i class="bi bi-check-lg"></i>
        </button>
      </div>
    </div>
  </div>
</div>
