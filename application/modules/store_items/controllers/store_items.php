<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_items extends MX_Controller
{

function __construct() {
parent::__construct();
}


function _display_items_table()
{
   $data['query']=$this->get('item_name');
  $this->load->view('items_table',$data);


}

function show()
{
  # code...
  $item_id=$this->uri->segment(3);
   $data['item'] =$this->get_data_from_db($item_id);
   $data['item_id']=$item_id;

  $template="shop_front";
  $data['view_file']="showitem";
  $this->load->module('template');
  $this->template->$template($data);
}

function do_upload($item_id)
{
  # code...
    $config['upload_path'] = './itempics/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2024';
		$config['max_height']  = '2768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$data['error'] = array('error' => $this->upload->display_errors("<p style='color:red'>","</p>"));
      $data['item_id']=$item_id;
      $template="admin";
      $data['view_file']="upload_pic";
      $this->load->module('template');
      $this->template->$template($data);

		}
		else
		{
      $data =$this->upload->data();
      $file_name=$data['file_name'];
      //create a thumbnail
      $config['image_library'] = 'gd2';
      $config['source_image']	= './itempics/'.$file_name;
      $config['create_thumb'] = TRUE;
      $config['maintain_ratio'] = TRUE;
      $config['width']	= 137;
      $config['height']	= 137;

      $this->load->library('image_lib', $config);
      $this->image_lib->resize();

      //resize the larger image
      $newwidth=400;
      $newheight=400;
      $this->_resize_pic($file_name,$newheight,$newwidth);

      $raw_file_name=$data['raw_name'];
      $file_ext=$data['file_ext'];

      unset($data);
      $data['small_pic']=$raw_file_name."_thumb".$file_ext;
      $data['big_pic']=$file_name;
      $this->_update($item_id,$data);



		}
}

function _resize_pic($file_name,$newheight,$newwidth)
{
  $config['image_library'] = 'gd2';
  $config['source_image']	= './itempics/'.$file_name;
  $config['create_thumb'] = FALSE;
  $config['maintain_ratio'] = TRUE;
  $config['width']	= $newwidth;
  $config['height']	= $newheight;

  $this->image_lib->initialize($config);
  $this->load->library('image_lib', $config);
  $this->image_lib->resize();

}

function upload_pic($value='')
{
  # code...
  $data['item_id']=$value;
  $template="admin";
  $data['view_file']="upload_pic";
  $this->load->module('template');
  $this->template->$template($data);

}

function get_data_from_post($value='')
{
  # code...
  $data['item_name']=$this->input->post('item_name',TRUE);
  $data['item_price']=$this->input->post('item_price',TRUE);
  $data['item_description']=$this->input->post('item_description',TRUE);
  return $data;
}

function get_data_from_db($item_id)
{
  $query=$this->get_where($item_id);
  foreach ($query->result() as $row) {
    $data['item_name']=$row->item_name;
    $data['item_price']=$row->item_price;
    $data['small_pic']=$row->small_pic;
    $data['big_pic']=$row->big_pic;
    $data['item_url']=$row->item_url;
    $data['item_description']=$row->item_description;

  }
  if (!isset($data)) {
    $data="";
    # code...
  }
  return $data;
}

function delete_item($item_id)
{
  $this->_delete($item_id);
  $value='<p style="color:green">Item Deleted Successfully</p>';
  $this->session->set_flashdata('item',$value);
  redirect('store_items/manage');

}

function submit($value='')
{
  $this->load->library('form_validation');

		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_price', 'Item Price', 'required|is_numeric');
		$this->form_validation->set_rules('item_description', 'Item Description', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			$this->create();
		}
		else
		{
      $update_id=$this->uri->segment(3);
      if ($update_id>0) {
        $data=$this->get_data_from_post();
        $data['item_url']=url_title($data['item_name']);
        $this->_update($update_id,$data);
        $value='<p style="color:green">Item updated Successfully</p>';
        $item_id=$update_id;
      }else{

			$data=$this->get_data_from_post();
      $data['item_url']=url_title($data['item_name']);
      $this->_insert($data);
      $item_id=$this->get_max();
      $value='<p style="color:green">Item Created Successfully</p>';
    }
      $this->session->set_flashdata('item',$value);
      redirect('store_items/create/'.$item_id);
		}

}

function create()
{
  $item_id=$this->uri->segment(3);
  $data=$this->get_data_from_post();
  $submit=$this->input->post('submit',TRUE);
  if ($item_id>0) {

    if ($submit!="Submit") {
      $data=$this->get_data_from_db($item_id);
    }
    $data['headline']="Edit Item";
  }else{
    $data['headline']="Create New Item";
  }
  $current_url=current_url();
  $data['form_location']=str_replace('/create','/submit',$current_url);
  $data['item_id']=$item_id;
  $flash=$this->session->flashdata('item');
  if ($flash!="") {
    $data['flash_data']=$flash;
  }
  $template="admin";
  $data['view_file']="create";
  $this->load->module('template');
  $this->template->$template($data);
}

function manage($value='')
{
  $template="admin";
 $flash=$this->session->flashdata('item');
  if ($flash!="") {
    $data['flash_data']=$flash;
  }

  $data['view_file']="manage";
  $this->load->module('template');
  $this->template->$template($data);
}

function get($order_by) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get($order_by);
return $query;
}



function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_items');
$this->mdl_store_items->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_items');
$count = $this->mdl_store_items->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_items');
$max_id = $this->mdl_store_items->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_items');
$query = $this->mdl_store_items->_custom_query($mysql_query);
return $query;
}

}
