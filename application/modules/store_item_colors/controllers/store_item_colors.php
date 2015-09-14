<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_item_colors extends MX_Controller
{

function __construct() {
parent::__construct();
}

function ditch($value)
{
  $item_id=$this->uri->segment(4);
  $this->_delete($value);
  redirect('store_item_colors/update/'.$item_id);
}

function _display_colors($item_id)
{
  $data['query']=$this->get_where_custom('item_id',$item_id);
  $data['item_id']=$item_id;
  $this->load->view('display_colors',$data);

}

function update($value)
{
  $submit=$this->input->post('submit',TRUE);
  $item_color=trim($this->input->post('item_color',TRUE));
  if ($submit=='Cancel') {
    redirect('store_items/create/'.$value);
  }
  if (($submit=='Submit' && $item_color!="")) {
    $data['item_id']=$value;
    $data['item_color']=$item_color;
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
$this->load->model('mdl_store_item_colors');
$query = $this->mdl_store_item_colors->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_item_colors');
$query = $this->mdl_store_item_colors->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_item_colors');
$query = $this->mdl_store_item_colors->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_item_colors');
$query = $this->mdl_store_item_colors->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_item_colors');
$this->mdl_store_item_colors->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_item_colors');
$this->mdl_store_item_colors->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_item_colors');
$this->mdl_store_item_colors->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_item_colors');
$count = $this->mdl_store_item_colors->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_item_colors');
$max_id = $this->mdl_store_item_colors->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_item_colors');
$query = $this->mdl_store_item_colors->_custom_query($mysql_query);
return $query;
}

}
