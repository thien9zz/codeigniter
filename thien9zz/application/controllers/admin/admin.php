<?php
class admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }
   function index()
   {
        $input = array();
        $list = $this->Admin_model->get_list($input);
        $this->data['list'] = $list;
        $total = $this->Admin_model->get_total();
        $this->data['total'] = $total;
       $this->data['temp'] = 'admin/admin/index';
       $this->load->view('admin/main', $this->data);
   }
   function add()
   {
      $this->load->library('form_validation');
      $this->load->helper('form');
      if ($this->input->post()) {
        $this->form_validation->set_rules('name', 'Tên', 'required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('username', 'Tài Khoản Đăng Nhập', 'required');
        $this->form_validation->set_rules('password', 'Mật Khẩu', 'required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('re_password', 'Nhập lại mật khâu', 'matches');
        if ($this->form_validation->run()) {
          # code...
          $name = $this->input->post('name');
          $username = $this->input->post('username');
          $password = $this->input->post('password');

          $data = array(
            'name' => $name,
            'username' => $username,
            'password' => md5($password)
          );
          if($this->Admin_model->create($data))
          {
            echo 'Thành Công';
          }else
          {
            echo 'Không thêm thành công';
          }
        }
      }
      $this->data['temp'] = 'admin/admin/add';
      $this->load->view('admin/main', $this->data);
   }
}               