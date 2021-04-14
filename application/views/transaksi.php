
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Transaksi</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_trx()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tbl_trx" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info">
                                    <th>No Transaksi</th>
                                    <th>Tgl Masuk</th>
                                    <th>Tgl Ambil</th>
                                    <th>Pelanggan</th>
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

<script type="text/javascript">
var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table =$("#tbl_trx").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "sEmptyTable": "Data Transaksi Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('transaksi/ajax_list')?>",
            "type": "POST"
        },
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
            "targets": [ -1 ], //last column
            "render": function ( data, type, row ) {

                return "<a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_trx("+row[4]+")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama="+row[0]+"  onclick=\"deltrx("+row[4]+")\"><i class=\"fas fa-trash\"></i></a>";

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
 $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
          dropdownParent: $('#modal_form'),
          tags: true
      })

    })

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

function add_trx()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Add Transaksi'); // Set Title to Bootstrap modal title
}

function edit_trx(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('aplikasi/edit_aplikasi')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="nama_owner"]').val(data.nama_owner);
            $('[name="alamat"]').val(data.alamat);
            $('[name="tlp"]').val(data.tlp);
            $('[name="title"]').val(data.title);
            $('[name="nama_aplikasi"]').val(data.nama_aplikasi);
            $('[name="copy_right"]').val(data.copy_right);
            $('[name="tahun"]').val(data.tahun);
            $('[name="versi"]').val(data.versi);
            if (data.logo==null) {
                var image = "<?php echo base_url('assets/foto/logo/Logo.png')?>";
                $("#v_image").attr("src",image);
            }else{
                var image = "<?php echo base_url('assets/foto/logo/')?>";
                $("#v_image").attr("src",image+data.logo);
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Aplikasi'); // Set title to Bootstrap modal title

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
    var url = "<?php echo site_url('aplikasi/update')?>";
    var formdata = new FormData($('#form')[0]);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formdata,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
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
<div class="modal fade" id="modal_form"  role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <!-- header -->

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
                           <label  class="col-sm-3 col-form-label">Pelanggan</label>
                           <div class="col-sm-9 kosong">
                            <select class="form-control select2"  id="pelanggan" name="pelanggan">
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

