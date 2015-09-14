<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template extends MX_Controller
{

function __construct() {
parent::__construct();
}

public function admin($data)
{
  Modules::run('site_security/check_is_admin');
  $this->load->view('admin',$data);
}
}
