<div class="card-body">
  <table class="table table-bordered table-hover" id="vakses"> 
    <thead>
      <tr class="bg-primary">
        <th>No</th>
        <th>Menu</th>
        <th>View</th>
        <th>Add</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Print</th>
        <th>Upload</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($data_menu as $row) {

        ?>
        <tr>
          <td class="bg-success"><?=$i++;?></td>
          <td class="bg-success"><?=$row->nama_menu?></td>
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
          <td style="background-color: #edebe6">
        <div style="pointer-events:none; ">
            <i class="fa fa-times-circle text-red btn"></i>
          </div>
        </td>
        <td style="background-color: #edebe6">
        <div style="pointer-events:none; ">
          <i class="fa fa-times-circle text-red btn"></i>
        </div>
      </td>
      <td style="background-color: #edebe6">
        <div style="pointer-events:none; ">
          <i class="fa fa-times-circle text-red btn"></i>
        </div>
      </td>
      <td style="background-color: #edebe6">
        <div style="pointer-events:none; ">
          <i class="fa fa-times-circle text-red btn"></i>
        </div>
      </td>
      <td style="background-color: #edebe6">
        <div style="pointer-events:none; ">
          <i class="fa fa-times-circle text-red btn"></i>
        </div>
      </td>
    </tr>
    <?php 

    foreach ($data_submenu as $sub ) {
      if ($sub->id_menu==$row->id_menu) {
        ?>
        <tr>
          <td></td>
          <td><?= $sub->nama_submenu?></td>
          <td>
            <?php if ($sub->view_level=="Y") {?>
              <div  onClick="vchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
                <i class="fas fa-check-circle text-success btn"></i>
              </div>
            <?php }else{ ?>
              <div  onClick="vunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
                <i class="fa fa-times-circle text-red btn"></i>
              </div>
            <?php } ?>
          </td>
          <td>
           <?php if ($sub->add_level=="Y") {?>
            <div  onClick="addchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
              <i class="fas fa-check-circle text-success btn"></i>
            </div>
          <?php }else{ ?>
            <div  onClick="addunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
              <i class="fa fa-times-circle text-red btn"></i>
            </div>
          <?php } ?>
        </td>
        <td>
         <?php if ($sub->edit_level=="Y") {?>
          <div  onClick="editchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fas fa-check-circle text-success btn"></i>
          </div>
        <?php }else{ ?>
          <div  onClick="editunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fa fa-times-circle text-red btn"></i>
          </div>
        <?php } ?>
      </td>
      <td>
        <?php if ($sub->delete_level=="Y") {?>
          <div  onClick="delchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fas fa-check-circle text-success btn"></i>
          </div>
        <?php }else{ ?>
          <div  onClick="delunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fa fa-times-circle text-red btn"></i>
          </div>
        <?php } ?>
      </td>
      <td>
        <?php if ($sub->print_level=="Y") {?>
          <div  onClick="printchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fas fa-check-circle text-success btn"></i>
          </div>
        <?php }else{?>
          <div  onClick="printunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fa fa-times-circle text-red btn"></i>
          </div>
        <?php } ?>
      </td>
      <td>
        <?php if ($sub->upload_level=="Y") {?>
          <div  onClick="uplchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fas fa-check-circle text-success btn"></i>
          </div>
        <?php }else{ ?>
          <div  onClick="uplunchecked('<?=$sub->id?>','<?=$sub->id_level?>')">
            <i class="fa fa-times-circle text-red btn"></i>
          </div>
        <?php } ?>
      </td>
    </tr>
    <?php 
  }
} ?>
<?php 
} ?>
</tbody>
</table>
</div>

<script type="text/javascript">

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
  function vchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/view_akses') ?>',
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

  function vunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/view_akses') ?>',
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

  function addchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/add_akses') ?>',
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

  function addunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/add_akses') ?>',
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

  function editchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/edit_akses') ?>',
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

  function editunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/edit_akses') ?>',
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

  function delchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/delete_akses') ?>',
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

  function delunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/delete_akses') ?>',
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

  function uplchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/upload_akses') ?>',
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

  function uplunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/upload_akses') ?>',
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
  function printchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/print_akses') ?>',
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

  function printunchecked(id, level) {
    $.ajax({
      type : 'POST',
      url : '<?=base_url('userlevel/print_akses') ?>',
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