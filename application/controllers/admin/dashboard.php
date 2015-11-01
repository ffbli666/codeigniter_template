<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->_set_sidebar('dashboard');
    }

    public function index()
    {
        $this->data['html_main_content'] = $this->load->view('admin/dashboard', $this->data, true);
        $this->load->view('admin/template/main', $this->data);
    }
}
