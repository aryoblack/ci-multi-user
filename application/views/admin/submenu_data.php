
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data submenu</h3>
            <div class="text-right">
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_submenu()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
              <a  href="<?php echo base_url('submenu/download'); ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_submenu" title="Download"><i class="fas fa-download"></i> Download</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabelsubmenu" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-info">
                  <th>Nama submenu</th>
                  <th>Link</th>
                  <th>Icon</th>
                  <th>Menu</th>
                  <th>Is Active</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<!-- Modal Hapus-->
<div class="modal fade" id="myModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="idhapus" id="idhapus">
        <p>Apakah anda yakin ingin menghapus submenu <strong class="text-konfirmasi"> </strong> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title ">View Submenu</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="md_def">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->  


<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table =$("#tabelsubmenu").DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "sEmptyTable": "Data submenu Belum Ada"
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('submenu/ajax_list')?>",
          "type": "POST"
        },
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
            "targets": [ -1 ], //last column
            "render": function ( data, type, row ) {

             
              if (row[4]=="N") { 
                return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vsubmenu("+row[5]+")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_submenu("+row[5]+")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama="+row[0]+"  onclick=\"delsubmenu("+row[5]+")\"><i class=\"fas fa-trash\"></i></a>"
              }else{
               return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vsubmenu("+row[5]+")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_submenu("+row[5]+")\"><i class=\"fas fa-edit\"></i></a>";
             }

           },
            "orderable": false, //set not orderable
          },
          ],
        });

 //set input/textarea/select event when change value, remove class error and remove text help block 
 $("input").change(function(){
  $(this).parent().parent().removeClass('has-error');
  $(this).next().empty();
  $(this).removeClass('is-invalid');
});
 $("textarea").change(function(){
  $(this).parent().parent().removeClass('has-error');
  $(this).next().empty();
  $(this).removeClass('is-invalid');
});
 $("select").change(function(){
  $(this).parent().parent().removeClass('has-error');
  $(this).next().empty();
  $(this).removeClass('is-invalid');
});

});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


//view
// $(".v_submenu").click(function(){
  function vsubmenu(id){
    $('.modal-title').text('View Submenu');
    $("#modal-default").modal();
    $.ajax({
      url : '<?php echo base_url('submenu/viewsubmenu'); ?>',
      type : 'post',
      data : 'table=tbl_submenu&id='+id,
      success : function(respon){

        $("#md_def").html(respon);
      }
    })


  }


  function delsubmenu(id){

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url:"<?php echo site_url('submenu/delete');?>",
          type:"POST",
          data:"id_submenu="+id,
          cache:false,
          dataType: 'json',
          success:function(respone){
            if (respone.status == true) {
              reload_table();
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                );
            }else{
              Toast.fire({
                icon: 'error',
                title: 'Delete Error!!.'
              });
            }
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
          )
      }
    })
  }



  function add_submenu()
  {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Submenu'); // Set Title to Bootstrap modal title
  }

  function edit_submenu(id){
   save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('submenu/editsubmenu')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {

        $('[name="id"]').val(data.id_submenu);
        $('[name="id_menu"]').val(data.id_menu);
        $('[name="id_submenu"]').val(data.id_submenu);
        $('[name="nama_submenu"]').val(data.nama_submenu);
        $('[name="link"]').val(data.link);
        $('[name="icon"]').val(data.icon);
        $('[name="is_active"]').val(data.is_active);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Submenu'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
  }

  function save()
  {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
      url = "<?php echo site_url('submenu/insert')?>";
    } else {
      url = "<?php echo site_url('submenu/update')?>";
    }

    // ajax adding data to database
    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {

            if(data.status) //if success close modal and reload ajax table
            {
              $('#modal_form').modal('hide');
              reload_table();
              Toast.fire({
                icon: 'success',
                title: 'Success!!.'
              });
            }
            else
            {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
              }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

          }
        });
  }

</script>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title">Person Form</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/> 
          <div class="card-body">
            <div class="form-group row">
              <label for="id_menu" class="col-sm-3 col-form-label">Menu</label>
              <div class="col-sm-9 kosong">
                <select class="form-control" name="id_menu" id="id_menu" >
                  <option value="" selected disabled>Pilih Menu</option>
                  <?php 
                  foreach ($menu as $menus):
                    echo "<option value='$menus->id_menu' $sel>$menus->nama_menu</option>";
                  endforeach; ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row ">
              <label for="nama_submenu" class="col-sm-3 col-form-label">Nama submenu</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control"  name="nama_submenu" id="nama_submenu" placeholder="Nama submenu" >
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row ">
              <label for="link" class="col-sm-3 col-form-label">Link</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="link" id="link" placeholder="Link" >
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row ">
              <label for="icon" class="col-sm-3 col-form-label">Icon</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" >
                <span class="help-block"></span>
              </div>
            </div>
            
            <div class="form-group row ">
              <label for="is_active" class="col-sm-3 col-form-label">Is Active</label>
              <div class="col-sm-9 kosong">
                <select class="form-control" name="is_active" id="is_active" >
                  <option value="" selected disabled>Pilih Active</option>
                  <option value="Y">Y</option>
                  <option value="N">N</option>
                </select>
                <span class="help-block"></span>
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