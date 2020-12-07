<div class="box ">
  <table style="width: 100%" > 
  <?php foreach ($data_table as $row) {
    foreach ($data_field as $key){ if($key->name!='id'){?>
    <tr >
      <td class="text-right" style="width: 50%;" >
        <?=strtoupper($key->name);?>
      </td>
      <td style="column-width: 10%">:</td>
      <td class="text-left" style="text-align: justify;" >
          <?=$row[$key->name];?>
      </td>
    </tr>
  <?php }}} ?>
  </table>
</div>
