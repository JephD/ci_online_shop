<h2>Upload Item Pic</h2>
<?php
 if (isset($error)) {
   # code...
   foreach ($error as $fault) {
     echo $fault;
   }
 }
 ?>
<?php echo form_open_multipart('store_items/do_upload/'.$item_id);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
