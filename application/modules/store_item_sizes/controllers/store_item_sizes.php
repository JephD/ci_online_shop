<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_item_sizes extends MX_Controller
{

function __construct() {
parent::__construct();
}

function ditch($value)
{
  $item_id=$this->uri->segment(4);
  $this->_delete($value);
  redirect('store_item_sizes/update/'.$item_id);
}

function _display_sizes($item_id)
{
  $data['query']=$this->get_where_custom('item_id',$item_id);
  $data['item_id']=$item_id;
  $this->load->view('display_sizes',$data);

}

function update($value)
{
  $submit=$this->input->post('submit',TRUE);
  $item_size=trim($this->input->post('item_size',TRUE));
  if ($submit=='Cancel') {
    redirect('store_items/create/'.$value);
  }
  if (($submit=='Submit' && $item_size!="")) {
    $data['item_id']=$value;
    $data['item_size']=$item_size;
    $this->_insert($data);
  }
  $data['item_id']=$value;
  $data['form_location']=current_url();;
  $template="admin";
  $data['view_file']="update";
  $this->load->module('template');
  $this->template->$template($data);
}

function get($order_by) {
$this->load->model('mdl_store_item_sizes');
$query = $this->mdl_store_item_sizes->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_item_sizes');
$query = $this->mdl_store_item_sizes->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_item_sizes');
$query = $this->mdl_store_item_sizes->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_item_sizes');
$query = $this->mdl_store_item_sizes->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_item_sizes');
$this->mdl_store_item_sizes->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_item_sizes');
$this->mdl_store_item_sizes->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_item_sizes');
$this->mdl_store_item_sizes->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_item_sizes');
$count = $this->mdl_store_item_sizes->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_item_sizes');
$max_id = $this->mdl_store_item_sizes->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_item_sizes');
$query = $this->mdl_store_item_sizes->_custom_query($mysql_query);
return $query;
}

}
