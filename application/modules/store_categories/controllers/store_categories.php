<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_categories extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _display_categories_table($parent_category)
{
  # code...
  $data['query']=$this->get_where_custom('parent_category',$parent_category);
  $this->load->view('categories_table',$data);
}

function get_category_name($id)
{
  # code...
  $data=$this->get_data_from_db($id);
  $category_name=$data['category_name'];
  return $category_name;
}

function manage()
{
  # code...
  $template="admin";
  $parent_category=$this->uri->segment(3);

   if ($parent_category<1 || (!is_numeric($parent_category))) {
     # code...
     $parent_category=0;
   }
   if ($parent_category>0) {
     # code...
     $data['headline']="Manage ".$this->get_category_name($parent_category);
   }else {
     # code...
     $data['headline']="Manage Categories";
   }
   $data['parent_category']=$parent_category;

  $flash=$this->session->flashdata('item');
  if ($flash!="") {
    $data['flash_data']=$flash;
  }

  $data['view_file']="manage";
  $this->load->module('template');
  $this->template->$template($data);
}

function delete_catetory($category_id)
{
  # code...
  $this->_delete($category_id);
  $value='<p style="color:green">Category Deleted Successfully</p>';
  $this->session->set_flashdata('item',$value);
  redirect('store_categories/manage');

}

function get_data_from_post($value='')
{
  # code...
  $data['category_name']=$this->input->post('category_name',TRUE);

  return $data;
}
function get_data_from_db($category_id)
{
  $query=$this->get_where($category_id);
  foreach ($query->result() as $row) {
    $data['category_name']=$row->category_name;
    }
  if (!isset($data)) {
    $data="";
    # code...
  }
  return $data;
}


function create($category_id='')
{
  # code...
  // $item_id=$this->uri->segment(3);
   $data=$this->get_data_from_post();
   $submit=$this->input->post('submit',TRUE);
  if ($category_id>0) {

    if ($submit!="Submit") {//form not submitted
      $data=$this->get_data_from_db($category_id);
    }
    $data['headline']="Edit Category";
  }else{
    $data['headline']="Create New Category";
  }
  $current_url=current_url();
  $data['form_location']=str_replace('/create','/submit',$current_url);
  $data['category_id']=$category_id;
  $flash=$this->session->flashdata('item');
  if ($flash!="") {
    $data['flash_data']=$flash;
  }
  $template="admin";
  $data['view_file']="create";
  $this->load->module('template');
  $this->template->$template($data);
}

function submit()
{
  $this->load->library('form_validation');

		$this->form_validation->set_rules('category_name', 'Category Name', 'required');



		if ($this->form_validation->run() == FALSE)
		{
			$this->create();
		}
		else
		{
      $update_id=$this->uri->segment(3);
      $parent_category=$this->uri->segment(4);
      if (!is_numeric($parent_category)) {
        # code...
        $parent_category=0;
      }
      if ($update_id>0) {
        $data=$this->get_data_from_post();
        $data['category_url']=url_title($data['category_name']);
        $this->_update($update_id,$data);
        $value='<p style="color:green">Category updated Successfully</p>';
        $parent_category=$update_id;
      }else{

			$data=$this->get_data_from_post();
      $data['category_url']=url_title($data['category_name']);
      $data['parent_category']=$parent_category;
      $this->_insert($data);
      $update_id=$this->get_max();
      $value='<p style="color:green">Category Created Successfully</p>';
    }
      $this->session->set_flashdata('item',$value);
      redirect('store_categories/manage/'.$parent_category);
		}

}

function get($order_by) {
$this->load->model('mdl_store_categories');
$query = $this->mdl_store_categories->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_categories');
$query = $this->mdl_store_categories->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_categories');
$query = $this->mdl_store_categories->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_categories');
$query = $this->mdl_store_categories->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_categories');
$this->mdl_store_categories->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_categories');
$this->mdl_store_categories->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_categories');
$this->mdl_store_categories->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_categories');
$count = $this->mdl_store_categories->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_categories');
$max_id = $this->mdl_store_categories->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_categories');
$query = $this->mdl_store_categories->_custom_query($mysql_query);
return $query;
}

}
