<h2>Update Sizes</h2>


<?php echo Modules::run('store_item_sizes/_display_sizes',$item_id); ?>

<?php echo form_open($form_location);

      echo form_input('item_size','');
      echo nbs(3);
      echo form_submit('submit','Submit');
      echo nbs(3);
      echo form_submit('submit','Cancel');
      echo form_close();
?>
