<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content ">

      <div class="modal-header">
        <h3 class="modal-title">Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" >
          <input type="hidden" value="" name="id"/> 
          <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6">
                              <div class="form-group row ">
                               <label for="notrx" class="col-sm-3 col-form-label">No Transaksi</label>
                               <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="notrx" id="notrx" placeholder="Otomatis" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row ">
                           <label  class="col-sm-3 col-form-label">Pelanggan</label>
                           <div class="col-sm-9 kosong">
                            <select class="form-control select2bs4"  id="pelanggan" name="pelanggan">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->