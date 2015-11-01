<?php
class User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('My_Pagination');
        $this->load->helper('error_queue');
        $this->error = new Error_Queue();
    }

    public function get_list($page = 1, $page_num = 10, $where_sql = null, $where_data = null)
    {
        $sql = "SELECT *
                  FROM `user`
                  $where_sql
                 ORDER BY id DESC";
        $data = $this->my_pagination->sql_execute($this->db->conn_id, $sql, $where_data, $page, $page_num);
        return $data;
    }

    public function get($id)
    {
        $id = intval($id);
        if (!$id)
        {
            return null;
        }

        $sql = "SELECT * FROM `user` WHERE id=:id";
        $query = $this->db->conn_id->prepare($sql);
        $query->execute(array(':id' => $id));
        $result = $query->fetchAll();
        return ($result) ? $result[0] : null;
    }

    public function get_error()
    {
        return $this->error->get_queue();
    }

    public function clear_error()
    {
        $this->error->clear();
    }
}