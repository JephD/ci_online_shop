<h2><?php echo $headline;?></h2>

<?php if ($item_id>0): ?>
  <?php echo anchor('store_item_colors/update/'.$item_id,'Update Item Color')."&nbsp&nbsp";?>
  <?php echo anchor('store_item_sizes/update/'.$item_id,'Update Item Sizes')."&nbsp&nbsp";?>
  <?php echo anchor('store_items/upload_pic/'.$item_id,'Update Item Pic')."&nbsp&nbsp";?>
  <?php echo anchor('store_items/delete_item/'.$item_id,'Delete Item')."&nbsp&nbsp<br><br>";?>
<?php endif; ?>

<?php echo (isset($flash_data)?$flash_data:"");?>


<?php echo validation_errors('<p style="color:red">','</p>');?>
<?php echo form_open($form_location);?>
Item Name: <?php echo form_input('item_name',$item_name)."<br><br>";?>
Item Price: <?php echo form_input('item_price',$item_price)."<br><br>";?>
Item Description: <?php echo form_textarea('item_description',$item_description)."<br><br>";?>
 <?php echo form_submit('submit',"Submit")."<br><br>";?>
<?php echo form_close();;?>
