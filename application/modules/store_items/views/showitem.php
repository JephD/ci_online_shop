<?php echo "<h1>" .$item['item_name']."<h1>"; ?>
  <div class="row">
    <div class="col-md-4">
      <?php $pic_path=base_url().'itempics/'.$item['big_pic'] ?>
      <img src="<?php echo $pic_path; ?>" alt="Item" />
    </div>
    <div class="col-md-4" style="padding:20px 20px 20px 40px;">
      <?php
       $price=number_format($item['item_price'],2);
       $price=str_replace(".00","",$price);
      echo "<p style='font-size:26px;'>Price: Ksh ".$price."</p>"; ?>
      <?php echo "<p style='font-size:14px;'>".nl2br($item['item_description'])."</p>"; ?>
    </div>
    <div class="col-md-4">
      <?php echo Modules::run('cart/_display_cart_items',$item_id,$price); ?>
    </div>

  </div>
