<h2><?php echo $headline; ?></h2>
<?php
if (isset($flash_data)) {
  echo $flash_data;
}
 ?>
<?php echo anchor('store_categories/create/x/'.$parent_category,'Create New Category(on this level)');
 echo nbs(7);
if ($parent_category>0) {
  # code...
  echo anchor('store_categories/create/'.$parent_category,'Update Parent Category');
}


?>


<?php echo Modules::run('store_categories/_display_categories_table',$parent_category);?>
