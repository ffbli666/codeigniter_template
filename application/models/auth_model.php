<?php
class Auth_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function _get_user_session() {
        return array(
            'id' => $this->session->userdata('id'),
            'account' => $this->session->userdata('account'),
        );
    }

    function is_login()
    {
        $user = $this->_get_user_session();
        if (!$user['id'])
            return false;
        return $user;
    }

    function get_user($account)
    {
        $account = trim(htmlspecialchars($account, ENT_QUOTES));
        if (!$account)
        {
            return null;
        }
        $sql = 'SELECT * FROM user WHERE account=:account';
        $query = $this->db->conn_id->prepare($sql);
        $query->execute(array(':account' => $account));
        $result = $query->fetchAll();
        return ($result) ? $result[0] : null;
    }
}