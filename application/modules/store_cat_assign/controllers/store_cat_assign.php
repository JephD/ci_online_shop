<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_cat_assign extends MX_Controller
{

function __construct() {
parent::__construct();
}

function assign($value='')
{
  # code...
  $template="admin";
  $data['view_file']="assign";
  $this->load->module('template');
  $this->template->$template($data);
}

function get($order_by) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_cat_assign');
$count = $this->mdl_store_cat_assign->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_cat_assign');
$max_id = $this->mdl_store_cat_assign->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->_custom_query($mysql_query);
return $query;
}

}
