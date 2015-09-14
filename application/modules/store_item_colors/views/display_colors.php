<?php
 $num_rows=$query->num_rows();

 if ($num_rows>0) {
   echo "<h3>Available Colors</h3>";

   foreach ($query->result() as $row) {

     echo $row->item_color." ".anchor('store_item_colors/ditch/'.$row->id.'/'.$item_id,'<span style="color:red">Delete</span>').nbs(4);

   }
   echo "<br><br>";

 }

 ?>
