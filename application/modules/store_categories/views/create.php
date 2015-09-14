<h2><?php echo $headline;?></h2>

<?php if ($category_id>0): ?>
  <!-- <?php echo anchor('store_item_colors/update/'.$category_id,'Update Item Color')."&nbsp&nbsp";?> -->

  <?php echo anchor('store_categories/delete_catetory/'.$category_id,'Delete Category')."&nbsp&nbsp<br><br>";?>
<?php endif; ?>

<?php echo (isset($flash_data)?$flash_data:"");?>


<?php echo validation_errors('<p style="color:red">','</p>');?>
<?php echo form_open($form_location);?>
Category Name: <?php echo form_input('category_name',$category_name)."<br><br>";?>

 <?php echo form_submit('submit',"Submit")."<br><br>";?>
<?php echo form_close();;?>
