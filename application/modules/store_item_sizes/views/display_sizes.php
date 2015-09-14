<?php
 $num_rows=$query->num_rows();

 if ($num_rows>0) {
   echo "<h3>Available Sizes</h3>";

   foreach ($query->result() as $row) {

     echo $row->item_size." ".anchor('store_item_sizes/ditch/'.$row->id.'/'.$item_id,'<span style="color:red">Delete</span>').nbs(4);

   }
   echo "<br><br>";

 }

 ?>
