<table cellpadding="7" cellspacing="0" border="0" width="600">
  <tr style="text-align:left">
    <th>Count</th>
    <th>Category Name  </th>
    <th>Action  </th>
  </tr>
  <?php
  $count=0;
  foreach ($query->result() as $row) {
     $count++;
    ?>
  <tr>
    <td>
      <?php echo $count; ?>
    </td>
    <td>
      <?php echo $row->category_name; ?>
    </td>
    <td>
      <!-- <?php echo anchor('store_categories/create/'.$row->id,'Edit'); ?> -->
      <?php echo anchor('store_categories/manage/'.$row->id,'Edit'); ?>
    </td>
  </tr>
  <?php } ?>
</table>
