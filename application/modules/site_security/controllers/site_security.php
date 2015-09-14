<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_security extends MX_Controller
{

function __construct() {
parent::__construct();
}
 function check_is_admin($value='')
 {
   # code...
   //user must login as admin
   return TRUE;
 }
}
