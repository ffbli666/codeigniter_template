<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auth extends API_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $account = $this->input->get_post('account');
        $password = trim($this->input->get_post('password'));

        if (!$account || !$password) {
            echo $this->_error('Please input account and password');
            return;
        }

        $user = $this->auth_model->get_user($account);
        if (!$user)
        {
            echo $this->_error('Not found user');
            return;
        }

        if (md5($password) !== $user['password'])
        {
            echo $this->_error('Password Error');
            return;
        }

        $this->session->set_userdata(array('id' => $user['id'], 'account' => $user['account']));
        echo $this->_success('success');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        echo $this->_success('success');
    }
}
