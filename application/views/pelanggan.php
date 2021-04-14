
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-light">
						<h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Pelanggan</h3>
						<div class="text-right">
							<button type="button" class="btn btn-sm btn-outline-primary" onclick="add_pel()" title="Add Data"><i class="fas fa-plus"></i> Add</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="tbl_pel" class="table table-bordered table-striped table-hover">
							<thead>
								<tr class="bg-info">
									<th>Nama Pelanggan</th>
									<th>No Telpon</th>
									<th>Alamat</th>
									<th>Saldo</th>
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
    table =$("#tbl_pel").DataTable({
    	"responsive": true,
    	"autoWidth": false,
    	"language": {
    		"sEmptyTable": "Data Pelanggan Belum Ada"
    	},
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
        	"url": "<?php echo site_url('pelanggan/ajax_list')?>",
        	"type": "POST"
        },
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
            "targets": [ -1 ], //last column
            "render": function ( data, type, row ) {

            	return "<a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_pel("+row[4]+")\"><i class=\"fas fa-edit\"></i></a><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" nama="+row[0]+"  onclick=\"delpel("+row[4]+")\"><i class=\"fas fa-trash\"></i></a>";

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

//delete
function delpel(id){

    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {

        $.ajax({
        url:"<?php echo site_url('pelanggan/delete');?>",
        type:"POST",
        data:"id="+id,
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
})
}
function add_pel()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal({backdrop: 'static', keyboard: false}); // show bootstrap modal
    $('.modal-title').text('Add Pelanggan'); // Set Title to Bootstrap modal title
}

function edit_pel(id){
	save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
    	url : "<?php echo site_url('pelanggan/edit_pel')?>/" + id,
    	type: "GET",
    	dataType: "JSON",
    	success: function(data)
    	{

    		$('[name="id"]').val(data.id);
    		$('[name="nama"]').val(data.nama);
    		$('[name="alamat"]').val(data.alamat);
    		$('[name="notelp"]').val(data.no_telp);
            $('[name="saldo"]').val(data.saldo);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pelanggan'); // Set title to Bootstrap modal title

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
        if(save_method == 'add') {
        url = "<?php echo site_url('pelanggan/insert')?>";
    } else {
        url = "<?php echo site_url('pelanggan/update')?>";
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">

            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" >
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pelanggan" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="notelp" class="col-sm-3 col-form-label">No Telpon</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control"  name="notelp" id="notelp" placeholder="No Telpon" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group row ">
                            <label for="deposit" class="col-sm-3 col-form-label">Saldo</label>
                            <div class="col-sm-9 kosong">
                                <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" >
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