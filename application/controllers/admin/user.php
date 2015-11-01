<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        $this->_set_sidebar('user');
        $this->breadcrumb = array();
        $this->breadcrumb[] = array("url"=>"/admin/user", "title"=>$this->lang->line('user_management'));
    }

    public function index()
    {
        $page = $this->input->get('page');

        $page_num = 10;

        $url = "";
        $where_sql = "";
        $where_data = array();
        $this->data['filter'] = array(
                                        'account' => '',
                                        'name'    => '',
                                     );
        $account = htmlspecialchars($this->input->get('account'), ENT_QUOTES);
        if ($account)
        {
            $url .= "&account=$account";
            $where_sql .= "AND account LIKE :account ";
            $where_data[':account'] = "%$account%";
            $this->data['filter']['account'] = $account;
        }

        $name = htmlspecialchars($this->input->get('name'), ENT_QUOTES);
        if ($name)
        {
            $url .= "&name=$name";
            $where_sql .= "AND name LIKE :name ";
            $where_data[':name'] = "%$name%";
            $this->data['filter']['name'] = $name;
        }

        if ($where_sql)
        {
            $where_sql = "WHERE " . substr($where_sql, 3);
            $url = "?" . substr($url, 1);
        }
        //get data
        $lists = $this->user_model->get_list($page, $page_num, $where_sql, $where_data);
        $this->data['lists'] = $lists;

        //pagination
        $this->load->library('My_Pagination');
        $this->data['pagination'] = $this->my_pagination->html("/admin/user" . $url, $page, $page_num, $lists['total_rows']);

        //view
        $this->_set_breadcrumb($this->breadcrumb);
        $this->data['html_js'] = $this->load->view('admin/user_js', $this->data, true);
        $this->data['html_main_content'] = $this->load->view('admin/user', $this->data, true);
        $this->load->view('admin/template/main', $this->data);
    }
}
