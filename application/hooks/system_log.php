<?php

class SystemLog {
    private $CI;

    public function log() {
        $this->CI =& get_instance();
        $data = array(
                        ':request_url' => '',
                        ':request_method' => '',
                        ':model' => '',
                        ':function' => '',
                        ':user_id' => 0,
                        ':ip' => '',
                        ':agent' => '',
                        ':data'=>''
                    );
        $data[':model'] = $this->CI->router->fetch_directory() . $this->CI->router->fetch_class();
        $data[':function'] = $this->CI->router->fetch_method();

        $user = $this->CI->auth_model->is_login();
        if ($user)
        {
            $data[':user_id'] = $user['id'];
        }

        $data[':ip'] = trim($this->CI->input->ip_address());

        if (isset($_SERVER['HTTP_USER_AGENT']))
        {
            $data[':agent'] = trim($_SERVER['HTTP_USER_AGENT']);
        }

        if ($this->CI->uri->uri_string())
        {
            $data[':request_url'] = $this->CI->uri->uri_string();
        }
        $data[':request_method'] = $_SERVER['REQUEST_METHOD'];

        if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if (isset($_GET) && count($_GET) > 0)
            {
                $data[':data'] = json_encode($_GET);
            }
        }
        else {
            // 未試 file upload, RESTFul
            // POST JSON

            if (isset($_SERVER["CONTENT_TYPE"]) && preg_match('/application\/json/', $_SERVER["CONTENT_TYPE"]))
            {
                $input = file_get_contents('php://input');
                if ($input)
                {
                    $data[':data'] = $input;
                }
            }
            else // POST
            {
                if (isset($_POST) && count($_POST) > 0)
                {
                    $data[':data'] = json_encode($_POST);
                }
            }
        }


        // if (isset($_COOKIE))
        // {
        //     $data[':cookie'] = json_encode($_COOKIE);
        // }

        $sql = "INSERT INTO `system_log`
                        SET request_url=:request_url,
                            request_method=:request_method,
                            model=:model,
                            function=:function,
                            user_id=:user_id,
                            ip=:ip,
                            agent=:agent,
                            data=:data,
                            enterdate=now()";
        $query = $this->CI->db->conn_id->prepare($sql);
        // print_r($data);
        $query->execute($data);
    }
}