<div class="card-body">
  <table class="table table-striped table-bordered" id="vakses"> 
    <thead>
      <tr class="bg-gray">
        <th>Menu</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($data_menu as $row) {
        $i++;
        ?>
        <tr>
          <td><?=$row->nama_menu?></td>
          <td>
          <?php if ($row->view_level=="Y") {?>
            <div id="vcek<?=$i.$row->id?>" onClick="checked('<?=$row->id?>','<?=$row->id_level?>')">
            <i class="fas fa-check-circle text-success btn"></i>
          </div>
          
          <?php }else{?>
            <div id="vucek<?=$i.$row->id?>" onClick="unchecked('<?=$row->id?>','<?=$row->id_level?>')">
              <i class="fa fa-times-circle text-red btn"></i>
            </div>

          <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  var table;
  $(document).ready(function() {
     table= $("#vakses").DataTable({
    "responsive": true,
    "autoWidth": false,
    "orderable": false,
  });
  });
function reload_table()
{
    table.ajax.reload();
}


function checked(id, level) {
  $.ajax({
    type : 'POST',
    url : '<?=base_url('userlevel/update_akses') ?>',
    data : 'chek=checked&id='+id,
    success : function (data) {
  $.ajax({
    url : '<?php echo base_url('userlevel/view_akses_menu'); ?>',
    type : 'post',
    data : 'id='+level,
    success : function(respon){
      $("#md_def").html(respon);
    }
  })
    }
  });
}
function unchecked(id, level) {
  $.ajax({
    type : 'POST',
    url : '<?=base_url('userlevel/update_akses') ?>',
    data : 'chek=unchecked&id='+id,
    success : function (data) {
     
  $.ajax({
    url : '<?php echo base_url('userlevel/view_akses_menu'); ?>',
    type : 'post',
    data : 'id='+level,
    success : function(respon){
      $("#md_def").html(respon);
    }
  })
    }
  });
}
</script>