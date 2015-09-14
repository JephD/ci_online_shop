<h2>Update Color</h2>


<?php echo Modules::run('store_item_colors/_display_colors',$item_id); ?>

<?php echo form_open($form_location);

      echo form_input('item_color','');
      echo nbs(3);
      echo form_submit('submit','Submit');
      echo nbs(3);
      echo form_submit('submit','Cancel');
      echo form_close();
?>
