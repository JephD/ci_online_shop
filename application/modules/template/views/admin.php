<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
  </head>
  <body>
    <h2><?php echo anchor('dashboard/home','Admin Panel');?> </h2>

    <?php
     if (!isset($module)) {
       $module=$this->uri->segment(1);
     }

      if (!isset($view_file)) {
        $module=$this->uri->segment(2);
      }

       if ($module!="" && $view_file!="") {
         $path=$module."/".$view_file;
         $this->load->view($path);
       }

     ?>
  </body>
</html>
