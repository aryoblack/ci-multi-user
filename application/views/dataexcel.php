<?php
header('Chace-Control: no-store, no-cache, must-revalation');
header('Chace-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="EXPORT_DATA_'.strtoupper($table).'.xls"');
  foreach($data_field as $row){ 
    if($row->name!='id'){
      $field1[]="<td>".strtoupper(substr($row->name,0,1)).substr($row->name,1)."</td>"; 
      $field2[] = $row->name; 
    }
  }
  $count = count($field2)-1;
  $field=join('',$field1);
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>export</title>
</head>
<body>
 EXPORT DATA <?=strtoupper($table).' '.gmdate('Y-m-d H:i:s',time()+60*60*7);?>
  <table border="1">
    <tr>
      <td>No</td>
      <?=$field;?>
    </tr>
    <?php $no=1; foreach ($data_table as $key) { ?>
    <tr>
      <td><?=$no;?></td>
      <?php for($i=0; $i<=$count; $i++) { ?>
      <td>
        <?=$key[$field2[$i]];?>
      </td>
      <?php } ?>
    </tr>
    <?php $no=$no+1; } ?>
  </table>
</body>
</html>
<?php
exit();
?>
 

