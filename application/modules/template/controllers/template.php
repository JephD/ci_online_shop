<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template extends MX_Controller
{

function __construct() {
parent::__construct();
}

 function admin($data)
{
  Modules::run('site_security/check_is_admin');
  $this->load->view('admin',$data);
}

function shop_front($data)
{

 Modules::run('site_security/check_is_admin');
 $this->load->view('shop_front',$data);
}

}
