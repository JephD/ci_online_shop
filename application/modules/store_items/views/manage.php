<h2>Manage your Products</h2>
<?php
if (isset($flash_data)) {
  echo $flash_data;
}
 ?>
<?php echo anchor('store_items/create','New Item');?>
<?php echo Modules::run('store_items/_display_items_table');?>
