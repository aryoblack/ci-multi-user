    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Menu</h3>
                <div class="text-right">

                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_menu()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
                  <a href="<?php echo base_url('menu/download') ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_menu" target="_blank" title="Download"><i class="fas fa-download"></i> Download</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelmenu" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info">
                      <th>Nama Menu</th>
                      <th>Link</th>
                      <th>Icon</th>
                      <th>Urutan</th>
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
            <p>Apakah anda yakin ingin menghapus menu <strong class="text-konfirmasi"> </strong> ?</p>
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
            <h4 class="modal-title ">View Menu</h4>
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

 table =$("#tabelmenu").DataTable({
  "responsive": true,
  "autoWidth": false,
  "language": {
    "sEmptyTable": "Data menu Belum Ada"
  },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('menu/ajax_list')?>",
          "type": "POST"
        },
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
            "targets": [ -1 ], //last column
            "render": function ( data, type, row ) {


              if (row[4]=="N") { 
                return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vmenu("+row[5]+")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_menu("+row[5]+")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"delmenu("+row[5]+")\"><i class=\"fas fa-trash\"></i></a>"
              }else{
               return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"vmenu("+row[5]+")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_menu("+row[5]+")\"><i class=\"fas fa-edit\"></i></a>";
             }

           },
            "orderable": false, //set not orderable
          },
          ],
        });
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
function vmenu(id){
  $('.modal-title').text('View Menu');
  $("#modal-default").modal('show');
  $.ajax({
    url : '<?php echo base_url('menu/viewmenu'); ?>',
    type : 'post',
    data : 'table=tbl_menu&id='+id,
    success : function(respon){
      $("#md_def").html(respon);
    }
  })
}

//delete
function delmenu(id){

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
        url:"<?php echo site_url('menu/delete');?>",
        type:"POST",
        data:"id_menu="+id,
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




function add_menu()
{
  save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Menu'); // Set Title to Bootstrap modal title
  }

  function edit_menu(id){
   save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('menu/editmenu')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {

        $('[name="id_menu"]').val(data.id_menu);
        $('[name="nama_menu"]').val(data.nama_menu);
        $('[name="link"]').val(data.link);
        $('[name="urutan"]').val(data.urutan);
        $('[name="icon"]').val(data.icon);
        $('[name="is_active"]').val(data.is_active);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Menu'); // Set title to Bootstrap modal title

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
      url = "<?php echo site_url('menu/insert')?>";
    } else {
      url = "<?php echo site_url('menu/update')?>";
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
                $('[name="'+data.inputerror[i]+'"]').closest('.kosong').append('<span></span>');
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
          <input type="hidden" value="" name="id_menu"/> 
          <div class="card-body">
            <div class="form-group row ">
              <label for="nama_menu" class="col-sm-3 col-form-label">Nama Menu</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu">
              </div>
            </div>
            <div class="form-group row ">
              <label for="link" class="col-sm-3 col-form-label">Link</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="link" id="link" placeholder="Link">
              </div>
            </div>
            <div class="form-group row ">
              <label for="icon" class="col-sm-3 col-form-label">Icon</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
              </div>
            </div>
            <div class="form-group row ">
              <label for="urutan" class="col-sm-3 col-form-label">Urutan</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan">
              </div>
            </div>
            <div class="form-group row ">
              <label for="is_active" class="col-sm-3 col-form-label">Is Active</label>
              <div class="col-sm-9 kosong">
                <select class="form-control" name="is_active" id="is_active">
                  <option value=""></option>
                  <option value="Y">Y</option>
                  <option value="N">N</option>
                </select>
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